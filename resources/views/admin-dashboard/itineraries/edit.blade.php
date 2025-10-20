{{-- resources/views/itinerary/edit.blade.php --}}
@extends('layouts.admin-dashboard')

@section('content')
<div class="container mx-auto px-4 py-8" data-itinerary-id="{{ $itinerary->id }}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">{{ $itinerary->title }}</h1>
        <div class="flex space-x-2">
            <button onclick="createVersion()" class="bg-blue-500 text-white px-4 py-2 rounded">
                Create New Version
            </button>
            <button onclick="saveItinerary()" class="bg-green-500 text-white px-4 py-2 rounded">
                Save Itinerary
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Itinerary Days -->
        <div class="lg:col-span-2">
            @foreach($itinerary->days as $day)
                <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold">Day {{ $day->day_number }}</h3>
                        <span class="text-sm text-gray-500">{{ $day->date->format('M d, Y') }}</span>
                    </div>
                    
                    <div class="mb-4">
                        <textarea class="w-full p-2 border rounded" 
                                  placeholder="Day notes..." 
                                  data-day-id="{{ $day->id }}">{{ $day->notes }}</textarea>
                    </div>

                    <!-- Items for this day -->
                    <div class="space-y-3" id="items-{{ $day->id }}">
                        @foreach($day->items as $item)
                            @include('admin-dashboard.itineraries.partials.item', ['item' => $item])
                        @endforeach
                    </div>

                    <!-- Add Item Button -->
                    <button onclick="showAddItemModal({{ $day->id }})" 
                            class="mt-4 w-full border-2 border-dashed border-gray-300 rounded-lg p-4 text-gray-500 hover:border-blue-500 hover:text-blue-500">
                        + Add Item
                    </button>
                </div>
            @endforeach
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Itinerary Summary</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>Total Days:</span>
                        <span>{{ $itinerary->days->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Total Cost:</span>
                        <span class="font-semibold" id="total-cost">${{ number_format($itinerary->calculateTotalCost(), 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="space-y-3" id="items-{{ $day->id }}">
    @foreach($day->items as $item)
        @include('itinerary.partials.item', ['item' => $item])
    @endforeach
</div>

<!-- Add Item Modal -->
@include('admin-dashboard.itineraries.partials.add-item-modal')

@endsection