		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="contentTitle">Payments</div>
			<div class="clearFix"></div>
			<div class="leftcontentBody">
				<?php $this->menu->generate(); ?>
	        </div>
	        <div class="rightcontentBody">
	        	<div class="frm_container">
	        		<?php 
	        			$total_amount = 0;

        				$action = $this->uri->segment(3);
						
						switch ($action) {
							case 'incoming':
								if($filter) {
									$payments = $this->Payment_model->get_incoming_payments($_GET);
								} else {
									$payments = $this->Payment_model->get_incoming_payments();
								}
								$payment_type = 'Incoming';
								break;
							default:
								if($filter) {
									$payments = $this->Payment_model->get_received_payments($_GET);
									
								} else {
									$payments = $this->Payment_model->get_received_payments();
								}
								$payment_type = 'Received';
								break;
						}
        			?>
	        		<div class="frm_heading"><span><?php echo $payment_type;?> Payments (<a href="#" id='filter'>Filter</a>)</span></div>
	        		<h4>Detailed</h4>
	        		<div class="frm_inputs">
			        	<?php if($payments AND $payment_type == 'Incoming') : ?>
			        	<table class="incoming" cellspacing="1">
			        		<thead>
			        			<tr>
			        				<th>Loan #</th>
			        				<th>Check Date</th>
			        				<th>Amount Due</th>
			        				<th>Name</th>
			        				<th>Payment #</th>
			        			</tr>
			        		</thead>
			        		<tbody>
			        			<?php foreach ($payments->result() as $payment) :?>
			        			<tr>
			        				<td><a href="<?php echo base_url();?>loan/view_info/?id=<?php echo $payment->borrower_loan_id ;?>"><?php echo $payment->borrower_loan_id ;?></a></td>
			        				<td><?php echo $payment->payment_sched ;?></td>
			        				<td><?php echo $this->config->item('currency_symbol') . $payment->amount ;?></td>
			        				<td><a href="<?php echo base_url();?>borrower/view/?id=<?php echo $payment->borrower_id ;?>"><?php echo $payment->lname.', '.$payment->fname ;?></a></td>
			        				<td><?php echo $payment->payment_number ;?></td>
			        			</tr>
			        			<?php 
			        				//compute total amount
			        				$total_amount .= $payment->amount;
			        			?>
			        			<?php endforeach; ?>
			        		</tbody>
			        	</table>
			        	<!-- pager -->
						<div class='incoming_pager'>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/first.png' class='first'/>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/prev.png' class='prev'/>
						    <span class='pagedisplay'></span> <!-- this can be any element, including an input -->
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/next.png' class='next'/>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/last.png' class='last'/>
						    <select class='pagesize'>
						        <option value='20'>20</option>
						        <option value='30'>30</option>
						        <option value='40'>40</option>
						    </select>
						</div>
			        	<?php elseif($payments AND $payment_type == 'Received') : ?>
			        	<table class="received" cellspacing="1">
			        		<thead>
			        			<tr>
			        				<th>Loan #</th>
			        				<th>Process Date</th>
			        				<th>Amount Received</th>
			        				<th>Customer Name</th>
			        				<th>Processed By</th>
			        				<th>Payment #</th>
			        			</tr>
			        		</thead>
			        		<tbody>
			        			<?php foreach ($payments->result() as $payment) :?>
			        			<tr>
			        				<td><a href="<?php echo base_url();?>loan/view_info/?id=<?php echo $payment->borrower_loan_id ;?>"><?php echo $payment->borrower_loan_id ;?></a></td>
			        				<td><?php echo $payment->process_date ;?></td>
			        				<td><?php echo $this->config->item('currency_symbol') . $payment->amount ;?></td>
			        				<td><a href="<?php echo base_url();?>borrower/view/?id=<?php echo $payment->borrower_id ;?>"><?php echo $payment->lname.', '.$payment->fname ;?></a></td>
			        				<td><?php echo $payment->username ;?></td>
			        				<td><?php echo $payment->payment_number ;?></td>
			        			</tr>
			        			<?php 
			        				//compute total amount
			        				$total_amount += $payment->amount;
			        			?>
			        			<?php endforeach; ?>
			        		</tbody>
			        	</table>
			        	<!-- pager -->
						<div class='received_pager'>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/first.png' class='first'/>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/prev.png' class='prev'/>
						    <span class='pagedisplay'></span> <!-- this can be any element, including an input -->
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/next.png' class='next'/>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/last.png' class='last'/>
						    <select class='pagesize'>
						        <option value='20'>20</option>
						        <option value='30'>30</option>
						        <option value='40'>40</option>
						    </select>
						</div>
			        	<h4>Summary</h4>
			        	<span>Total <?php echo $payment_type ?> = <?php echo $this->config->item('currency_symbol') . $total_amount; ?></span>
			        	<?php else : ?>
					        No records found.
					    <?php endif; ?>
	        		</div>
	        	</div>
	        </div>
	        <div class="clearFix"></div>
		</div>
		<div style='display:none'>
			<div class="frm_container" id="dialog-modal">
        		<div class="frm_heading"><span>Filter Dialog</span></div>
        		<div class="frm_inputs">
        			<form action="<?php echo base_url(); ?>stats/payments/received/filter" method="get">
	        			<table class="form_tbl">
		        			<tr>
		        				<td>Start Date:</td>
		        				<td><input type="text" name="sdate" class="datepicker" /></td>
		        			</tr>
		        			<tr>
		        				<td>End Date:</td>
		        				<td><input type="text" name="edate" class="datepicker" /></td>
		        			</tr>
		        			<tr>
		        				<td></td>
		        				<td><input type="submit" name="submit_borrower" value="Submit" /></td>
		        			</tr>
		        		</table>
	        		</form>  
        		</div>
    		</div>   
		</div>
		<script type='text/javascript'>
		$(function() {
			$('.incoming').tablesorter()
				.tablesorterPager({
				    container: $('.incoming_pager'),
				    updateArrows: true,
				    page: 0,
				    size: 20,
				    fixedHeight: false,
				    removeRows: false,
				    cssNext: '.next',
				    cssPrev: '.prev',
				    cssFirst: '.first',
				    cssLast: '.last',
				    cssPageDisplay: '.pagedisplay',
				    cssPageSize: '.pagesize',
				    cssDisabled: 'disabled'
			});
			$('.received').tablesorter()
				.tablesorterPager({
				    container: $('.received_pager'),
				    updateArrows: true,
				    page: 0,
				    size: 20,
				    fixedHeight: false,
				    removeRows: false,
				    cssNext: '.next',
				    cssPrev: '.prev',
				    cssFirst: '.first',
				    cssLast: '.last',
				    cssPageDisplay: '.pagedisplay',
				    cssPageSize: '.pagesize',
				    cssDisabled: 'disabled'
			});

			$("#filter").colorbox({width:"40%", inline:true, href:"#dialog-modal"});

			$( ".datepicker" ).datepicker();
		});
		</script>