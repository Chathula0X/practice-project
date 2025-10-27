<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreItineraryRequest;
use App\Http\Requests\UpdateItineraryRequest;
use App\Models\Itinerary;
use App\Models\Inquiry;


class ItineraryController extends Controller
{
    public function constructor(){
        $this->middleware('auth');
    }

    public function index($inquiry_id){
        $inquiry = Inquiry::findOrFail($inquiry_id);
        $itineraries = Itinerary::where('inquiry_id', $inquiry_id)->get();
        return view('admin-dashboard.itinerary.index', compact('inquiry', 'itineraries'));
    }

    public function create($inquiry_id){
        $inquiry = Inquiry::findOrFail($inquiry_id);
        return view('admin-dashboard.itinerary.create', compact('inquiry'));
    }

    public function store(StoreItineraryRequest $request, $inquiry_id){
        $data = $request->validated();
        $data['inquiry_id'] = $inquiry_id;

        // Filter out empty activities
        $activities = $request->input('activities', []);
        $filteredActivities = array_filter($activities, function($activity) {
            return !empty($activity['name']) || !empty($activity['cost']);
        });
        
        $itinerary = new Itinerary([
            'inquiry_id' => $inquiry_id,
            'title' => $request->title,
            'destination' => $request->destination,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'accommodation' => $request->input('accommodation'),
            'transport' => $request->input('transport'),
            'activities' => array_values($filteredActivities),
            'notes' => $request->notes,
            'status' => 'draft',
        ]);
        
        // Calculate totals
        $itinerary->calculateTotals();
        $itinerary->save();

        return redirect()->route('itinerary.show', $itinerary->id)->with('success', 'Itinerary created successfully');
    }

    public function show($id){
        $itinerary = Itinerary::with(['inquiry.client'])->findOrFail($id);
        return view('admin-dashboard.itinerary.show', compact('itinerary'));
    }

    public function edit($itinerary_id){
        $itinerary = Itinerary::with(['inquiry.client'])->findOrFail($itinerary_id);
        return view('admin-dashboard.itinerary.edit', compact('itinerary'));
    }

    public function update(UpdateItineraryRequest $request, $itinerary_id){
        $itinerary = Itinerary::findOrFail($itinerary_id);
        
        // Filter out empty activities
        $activities = $request->input('activities', []);
        $filteredActivities = array_filter($activities, function($activity) {
            return !empty($activity['name']) || !empty($activity['cost']);
        });
        
        $itinerary->fill([
            'title' => $request->title ?? $itinerary->title,
            'destination' => $request->destination ?? $itinerary->destination,
            'start_date' => $request->start_date ?? $itinerary->start_date,
            'end_date' => $request->end_date ?? $itinerary->end_date,
            'accommodation' => $request->input('accommodation') ?? $itinerary->accommodation,
            'transport' => $request->input('transport') ?? $itinerary->transport,
            'activities' => !empty($filteredActivities) ? array_values($filteredActivities) : $itinerary->activities,
            'notes' => $request->notes ?? $itinerary->notes,
            'status' => $request->status ?? $itinerary->status,
        ]);
        
        // Recalculate totals
        $itinerary->calculateTotals();
        $itinerary->save();

        return redirect()->route('itinerary.show', $itinerary->id)->with('success', 'Itinerary updated successfully');
    }

    public function delete($itinerary_id){
        $itinerary = Itinerary::where('id', $itinerary_id)->first();
        $inquiry_id = $itinerary->inquiry_id;
        $itinerary->delete();
        return redirect()->route('itinerary.index', $inquiry_id)->with('success', 'Itinerary deleted successfully');
    }

    public function updateStatus(Request $request, $id){
        $request->validate([
            'status' => 'required|in:draft,pending,approved,rejected'
        ]);
        
        $itinerary = Itinerary::findOrFail($id);
        $itinerary->status = $request->status;
        $itinerary->save();
        
        return back()->with('success', 'Status updated successfully!');
    }
}
