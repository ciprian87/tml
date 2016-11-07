<?php
//=====================================================================
//WRITER:		Ciprian Robu
//DATE:			04/09/15
//PURPOSE:		Script that updates truck info in DB
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

$make 		= $conn->real_escape_string(trim($_GET['make']));
$model 		= $conn->real_escape_string(trim($_GET['model']));
$length 	= $conn->real_escape_string(trim($_GET['length']));
$type	 	= $conn->real_escape_string(trim($_GET['type']));
$trailer_no	= $conn->real_escape_string(trim($_GET['trailer_no']));
$trailer_id	= $conn->real_escape_string(trim($_GET['trailer_id']));
$truck_id	= $conn->real_escape_string(trim($_GET['truck_id']));

echo "$make $model $trailer_no $length $type";

//if empty fields return without adding anything to DB
if (strlen($trailer_no)<1) {
	$conn->close();
	echo "Blank fields";
	header("Location: ..\index.php?navigation=trailer_edit&trailer_id=$trailer_id");
} else {
		$sql = "update data_trailers set
					make='$make', 
					model='$model', 
					length='$length', 
					type='$type',
					trailer_no='$trailer_no'
					where id='$trailer_id';";
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$sql = "select truck_id from rel_truck_trailer where trailer_id='$trailer_id'";
		$result = $conn->query($sql);
		$tmp_counter = 0;
		foreach ($result as $row) {
			$tmp_counter++;
		}
		if ($tmp_counter>0) {
			$sql = "UPDATE rel_truck_trailer SET truck_id='$truck_id' WHERE trailer_id='$trailer_id';";
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		} else {
			$sql = "INSERT INTO rel_truck_trailer(trailer_id, truck_id) VALUES('$trailer_id', '$truck_id');";
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		
		//Close the connection
		$conn->close();
		echo "Connection terminated successfully!";
		header("Location: ..\index.php?navigation=trailer_view&trailer_id=$trailer_id");
	}


?>