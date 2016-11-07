<?php
//=====================================================================
//WRITER:		Ciprian Robu
//DATE:			04/09/15
//PURPOSE:		Generate table of drivers in our DB
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

$sql = "SELECT id, firstname, lastname from data_drivers order by firstname;";

$result = $conn->query($sql);

$drivers_list_output = "<table>";
foreach($result as $row) {
	$drivers_list_output .= '<tr>
								<td> <a href="index.php?navigation=driver_view&driver_id='.$row['id'].'">' . $row['firstname'] . ' ' .  $row['lastname']	. ' </a></td>
							</tr> ';
}
$drivers_list_output .= '</table>';
//Close the connection
$conn->close();

//echo $drivers_list_output;


?>





