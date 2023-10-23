<?php
require('db.php');

?>
<link rel="stylesheet" type="text/css" href="css/admin.css">
<?php

$endpoint = '/api/client/get/all';
$apiUrl = $apiBaseUrl . $endpoint;

$response = file_get_contents($apiUrl);

if ($response === false) {
    die('Failed to fetch data from the API.'. $response);
}

$data = json_decode($response, true);

if ($data === null) {
    die('Failed to parse JSON response.');
}

// Pagination settings
$itemsPerPage = 10;
$totalItems = count($data);
$totalPages = ceil($totalItems / $itemsPerPage);

// HTML and CSS for displaying data
echo '<html>';
echo '<head>';
echo '<style>';
echo 'table { border-collapse: collapse; width: 100%; }';
echo 'table, th, td { border: 1px solid black; }';
echo 'th, td { padding: 8px; text-align: left; }';
echo 'th { background-color: #f2f2f2; }';
echo '.pagination { margin-top: 10px; }';
echo '</style>';
echo '</head>';
echo '<body>';
echo '<h1>Client Data</h1>';

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

echo '</body>';
echo '</html>';
?>
