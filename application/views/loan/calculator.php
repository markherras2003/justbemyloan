		<?php 
			//get all loan type and display it on a dropdown
			$loans = $this->Loan_model->view_all();
			
			$temp_arr = array();
			$loan_types = array();
			foreach ($loans->result() as $loan)
			{
				$temp_arr = array($loan->id => $loan->lname);
				$loan_types = $loan_types + $temp_arr;
			}
			
		?>
		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="contentTitle">Loan Calculator</div>
			<div class="clearFix"></div>
			<div class="leftcontentBody">
				<?php $this->menu->generate(); ?>
	        </div>
	        <div class="rightcontentBody">
	        	<form action="" method="post">
	        		<table class="form_tbl">
	        			<tr>
	        				<td>Loan Amount:</td>
	        				<td><input type="text" name="amount" value="<?php echo set_value('amount'); ?>" /></td>
	        			</tr>
	        			<tr>
	        				<td>Months to Pay:</td>
	        				<td><input type="text" name="months" value="<?php echo set_value('months'); ?>" /></td>
	        			</tr>
	        			<tr>
	        				<td>Select Loan Type:</td>
	        				<td><?php echo form_dropdown('loan_type', $loan_types); ?></td>
	        			</tr>
	        			<tr>
	        				<td>Loan Date:</td>
	        				<td><input type="text" name="loan_date" class="datepicker" value="<?php echo set_value('loan_date'); ?>" /></td>
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
		<?php if (isset($result)): ?>
		<div class="clearFix"></div>
		<div class="contentBody w500">
			<div class="contentTitle">Loan Result</div>
			<div class="clearFix"></div>
	        <div class="midcontentBody">
	        	<?php echo $result; ?>
	        </div>
	        <div class="clearFix"></div>
		</div>
		<?php endif;?>