<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Error404 extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper("head");
		echo head();
	}
	public function index()
	{
		$this->load->view('error404');
	}
	
	function __destruct()
	{
		$this->load->helper("footer");
		echo footer();
	}
}
?>