<!-- resources/views/admin-dashboard/itineraries/partials/hotel.blade.php -->
<div class="text-sm text-gray-600">
  <div>Hotel: {{ data_get($details, 'hotel_name') }}</div>
  <div>Room: {{ data_get($details, 'room_type') }}</div>
  <div>Meal Plan: {{ data_get($details, 'meal_plan') }}</div>
  <div>Nights: {{ data_get($details, 'nights') }}</div>
</div>
