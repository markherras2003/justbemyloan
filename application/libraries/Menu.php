<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu {
	
	var $CI;
	
	public function __construct()
	{
		//instantiate CI
		$this->CI =& get_instance();
		$menu_arr = array();
	}
	
	public function generate()
	{
		$menu_arr[] = array('text' => 'Home', 'controller' => 'stats', 'function' => 'index');
		$menu_arr[] = array('text' => 'Loan', 'controller' => 'loan', 'function' => 'view',
			'submenu' => array(
				array(
					'text' => 'Loan List', 
					'controller' => 'loan', 
					'function' => 'view'
				),
				array(
					'text' => 'Loan Summary', 
					'controller' => 'report', 
					'function' => 'summary'
				),
				array(
					'text' => 'Loan Types', 
					'controller' => 'loan', 
					'function' => 'view_loan_types'
				),
				array(
					'text' => 'Loan Calculator', 
					'controller' => 'loan', 
					'function' => 'calculator'
				)
			)
		);
		$menu_arr[] = array('text' => 'Borrower', 'controller' => 'borrower', 'function' => 'index',
			'submenu' => array(
				array(
					'text' => 'Borrower List', 
					'controller' => 'borrower', 
					'function' => 'viewall'
				),
				array(
					'text' => 'Add Borrower', 
					'controller' => 'borrower', 
					'function' => 'add'
				)
			)
		);
		$menu_arr[] = array('text' => 'Payments', 'controller' => 'stats', 'function' => 'payments',
			'submenu' => array(
				array(
					'text' => 'Received', 
					'controller' => 'stats', 
					'function' => 'payments/received'
				),
				array(
					'text' => 'incoming', 
					'controller' => 'stats', 
					'function' => 'payments/incoming'
				)
			)
		);
		$menu_arr[] = array('text' => 'Logout', 'controller' => 'user', 'function' => 'logout');
		
		//print_r($menu_arr);
		
		echo "<div id='cssmenu'>";
		
		$level = 0;
		$this->print_link($menu_arr, $level);
		
		echo "</div>";
		
	}

	function print_link($complex_array, &$level)
	{
		$base_url = base_url();
		echo "<ul>";
	    foreach ($complex_array as $n)
	    {
	    	$has_sub = (array_key_exists('submenu', $n) AND is_array($n['submenu'])) ? TRUE:FALSE;
			
			$class = $has_sub?"class='has-sub'":"";
			
	    	echo "<li $class><a href='{$base_url}{$n['controller']}/{$n['function']}'>{$n['text']}</a>";
			//str_repeat('-',$level).$n['text'].'-'.$n['controller'].'-'.$n['function'].'<br />';
			if($has_sub) {
				$level++;
	            $this->print_link($n['submenu'],$level);
				$level--;
			}
			echo  "</li>";
	    }
		echo "</ul>";
	}
	
}