<?php
$new_truck_form = '<form action="insert\add_truck.php" method="GET">
	<fieldset class="form_fieldset">
		<legend>ADD A NEW TRUCK: </legend>
			<table>
				<tr>
					<td>Make:</td>
					<td><input type="text" name="make"/></td>
				</tr>
				<tr>
					<td>Model:</td>
					<td><input type="text" name="model"/></td>
				</tr>
				<tr>
					<td>Engine:</td>
					<td><input type="text" name="engine"/></td>
				</tr>
				<tr>
					<td>Truck#:</td>
					<td><input type="text" name="truck_no"/></td>
				</tr>
				<tr>
					<td colspan=2><input class="button-primary" type="submit" value="Submit"></td>
				</tr>
			</table>
	</fieldset>
</form>';
?>