<!-- resources/views/admin-dashboard/itineraries/partials/activity.blade.php -->
<div class="text-sm text-gray-600">
  <div>Provider: {{ data_get($details, 'provider') }}</div>
  <div>Duration: {{ data_get($details, 'duration') }}</div>
  <div>Inclusions: {{ data_get($details, 'inclusions') }}</div>
</div>
