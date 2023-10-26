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
<?php
 echo '<html>';
 echo '<head>';
 echo '<style>';
 echo 'table { border-collapse: collapse; width: 100%; }';
 echo 'table, th, td { border: 1px solid black; }';
 echo 'th, td { padding: 8px; text-align: left; }';
 echo 'th { background-color: #f2f2f2; }';
 echo '#edit { text-decoration: none; color:#333 !important; }';
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
 ?>
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
            echo '<th>End time</th>';
            echo '<th>Start time</th>';
            echo '<td><a id="edit" href="add/addparking.php">Add</a> </td>';
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
                echo '<td>' . $parking['endTime'] . '</td>';
                echo '<td>' . $parking['startTime'] . '</td>';
                echo '<td><a id="edit" href="edit/editparking.php?id=' . $parking['id'] . '">Edit</a> </td>';
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
