<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
    <button id="toggleSidebar" class="toggle-button">Show Sidebar</button>

    <div id="sidebar" class="hidden">
        <button id="hideSidebar" class="toggle-button">Hide Sidebar</button>
        <ul>
            <li><a href="mainPage.php">Main Page</a></li>
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
        const showButton = document.getElementById('toggleSidebar');
        const hideButton = document.getElementById('hideSidebar');
        const sidebar = document.getElementById('sidebar');

        showButton.addEventListener('click', () => {
            sidebar.classList.remove('hidden');
            showButton.style.display = 'none';
            hideButton.style.display = 'block';
        });

        hideButton.addEventListener('click', () => {
            sidebar.classList.add('hidden');
            showButton.style.display = 'block';
            hideButton.style.display = 'none';
        });
    </script>
</body>
</html>
