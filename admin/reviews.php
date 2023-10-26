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
            $endpoint = '/api/review/get/all';
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
            echo '<html>';
            echo '<head>';
            echo '<style>';
            echo 'table { border-collapse: collapse; width: 100%; }';
            echo 'table, th, td { border: 1px solid black; }';
            echo 'th, td { padding: 8px; text-align: left; }';
            echo 'th { background-color: #f2f2f2; }';
            echo 'a, #href { text-decoration: none; color:#333; }';
            echo '.hidden { display: none; }';
            echo '.pagination { margin-top: 10px; }';
            echo '</style>';
            echo '<script>';
            echo 'function toggleDetails(elementId) {';
            echo '    var element = document.getElementById(elementId);';
            echo '    if (element.style.display === "none") {';
            echo '        element.style.display = "block";';
            echo '    } else {';
            echo '        element.style.display = "none";';
            echo '    }';
            echo '}';
            echo '</script>';
            
            echo '</head>';
            echo '<body>';
            echo '<div class="heading"><h1>Reviews</h1></div>';

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
            echo '<th>Description</th>';
            echo '<th>Posted time</th>';
            echo '<th>Rating</th>';
            echo '<th>Title</th>';
            echo '<th>Parking ID</th>';
            echo '<th>Client ID</th>';
            echo '<td><a id="edit" href="add/addreview.php">Add</a> </td>';


            echo '</tr>';

            foreach (array_slice($data, $startIndex, $itemsPerPage) as $reserve) {
                echo '<tr>';
                echo '<td>' . $reserve['id'] . '</td>';
                echo '<td>' . $reserve['description'] . '</td>';
                echo '<td>' . $reserve['postedTime'] . '</td>';
                echo '<td>' . $reserve['rating'] . '</td>';
                echo '<td>' . $reserve['title'] . '</td>';
                echo '<td>';
                echo '<a href="javascript:void(0);" onclick="toggleDetails(\'parking_' . $reserve['id'] . '\')">'. $reserve['parking']['id'] .' : Show Parking</a>';
                echo '<div id="parking_' . $reserve['id'] . '" class="hidden">';
                echo 'Address: ' . $reserve['parking']['address'] . '<br>';
                echo 'Disabled?: ' . ($reserve['parking']['isDisabled'] ? 'true' : 'false') . '<br>';
                echo 'Has premium?: ' . ($reserve['parking']['isPremium'] ? 'true' : 'false') . '<br>';
                echo 'Partner ID: ' . $reserve['parking']['partnerId'] . '<br>';
                echo 'Max spot count: ' . $reserve['parking']['maxSpotsCount'] . '<br>';
                echo 'Price: ' . $reserve['parking']['price'] . '<br>';
                echo 'Spots Taken: ' . $reserve['parking']['spotsTaken'] . '<br>';
                echo '</div>'; 
                echo '</td>';
                echo '<td>';
                echo '<a href="javascript:void(0);" onclick="toggleDetails(\'client_' . $reserve['id'] . '\')">'. $reserve['client']['id'] .' : Show Client</a>';
                echo '<div id="client_' . $reserve['id'] . '" class="hidden">';
                echo 'Client ID: ' . $reserve['client']['id'] . '<br>';
                echo 'Username: ' . $reserve['client']['username'] . '<br>';
                echo 'Email: ' . $reserve['client']['email'] . '<br>';
                echo 'Image: <img src="' . $reserve['client']['image'] . '" width="50" height="50">' . '<br>';
                echo 'level: ' . $reserve['client']['level'] . '<br>';
                echo 'xp: ' . $reserve['client']['xp'] . '<br>';
                echo '</div>';
                echo '</td>';
                echo '<td><a id="edit" href="edit/editreviews.php?id=' . $reserve['id'] . '">Edit</a> </td>';

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
