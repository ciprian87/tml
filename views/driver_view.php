<?php
//=====================================================================
//WRITER:		Ciprian Robu
//DATE:			04/09/15
//PURPOSE:		Driver view and assignment of driver to truck
//COMMENTS:		Will probably add more info about drivers down the line
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
$driver_id ='';

if(isset($_GET['driver_id'])) {
		$add_driver_status = $_GET["add_driver_status"];
	}

$sql = "SELECT * from data_drivers;";

$result = $conn->query($sql);

$drivers_list_output = "<table>
				<tr>
					<th>First name</th>
					<th>Last name</th>
					<th>Phone number</th>
					<th>Tanker Endorsement</th>
					<th>Hazmat Endorsement</th>
					<th>Twic Card</th>
				</tr>";
foreach($result as $row) {
	$drivers_list_output .= '<tr>
								<td> '. $row['firstname']	. ' </td>
								<td> '. $row['lastname']	. ' </td>
								<td> '. $row['phone_no']	. ' </td>
								<td> '. $row['endr_tanker']	. ' </td>
								<td> '. $row['endr_hazmat']	. ' </td>
								<td> '. $row['twic_card']	. ' </td>
							</tr> ';
}
$drivers_list_output .= '</table>';
//Close the connection
$conn->close();

//echo $drivers_list_output;


?>





