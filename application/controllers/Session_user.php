<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Session_user extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper("head");
		echo head();
	}
	public function index()
	{
		if($this->session->userdata('login')==false)
		{
			$message=$this->session->flashdata("message");
			$this->load->view('init',$message);
		}else
		{
			redirect("/userlog");
		}
	}
	public function init_session()
	{
		if($this->input->post())
		{
			$message=array();
			$user = $this->input->post("email");
			$pass = md5($this->input->post("Password"));
			$this->load->model("session_model");
			$check_user=$this->session_model->check_user($user);
			if($check_user)
			{
				
				$user_sess=$this->session_model->init_session($user,$pass);
				if($user_sess)
				{
					$user_data = array(
						'id' => $user_sess->id,
						'email' => $user_sess->user,
						'login' =>TRUE
					);
					$this->session->set_userdata($user_data);
					redirect("/userlog");
				}else
				{
					$message["msj_pass"]="Contraseña invalida, !por favor vuelva a intentar¡";
					$message["user"]=$user;
					$this->session->set_flashdata("message",$message);
					redirect("/session_user");	
				}
			}
			else
			{
				$message["msj_user"]="Usuario invalido, !por favor vuelva a intentar¡";
				$this->session->set_flashdata("message",$message);
				redirect("/session_user");	
			}
		
		}
	}
	function __destruct()
	{
		$this->load->helper("footer");
		echo footer();
	}
	
}
?>