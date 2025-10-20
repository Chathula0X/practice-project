<!-- resources/views/itinerary/partials/transport-details.blade.php -->
<div class="text-sm text-gray-600">
  <div>Mode: {{ data_get($details, 'mode') }}</div>
  <div>Operator: {{ data_get($details, 'operator') }}</div>
  <div>Times: {{ data_get($details, 'times') }}</div>
  <div>Reference: {{ data_get($details, 'reference') }}</div>
</div>