<?php
$servername = "192.168.1.110";
$username = "yourusername";
$password = "yourpassword";
$dbname = "yourdbname";

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

<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Expense Tracker</h2>

    <form method="post" action="submit.php">
        <label for="edate">Date:</label>
        <input type="date" name="edate" required>

        <label for="eitem">Item:</label>
        <input type="text" name="eitem" required>

        <label for="eamount">Amount:</label>
        <input type="number" name="eamount" step=".01" required>

        <label for="etype">Type:</label>
        <select name="etype" required>
            <option value="">Select Type</option>
            <option value="Income">Income</option>
            <option value="Expense">Expense</option>
        </select>

        <button type="submit">Submit</button>
    </form>

    <h2>Expense Report</h2>
    <?php if (count($entries) > 0) : ?>
    <table>
        <tr>
            <th>Date</th>
            <th>Item</th>
            <th>Amount</th>
            <th>Type</th>
        </tr>
        <?php foreach ($entries as $entry) : ?>
        <tr>
            <td><?php echo $entry['edate']; ?></td>
            <td><?php echo $entry['eitem']; ?></td>
            <



<!DOCTYPE html>
<html>
<head>
	<title>Expense Entry Form</title>
	<style>
		table {
			margin: 0 auto; /* center the table */
			border-collapse: collapse;
		}

		td {
			padding: 8px;
			border: 1px solid #ddd;
		}
	</style>
</head>
<body>
	<h1>Expense Entry Form</h1>
	<form method="post" action="submit.php">
		<table>
			<tr>
				<td>Date:</td>
				<td><input type="date" name="edate"></td>
			</tr>
			<tr>
				<td>Item:</td>
				<td><input type="text" name="eitem"></td>
			</tr>
			<tr>
				<td>Amount:</td>
				<td><input type="text" name="eamount"></td>
			</tr>
			<tr>
				<td>Type:</td>
				<td>
					<select name="etype">
						<option value="income">Income</option>
						<option value="expense">Expense</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="Submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>
