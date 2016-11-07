<?php 
$new_trailer_form = '<form action="insert\add_trailer.php" method="GET">
	<fieldset class="form_fieldset">
		<legend>ADD A NEW TRAILER: </legend>
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
					<td>Length:</td>
					<td><select name="length">
							<option value="53" selected>53ft</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Type:</td>
					<td>
						<select name="type">
							<option value="dv">Dry van</option>
							<option value="r">Reefer</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Trailer#:</td>
					<td><input type="text" name="trailer_no"/></td>
				<tr>
					<td colspan=2><input class="button-primary" type="submit" value="Submit"></td>
				</tr>
			</table>
	</fieldset>
</form>';
?>