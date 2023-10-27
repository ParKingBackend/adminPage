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
            $endpoint = '/api/report/get/all';
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
            echo 'a ,#href{ text-decoration: none; color:#333; }';
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
            echo '<div class="heading"><h1>Reports</h1></div>';

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
            echo '<th>Parking ID</th>';
            echo '<th>Client ID</th>';
            echo '<td><a id="edit" href="add/addreport.php">Add</a> </td>';


            echo '</tr>';

            foreach (array_slice($data, $startIndex, $itemsPerPage) as $reports) {
                echo '<tr>';
                echo '<td>' . $reports['id'] . '</td>';
                echo '<td>' . $reports['description'] . '</td>';
                echo '<td>';
                echo '<a href="javascript:void(0);" onclick="toggleDetails(\'parking_' . $reports['id'] . '\')">' . $reports['parking']['id'] . ' : Show Parking</a>';
                echo '<div id="parking_' . $reports['id'] . '" class="hidden">';
                echo 'Address: ' . $reports['parking']['address'] . '<br>';
                echo 'Disabled?: ' . ($reports['parking']['isDisabled'] ? 'true' : 'false') . '<br>';
                echo 'Has premium?: ' . ($reports['parking']['isPremium'] ? 'true' : 'false') . '<br>';
                echo 'Partner ID: ' . (isset($reports['parking']['partner']['id']) ? $reports['parking']['partner']['id'] : 'N/A') . '<br>';
                echo 'Max spot count: ' . $reports['parking']['maxSpotsCount'] . '<br>';
                echo 'Price: ' . $reports['parking']['price'] . '<br>';
                echo 'Spots Taken: ' . $reports['parking']['spotsTaken'] . '<br>';
                echo '</div>';
                echo '</td>';
                echo '<td>';
                if (isset($reports['client'])) {
                    echo '<a href="javascript:void(0);" onclick="toggleDetails(\'client_' . $reports['id'] . '\')">' . $reports['client']['id'] . ' : Show Client</a>';
                    echo '<div id="client_' . $reports['id'] . '" class="hidden">';
                    echo 'Client ID: ' . $reports['client']['id'] . '<br>';
                    echo 'Username: ' . $reports['client']['username'] . '<br>';
                    echo 'Email: ' . $reports['client']['email'] . '<br>';
                    echo 'Image: <img src="' . $reports['client']['image'] . '" width="50" height="50">' . '<br>';
                    echo 'level: ' . $reports['client']['level'] . '<br>';
                    echo 'xp: ' . $reports['client']['xp'] . '<br>';
                    echo '</div>';
                } else {
                    echo 'N/A';
                }
                
                echo '</td>';
                echo '<td class="addNew"><a id="edit" href="edit/editreport.php?id=' . $reports['id'] . '"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z" fill="#000000"></path> </g></svg></a> </td>';
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