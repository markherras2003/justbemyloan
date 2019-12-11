<?php

class Search extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Search_model');
	}
	
	function loan()
	{
		$this->load->view(
			'template/main',
			array(
				'content'=>'search/index', 
				'location' => 'Search / Result', 
				'menu' => array(
					'Logout' => 'user/logout', 
					'Report' => 'report/summary',
					'Loan' => 'loan/view', 
					'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Home' => 'stats')
				)
			);
	}
	
}