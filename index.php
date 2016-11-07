<?php
//=====================================================================
//WRITER:		Ciprian Robu
//DATE:			04/09/15
//PURPOSE:		Main page. Caller of other smaller scripts
//COMMENTS:		Still more to be done here
//=====================================================================


	$navigation = '';
	$add_driver_status = '';
	$driver_notification = '';
	$add_truck_status = '';
	$truck_notification = '';
	$add_trailer_status = '';
	$trailer_notification = '';
	$add_load_status = '';
	$load_notification = '';
	$today = date("m-d-Y");
	
	
	if(isset($_GET['navigation'])) {
		$navigation = $_GET["navigation"];
	}
	if(isset($_GET['add_driver_status'])) {
		$add_driver_status = $_GET["add_driver_status"];
	}
	if(isset($_GET['add_truck_status'])) {
		$add_truck_status = $_GET["add_truck_status"];
	}
	if(isset($_GET['add_trailer_status'])) {
		$add_trailer_status = $_GET["add_trailer_status"];
	}
	if(isset($_GET['add_load_status'])) {
		$add_load_status = $_GET["add_load_status"];
	}
	if ($add_load_status == 'y') {
		$driver_notification = "<span class='green'>LOAD ADDED SUCCESSFULLY!</span>";
	}
	if ($add_driver_status == 'y') {
		$driver_notification = "<span class='green'>DRIVER ADDED SUCCESSFULLY!</span>";
	} elseif ($add_driver_status == 'de') {
		$driver_notification = "<span class='red'>DRIVER WAS NOT ADDED. DRIVER ALREADY EXISTS!</span>";
	} elseif ($add_driver_status == 'i') {
		$driver_notification = "<span class='red'>INCOMPLETE FIELDS!</span>";
	}
	if ($add_truck_status == 'y') {
		$truck_notification = "<span class='green'>TRUCK ADDED SUCCESSFULLY!</span>";
	} elseif ($add_truck_status == 'te') {
		$truck_notification = "<span class='red'>TRUCK WAS NOT ADDED. TRUCK NUMBER ALREADY EXISTS!</span>";
	} elseif ($add_truck_status == 'i') {
		$truck_notification = "<span class='red'>INCOMPLETE FIELDS!</span>";
	}
	if ($add_trailer_status == 'y') {
		$trailer_notification = "<span class='green'>TRAILER ADDED SUCCESSFULLY!</span>";
	} elseif ($add_trailer_status == 'te') {
		$trailer_notification = "<span class='red'>TRAILER WAS NOT ADDED. TRAILER NUMBER ALREADY EXISTS!</span>";
	} elseif ($add_trailer_status == 'i') {
		$trailer_notification = "<span class='red'>INCOMPLETE FIELDS!</span>";
	}
	if ($navigation == 'drivers') {
		include '\lists\drivers_list.php';
		include '\forms\new_driver_form.php';
		$page_body = '
				<div class="six columns">
				' . $driver_notification . $new_driver_form .  '
				</div>
				<div class="six columns"> <fieldset><legend>EXISTING DRIVERS:</legend>'.
					$drivers_list_output .'
				</fieldset></div>';
	} elseif ($navigation == 'loads') {
		include '\lists\load_list.php';
		include '\forms\new_load_form.php';
		$page_body = '
				<div class="six columns"> '
				. $driver_notification . $new_load_form . 
				'</div>
				<div class="six columns"> <fieldset><legend>EXISTING LOADS:</legend>'.
					$load_list_output .'
				</fieldset></div>';
	} elseif ($navigation == 'trucks') {
		include '\lists\truck_list.php';
		include '\forms\new_truck_form.php';
		$page_body = '
				<div class="six columns">'
				. $truck_notification . $new_truck_form .
				'</div>
				<div class="six columns"> <fieldset><legend>EXISTING TRUCKS:</legend>'
				. $truck_list_output . 
				'</fieldset></div>';
	} elseif ($navigation == 'trailers') {
		include '\lists\trailer_list.php';
		include '\forms\new_trailer_form.php';
		$page_body = '
				<div class="six columns">'
				. $trailer_notification . $new_trailer_form .
				'</div>
				<div class="six columns"> <fieldset><legend>EXISTING TRAILERS:</legend>'
				. $trailer_list_output .
				'</fieldset></div>';
	} elseif ($navigation == 'driver_view') {
		if(isset($_GET['driver_id'])) {
			$driver_id = $_GET['driver_id'];
			$page_body = "<div class='twelve columns'>
							<h5>DRIVER VIEW:</h5>" . 
							driver_view($driver_id) .
						"</div>";
		} else {
			$page_body = "<div class='twelve columns'><h5>DRIVER VIEW:</h5><span class='red'>SORRY, BUT THERE WAS NO DRIVER ID PROVIDED!</span></div>";
		}
	} elseif ($navigation == 'driver_edit') {
		if(isset($_GET['driver_id'])) {
			$driver_id = $_GET['driver_id'];
			$page_body = "<div class='twelve columns'>
							<h5>DRIVER EDIT:</h5>" . 
							driver_edit($driver_id) .
						"</div>";
		} else {
			$page_body = "<div class='twelve columns'><h5>DRIVER EDIT:</h5><span class='red'>SORRY, BUT THERE WAS NO DRIVER ID PROVIDED!</span></div>";
		}
	} elseif ($navigation == 'load_view') {
		if(isset($_GET['load_id'])) {
			$load_id = $_GET['load_id'];
			$page_body = "<div class='twelve columns'>
							<h5>LOAD VIEW:</h5>" . 
							load_view($load_id) .
						"</div>";
		} else {
			$page_body = "<div class='twelve columns'><h5>LOAD VIEW:</h5><span class='red'>SORRY, BUT THERE WAS NO LOAD ID PROVIDED!</span></div>";
		}
	} elseif ($navigation == 'truck_view') {
		if(isset($_GET['truck_id'])) {
			$truck_id = $_GET['truck_id'];
			$page_body = "<div class='six columns'>
							<h5>TRUCK VIEW:</h5>" . 
							truck_view($truck_id) .
						"</div>
						<div class='six columns'>
						<h6>LAST 5 LOADS FOR THIS TRUCK:</h6>".
						load_history($truck_id) .
						"</div>";
		} else {
			$page_body = "<div class='twelve columns'><h5>TRUCK VIEW:</h5><span class='red'>SORRY, BUT THERE WAS NO TRUCK ID PROVIDED!</span></div>";
		}
	} elseif ($navigation == 'trailer_view') {
		if(isset($_GET['trailer_id'])) {
			$trailer_id = $_GET['trailer_id'];
			$page_body = "<div class='twelve columns'>
							<h5>TRAILER VIEW:</h5>" . 
							trailer_view($trailer_id) .
						"</div>";
		} else {
			$page_body = "<div class='twelve columns'><h5>TRAILER VIEW:</h5><span class='red'>SORRY, BUT THERE WAS NO TRAILER ID PROVIDED!</span></div>";
		}
	} elseif ($navigation == 'truck_edit') {
		if(isset($_GET['truck_id'])) {
			$truck_id = $_GET['truck_id'];
			$page_body = "<div class='twelve columns'>
							<h5>TRUCK EDIT:</h5>" . 
							truck_edit($truck_id) .
						"</div>";
		} else {
			$page_body = "<div class='twelve columns'><h5>TRUCK EDIT:</h5><span class='red'>SORRY, BUT THERE WAS NO TRUCK ID PROVIDED!</span></div>";
		}
	} elseif ($navigation == 'load_edit') {
		if(isset($_GET['load_id'])) {
			$load_id = $_GET['load_id'];
			$page_body = "<div class='twelve columns'>
							<h5>LOAD EDIT:</h5>" . 
							load_edit($load_id) .
						"</div>";
		} else {
			$page_body = "<div class='twelve columns'><h5>LOAD EDIT:</h5><span class='red'>SORRY, BUT THERE WAS NO LOAD ID PROVIDED!</span></div>";
		}
	} elseif ($navigation == 'trailer_edit') {
		if(isset($_GET['trailer_id'])) {
			$trailer_id = $_GET['trailer_id'];
			$page_body = "<div class='twelve columns'>
							<h5>TRAILER EDIT:</h5>" . 
							trailer_edit($trailer_id) .
						"</div>";
		} else {
			$page_body = "<div class='twelve columns'><h5>TRAILER EDIT:</h5><span class='red'>SORRY, BUT THERE WAS NO TRAILER ID PROVIDED!</span></div>";
		}
	} elseif ($navigation == 'fleet_view') {
		$page_body = "<div class='twelve columns'>
						<h5>FLEET VIEW:</h5>" . 
						fleet_view() .
					"</div>";
	} else {
		$page_body = truck_status();
	}
	
	
//FUNCTIONS============================================================

function fleet_view(){
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
	$sql = "SELECT 
				A.id AS truck_id,
				D.id AS trailer_id,
				E.id AS driver_id,
				A.truck_no,
				E.firstname,
				E.lastname,
				D.type,
				D.trailer_no,
				E.endr_tanker,
				E.endr_hazmat,
				E.twic_card
			FROM data_trucks A
			LEFT JOIN rel_driver_truck B
			ON A.id=B.truck_id
			LEFT JOIN rel_truck_trailer C
			ON A.id=C.truck_id
			LEFT JOIN data_trailers D
			ON C.trailer_id=D.id
			LEFT JOIN data_drivers E
			ON B.driver_id=E.id
			ORDER BY A.truck_no;";
	$result = $conn->query($sql);
	$fleet_view_return = "<table>
							<tr>
								<th>Truck#</th>
								<th>Driver</th>
								<th>Trailer#</th>
								<th>Trailer Type</th>
								<th>Hazmat Endr.</th>
								<th>Tanker Endr</th>
								<th>Twic Card</th>
							</tr>";
	foreach ($result as $row) {
		$tmp_truck_id = $row['truck_id'];
		$tmp_driver_id = $row['driver_id'];
		$tmp_trailer_id = $row['trailer_id'];
		$tmp_truck_no = $row['truck_no'];
		$tmp_driver = $row['firstname'] .' '. $row['lastname'] ;
		$tmp_trailer_no = $row['trailer_no'];
		$tmp_type = $row['type'];
		$tmp_hazmat = $row['endr_hazmat'];
		$tmp_tanker = $row['endr_tanker'];
		$tmp_twic_card = $row['twic_card'];

		$fleet_view_return .= "<tr>
								<td><a href='index.php?navigation=truck_view&truck_id=$tmp_truck_id'>$tmp_truck_no</a></td>
								<td><a href='index.php?navigation=driver_view&driver_id=$tmp_driver_id'>$tmp_driver</a></td>
								<td><a href='index.php?navigation=trailer_view&trailer_id=$tmp_trailer_id'>$tmp_trailer_no</a></td>
								<td>$tmp_type</td>
								<td>$tmp_hazmat</td>
								<td>$tmp_tanker</td>
								<td>$tmp_twic_card</td>
							</tr>";
	}
	$fleet_view_return .= "</table>";
	return $fleet_view_return;
} //end function fleet_view

//---------------------------------------------------------------------------------------------

function load_history($truck_id) {
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
	
	$sql = "SELECT 	A.id,
					A.pickup_location,
					A.delivery_location,
					A.dollar_per_mile
			FROM data_loads A 
			LEFT JOIN data_trucks B
			ON A.truck_no=B.truck_no
			WHERE B.id='$truck_id'
			ORDER BY A.delivery_date
			limit 5;";
	
	$result = $conn->query($sql);
	
	$load_history_output = '<table><tr>
								<th>Load ID</th>
								<th>Pickup</th>
								<th>Delivery</th>
								<th>$/mile</th>
								</tr>';
	
	foreach($result as $row) {
		$load_history_output .= '<tr>
									<td>
										<a href="index.php?navigation=load_view&load_id='.$row['id'].'">'. $row['id']	. '</a>
									</td>
									<td>
										'. $row['pickup_location']	. '
									</td>
									<td>
										'. $row['delivery_location']. '
									</td>
									<td>
										'. $row['dollar_per_mile']	. '
									</td>
								</tr>';
	}
	$load_history_output .= '</table>';
	//Close the connection
	$conn->close();
	return $load_history_output;
} // end load_history() function

//---------------------------------------------------------------------------------------------

function driver_view($driver_id) {
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
	
	$sql = "SELECT * from data_drivers where id='$driver_id';";
	
	$result = $conn->query($sql);
	

	foreach($result as $row) {
		$driver_view_output = '<table><tr>
									<th>First name:</th><td> '. $row['firstname']	. ' </td>
								</tr>
								<tr>
									<th>Last name:</th><td> '. $row['lastname']	. ' </td>
								</tr>
								<tr>
									<th>Phone number:</th><td> '. $row['phone_no']	. ' </td>
								</tr>
								<tr>
									<th>Tanker Endorsement:</th><td> '. $row['endr_tanker']	. ' </td>
								</tr>
								<tr>
									<th>Hazmat Endorsement:</th><td> '. $row['endr_hazmat']	. ' </td>
								</tr>
								<tr>
									<th>Twic Card:</th><td> '. $row['twic_card']	. ' </td>
								</tr>';
	}
	
	//retrieve the truck that this driver is assigned to
	$sql = "SELECT * from rel_driver_truck where driver_id='$driver_id';";
	$result = $conn->query($sql);
	$truck_id = '';
	foreach ($result as $row) {
		$truck_id = $row['truck_id'];
	}

	if ( strlen($truck_id)<1 ) {
		$driver_view_output .= "<tr>
									<th>Truck No#:</th>
									<td><span class='red'>NO TRUCK ASSIGNED</span></td>
								</tr>
								<tr>
									<td colspan=2><a class='button button-primary' href='index.php?navigation=driver_edit&driver_id=$driver_id'>Edit info</a></td>
								</tr>
							</table>";
	} else {
		$sql = "SELECT truck_no from data_trucks where id='$truck_id';";
		$result = $conn->query($sql);
		foreach ($result as $row){
			$truck_no = $row['truck_no'];
		}
		$driver_view_output .= "<tr>
									<th>Truck No#:</th>
									<td>$truck_no</td>
								</tr>
								<tr>
									<td colspan=2><a class='button button-primary' href='index.php?navigation=driver_edit&driver_id=$driver_id'>Edit info</a></td>
								</tr>
							</table>
							";
	}
	//Close the connection
	$conn->close();
	return $driver_view_output;
} //end function driver_view()

//---------------------------------------------------------------------------------------------

function driver_edit($driver_id) {
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
	
	$sql = "SELECT * from data_drivers where id='$driver_id';";
	
	$result = $conn->query($sql);
	

	foreach($result as $row) {
		$tmp_tanker 	= $row['endr_tanker'];
		if ($tmp_tanker == 'y') {
			$tmp_tanker_yes = ' checked '; 
			$tmp_tanker_no = ' ';
		} else {
			$tmp_tanker_yes = ' '; 
			$tmp_tanker_no = ' checked ';
		}
		$tmp_hazmat 	= $row['endr_hazmat'];
		if ($tmp_hazmat == 'y') {
			$tmp_hazmat_yes = ' checked '; 
			$tmp_hazmat_no = ' ';
		} else {
			$tmp_hazmat_yes = ' '; 
			$tmp_hazmat_no = ' checked ';
		}
		$tmp_twic 	= $row['twic_card'];
		if ($tmp_twic == 'y') {
			$tmp_twic_yes = ' checked '; 
			$tmp_twic_no = ' ';
		} else {
			$tmp_twic_yes = ' '; 
			$tmp_twic_no = ' checked ';
		}
		$driver_edit_output = '<form action="update\update_driver.php" method="GET">
								<input type="hidden" name="driver_id" value="'. $driver_id .'"/>
							<table><tr>
									<th>First name:</th><td><input type="text" name="firstname" value="'. $row['firstname']	. '" /></td>
								</tr>
								<tr>
									<th>Last name:</th><td><input type="text" name="lastname" value="'. $row['lastname']	. '" /> </td>
								</tr>
								<tr>
									<th>Phone number:</th><td><input type="text" name="phone_no" value="'. $row['phone_no']	. '" /> </td>
								</tr>
								<tr>
									<th>Tanker Endorsement:</th>
									<td><input type="radio" name="endr_tanker" value="y"' . $tmp_tanker_yes . '/>Yes
										<input type="radio" name="endr_tanker" value="n"' . $tmp_tanker_no . '/>No 
									</td>
								</tr>
								<tr>
									<th>Hazmat Endorsement:</th>
									<td>
										<input type="radio" name="endr_hazmat" value="y"' . $tmp_hazmat_yes . '/>Yes
										<input type="radio" name="endr_hazmat" value="n"' . $tmp_hazmat_no . '/>No
									</td>
								</tr>
								<tr>
									<th>Twic Card:</th>
									<td>
										<input type="radio" name="twic_card" value="y"' . $tmp_twic_yes . '/>Yes
										<input type="radio" name="twic_card" value="n"' . $tmp_twic_no . '/>No
									</td>
								</tr>
								<tr>
									<th>Truck No#:</th>';
	}
	
	//retrieve the truck that this driver is assigned to
	$sql = "SELECT * from rel_driver_truck where driver_id='$driver_id';";
	$result = $conn->query($sql);
	$truck_id = '';
	foreach ($result as $row) {
		$truck_id = $row['truck_id'];
	}
	
	if ( strlen($truck_id)<1 ) {
		//get list of trucks for drop-down menu without selected one
		$sql = "select truck_no from data_trucks order by truck_no;";
		$result = $conn->query($sql);
		$driver_edit_output .= '<td><select name="truck_no"><option value="" selected>Select a truck</option>';
		foreach($result as $row) {
			$driver_edit_output .= '<option value="' . $row['truck_no'] . '">' . $row['truck_no'] . '</option>';
		}
		$driver_edit_output .= '		</select>
									</td>
								</tr>
								<tr>
									<td colspan=2><input class="button-primary" type="submit" value="Submit" /></td>
								</tr>
							</table>
							</form>';
	} else {
		$sql = "select id, truck_no from data_trucks order by truck_no;";
		$result = $conn->query($sql);
		$driver_edit_output .= '<td><select name="truck_no"><option value="">Select a truck</option>';
		foreach($result as $row) {
			if ($truck_id == $row['id']) {
				$driver_edit_output .= '<option value="' . $row['truck_no'] . '" selected>' . $row['truck_no'] . '</option>';
			} else {
				$driver_edit_output .= '<option value="' . $row['truck_no'] . '">' . $row['truck_no'] . '</option>';
			}
		}
		$driver_edit_output .= '		</select>
									</td>
								</tr>
								<tr>
									<td colspan=2><input class="button-primary" type="submit" value="Submit" /></td>
								</tr>
							</table>
							</form>';
	}
	//Close the connection
	$conn->close();
	return $driver_edit_output;
} //end function driver_edit()

//---------------------------------------------------------------------------------------------

function load_view($load_id) {
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
	
	$sql = "SELECT * from data_loads where id='$load_id';";
	
	$result = $conn->query($sql);
	
	foreach($result as $row) {
		$load_view_output = '<table><tr>
									<th>Truck#:</th><td> '. $row['truck_no']	. ' </td>
								</tr>
								<tr>
									<th>Trailer#:</th><td> '. $row['trailer_no']	. ' </td>
								</tr>
								<tr>
									<th>Broker:</th><td> '. $row['broker']	. ' </td>
								</tr>
								<tr>
									<th>Load#:</th><td> '. $row['load_number']	. ' </td>
								</tr>
								<tr>
									<th>Pickup location:</th><td> '. $row['pickup_location']	. ' </td>
								</tr>
								<tr>
									<th>Pickup date:</th><td> '. $row['pickup_date']	. ' </td>
								</tr>
								<tr>
									<th>Pickup time:</th><td> '. $row['pickup_time']	. ' </td>
								</tr>
								<tr>
									<th>Delivery location:</th><td> '. $row['delivery_location']	. ' </td>
								</tr>
								<tr>
									<th>Delivery date:</th><td> '. $row['delivery_date']	. ' </td>
								</tr>
								<tr>
									<th>Delivery time:</th><td> '. $row['delivery_time']	. ' </td>
								</tr>
								<tr>
									<th>Weight:</th><td> '. $row['weight']	. ' </td>
								</tr>
								<tr>
									<th>Deadhead:</th><td> '. $row['dh']	. ' </td>
								</tr>
								<tr>
									<th>Miles:</th><td> '. $row['miles']	. ' </td>
								</tr>
								<tr>
									<th>Rate:</th><td> '. $row['rate']	. ' </td>
								</tr>
								<tr>
									<th>Dollar per mine:</th><td> '. $row['dollar_per_mile']	. ' </td>
								</tr>
								<tr>
									<td colspan=2><a class="button button-primary" href="index.php?navigation=load_edit&load_id='. $load_id .'">Edit info</a></td>
								</tr></table>';
	}

	//Close the connection
	$conn->close();
	return $load_view_output;
} //end function load_view()
//---------------------------------------------------------------------------------------------

function load_edit($load_id) {
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
	
	$sql = "SELECT truck_no from data_trucks order by truck_no;";
	$tmp_truck_list = $conn->query($sql);
	
	$sql = "SELECT truck_no, pickup_date, delivery_date from data_loads where id='$load_id';";
	$result = $conn->query($sql);
	$load_truck_no = '';
	$load_pickup_date = '';
	$load_delivery_date = '';
	
	foreach($result as $row) {
		$load_truck_no = $row['truck_no'];
		$load_pickup_date = $row['pickup_date'];
		$load_delivery_date = $row['delivery_date'];
	}

	//in the future, reference these 2 variables by their array content. ex: $load_pickup_date[0], $load_pickup_date[1]
	// 0->year
	// 1->month
	// 2->day

	$load_pickup_date = explode("-", $load_pickup_date);
	$load_delivery_date = explode("-", $load_delivery_date);
	
	$tmp_selected_truck = "<select name='truck_no'>";
	foreach($tmp_truck_list as $row) {
		if ($load_truck_no == $row['truck_no']) {
			$tmp_selected_truck .= "<option value='" . $row['truck_no'] . "' selected>" . $row['truck_no'] . "</option>";
		} else {
			$tmp_selected_truck .= "<option value='" . $row['truck_no'] . "'>" . $row['truck_no'] . "</option>";
		}
	}
	$tmp_selected_truck .= "</select>";
	
	//date arrays
	$days = array("Day", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");
	$months = array("Month", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
	$years = array("Year", "2015", "2016", "2017", "2018", "2019", "2020", "2021", "2022", "2023", "2024", "2025", "2026", "2027", "2028", "2029", "2030");
	//create selected day for both delivery and pickup
	$pickup_selected_day = '<select title="Day" name="pickup_day">';
	$delivery_selected_day = '<select title="Day" name="delivery_day">';
	foreach ($days as $day) {
		if ($load_pickup_date[2] == $day) {
			$pickup_selected_day .= "<option value='$day' selected>$day</option>";
		} else {
			$pickup_selected_day .= "<option value='$day'>$day</option>";
		}
		if ($load_delivery_date[2] == $day) {
			$delivery_selected_day .= "<option value='$day' selected>$day</option>";
		} else {
			$delivery_selected_day .= "<option value='$day'>$day</option>";
		}
	}
	$pickup_selected_day .= "</select>";
	$delivery_selected_day .= "</select>";
	
	//create selected month for both delivery and pickup
	$pickup_selected_month = '<select title="Month" name="pickup_month">';
	$delivery_selected_month = '<select title="Month" name="delivery_month">';
	foreach ($months as $month) {
		if ($load_pickup_date[1] == $month) {
			$pickup_selected_month .= "<option value='$month' selected>$month</option>";
		} else {
			$pickup_selected_month .= "<option value='$month'>$month</option>";
		}
		if ($load_delivery_date[1] == $month) {
			$delivery_selected_month .= "<option value='$month' selected>$month</option>";
		} else {
			$delivery_selected_month .= "<option value='$month'>$month</option>";
		}
	}
	$pickup_selected_month .= "</select>";
	$delivery_selected_month .= "</select>";
	
	//create selected year for both delivery and pickup
	$pickup_selected_year = '<select title="Year" name="pickup_year">';
	$delivery_selected_year = '<select title="Year" name="delivery_year">';
	foreach ($years as $year) {
		if ($load_pickup_date[0] == $year) {
			$pickup_selected_year .= "<option value='$year' selected>$year</option>";
		} else {
			$pickup_selected_year .= "<option value='$year'>$year</option>";
		}
		if ($load_delivery_date[0] == $year) {
			$delivery_selected_year .= "<option value='$year' selected>$year</option>";
		} else {
			$delivery_selected_year .= "<option value='$year'>$year</option>";
		}
	}
	$pickup_selected_year .= "</select>";
	$delivery_selected_year .= "</select>";
	
	$sql = "SELECT * from data_loads where id='$load_id';";
	$result = $conn->query($sql);
	
	$load_edit_output = '';
	foreach($result as $row) {
		$load_edit_output = '
							<form action="update\update_load.php" method="GET">
							<input type="hidden" name="load_id" value="'. $load_id .'"/>
							<table><tr>
									<th>Truck#:</th><td>'. $tmp_selected_truck	. ' </td>
								</tr>
								<tr>
									<th>Broker:</th><td><input type="text" name="broker" value="'. $row['broker']	. '" /> </td>
								</tr>
								<tr>
									<th>Load#:</th><td><input type="text" name="load_number" value="'. $row['load_number']	. '" /> </td>
								</tr>
								<tr>
									<th>Pickup location:</th><td><input type="text" name="pickup_location" value="'. $row['pickup_location']	. '" /> </td>
								</tr>
								<tr>
									<th>Pickup date:</th><td> '. $pickup_selected_month . $pickup_selected_day . $pickup_selected_year . ' </td>
								</tr>
								<tr>
									<th>Pickup time:</th><td><input type="text" name="pickup_time" value="'. $row['pickup_time']	. '" /> </td>
								</tr>
								<tr>
									<th>Delivery location:</th><td><input type="text" name="delivery_location" value="'. $row['delivery_location']	. '" /> </td>
								</tr>
								<tr>
									<th>Delivery date:</th><td> '. $delivery_selected_month . $delivery_selected_day . $delivery_selected_year .' </td>
								</tr>
								<tr>
									<th>Delivery time:</th><td><input type="text" name="delivery_time" value="'. $row['delivery_time']	. '" /> </td>
								</tr>
								<tr>
									<th>Weight:</th><td><input type="text" name="weight" value="'. $row['weight']	. '" /> </td>
								</tr>
								<tr>
									<th>Deadhead:</th><td><input type="text" name="weight" value="'. $row['dh']	. '" /> </td>
								</tr>
								<tr>
									<th>Miles:</th><td><input type="text" name="miles" value="'. $row['miles']	. '" /> </td>
								</tr>
								<tr>
									<th>Rate:</th><td><input type="text" name="rate" value="'. $row['rate']	. '" /> </td>
								</tr>
								<tr>
									<td colspan=2><input class="button-primary" type="submit" value="Submit" /></td>
								</tr>
								</table></form>';
	}

	//Close the connection
	$conn->close();
	return $load_edit_output;
} //end function load_edit()

//---------------------------------------------------------------------------------------------

function truck_view($truck_id) {
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
	
	$sql = "SELECT * from data_trucks where id='$truck_id';";
	
	$result = $conn->query($sql);
	

	foreach($result as $row) {
		$truck_view_output = '<table><tr>
									<th>Make:</th><td> '. $row['make']	. ' </td>
								</tr>
								<tr>
									<th>Model:</th><td> '. $row['model']	. ' </td>
								</tr>
								<tr>
									<th>Engine:</th><td> '. $row['engine']	. ' </td>
								</tr>
								<tr>
									<th>Truck#:</th><td> '. $row['truck_no']	. ' </td>
								</tr>';
	}
	
	//retrieve the truck that this driver is assigned to
	$sql = "SELECT * from rel_driver_truck where truck_id='$truck_id';";
	$result = $conn->query($sql);
	$driver_id = '';
	foreach ($result as $row) {
		$driver_id = $row['driver_id'];
	}

	if ( strlen($driver_id)<1 ) {
		$truck_view_output .= "<tr>
									<th>Driver:</th>
									<td><span class='red'>NO DRIVER ASSIGNED</span></td>
								</tr>
								<tr>
									<td colspan=2><a class='button button-primary' href='index.php?navigation=truck_edit&truck_id=$truck_id'>Edit info</a></td>
								</tr>
							</table>";
	} else {
		$sql = "SELECT firstname, lastname from data_drivers where id='$driver_id';";
		$result = $conn->query($sql);
		$driver = '';
		foreach ($result as $row){
			$driver = $row['firstname'] . ' ' . $row['lastname'];
		}
		$truck_view_output .= "<tr>
									<th>Driver:</th>
									<td>$driver</td>
								</tr>
								<tr>
									<td colspan=2><a class='button button-primary' href='index.php?navigation=truck_edit&truck_id=$truck_id'>Edit info</a></td>
								</tr>
							</table>
							";
	}
	//Close the connection
	$conn->close();
	return $truck_view_output;
} //end function truck_view()

//---------------------------------------------------------------------------------------------

function truck_edit($truck_id) {
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
	
	$sql = "SELECT * from data_trucks where id='$truck_id';";
	
	$result = $conn->query($sql);
	

	foreach($result as $row) {
		$truck_edit_output = '
						<form action="update\update_truck.php" method="GET">
						<input type="hidden" name="truck_id" value="' . $truck_id . '" />
							<table><tr>
									<th>Make:</th><td><input type="text" name="make" value="'. $row['make']	. '" /></td>
								</tr>
								<tr>
									<th>Model:</th><td><input type="text" name="model" value="'. $row['model']	. '" /></td>
								</tr>
								<tr>
									<th>Engine:</th><td><input type="text" name="engine" value="'. $row['engine']	. '" /></td>
								</tr>
								<tr>
									<th>Truck#:</th><td><input type="text" name="truck_no" value="'. $row['truck_no']	. '" /> </td>
								</tr>';
	}
	
	//retrieve the truck that this driver is assigned to
	$sql = "SELECT * from rel_driver_truck where truck_id='$truck_id';";
	$result = $conn->query($sql);
	$driver_id = '';
	foreach ($result as $row) {
		$driver_id = $row['driver_id'];
	}
	
	$sql = "select id, firstname, lastname from data_drivers order by firstname;";
	$result = $conn->query($sql);
	$driver_select_dropdown = "<select name='driver_id'><option>None</option>";
	foreach ($result as $row) {
		if ($driver_id == $row['id']) {
			$driver_select_dropdown .= '<option value="' . $row['id'] . '" selected>' . $row['firstname'] .' '. $row['lastname'] . "</option>";
		} else {
			$driver_select_dropdown .= '<option value="' . $row['id'] . '">' . $row['firstname'] .' '. $row['lastname'] . "</option>";
		}
	}
	$driver_select_dropdown .= "</select>";

	$truck_edit_output .= "<tr>
								<th>Driver:</th>
								<td>". $driver_select_dropdown ."</td>
							</tr>
							<tr>
								<td colspan=2><input class='button button-primary' type='submit' value='Submit' /></td>
							</tr>
						</table></form>";
	//Close the connection
	$conn->close();
	return $truck_edit_output;
} //end function truck_edit()

//---------------------------------------------------------------------------------------------

function trailer_view($trailer_id) {
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
	
	$sql = "SELECT * from data_trailers where id='$trailer_id';";
	
	$result = $conn->query($sql);
	

	foreach($result as $row) {
		$tmp_trailer_type = $row['type'];
		if ($tmp_trailer_type == 'dv') {
			$tmp_trailer_type = 'Dry van';
		} elseif ($tmp_trailer_type == 'r') {
			$tmp_trailer_type = 'Reefer';
		}
		$trailer_view_output = '<table><tr>
									<th>Make:</th><td> '. $row['make']	. ' </td>
								</tr>
								<tr>
									<th>Model:</th><td> '. $row['model']	. ' </td>
								</tr>
								<tr>
									<th>Length:</th><td> '. $row['length']	. ' </td>
								</tr>
								<tr>
									<th>Type:</th><td> '. $tmp_trailer_type	. ' </td>
								</tr>
								<tr>
									<th>Trailer#:</th><td> '. $row['trailer_no']	. ' </td>
								</tr>';
	}
	
	//retrieve the truck that this trailer is assigned to
	$sql = "SELECT * from rel_truck_trailer where trailer_id='$trailer_id';";
	$result = $conn->query($sql);
	$truck_id = '';
	foreach ($result as $row) {
		$truck_id = $row['truck_id'];
	}

	if ( strlen($truck_id)<1 ) {
		$trailer_view_output .= "<tr>
									<th>Truck:</th>
									<td><span class='red'>NO TRUCK ASSIGNED</span></td>
								</tr>
								<tr>
									<td colspan=2><a class='button button-primary' href='index.php?navigation=trailer_edit&trailer_id=$trailer_id'>Edit info</a></td>
								</tr>
							</table>";
	} else {
		$sql = "SELECT truck_no from data_trucks where id='$truck_id';";
		$result = $conn->query($sql);
		$truck_no = '';
		foreach ($result as $row){
			$truck_no = $row['truck_no'];
		}
		$trailer_view_output .= "<tr>
									<th>Truck#:</th>
									<td>$truck_no</td>
								</tr>
								<tr>
									<td colspan=2><a class='button button-primary' href='index.php?navigation=trailer_edit&trailer_id=$trailer_id'>Edit info</a></td>
								</tr>
							</table>
							";
	}
	//Close the connection
	$conn->close();
	return $trailer_view_output;
} //end function trailer_view()

//---------------------------------------------------------------------------------------------

function trailer_edit($trailer_id) {
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
	
	$sql = "SELECT * from data_trailers where id='$trailer_id';";
	
	$result = $conn->query($sql);
	

	foreach($result as $row) {
		$tmp_selected_type = '';
		
		if ($row['type'] == 'dv'){
			$tmp_selected_type = "<select name='type'>
									<option value='dv' selected>Dry van</option>
									<option value='r'>Reefer</option>
								  </select>";
		} elseif ($row['type'] == 'r'){
			$tmp_selected_type = "<select name='type'>
									<option value='dv'>Dry van</option>
									<option value='r' selected>Reefer</option>
								  </select>";
		}
		
		$trailer_edit_output = '
							<form action="update\update_trailer.php" method="GET">
							<input type="hidden" name="trailer_id" value="'. $trailer_id .'"/>
							<table><tr>
									<th>Make:</th><td><input type="text" name="make" value="'. $row['make']	. '" /> </td>
								</tr>
								<tr>
									<th>Model:</th><td><input type="text" name="model" value="'. $row['model']	. '" /> </td>
								</tr>
								<tr>
									<th>Length:</th>
									<td>
										<select name="length">
											<option value="53" selected>53ft</option>
										</select>
									</td>
								</tr>
								<tr>
									<th>Type:</th><td> '. $tmp_selected_type	. ' </td>
								</tr>
								<tr>
									<th>Trailer#:</th><td><input type="text" name="trailer_no" value="'. $row['trailer_no']	. '" /> </td>
								</tr>';
	}
	
	//retrieve the truck that this trailer is assigned to
	$sql = "SELECT * from rel_truck_trailer where trailer_id='$trailer_id';";
	$result = $conn->query($sql);
	$truck_id = '';
	foreach ($result as $row) {
		$truck_id = $row['truck_id'];
	}
	
	$sql = "SELECT id, truck_no from data_trucks order by truck_no;";
	$tmp_truck_array = $conn->query($sql);

	$truck_option_select = '<select name="truck_id"><option>None</option>';
	foreach ($tmp_truck_array as $row) {
		if ($truck_id == $row['id']) {
			$truck_option_select .= '<option value="'.$row['id'].'" selected>'.$row['truck_no'].'</option>';
		} else {
			$truck_option_select .= '<option value="'.$row['id'].'">'.$row['truck_no'].'</option>';
		}
	}
	$truck_option_select .= '</select>';
	$trailer_edit_output .= "<tr>
								<th>Truck:</th>
								<td>". $truck_option_select ."</td>
							</tr>
							<tr>
								<td colspan=2><input type='submit' class='button button-primary' value='Submit' /></td>
							</tr>
						</table>";

	//Close the connection
	$conn->close();
	return $trailer_edit_output;
} //end function trailer_edit()


//---------------------------------------------------------------------------------------------

function truck_status() {
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
	$sql = "SELECT truck_no FROM data_trucks;";
	$truck_list = $conn->query($sql);
	
	$today = date("m-d-Y");
	$today = explode("-", $today);
	$today_month = $today[0];
	$today_day = $today[1];
	$today_year = $today[2];
	
	$truck_array = array();
	$truck_status_return = '<div class="twelve columns"><table>
									<tr>
										<th>Truck#</th>
										<th>Driver</th>
										<th>Pickup Location</th>
										<th>Pickup Date</th>
										<th>Delivery Location</th>
										<th>Delivery Date</th>
										<th>Rate</th>
										<th>$/mile</th>
										<th>Date Modified</th>
									</tr>';
	foreach($truck_list as $row) {
		array_push($truck_array, $row['truck_no']);
	}
	
	foreach ($truck_array as $value) {
		$tmp_sql = "SELECT 
						A.broker, 
						A.truck_no,
						D.firstname,
						A.pickup_location, 
						A.pickup_date, 
						A.pickup_time, 
						A.delivery_location,
						A.delivery_date, 
						A.delivery_time,
						A.weight,
						A.dh, 
						A.miles,
						A.rate,
						A.dollar_per_mile,
						A.date_modified
					FROM data_loads A
					LEFT JOIN data_trucks B
						ON A.truck_no = B.truck_no
					LEFT JOIN rel_driver_truck C
						ON B.id = C.truck_id
					LEFT JOIN data_drivers D
						ON C.driver_id = D.id
					WHERE A.truck_no=$value
					ORDER BY A.delivery_date 
					DESC limit 1;";
		$tmp_result = $conn->query($tmp_sql);
		foreach ($tmp_result as $tmp_row) {
			$truck_status_return .= '<tr>
										<td>'.$tmp_row['truck_no'].'</td>
										<td>'.$tmp_row['firstname'].'</td>
										<td>'.$tmp_row['pickup_location'].'</td>
										<td>'.$tmp_row['pickup_date'].'</td>
										<td>'.$tmp_row['delivery_location'].'</td>
										<td>'.$tmp_row['delivery_date'].'</td>
										<td>'.$tmp_row['rate'].'</td>
										<td>'.$tmp_row['dollar_per_mile'].'</td>
										<td>'.$tmp_row['date_modified'].'</td>
									</tr>';
		}
	}
	$truck_status_return .= '</table></div>';
	
	$conn->close();
	return $truck_status_return;
} //end function truck_status()


//=====================================================================

?>


<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="css/skeleton.css" />
	<link rel="stylesheet" type="text/css" href="css/tml.css" />
	<title>Triple M Logistics, Inc.</title>
	<script type="text/javascript" src="/javascript/jquery.js"></script>
	<script type="text/javascript" src="/javascript/tablesorter.js"></script>
	<script type="text/javascript" src="/javascript/tml_jquery.js"></script>
</head>

<body>
	<div class='container'>
		<div class='row'>
			<div class='twelve columns'>
				<h4 class='center_text'>Today's date: <?php echo $today ?></h4>
				
			</div>
		</div>
		<div class='row'>
			<div class='twelve columns'>
				<a class="button button-primary" href="index.php">Truck Status</a>
				<a class="button button-primary" href="index.php?navigation=drivers">Drivers</a>
				<a class="button button-primary" href="index.php?navigation=loads">Loads</a>
				<a class="button button-primary" href="index.php?navigation=trucks">Trucks</a>
				<a class="button button-primary" href="index.php?navigation=trailers">Trailers</a>
				<a class="button button-primary" href="index.php?navigation=fleet_view">Fleet View</a>
			</div>
		</div>
		<div class='row'>

			<?php
				echo $page_body;
			?>

		</div>
		<div class='row'>
			<div class='twelve columns'>
				<a class="button" href="index.php">Truck Status</a>
				<a class="button" href="index.php?navigation=drivers">Drivers</a>
				<a class="button" href="index.php?navigation=loads">Loads</a>
				<a class="button" href="index.php?navigation=trucks">Trucks</a>
				<a class="button" href="index.php?navigation=trailers">Trailers</a>
				<a class="button" href="index.php?navigation=fleet_view">Fleet View</a>
			</div>
		</div>
	</div>

</body>

</html>