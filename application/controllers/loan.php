<?php

class Loan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Loan_model');
		
		$this->load->model('Payment_model');

		$this->load->model('Borrower_model');
		
		$this->load->library('logger');
	}
	
	function view()
	{
		$this->load->view(
			'template/main', 
			array(
				'content'=>'loan/index', 
				'location' => 'Loan / View all', 
				'menu' => array(
					'Logout' => 'user/logout', 
					'Report' => 'report/summary',
					'Loan' => 'loan/view', 
					'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Home' => 'stats')
				)
			);
	}
	
	function view_loan_types()
	{
		$this->load->view(
			'template/main', 
			array(
				'content'=>'loan/loan_types', 
				'location' => 'Loan / Loan Types / View all', 
				'menu' => array(
					'Logout' => 'user/logout', 
					'Report' => 'report/summary',
					'Loan' => 'loan/view', 
					'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Home' => 'stats')
				)
			);
	}
	
	function view_info()
	{
		$this->load->view('template/main', array('content' => 'loan/info', 'location' => 'Loan / View', 'menu' => array('Logout' => 'user/logout', 'Report' => 'report/summary', 'Loan' => 'loan/view', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Home' => 'stats')));
	}

	function view_report()
	{
		//get loan id
		if(isset($_GET['id'])) {
			$loan_id = $_GET['id'];
			
			//query loan details
			$loan = $this->Borrower_model->get_datails($loan_id);

			if($loan) {
				$name = $this->Borrower_model->get_name($loan->borrower_id);
				$maturity = $this->Payment_model->get_last_payment($loan->borrower_loan_id);
				$first_payment = $this->Payment_model->get_first_payment($loan->borrower_loan_id);
				$payments = $this->Payment_model->get_payments($loan->borrower_loan_id);
				$html = $this->load->view('report/loan', array('loan' => $loan, 'name' => $name, 'maturity' => $maturity, 'first_payment' => $first_payment, 'payments' => $payments), true);

				require_once("./public/dompdf/dompdf_config.inc.php");
				
				$pdf =  new DOMPDF();
				$pdf->load_html($html);
				$pdf->render();
				$pdf->stream($name . "-" . $loan->borrower_loan_id . ".pdf");
			}
		}
	}
	
	function add()
	{
		//validation
		$this->form_validation->set_rules('lname', 'Loan Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('interest', 'Interest', 'trim|required|xss_clean|numeric');
		//$this->form_validation->set_rules('terms', 'Terms', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('frequency', 'Frequency', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			//change validation error delimiters
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->load->view('template/main', array('content' => 'loan/add', 'location' => 'Loan / Loan Types / Add', 'menu' => array('Logout' => 'user/logout', 'Report' => 'report/summary', 'Loan' => 'loan/view', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Home' => 'stats')));
		}
		else
		{
			if (isset($_POST['submit_loan'])) {
				//check if loan name exist
				$exist = $this->Loan_model->chk_loan_exist(array('lname' => $this->input->post('lname')));
				
				if ($exist) {
					$this->load->view('template/main', array('content' => 'loan/add', 'data' => array('error' => '<div class="error">Loan Name Already Exist</div>'), 'location' => 'Login', 'menu' => array('Logout' => 'user/logout', 'Report' => 'report/summary', 'Loan' => 'loan/view', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Home' => 'stats')));
				} else {
					//destroy submit_loan from the POST array
					unset($_POST['submit_loan']);
					//add loan
					if ($this->Loan_model->add($_POST)) {
						redirect('loan/view', 'refresh');
					}
				}
			}
		}
	}
	
	function edit()
	{
		//validation
		$this->form_validation->set_rules('lname', 'Loan Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('interest', 'Interest', 'trim|required|xss_clean|numeric');
		//$this->form_validation->set_rules('terms', 'Terms', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('frequency', 'Frequency', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			//change validation error delimiters
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->load->view('template/main', array('content' => 'loan/edit', 'location' => 'Loan / Loan Types / Edit', 'menu' => array('Logout' => 'user/logout', 'Report' => 'report/summary', 'Loan' => 'loan/view', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Home' => 'stats')));
		}
		else
		{
			if (isset($_POST['submit_loan'])) {
				//check if loan name exist
				$id = $this->input->post('id');
				$exist = $this->Loan_model->chk_loan_exist(array('id' => $id));
				
				if ($exist) {
					//destroy submit_loan and id from the POST array
					unset($_POST['submit_loan']);
					unset($_POST['id']);
					//edit loan
					if ($this->Loan_model->edit($_POST, $id)) {
						redirect('loan/view', 'refresh');
					}
				} else {
					$this->load->view('template/main', array('content' => 'loan/edit', 'data' => array('error' => '<div class="error">Sorry, loan don\'t exist.</div>'), 'location' => 'Login', 'menu' => array('Logout' => 'user/logout', 'Report' => 'report/summary', 'Loan' => 'loan/view', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Home' => 'stats')));
				}
			}
		}
	}
	
	function calculator()
	{
		//validation
		$this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('loan_type', 'Loan Type', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('months', 'Months', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('loan_date', 'Loan Date', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			//change validation error delimiters
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->load->view('template/main', array('content' => 'loan/calculator', 'location' => 'Loan / Loan Calculator', 'menu' => array('Logout' => 'user/logout', 'Report' => 'report/summary', 'Loan' => 'loan/view', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Home' => 'stats')));
		}
		else
		{
			if (isset($_POST['submit_loan'])) {
				//check if loan name exist
				$id = $this->input->post('loan_type');
				$exist = $this->Loan_model->chk_loan_exist(array('id' => $id));
				
				if ($exist) {
					$result = $this->Loan_model->calculate($this->input->post('amount'), $this->input->post('months'), $this->input->post('loan_type'), $this->input->post('loan_date'));
					$this->load->view('template/main', array('content' => 'loan/calculator', 'data' => array('result' => $result), 'location' => 'Loan / Loan Calculator', 'menu' => array('Logout' => 'user/logout', 'Report' => 'report/summary', 'Loan' => 'loan/view', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Home' => 'stats')));
				} else {
					$this->load->view('template/main', array('content' => 'loan/calculator', 'data' => array('error' => '<div class="error">Sorry, loan don\'t exist.</div>'), 'location' => 'Login', 'menu' => array('Logout' => 'user/logout', 'Report' => 'report/summary', 'Loan' => 'loan/view', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Borrower' => 'borrower', 'Payments' => 'stats/payments', 'Home' => 'stats')));
				}
			}
		}
	}

}