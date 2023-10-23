<?php
require('db.php');
include ('mainPage.php');
?>
 <link rel="stylesheet" type="text/css" href="css/admin.css">
<?php 

$endpoint = '/persons/get/all';
$apiUrl = $apiBaseUrl . $endpoint;

$response = file_get_contents($apiUrl);

if ($response === false) {
    die('Failed to fetch data from the API.');
}

$data = json_decode($response, true);

if ($data === null) {
    die('Failed to parse JSON response.');
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
echo 'a { text-decoration: none; }';
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
echo '</tr>';

for ($i = $startIndex; $i < $endIndex; $i++) {
    $person = $data[$i];
    echo '<tr>';
    echo '<td>' . $person['id'] . '</td>';
    echo '<td>' . $person['firstName'] . '</td>';
    echo '<td>' . $person['surname'] . '</td>';
    echo '<td>';
    echo '<a href="javascript:void(0);" onclick="toggleClientDetails(\'' . $person['id'] . '\')">Show Client</a>';
    echo '<div id="' . $person['id'] . '" class="hidden">';
    echo 'Client ID: ' . $person['client']['id'] . '<br>';
    echo 'Username: ' . $person['client']['username'] . '<br>';
    echo 'Email: ' . $person['client']['email'] . '<br>';
    echo 'Bank Account: ' . $person['client']['bankAccount'] . '<br>';
    echo '</div>';
    echo '</td>';
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

echo '</body>';
echo '</html>';
?>
