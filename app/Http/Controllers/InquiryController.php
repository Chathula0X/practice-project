<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Inquiry;
use App\Http\Requests\StoreInquiryRequest;
use App\Http\Requests\UpdateInquiryRequest;


class InquiryController extends Controller
{
    public function index($client_id){
        $client = Client::with('inquiries')->findOrFail($client_id);
        return view('admin-dashboard.inquiries.index', compact('client'));
    }

    public function create($client_id){
        $client = Client::findOrFail($client_id);
        return view('admin-dashboard.inquiries.create', compact('client'));
    }

    public function store(StoreInquiryRequest $request, $client_id){
        $inquiry = Inquiry::create(array_merge($request->validated(), ['client_id' => $client_id]));
        return redirect()->route('inquiry.index', $client_id)->with('success', 'Inquiry created successfully');
    }

    public function edit($inquiry_id){
        $inquiry = Inquiry::where('id', $inquiry_id)->first();
        return view('admin-dashboard.inquiries.edit', compact('inquiry'));
        }

    public function update(UpdateInquiryRequest $request, $inquiry_id){
        $inquiry = Inquiry::where('id', $inquiry_id)->first();
        $inquiry->update($request->validated());
        return redirect()->route('inquiry.index', $inquiry->client_id)->with('success', 'Inquiry updated successfully');
    }

    public function delete($inquiry_id){
        $inquiry = Inquiry::where('id', $inquiry_id)->first();
        $inquiry->delete();
        return redirect()->route('inquiry.index', $inquiry->client_id)->with('success', 'Inquiry deleted successfully');
    }

}