function csrf() {
  const el = document.querySelector('meta[name="csrf-token"]');
  return el ? el.content : '';
}

window.showAddItemModal = function(dayId) {
  const modal = document.getElementById('add-item-modal');
  if (!modal) return;
  modal.classList.remove('hidden');
  document.getElementById('day-id').value = dayId;
};

window.closeAddItemModal = function() {
  const modal = document.getElementById('add-item-modal');
  if (!modal) return;
  modal.classList.add('hidden');
};

window.addItem = async function() {
  const form = document.getElementById('add-item-form');
  const formData = new FormData(form);
  const dayId = formData.get('day_id');

  const detailsText = formData.get('details');
  if (detailsText && typeof detailsText === 'string') {
    try {
      const parsed = JSON.parse(detailsText);
      formData.delete('details');
      formData.append('details', new Blob([JSON.stringify(parsed)], { type: 'application/json' }));
    } catch (e) {
      alert('Details must be valid JSON or leave it empty.');
      return;
    }
  }

  try {
    const res = await fetch(`/itinerary/day/${dayId}/add-item`, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': csrf() },
      body: formData
    });
    const data = await res.json();
    if (data.success) {
      location.reload();
    } else {
      alert('Failed to add item');
    }
  } catch (e) {
    alert('Error adding item');
  }
};

window.createVersion = async function() {
  const root = document.querySelector('[data-itinerary-id]');
  const itineraryId = root ? root.getAttribute('data-itinerary-id') : null;
  if (!itineraryId) return;

  const changeLog = prompt('Enter change description:');
  if (!changeLog) return;

  try {
    const res = await fetch(`/itinerary/${itineraryId}/create-version`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrf()
      },
      body: JSON.stringify({ change_log: changeLog })
    });
    const data = await res.json();
    if (data.success) {
      location.reload();
    } else {
      alert('Failed to create version');
    }
  } catch (e) {
    alert('Error creating version');
  }
};

window.saveItinerary = function() {
  alert('Save action not implemented yet.');
};


