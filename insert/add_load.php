<?php
//=====================================================================
//WRITER:		Ciprian Robu
//DATE:			04/09/15
//PURPOSE:		Script that introduces new load info in DB
//COMMENTS:		I think its done. Maybe check against existing loads
//				and if all values are exactly the same, we don't enter
//				them
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

$truck_no 			= $conn->real_escape_string(trim($_GET['truck_no']));
$broker 			= $conn->real_escape_string(trim($_GET['broker']));
$load_no 			= $conn->real_escape_string(trim($_GET['load_no']));
$pickup_location 	= $conn->real_escape_string(trim($_GET['pickup_location']));
$pickup_month		= $conn->real_escape_string(trim($_GET['pickup_month']));
$pickup_day			= $conn->real_escape_string(trim($_GET['pickup_day']));
$pickup_year		= $conn->real_escape_string(trim($_GET['pickup_year']));
$pickup_time		= $conn->real_escape_string(trim($_GET['pickup_time']));
$delivery_location	= $conn->real_escape_string(trim($_GET['delivery_location']));
$delivery_month		= $conn->real_escape_string(trim($_GET['delivery_month']));
$delivery_day		= $conn->real_escape_string(trim($_GET['delivery_day']));
$delivery_year		= $conn->real_escape_string(trim($_GET['delivery_year']));
$delivery_time		= $conn->real_escape_string(trim($_GET['delivery_time']));
$load_weight 		= $conn->real_escape_string(trim($_GET['load_weight']));
$dh					= $conn->real_escape_string(trim($_GET['dh']));
$load_miles 		= $conn->real_escape_string(trim($_GET['load_miles']));
$load_rate 			= $conn->real_escape_string(trim($_GET['load_rate']));

$pickup_date = $pickup_year.'-'.$pickup_month.'-'.$pickup_day;
$delivery_date = $delivery_year.'-'.$delivery_month.'-'.$delivery_day;

if(isset($_GET['dh']) && !empty($_GET['dh'])){ 
	$dollar_per_mile = $load_rate/($dh+$load_miles);
} else {
	$dollar_per_mile = $load_rate/$load_miles;
}
//get trailer number
$sql = "select * from data_trucks A 
			left outer join rel_truck_trailer B 
			on A.id=B.truck_id 
			left join data_trailers C 
			on B.trailer_id = C.id 
			where A.truck_no=$truck_no limit 1;";

$result = $conn->query($sql);
$trailer_no = '';
foreach ($result as $row) {
	$trailer_no = $row['trailer_no'];
}

//we need to check against empty and necessary fields and return to screen

if ((strlen($broker)<1) ||
	(strlen($pickup_location)<1) || 
	(strlen($pickup_date)<1) || 
	(strlen($delivery_location)<1) || 
	(strlen($delivery_date)<1) || 
	(strlen($load_miles)<1) ||
	(strlen($load_rate)<1)	) {
		//Close the connection
		$conn->close();
		echo "Connection terminated successfully!";
		header("Location: ..\index.php?navigation=loads");
	} else {
		date_default_timezone_set('America/Chicago');
		$current_date_time = date ("Y-m-d H:i:s", time());
		$sql = "insert into data_loads(
						truck_no, 
						trailer_no, 
						broker, 
						load_number, 
						pickup_location, 
						pickup_date, 
						pickup_time, 
						delivery_location, 
						delivery_date, 
						delivery_time, 
						weight, 
						dh, 
						miles, 
						rate, 
						dollar_per_mile,
						date_modified) 
				values (
						'$truck_no', 
						'$trailer_no', 
						'$broker', 
						'$load_no', 
						'$pickup_location', 
						'$pickup_date',
						'$pickup_time', 
						'$delivery_location', 
						'$delivery_date',
						'$delivery_time', 
						'$load_weight',
						'$dh',
						'$load_miles',
						'$load_rate',
						'$dollar_per_mile',
						'$current_date_time');";
						

		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		//Close the connection
		$conn->close();
		echo "Connection terminated successfully!";

		header("Location: ..\index.php?navigation=loads&add_load_status=y");
	}
?>