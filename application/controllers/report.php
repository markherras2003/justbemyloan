<?php

class Report extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Report_model');
	}
	
	function index()
	{
		$this->summary();
	}
	
	function summary()
	{
		$this->load->view(
			'template/main', 
			array(
				'content'=>'report/summary', 
				'location' => 'Report / Summary', 
				'menu' => array(
					'Logout' => 'user/logout',
					'Report' => 'report/summary',
					'Report' => 'report/summary',
					'Loan' => 'loan/view',
					'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Home' => 'stats')
			)
		);
	}
	
}