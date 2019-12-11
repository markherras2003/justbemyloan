		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="contentTitle">Add Loan Type</div>
			<div class="clearFix"></div>
			<div class="leftcontentBody">
				<?php $this->menu->generate(); ?>
	        </div>
	        <div class="rightcontentBody">
	        	<form action="" method="post">
	        		<table class="form_tbl">
	        			<tr>
	        				<td>Loan Name:</td>
	        				<td><input type="text" name="lname" value="<?php echo set_value('lname'); ?>" /></td>
	        			</tr>
	        			<tr>
	        				<td>Monthly Interest Rate (%):</td>
	        				<td><input type="text" name="interest" value="<?php echo set_value('interest'); ?>" /></td>
	        			</tr>
	        			<!-- 
	        			<tr>
	        				<td>Months to Pay:</td>
	        				<td><input type="text" name="terms" value="<?php echo set_value('terms'); ?>" /></td>
	        			</tr>
	        			-->
	        			<tr>
	        				<td>Payment Frequency:</td>
	        				<td>
	        					<select name="frequency">
	        						<option value=""></option>
	        						<option value="Monthly">Monthly</option>
	        						<option value="2 Weeks">2 Weeks</option>
	        						<option value="Weekly">Weekly</option>
	        					</select>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td></td>
	        				<td><input type="submit" name="submit_loan" value="Submit" /></td>
	        			</tr>
	        			<?php if (validation_errors()) : ?>
						<tr>
							<td>
								
							</td>
							<td>
								<?php echo validation_errors(); ?>
							</td>
						</tr>
						<?php endif;?>
						<?php if (isset($error)) : ?>
						<tr>
							<td>
								
							</td>
							<td>
								<?php echo $error; ?>
							</td>
						</tr>
						<?php endif;?>
	        		</table>
	        	</form>
	        </div>
	        <div class="clearFix"></div>
		</div>