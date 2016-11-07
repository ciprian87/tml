<?php
include "/lists/truck_list.php";

$new_load_form = '<form action="insert\add_load.php" method="GET">
					<fieldset class="form_fieldset">
						<legend>ADD A NEW LOAD:</legend>
							<table>
								<tr>
									<td>Truck:</td>
									<td>' . $truck_list_dropdown . ' 
										
									</td>
								</tr>
								<tr>
									<td>Broker:</td>
									<td><input type="text" name="broker"/></td>
								</tr>
								<tr>
									<td>Load number:</td>
									<td><input type="text" name="load_no"/></td>
								</tr>
								<tr>
									<td>Pickup location:</td>
									<td><input type="text" name="pickup_location"/></td>
								</tr>
								<tr>
									<td>Pickup date:</td>
									<td>
										<select name="pickup_month">
											<option value="" disabled selected>Month</option>
											<option value="01">01</option>
											<option value="02">02</option>
											<option value="03">03</option>
											<option value="04">04</option>
											<option value="05">05</option>
											<option value="06">06</option>
											<option value="07">07</option>
											<option value="08">08</option>
											<option value="09">09</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
										</select>
										<select name="pickup_day">
											<option value="" disabled selected>Day</option>
											<option value="01">01</option>
											<option value="02">02</option>
											<option value="03">03</option>
											<option value="04">04</option>
											<option value="05">05</option>
											<option value="06">06</option>
											<option value="07">07</option>
											<option value="08">08</option>
											<option value="09">09</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
											<option value="13">13</option>
											<option value="14">14</option>
											<option value="15">15</option>
											<option value="16">16</option>
											<option value="17">17</option>
											<option value="18">18</option>
											<option value="19">19</option>
											<option value="20">20</option>
											<option value="21">21</option>
											<option value="22">22</option>
											<option value="23">23</option>
											<option value="24">24</option>
											<option value="25">25</option>
											<option value="26">26</option>
											<option value="27">27</option>
											<option value="28">28</option>
											<option value="29">29</option>
											<option value="30">30</option>
											<option value="31">31</option>
										</select>
										<select name="pickup_year">
											<option value="" disabled selected>Year</option>
											<option value="2015">2015</option>
											<option value="2016">2016</option>
											<option value="2017">2017</option>
											<option value="2018">2018</option>
											<option value="2019">2019</option>
											<option value="2020">2020</option>
											<option value="2021">2021</option>
											<option value="2022">2022</option>
											<option value="2023">2023</option>
											<option value="2024">2024</option>
											<option value="2025">2025</option>
											<option value="2026">2026</option>
											<option value="2027">2027</option>
											<option value="2028">2028</option>
											<option value="2029">2029</option>
											<option value="2030">2030</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Pickup time:</td>
									<td><input type="text" name="pickup_time"/></td>
								</tr>
								<tr>
									<td>Delivery location:</td>
									<td><input type="text" name="delivery_location"/></td>
								</tr>
								<tr>
									<td>Delivery date:</td>
									<td>
										<select name="delivery_month">
											<option value="" disabled selected>Month</option>
											<option value="01">01</option>
											<option value="02">02</option>
											<option value="03">03</option>
											<option value="04">04</option>
											<option value="05">05</option>
											<option value="06">06</option>
											<option value="07">07</option>
											<option value="08">08</option>
											<option value="09">09</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
										</select>
										<select name="delivery_day">
											<option value="" disabled selected>Day</option>
											<option value="01">01</option>
											<option value="02">02</option>
											<option value="03">03</option>
											<option value="04">04</option>
											<option value="05">05</option>
											<option value="06">06</option>
											<option value="07">07</option>
											<option value="08">08</option>
											<option value="09">09</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
											<option value="13">13</option>
											<option value="14">14</option>
											<option value="15">15</option>
											<option value="16">16</option>
											<option value="17">17</option>
											<option value="18">18</option>
											<option value="19">19</option>
											<option value="20">20</option>
											<option value="21">21</option>
											<option value="22">22</option>
											<option value="23">23</option>
											<option value="24">24</option>
											<option value="25">25</option>
											<option value="26">26</option>
											<option value="27">27</option>
											<option value="28">28</option>
											<option value="29">29</option>
											<option value="30">30</option>
											<option value="31">31</option>
										</select>
										<select name="delivery_year">
											<option value="" disabled selected>Year</option>
											<option value="2015">2015</option>
											<option value="2016">2016</option>
											<option value="2017">2017</option>
											<option value="2018">2018</option>
											<option value="2019">2019</option>
											<option value="2020">2020</option>
											<option value="2021">2021</option>
											<option value="2022">2022</option>
											<option value="2023">2023</option>
											<option value="2024">2024</option>
											<option value="2025">2025</option>
											<option value="2026">2026</option>
											<option value="2027">2027</option>
											<option value="2028">2028</option>
											<option value="2029">2029</option>
											<option value="2030">2030</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Delivery time:</td>
									<td><input type="text" name="delivery_time"/></td>
								</tr>
								<tr>
									<td>Load weight:</td>
									<td><input type="text" name="load_weight"/></td>
								</tr>
								<tr>
									<td title="Distance to pickup(deadhead)">DH-O:</td>
									<td><input type="text" name="dh"/></td>
								</tr>
								<tr>
									<td>Load miles:</td>
									<td><input type="text" name="load_miles"/></td>
								</tr>
								<tr>
									<td>Rate:</td>
									<td><input type="text" name="load_rate"/></td>
								</tr>
								<tr>
									<td colspan=2><input class="button-primary" type="submit" value="Submit"></td>
								</tr>
							</table>
					</fieldset>
				</form>';