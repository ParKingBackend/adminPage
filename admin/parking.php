<?php
require('db.php');
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" type="text/css" href="css/pageLayout.css">
    <link rel="stylesheet" type="text/css" href="css/fonts.css">
</head>

<body>
    <?php include('topBar.php'); ?>
    <div class="grid-container">
        <div class="side-menu">
            <?php include('sideMenu.php'); ?>
        </div>
        <div class="content">
            <?php
            // API endpoint and base URL
            $endpoint = '/api/parking/get/all';
            $apiUrl = $apiBaseUrl . $endpoint;

            // Fetch data from the API
            $response = file_get_contents($apiUrl);

            if ($response === false) {
                die('Failed to fetch data from the API.' . $response);
            }

            $data = json_decode($response, true);

            if ($data === null) {
                die('Failed to parse JSON response.');
            }

            echo '<div class="heading"><h1>Parking</h1></div>';

            // Pagination settings
            $itemsPerPage = 10;
            $totalItems = count($data);
            $totalPages = ceil($totalItems / $itemsPerPage);

            // Pagination logic
            if (isset($_GET['page'])) {
                $currentPage = min(max(1, $_GET['page']), $totalPages);
            } else {
                $currentPage = 1;
            }
            $startIndex = ($currentPage - 1) * $itemsPerPage;
            $endIndex = min($startIndex + $itemsPerPage, $totalItems);

            // Display the table and pagination links inside a div
            echo '<div class="data-container">';
            echo '<table>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Address</th>';
            echo '<th>Disabled?</th>';
            echo '<th>Premium?</th>';
            echo '<th>Max spots</th>';
            echo '<th>Partner ID</th>';
            echo '<th>Price</th>';
            echo '<th>Spots taken</th>';
            echo '</tr>';

            foreach (array_slice($data, $startIndex, $itemsPerPage) as $parking) {
                echo '<tr>';
                echo '<td>' . $parking['id'] . '</td>';
                echo '<td>' . $parking['address'] . '</td>';
                echo '<td>' . ($parking['isDisabled'] ? 'true' : 'false') . '</td>';
                echo '<td>' . ($parking['isPremium'] ? 'true' : 'false') . '</td>';
                echo '<td>' . $parking['maxSpotsCount'] . '</td>';
                echo '<td>' . $parking['partnerId'] . '</td>';
                echo '<td>' . $parking['price'] . '</td>';
                echo '<td>' . $parking['spotsTaken'] . '</td>';
                echo '</tr>';
            }

            echo '</table>';

            // Pagination links
            echo '<div class="pagination">';
            if ($totalPages > 1) {
                for ($page = 1; $page <= $totalPages; $page++) {
                    if ($page === $currentPage) {
                        echo '<span>' . $page . '</span>';
                    } else {
                        echo '<a href="?page=' . $page . '">' . $page . '</a>';
                    }
                }
            }
            echo '</div>';
            echo '</div>'; // Closing the table-container div
            ?>
        </div>
    </div>
</body>

</html>
