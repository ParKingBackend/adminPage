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
            $endpoint = '/api/client/get/all';
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

            echo '<div class="heading"><h1>Clients</h1></div>';
           


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
            echo '<th>Username</th>';
            echo '<th>Email</th>';
            echo '<th>Bank Account</th>';
            echo '<th>Image</th>';
            echo '<th>Level</th>';
            echo '<th>XP</th>';
            echo '<td><a id="edit" href="add/addclient.php">Add</a> </td>';
            echo '</tr>';

            foreach (array_slice($data, $startIndex, $itemsPerPage) as $client) {
                echo '<tr>';
                echo '<td>' . $client['id'] . '</td>';
                echo '<td>' . $client['username'] . '</td>';
                echo '<td>' . $client['email'] . '</td>';
                echo '<td>' . $client['bankAccount'] . '</td>';
                echo '<td> <img src="' . $client['image'] . '" width="50" height="50">' . '</td>';
                echo '<td>' . $client['level'] . '</td>';
                echo '<td>' . $client['xp'] . '</td>';
                echo '<td><a id="edit" href="edit/editclients.php?id=' . $client['id'] . '">Edit</a> </td>';


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
