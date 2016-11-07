<?php
//=====================================================================
//WRITER:		Ciprian Robu
//DATE:			04/09/15
//PURPOSE:		Generate table of loads in out DB
//COMMENTS:		Contents of this script are displayed when adding a new 
//				driver
//=====================================================================				

//script that creates table of drivers which are available in our database
//the content of this script gets appended to index.php on the add new driver page

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

$sql = "SELECT id, truck_no, pickup_location, pickup_date, delivery_location, delivery_date from data_loads order by delivery_date limit 15;";

$result = $conn->query($sql);

$load_list_output = "<table>
				<tr>
					<th>Truck #</th>
					<th>Pickup</th>
					<th>Pickup Date</th>
					<th>Delivery</th>
					<th>Delivery Date</th>
					<th></th>
				</tr>";
foreach($result as $row) {
	$load_list_output .= '<tr>
								<td> '. $row['truck_no']			. ' </td>
								<td> '. $row['pickup_location']		. ' </td>
								<td> '. $row['pickup_date']			. ' </td>
								<td> '. $row['delivery_location']	. ' </td>
								<td> '. $row['delivery_date']		. ' </td>
								<td><a href="index.php?navigation=load_view&load_id=' . $row['id'] . '">View load</a>
							</tr> ';
}
$load_list_output .= '</table>';
//Close the connection
$conn->close();

//echo $load_list_output;

?>





