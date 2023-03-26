<?php
$servername = "localhost";
$username = "root";
$password = "Citi@420";
$dbname = "detrack";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted, insert the data into the database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $edate = $_POST['edate'];
    $eitem = $_POST['eitem'];
    $eamount = $_POST['eamount'];
    $etype = $_POST['etype'];

    $sql = "INSERT INTO deentry (edate, eitem, eamount, etype)
            VALUES ('$edate', '$eitem', '$eamount', '$etype')";

    if ($conn->query($sql) === true) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Select all the entries from the database
$sql = "SELECT edate, eitem, eamount, etype FROM deentry";
$result = $conn->query($sql);

// Store the results in an array
$entries = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $entries[] = $row;
    }
}

$conn->close();
?>

