  document.addEventListener('DOMContentLoaded', function() {
            // Form submission handling
            const campusForm = document.getElementById('campusForm');
            
            campusForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form values
                const campusName = document.getElementById('campusName').value;
                const campusLocation = document.getElementById('campusLocation').value;
                const campusDescription = document.getElementById('campusDescription').value;
                
                // Simple validation
                if (!campusName || !campusLocation) {
                    alert('Please fill in all required fields');
                    return;
                }
                
                // In a real application, this would send data to a server
                // For demo purposes, we'll just show a success message
                alert(`Campus "${campusName}" has been added successfully!`);
                
                // Reset the form
                campusForm.reset();
            });
            
            // Edit button handlers
            const editButtons = document.querySelectorAll('.btn-primary');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // In a real application, this would populate the modal with actual data
                    const editModal = new bootstrap.Modal(document.getElementById('editCampusModal'));
                    editModal.show();
                });
            });
            
            // Delete button handlers
            const deleteButtons = document.querySelectorAll('.btn-danger');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (confirm('Are you sure you want to delete this campus? This action cannot be undone.')) {
                        // In a real application, this would send a delete request to the server
                        alert('Campus has been deleted successfully!');
                    }
                });
            });
        });