<?php
//=====================================================================
//WRITER:		Ciprian Robu
//DATE:			04/09/15
//PURPOSE:		Script that updates load info in DB
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

$load_id 			= $conn->real_escape_string(trim($_GET['load_id']));
$truck_no 			= $conn->real_escape_string(trim($_GET['truck_no']));
$broker 			= $conn->real_escape_string(trim($_GET['broker']));
$load_no 			= $conn->real_escape_string(trim($_GET['load_number']));
$pickup_location 	= $conn->real_escape_string(trim($_GET['pickup_location']));
$pickup_year 		= $conn->real_escape_string(trim($_GET['pickup_year']));
$pickup_month 		= $conn->real_escape_string(trim($_GET['pickup_month']));
$pickup_day 		= $conn->real_escape_string(trim($_GET['pickup_day']));
$pickup_time 		= $conn->real_escape_string(trim($_GET['pickup_time']));
$delivery_location 	= $conn->real_escape_string(trim($_GET['delivery_location']));
$delivery_year 		= $conn->real_escape_string(trim($_GET['delivery_year']));
$delivery_month 	= $conn->real_escape_string(trim($_GET['delivery_month']));
$delivery_day 		= $conn->real_escape_string(trim($_GET['delivery_day']));
$delivery_time 		= $conn->real_escape_string(trim($_GET['delivery_time']));
$weight 			= $conn->real_escape_string(trim($_GET['weight']));
$miles  			= $conn->real_escape_string(trim($_GET['miles']));
$dh 				= $conn->real_escape_string(trim($_GET['dh']));
$rate 				= $conn->real_escape_string(trim($_GET['rate']));

$pickup_date 	= $pickup_year . '-' . $pickup_month . '-' . $pickup_day;
$delivery_date 	= $delivery_year . '-' . $delivery_month . '-' . $delivery_day;

$dollar_per_mile = '';
if(isset($_GET['dh']) && !empty($_GET['dh'])){ 
	$dollar_per_mile = $rate/($dh+$miles);
} else {
	$dollar_per_mile = $rate/$miles;
}

//get truck_id
$sql = "select id from data_trucks where truck_no='$truck_no'";
$result = $conn->query($sql);
$truck_id = '';
foreach ($result as $row) {
	$truck_id = $row['id'];
}
$sql = "select A.trailer_no from data_trailers A
		left outer join rel_truck_trailer B
		on A.id=B.trailer_id
		where B.truck_id=$truck_id;";
$result = $conn->query($sql);
$trailer_no = '';
foreach ($result as $row) {
	$trailer_no = $row['trailer_no'];
}

//if empty fields return without adding anything to DB
if ((strlen($pickup_location)<1) || (strlen($delivery_location)<1)) {
	$conn->close();
	echo "Blank fields";
	header("Location: ..\index.php?navigation=load_edit&load_id=$load_id");
} else {
		date_default_timezone_set('America/Chicago');
		$current_date_time = date ("Y-m-d H:i:s", time());
		$sql = "update data_loads set
					truck_no='$truck_no', 
					trailer_no='$trailer_no', 
					broker='$broker',
					load_number='$load_no',
					pickup_location='$pickup_location', 
					pickup_date='$pickup_date', 
					pickup_time='$pickup_time', 
					delivery_location='$delivery_location',
					delivery_date='$delivery_date',
					delivery_time='$delivery_time', 
					weight='$weight',
					dh='$dh', 
					rate='$rate', 
					dollar_per_mile='$dollar_per_mile',
					date_modified='$current_date_time'
					where id='$load_id'";
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		//Close the connection
		$conn->close();
		echo "Connection terminated successfully!";
		header("Location: ..\index.php?navigation=load_view&load_id=$load_id");
	}


?>