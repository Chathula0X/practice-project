<!-- resources/views/itinerary/partials/add-item-modal.blade.php -->
<div id="add-item-modal" class="fixed inset-0 bg-black/30 hidden z-50">
  <div class="mx-auto mt-20 max-w-xl rounded-lg bg-white p-6 shadow">
    <h3 class="mb-4 text-lg font-semibold">Add Item</h3>
    <form id="add-item-form" onsubmit="event.preventDefault(); addItem();">
      <input type="hidden" id="day-id" name="day_id">
      <div class="grid gap-3">
        <select name="type" class="border rounded p-2" required>
          <option value="">Select type</option>
          <option value="transport">Transport</option>
          <option value="stay">Stay (Hotel)</option>
          <option value="activity">Activity/Tour</option>
          <option value="fees">Fees/Other</option>
        </select>
        <input name="title" class="border rounded p-2" placeholder="Title" required>
        <textarea name="description" class="border rounded p-2" placeholder="Description"></textarea>

        <!-- Pricing -->
        <div class="grid grid-cols-3 gap-2">
          <input name="quantity" type="number" step="0.01" min="0" class="border rounded p-2" placeholder="Qty" required>
          <input name="unit_price" type="number" step="0.01" min="0" class="border rounded p-2" placeholder="Unit Price" required>
          <input name="tax_fees" type="number" step="0.01" min="0" class="border rounded p-2" placeholder="Tax/Fees">
        </div>
        <input name="markup" type="number" step="0.01" min="0" class="border rounded p-2" placeholder="Markup">

        <!-- Details JSON (you may replace with dynamic fields per type) -->
        <textarea name="details" class="border rounded p-2" placeholder='Details JSON, e.g. {"operator":"...", "times":"..."}'></textarea>
      </div>

      <div class="mt-4 flex justify-end space-x-2">
        <button type="button" onclick="closeAddItemModal()" class="px-4 py-2 rounded border">Cancel</button>
        <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white">Add</button>
      </div>
    </form>
  </div>
</div>