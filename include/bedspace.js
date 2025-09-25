
document.addEventListener('DOMContentLoaded', function () {
    // Handle bedspace clicks to show appropriate modal content
    const bedspaces = document.querySelectorAll('.bedspace');
    const availableDetail = document.getElementById('availableBedspace');
    const occupiedDetail = document.getElementById('occupiedBedspace');

    bedspaces.forEach(bedspace => {
        bedspace.addEventListener('click', function () {
            if (this.classList.contains('available')) {
                availableDetail.classList.remove('d-none');
                occupiedDetail.classList.add('d-none');
            } else {
                availableDetail.classList.add('d-none');
                occupiedDetail.classList.remove('d-none');
            }
        });
    });

    // Search functionality
    const searchInput = document.querySelector('input[type="text"]');
    const searchButton = document.querySelector('.btn-primary');

    searchButton.addEventListener('click', function () {
        const searchTerm = searchInput.value.toLowerCase();
        const roomCards = document.querySelectorAll('.room-card');

        roomCards.forEach(card => {
            const roomNumber = card.querySelector('h5').textContent.toLowerCase();
            const bedspaces = card.querySelectorAll('.bedspace');
            let hasMatch = roomNumber.includes(searchTerm);

            if (!hasMatch) {
                bedspaces.forEach(bedspace => {
                    const status = bedspace.querySelector('small').textContent.toLowerCase();
                    if (status.includes(searchTerm)) {
                        hasMatch = true;
                    }
                });
            }

            if (hasMatch) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Reset filters
    const resetButton = document.querySelector('.btn-outline');

    resetButton.addEventListener('click', function () {
        searchInput.value = '';
        const roomCards = document.querySelectorAll('.room-card');
        roomCards.forEach(card => {
            card.style.display = 'block';
        });
    });
});
