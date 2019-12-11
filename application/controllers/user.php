<?php

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('log_lib');
	}

	function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->load->view('template/main', array('content' => 'user/login', 'location' => '', 'menu' => array('Register' => 'user/register')));
		}
		else
		{
			$this->load->library('log_lib');
				
			if (isset($_POST['submit_login'])) {
				$login = $this->log_lib->log_user($_POST['username'], $_POST['password']);

				if ($login) {
					$this->session->set_userdata('lend_user', md5($_POST['username'].config_item('encryption_key')));
					$this->session->set_userdata('lend_user_id', $login->id);
					if (isset($_GET['url'])) {
						redirect('http://'.$_SERVER['SERVER_NAME'].urldecode($_GET['url']));
					} else {
						redirect('/stats/', 'refresh');
					}
				} else {
					$this->load->view('template/main', array('content' => 'user/login', 'data' => array('error' => '<div class="error">Invalid Username/Password</div>')));
				}
			}
		}
	}
	
	function logout()
	{
		$sess_data = array(
			'lend_user'	=> ''
		);
		$this->session->unset_userdata($sess_data);

		redirect('/user/login/', 'refresh');
	}

	function register()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Username','trim|xss_clean|required|callback_username_not_exist');
		$this->form_validation->set_rules('password','Password','trim|xss_clean|required');
		$this->form_validation->set_rules('password_conf','Confirm Password','trim||xss_clean|required|matches[password]');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('template/main',array('content'=>'user/register'));
		}else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if($this->log_lib->register_user($username,$password))
			{
				$this->session->set_flashdata('insertdata', 'The data was inserted');
				$this->load->view('template/main',array('content'=>'user/register'));
			}else
			{
				return FALSE;
			}
		}
	}


	function username_not_exist($username)
	{
		$this->form_validation->set_message('username_not_exist','That username already exist choose another username');
		if($this->log_lib->check_exist_username($username))
		{
			return FALSE;
		}else
		{
			return TRUE;
		}
	}
}