<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\Itinerary;
use App\Models\ItineraryDay;
use App\Http\Requests\StoreItineraryRequest;
use App\Http\Requests\UpdateItineraryRequest;
use App\Http\Requests\StoreItineraryItemRequest;

class ItineraryController extends Controller
{
    public function index($inquiry_id){
        $inquiry = Inquiry::findOrFail($inquiry_id);
        $itineraries = $inquiry->itineraries()->with('days.items')->get();
        return view('admin-dashboard.itineraries.index', compact('inquiry', 'itineraries'));
    }

    public function create($inquiry_id){
        $inquiry = Inquiry::findOrFail($inquiry_id);
        return view('admin-dashboard.itineraries.create', compact('inquiry'));
    }

    public function store(StoreItineraryRequest $request, $inquiry_id){
        $itinerary = Itinerary::create(array_merge($request->validated(), [
            'inquiry_id' => $inquiry_id,
            'version' => 'v1',
            'status' => 'draft',
        ]));

        foreach($request->days as $index => $dayData){
            $itinerary->days()->create([
                'day_number' => $index + 1,
                'date' => $dayData['date'],
                'notes' => $dayData['notes'] ?? '',
            ]);
        }

        return redirect()->route('itinerary.edit', $itinerary->id)->with('success', 'Itinerary created successfully.');
    }

    public function edit($itinerary_id){
        $itinerary = Itinerary::with('days.items')->findOrFail($itinerary_id);
        return view('admin-dashboard.itineraries.edit', compact('itinerary'));
    }

    public function update(UpdateItineraryRequest $request, $itinerary_id){
        $itinerary = Itinerary::findOrFail($itinerary_id);
        $itinerary->update($request->validated());
        return redirect()->route('itinerary.edit', $itinerary->id)->with('success', 'Itinerary updated successfully.');
    }

    public function addItem(StoreItineraryItemRequest $request, $dayId)
    {
        $day = ItineraryDay::findOrFail($dayId);

        $item = $day->items()->create([
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'details' => $request->details,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'tax_fees' => $request->tax_fees ?? 0,
            'markup' => $request->markup ?? 0,
            'sort_order' => $day->items()->max('sort_order') + 1,
        ]);

        // Calculate total price (you can add this method in your model)
        $item->update(['total_price' => $item->calculateTotalPrice()]);

        return response()->json(['success' => true, 'item' => $item]);
    }

    public function createVersion(Request $request, $id)
    {
        $itinerary = Itinerary::with(['days.items'])->findOrFail($id);
        $newVersion = 'v' . ($itinerary->versions()->count() + 1);

        $itinerary->versions()->create([
            'version_number' => $newVersion,
            'change_log' => $request->change_log,
            'snapshot_data' => $itinerary->toArray(),
            'created_by' => auth('admins')->id(),
        ]);

        $itinerary->update(['version' => $newVersion]);

        return redirect()->back()->with('success', 'New version created successfully!');
    }

}