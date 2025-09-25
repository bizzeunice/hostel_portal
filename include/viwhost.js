document.addEventListener('DOMContentLoaded', () => {
    // Form submission handling
    const hostelForm = document.getElementById('hostelForm');

    hostelForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // Get form values
        const hostelName = document.getElementById('hostelName').value;
        const campusLocation = document.getElementById('campusLocation').value;
        const hostelType = document.getElementById('hostelType').value;
        const totalRooms = document.getElementById('totalRooms').value;
        const bedsPerRoom = document.getElementById('bedsPerRoom').value;
        const pricePerBed = document.getElementById('pricePerBed').value;

        // Simple validation
        if (!hostelName || !campusLocation || !hostelType || !totalRooms || !bedsPerRoom || !pricePerBed) {
            alert('Please fill in all required fields');
            return;
        }

        if (bedsPerRoom < 1 || bedsPerRoom > 4) {
            alert('Beds per room must be between 1 and 4');
            return;
        }

        // In a real application, this would send data to a server
        // For demo purposes, we'll just show a success message
        alert(`Hostel "${hostelName}" has been added successfully!`);

        // Reset the form
        hostelForm.reset();
    });

    // Edit button handlers
    const editButtons = document.querySelectorAll('.btn-primary');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            // In a real application, this would populate the modal with actual data
            const editModal = new bootstrap.Modal(document.getElementById('editHostelModal'));
            editModal.show();
        });
    });

    // Delete modal handling
    let currentRow = null;
    document.querySelectorAll('.delete-hostel-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const row = btn.closest('tr');
            document.getElementById('deleteHostelName').textContent = row.children[0].textContent.trim();
            currentRow = row;
            const modal = new bootstrap.Modal(document.getElementById('deleteHostelModal'));
            modal.show();
        });
    });

    document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
        if (currentRow) {
            const name = document.getElementById('deleteHostelName').textContent;
            currentRow.remove();
            bootstrap.Modal.getInstance(document.getElementById('deleteHostelModal')).hide();
            alert(`Hostel "${name}" has been deleted successfully!`);
            currentRow = null;
        }
    });
});