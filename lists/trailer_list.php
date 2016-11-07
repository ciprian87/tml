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

$sql = "SELECT id, trailer_no, type, length from data_trailers order by trailer_no;";

$result = $conn->query($sql);

$trailer_list_output = "<table>
				<tr>
					<th>Trailer#</th>
					<th>Type</th>
					<th>Length</th>
					<th></th>
				</tr>";
foreach($result as $row) {
	$trailer_list_output .= '<tr>
								<td> '. $row['trailer_no']	. ' </td>
								<td> '. $row['type']	. ' </td>
								<td> '. $row['length']	. ' </td>
								<td><a href="index.php?navigation=trailer_view&trailer_id='.$row['id'].'">View trailer</a></td>
							</tr> ';
}
$trailer_list_output .= '</table>';
//Close the connection
$conn->close();

//echo $trailer_list_output;

?>





