document.addEventListener('DOMContentLoaded', function () {
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    sidebarToggle.addEventListener('click', function () {
        document.body.classList.toggle('sidebar-collapsed');

        // Change icon based on state
        const icon = sidebarToggle.querySelector('i');
        if (document.body.classList.contains('sidebar-collapsed')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-indent');
        } else {
            icon.classList.remove('fa-indent');
            icon.classList.add('fa-bars');
        }
    });

    // Handle menu item clicks
    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(item => {
        item.addEventListener('click', function () {
            // Remove active class from all items
            menuItems.forEach(i => i.classList.remove('active'));

            // Add active class to clicked item
            this.classList.add('active');
        });
    });

    // Responsive behavior
    function handleResponsive() {
        if (window.innerWidth < 768) {
            document.body.classList.add('sidebar-collapsed');
            const icon = sidebarToggle.querySelector('i');
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-indent');
        } else {
            document.body.classList.remove('sidebar-collapsed');
            const icon = sidebarToggle.querySelector('i');
            icon.classList.remove('fa-indent');
            icon.classList.add('fa-bars');
        }
    }

    // Initial call
    handleResponsive();

    // Listen for window resize
    window.addEventListener('resize', handleResponsive);
});