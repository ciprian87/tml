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

$sql = "SELECT id, truck_no from data_trucks order by truck_no;";

$result = $conn->query($sql);

$truck_list_dropdown = '<select name="truck_no">';

$truck_list_output = "<table>
				<tr>
					<th>Truck#</th>
				</tr>";
foreach($result as $row) {
	$truck_list_dropdown .= '<option value="'. $row['truck_no'] .'">' . $row['truck_no'] . '</option>';
	$truck_list_output .= '<tr>
								<td><a href="index.php?navigation=truck_view&truck_id='. $row['id'] .'">'. $row['truck_no']	. '</a></td>
							</tr> ';
}
$truck_list_dropdown .= '</select>';
$truck_list_output .= '</table>';
//Close the connection
$conn->close();

//echo $truck_list_output;

?>





