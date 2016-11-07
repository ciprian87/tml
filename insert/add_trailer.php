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

$make 		= $conn->real_escape_string(trim($_GET['make']));
$model 		= $conn->real_escape_string(trim($_GET['model']));
$length 	= $conn->real_escape_string(trim($_GET['length']));
$type 		= $conn->real_escape_string(trim($_GET['type']));
$trailer_no = $conn->real_escape_string(trim($_GET['trailer_no']));


//if empty fields return without adding anything to DB
if (strlen($trailer_no)<1) {
	$conn->close();
	echo "Blank trailer number";
	header("Location: ..\index.php?navigation=trailers&add_trailer_status=i");
} else {
	//return to form without adding anything to DB if driver name already exists
	$sql = "select trailer_no from data_trailers where trailer_no='$trailer_no';";
	$result = $conn->query($sql);
	$tmp_counter = 0;
	foreach($result as $row) {
		$tmp_counter++;
	}
	echo "Counter is ". $tmp_counter;
	if ($tmp_counter>0) {
		$conn->close();
		echo "Trailer already exists";
		header("Location: ..\index.php?navigation=trailers&add_trailer_status=te");
	} else {
		$sql = "insert into data_trailers(make, model, length, type, trailer_no) 
		values ('$make', '$model', '$length', '$type', '$trailer_no' );";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		//Close the connection
		$conn->close();
		echo "Connection terminated successfully!";
		header("Location: ..\index.php?navigation=trailers&add_trailer_status=y");
	}
}

?>