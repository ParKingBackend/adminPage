
<?php
require('../db.php');
?>

<?php
if (isset($_GET['id'])) {
    $entryId = $_GET['id'];

} else {
   echo "Service broken, no ID";
}
$endpoint = '/api/persons/get/all';
$apiUrl = $apiBaseUrl . $endpoint;
$delpoint = $apiBaseUrl .'/api/persons/delete/';

$editpoint = $apiBaseUrl .'/api/persons/get/'.$entryId.'';
$updatepoint = $apiBaseUrl .'/api/persons/update/person/'.$entryId.'';

$response = file_get_contents($editpoint);

if ($response === false) {
    die('Failed to fetch data from the API.');
}

$data = json_decode($response, true);

if ($data === null) {
    die('Failed to parse JSON response: ' . json_last_error_msg());
}


if (isset($_POST['update'])) {
    $updateData = [
        'firstName' => $_POST['firstName'],
        'surname' => $_POST['surname']
    ];

    // Send a PUT request to update the entry
    $options = [
        'http' => [
            'method' => 'PUT',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($updateData)
        ]
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($updatepoint, false, $context);

    if ($result !== false) {
        echo 'Data updated successfully.';
        sleep(1);
        header('Location:../persons.php');
    } else {
        echo 'Failed to update data.';
    }
}

?>
<form method="POST" action="">
    <div class="data-entry">
        <label for="firstName">First Name</label>
        <input type="text" name="firstName" value="<?php echo $data['firstName']; ?>">
    </div>

    <div class="data-entry">
        <label for="surname">Surname</label>
        <input type="text" name="surname" value="<?php echo $data['surname']; ?>">
    </div>

    <input type="submit" name="update" value="Update Entry">
</form>