<?php

class Stats extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Loan_model');
		
		$this->load->model('Payment_model');
	}
	
	function index()
	{
		$this->load->view('template/main', array('content'=>'stats/index', 'location' => 'Home', 'menu' => array('Logout' => 'user/logout', 'Report' => 'report/summary', 'Loan' => 'loan/view', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Home' => 'stats')));
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * View all future payments
	 * 
	 */
	function payments($action = NULL, $filter = FALSE)
	{
		$this->load->view(
			'template/main', 
			array(
				'filter' => $filter,
				'content'=>'stats/payment', 
				'location' => 'Payments / '.$action, 
				'menu' => array(
					'Logout' => 'user/logout',
					'Report' => 'report/summary',
					'Loan' => 'loan/view', 
					'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Home' => 'stats'
					)
				)
			);
	}
	
}

