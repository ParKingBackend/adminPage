<?php
require('db.php');

?>
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
$endpoint = '/api/persons/get/all';
$apiUrl = $apiBaseUrl . $endpoint;
$delpoint = $apiBaseUrl .'/api/persons/delete/';
$editpoint = $apiBaseUrl .'/api/persons/update/';

$response = file_get_contents($apiUrl);

if ($response === false) {
    die('Failed to fetch data from the API.');
}

$data = json_decode($response, true);

if ($data === null) {
    die('Failed to parse JSON response: ' . json_last_error_msg());
}

// Pagination settings
$itemsPerPage = 10;
$totalItems = count($data);
$totalPages = ceil($totalItems / $itemsPerPage);

// Sort the data by a specific column
function sortByColumn($data, $column, $direction) {
    $sortColumn = array_column($data, $column);
    array_multisort($sortColumn, $direction === 'asc' ? SORT_ASC : SORT_DESC, $data);
    return $data;
}

// HTML and CSS for displaying data
echo '<html>';
echo '<head>';
echo '<style>';
echo 'table { border-collapse: collapse; width: 100%; }';
echo 'table, th, td { border: 1px solid black; }';
echo 'th, td { padding: 8px; text-align: left; }';
echo 'th { background-color: #f2f2f2; }';
echo 'a { text-decoration: none; color:#333; }';
<<<<<<< HEAD
echo  '#edit { text-decoration: none; color:#333 !important;  }';

=======
>>>>>>> 2dc472e... Fixed login, signout works, all data showedsqlnew
echo '.hidden { display: none; }';
echo '.pagination { margin-top: 10px; }';
echo '</style>';
echo '<script>';
echo 'function toggleClientDetails(id) {';
echo '  var details = document.getElementById(id);';
echo '  if (details.style.display === "none") {';
echo '    details.style.display = "table-row";';
echo '  } else {';
echo '    details.style.display = "none";';
echo '  }';
echo '}';
echo '</script>';
echo '</head>';
echo '<body>';
echo '<h1>Person Data</h1>';

// Sort the data when a column header is clicked
if (isset($_GET['sort']) && isset($_GET['order'])) {
    $data = sortByColumn($data, $_GET['sort'], $_GET['order']);
}

// Pagination logic
if (isset($_GET['page'])) {
    $currentPage = min(max(1, $_GET['page']), $totalPages);
} else {
    $currentPage = 1;
}
$startIndex = ($currentPage - 1) * $itemsPerPage;
$endIndex = min($startIndex + $itemsPerPage, $totalItems);

// Display the table
echo '<table>';
echo '<tr>';
echo '<th><a href="?sort=id&order=asc">ID &#8593;</a> <a href="?sort=id&order=desc">ID &#8595;</a></th>';
echo '<th><a href="?sort=firstName&order=asc">First Name &#8593;</a> <a href="?sort=firstName&order=desc">First Name &#8595;</a></th>';
echo '<th><a href="?sort=surname&order=asc">Surname &#8593;</a> <a href="?sort=surname&order=desc">Surname &#8595;</a></th>';
echo '<th>Client ID</th>';
echo '<td class="addNew"><a id="edit" href="add/addpersons.php">Add</a> </td>';
echo '</tr>';

for ($i = $startIndex; $i < $endIndex; $i++) {
    $person = $data[$i];
    echo '<tr>';
    echo '<td>' . $person['id'] . '</td>';
    echo '<td>' . $person['firstName'] . '</td>';
    echo '<td>' . $person['surname'] . '</td>';
    echo '<td>';
    echo '<a href="javascript:void(0);" onclick="toggleClientDetails(\'' . $person['id'] . '\')">'. $person['client']['id'] .' : Show Client</a>';
    echo '<div id="' . $person['id'] . '" class="hidden">';
    echo 'Client ID: ' . $person['client']['id'] . '<br>';
    echo 'Username: ' . $person['client']['username'] . '<br>';
    echo 'Email: ' . $person['client']['email'] . '<br>';
    echo 'Image: <img src="' . $person['client']['image'] . '" width="50" height="50">' . '<br>';
    echo 'level: ' . $person['client']['level'] . '<br>';
    echo 'xp: ' . $person['client']['xp'] . '<br>';
    echo '</div>';
    echo '</td>';
<<<<<<< HEAD
    echo '<td class="addNew"><a href="edit/editpersons.php?id=' . $person['id'] . '"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z" fill="#000000"></path> </g></svg></a> </td>';
          
=======
    echo '<td><a href="edit/editpersons.php?id=' . $person['id'] . '">Edit</a> </td>';
    echo '</tr>';
>>>>>>> 12e5de8... updated some shit
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

echo '</body>';
echo '</html>';
?>

        </div>
    </div>
</body>
