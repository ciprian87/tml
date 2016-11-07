<?php
//=====================================================================
//WRITER:		Ciprian Robu
//DATE:			04/09/15
//PURPOSE:		Script that introduces all new driver info in DB
//COMMENTS:		I think this one is done
//=====================================================================

$servername = "localhost";
$username = "triplemadmin";
$password = "triplem1234";
$dbname = "triplemlogistics";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$firstname 		= $conn->real_escape_string(trim($_GET['firstname']));
$lastname 		= $conn->real_escape_string(trim($_GET['lastname']));
$phone_no 		= $conn->real_escape_string(trim($_GET['phone_no']));
$endr_tanker 	= $conn->real_escape_string(trim($_GET['endr_tanker']));
$endr_hazmat 	= $conn->real_escape_string(trim($_GET['endr_hazmat']));
$twic_card 		= $conn->real_escape_string(trim($_GET['twic_card']));

//if empty fields return without adding anything to DB
if ((strlen($firstname)<1) || (strlen($lastname)<1)) {
	$conn->close();
	echo "Blank fields";
	header("Location: ..\index.php?navigation=drivers&add_driver_status=i");
} else {
	//return to form without adding anything to DB if driver name already exists
	$sql = "select firstname, lastname from data_drivers where firstname='$firstname' AND lastname='$lastname'";
	$result = $conn->query($sql);
	$tmp_counter = 0;
	foreach($result as $row) {
		$tmp_counter++;
	}
	echo "Counter is ". $tmp_counter;
	if ($tmp_counter>0) {
		$conn->close();
		echo "Driver already exists";
		header("Location: ..\index.php?navigation=drivers&add_driver_status=de");
	} else {
		$sql = "insert into data_drivers(firstname, lastname, phone_no, endr_tanker, endr_hazmat, twic_card) 
		values ('$firstname', '$lastname', '$phone_no', '$endr_tanker', '$endr_hazmat', '$twic_card' );";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		//Close the connection
		$conn->close();
		echo "Connection terminated successfully!";
		header("Location: ..\index.php?navigation=drivers&add_driver_status=y");
	}
}

?>