<?php
//=====================================================================
//WRITER:		Ciprian Robu
//DATE:			04/09/15
//PURPOSE:		Script that updates driver info in DB
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

$driver_id 		= $conn->real_escape_string(trim($_GET['driver_id']));
$firstname 		= $conn->real_escape_string(trim($_GET['firstname']));
$lastname 		= $conn->real_escape_string(trim($_GET['lastname']));
$phone_no 		= $conn->real_escape_string(trim($_GET['phone_no']));
$endr_tanker 	= $conn->real_escape_string(trim($_GET['endr_tanker']));
$endr_hazmat 	= $conn->real_escape_string(trim($_GET['endr_hazmat']));
$twic_card 		= $conn->real_escape_string(trim($_GET['twic_card']));
$truck_no		= $conn->real_escape_string(trim($_GET['truck_no']));

//get truck_id
$sql = "select id from data_trucks where truck_no='$truck_no'";
$result = $conn->query($sql);
$truck_id = '';
foreach ($result as $row) {
	$truck_id = $row['id'];
}

//if empty fields return without adding anything to DB
if ((strlen($firstname)<1) || (strlen($lastname)<1)) {
	$conn->close();
	echo "Blank fields";
	header("Location: ..\index.php?navigation=driver_edit&driver_id=$driver_id");
} else {
		$sql = "update data_drivers set
					firstname='$firstname', 
					lastname='$lastname', 
					phone_no='$phone_no', 
					endr_tanker='$endr_tanker', 
					endr_hazmat='$endr_hazmat', 
					twic_card='$twic_card' 
					where id='$driver_id'";
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$sql = "select truck_id from rel_driver_truck where driver_id='$driver_id'";
		$result = $conn->query($sql);
		$tmp_counter = 0;
		foreach ($result as $row) {
			$tmp_counter++;
		}
		if ($tmp_counter>0) {
			$sql = "UPDATE rel_driver_truck SET truck_id='$truck_id' WHERE driver_id='$driver_id';";
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		} else {
			$sql = "INSERT INTO rel_driver_truck(driver_id, truck_id) VALUES('$driver_id', '$truck_id');";
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		
		//Close the connection
		$conn->close();
		echo "Connection terminated successfully!";
		header("Location: ..\index.php?navigation=driver_view&driver_id=$driver_id");
	}


?>