<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Userlog extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
		$this->load->helper("head");
		$this->load->helper("header_Responsive");
			$items = array(
				"Roles",
				"Usuarios"
				);
		echo head();
		echo header_responsive($items);
	}
	public function index()
	{
		if($this->session->userdata('login'))
		{
			$data=array();
			$data['email']=$this->session->userdata('email');
			$this->load->view("loggedId",$data);
			
		}else
		{
			redirect("/session_user");
			delete_cookie("login",$domain,$path);
		}
	}
		public function session_finish()
	{
		$user_sess=array(
			"login"=>false
		);
		$this->session->set_userdata($user_sess);
		redirect("/session_user");
		delete_cookie("login",$domain,$path);
	}
	public function roles()
	{
		if($this->session->userdata('login'))
		{
			$messageRol["message"] = $this->session->flashdata("messageRol");
			$messageRol["message_first_user"] = $this->session->flashdata("mesj_empty_rol");
				$this->load->view("rol",$messageRol);
		}else
		{
			redirect("/session_user");
			delete_cookie("login",$domain,$path);
		}
	}
		public function addrole()
	{
		if($this->session->userdata('login'))
		{
			$this->load->model("rol_model");
			if(!$this->input->post("id"))
			{
				$insertRol = $this->rol_model->insert_role($this->input->post("rol"));
				if($insertRol==0)
				{
					$this->form_validation->set_rules("rol","rol","required");
					if($this->form_validation->run()==true)
					{
						$this->session->set_flashdata('messageRol','¡Rol registrado exitosamente!');
					}else
					{
						$this->session->set_flashdata('messageRol','¡Campo obligatorio!');
					}
				}else
				{
					$this->session->set_flashdata('messageRol','¡Este rol ya se encuentra registrado!');
				}
			}
			else
			{
				$updateRol = $this->rol_model->update_rol($this->input->post("rol"),$this->input->post("id"));
				if($this->form_validation->run()==true)
				{
					$this->session->set_flashdata('messageRol','¡Campo obligatorio!');
				}else
				{
					$this->session->set_flashdata('messageRol','¡Rol modoficado exitosamente!');
				}
			}
			redirect("/userlog/roles");
		}else
		{
			redirect("/session_user");
			delete_cookie("login",$domain,$path);
		}
	}
	public function deleteroles($id)
	{
		if($this->session->userdata('login'))
		{
			$this->load->model("rol_model");
			$this->rol_model->deleteRole($id);
			$this->session->set_flashdata("messageRol",'¡El Rol ha sido eliminado!');
			redirect("/userlog/roles");
		}
		else
		{
			redirect("/session_user");
			delete_cookie("login",$domain,$path);
		}
	}
	public function deleteUser($id)
	{
		if($this->session->userdata('login'))
		{
			$this->load->model("user_model");
			$this->user_model->delete_user($id);
			$this->session->set_flashdata("messageRol",'¡El Usuario ha sido eliminado!');
			redirect("/userlog/usuarios");
		}
		else
		{
			redirect("/session_user");
			delete_cookie("login",$domain,$path);
		}
	}
	public function usuarios($msj_e="not")
	{
		if($this->session->userdata('login'))
		{
			$this->load->model("rol_model");
			$result = $this->rol_model->select_role();
			$result2 = $this->rol_model->select_role_comp();
			if($result2)
			{
				$ContentRole=array();
				$ContentRole["result"]=$result;
				$ContentRole["msj_exito"]=$this->session->flashdata("msj");
				$ContentRole["msj_e"]=$msj_e;
				$this->load->view("users",$ContentRole);
			}else
			{
				$this->session->set_flashdata("mesj_empty_rol","¡Necesita registrar primero los roles de usuario!");
				redirect("/userlog/roles");
			}

		}else
		{
			redirect("/session_user");
			delete_cookie("login",$domain,$path);
		}
	}
		public function insert_users()
	{
		if($this->session->userdata('login'))
		{
			$this->load->library("form_validation");
			$this->load->helper("email_correct");
			$name =$this->input->post("name");
			$email =$this->input->post("email");
			$phone =$this->input->post("phone");
			$age=$this->input->post("age");
			$roles=array_values($this->input->post("roles[]"));
			$this->load->model("user_model");
			$this->load->helper("valid_date");
			$this->form_validation->set_rules("name","Nombre","required");
			$this->form_validation->set_rules("phone","Telefono","required");
			$this->form_validation->set_rules("roles[]","Rol","required");
			$this->form_validation->set_rules("age","Fecha","required|valid_date");
			$this->form_validation->set_message("required","El %s, es requerido");
	
			if($this->form_validation->run()==true)
			{
				if($this->input->post("id"))
				{
					$id =$this->input->post("id");
					$this->form_validation->set_rules("email","Email","required|valid_email|email_correct[".$id."]");
					$this->form_validation->set_message("email_correct","El email ya se encuentra registrado");
					$this->form_validation->set_message("valid_date","No es una fecha valida ej: 2000-05-12");
					$this->form_validation->set_message("valid_email","El email no es valido");
					if($this->form_validation->run()==true)
					{
						$this->session->set_flashdata("msj","¡Usuario actualizado exitosamente!");
						$this->user_model->update_user($id,$name,$email,$phone,$age,$roles);
						redirect("userlog/usuarios");

					}else
					{
						$this->usuarios("yes");
					}
				}
				else
				{
					$this->form_validation->set_rules("email","Email","required|valid_email|is_unique[users.email]");
					$this->form_validation->set_message("valid_date","No es una fecha valida ej: 2000-05-12");
					$this->form_validation->set_message("valid_email","El email no es valido");
					$this->form_validation->set_message("is_unique","El email ya se encuentra registrado");
					if($this->form_validation->run()==true)
					{
						$this->session->set_flashdata("msj","¡Usuario registrado exitosamente!");
						$this->user_model->insert_user($name,$email,$phone,$age,$roles);
						redirect("userlog/usuarios");
					}else
					{
						$this->usuarios("yes");

					}
				}
				
			}else
			{
				$this->usuarios("yes");
			}
		}else
		{
			redirect("/session_user");
			delete_cookie("login",$domain,$path);
		}
	}
	public function __destruct()
	{
		$this->load->helper("footer_responsive");
		$this->load->helper("footer");
		echo footer_responsive();
		echo footer();
	}

}
?>