<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>

</head>
<body>
    <div id="sidebar" class="hidden">
        <button id="toggleSidebar" class="toggle-button">Toggle Sidebar</button>
        <ul>
            <li><a href="clients.php">Clients</a></li>
            <li><a href="companies.php">Companies</a></li>
            <li><a href="persons.php">Persons</a></li>
            <li><a href="premium_subscriptions.php">Premium Subscriptions</a></li>
            <li><a href="parking.php">Parking</a></li>
            <li><a href="reports.php">Reports</a></li>
            <li><a href="reservations.php">Reservations</a></li>
            <li><a href="reviews.php">Reviews</a></li>
        </ul>
    </div>

    <script>
        // JavaScript to toggle sidebar visibility
        const toggleButton = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });
    </script>
</body>
</html>
