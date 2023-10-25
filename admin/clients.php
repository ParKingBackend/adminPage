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
            $endpoint = '/api/client/get/all';
            $apiUrl = $apiBaseUrl . $endpoint;

            $response = file_get_contents($apiUrl);

            if ($response === false) {
                die('Failed to fetch data from the API.' . $response);
            }

            $data = json_decode($response, true);

            if ($data === null) {
                die('Failed to parse JSON response.');
            }

            // Pagination settings
            $itemsPerPage = 10;
            $totalItems = count($data);
            $totalPages = ceil($totalItems / $itemsPerPage);

            echo '<div class="heading"><h1>Clients</h1></div>';

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
            echo '<th><a href="?sort=id&order=asc">ID &#8593;</a> <a href="?sort=id&order=desc">ID &#8595;</a></th>';
            echo '<th>Username</th>';
            echo '<th>Email</th>';
            echo '<th>Bank Account</th>';
            echo '</tr>';

            foreach (array_slice($data, $startIndex, $itemsPerPage) as $client) {
                echo '<tr>';
                echo '<td>' . $client['id'] . '</td>';
                echo '<td>' . $client['username'] . '</td>';
                echo '<td>' . $client['email'] . '</td>';
                echo '<td>' . $client['bankAccount'] . '</td>';
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