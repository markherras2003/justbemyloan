<?php

class Transaction extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Borrower_model');
		
		$this->load->model('Loan_model');
		
		$this->load->model('Payment_model');
		
		$this->load->library('logger');
	}
	
	function payment()
	{
		$this->load->view(
			'template/main', 
			array(
				'content'=>'transaction/payment', 
				'location' => 'Transaction / Payment', 
				'menu' => array(
					'Logout' => 'user/logout',
					'Report' => 'report/summary',
					'Loan' => 'loan/view', 
					'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Home' => 'stats')
			)
		);
	}
	
	function paid($payment_id, $loan_id)
	{
		$transac = $this->Payment_model->paid($payment_id);
		
		if ($transac) {
			//insert log
			$this->logger->save('payment', $payment_id, 'payment');
			
			//then redirect
			redirect('loan/view_info/?id='.$loan_id, 'refresh');
		}
	}
	
	function move($payment_id, $loan_id)
	{
		$transac = $this->Payment_model->move_payment($payment_id, $_POST['mdate']);
		
		if ($transac) {
			//insert log
			$this->logger->save('payment', $payment_id, 'move', $_POST['notes']);
			
			//then redirect
			redirect('loan/view_info/?id='.$loan_id, 'refresh');
		}
	}

	/**
	 * Process advance payments
	 * 
	 */
	function advance($loan_id)
	{
		if(count($_POST['payment'] > 0)) {
			$advance_payment_id = $this->Payment_model->advance_paid($_POST['payment']);
		}

		if ($advance_payment_id) {
			//insert log
			$this->logger->save('advance_payment', $advance_payment_id, 'advance_payment');
			
			//then redirect
			redirect('loan/view_info/?id='.$loan_id, 'refresh');
		}
	}
}