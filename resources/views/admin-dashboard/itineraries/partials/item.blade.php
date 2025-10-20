<!-- resources/views/itinerary/partials/item.blade.php -->
<div class="border rounded-lg p-4 bg-gray-50" data-item-id="{{ $item->id }}">
    <div class="flex justify-between items-start mb-2">
        <div class="flex-1">
            <h4 class="font-semibold">{{ $item->title }}</h4>
            <span class="text-sm text-gray-500 capitalize">{{ $item->type }}</span>
        </div>
        <div class="text-right">
            <div class="font-semibold">${{ number_format($item->total_price, 2) }}</div>
            <div class="text-sm text-gray-500">
                {{ $item->quantity }} × ${{ number_format($item->unit_price, 2) }}
            </div>
        </div>
    </div>

    @switch($item->type)
        @case('transport')
            @include('admin-dashboard.itineraries.partials.transport', ['details' => $item->details])
            @break
        @case('stay')
            @include('admin-dashboard.itineraries.partials.hotel', ['details' => $item->details])
            @break
        @case('activity')
            @include('admin-dashboard.itineraries.partials.activity', ['details' => $item->details])
            @break
        @case('fees')
            @include('admin-dashboard.itineraries.partials.fees', ['details' => $item->details])
            @break
    @endswitch

    <div class="flex justify-end space-x-2 mt-2">
        <button onclick="editItem({{ $item->id }})" class="text-blue-500 text-sm">Edit</button>
        <button onclick="deleteItem({{ $item->id }})" class="text-red-500 text-sm">Delete</button>
    </div>
</div>