<?php 
$new_driver_form='<form action="insert\add_driver.php" method="GET">
	<fieldset class="form_fieldset">
		<legend>ADD A NEW DRIVER: </legend>
			<table>
				<tr>
					<td>First name:</td>
					<td><input type="text" name="firstname"/></td>
				</tr>
				<tr>
					<td>Last name:</td>
					<td><input type="text" name="lastname"/></td>
				</tr>
				<tr>
					<td>Phone number:</td>
					<td><input type="text" name="phone_no"/></td>
				</tr>
				<tr>
					<td>Tanker endorsment:</td>
					<td><input type="radio" name="endr_tanker" value="y"/>Yes
						<input type="radio" name="endr_tanker" value="n" checked/>No
					</td>
				</tr>
				<tr>
					<td>Hazmat endorsment:</td>
					<td><input type="radio" name="endr_hazmat" value="y"/>Yes
						<input type="radio" name="endr_hazmat" value="n" checked/>No
					</td>
				</tr>
				<tr>
					<td>Twic card:</td>
					<td><input type="radio" name="twic_card" value="y"/>Yes
						<input type="radio" name="twic_card" value="n" checked/>No
					</td>
				</tr>
				<tr>
					<td colspan=2><input class="button-primary" type="submit" value="Submit"></td>
				</tr>
			</table>
	</fieldset>
</form> ';
?>