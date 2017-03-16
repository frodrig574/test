<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax_selection extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function selectRole()
	{
		if($this->session->userdata('login'))
		{
			$this->load->model("rol_model");
			//select 
			$dataRol = $this->rol_model->select_role();
			if($dataRol!=NULL)
			{
				$listRol='<table class="tableList">';
				$x=0;
				foreach($dataRol as $data)
				{
					$x=$x + 1;
					$listRol.='<tr class="listTr"><td class="listTd">'.$x.'</td><td class="listTdRole">'.$data->role.'</td><td class="listTdicons"><a onclick=\'edit("'.$data->id.'","'.$data->role.'")\'><i class="glyphicon glyphicon-pencil icon"></i></a></td><td class="listTdicons"><a onclick=\'deleteroles("'.$data->id.'","'.$data->role.'")\'><i class="fa fa-trash-o icon" style="color:red"></i></a></td></tr>';
				}
				$listRol.='</table>';
			}
			else
			{
				$listRol='<div class="messageNullRol">No hay roles registrados</div>';
			}
			echo $listRol;
		}else
		{
			redirect("/session_user");
			delete_cookie("login",$domain,$path);
		}
	}
		public function selectUser()
	{
		if($this->session->userdata('login'))
		{
			$this->load->model("user_model");
			//select 
			$dataUser = $this->user_model->select_user();
			if($dataUser!=NULL)
			{
				$listUser='<table class="tableList">';
				$x=0;
				foreach($dataUser as $data)
				{
					$x=$x + 1;
					$listUser.='<tr class="listTr"><td class="listTd">'.$x.'</td><td class="listTdRole">'.$data->email.'</td><td class="listTdicons"><a onclick=\'editUser("'.$data->id.'")\'><i class="glyphicon glyphicon-pencil icon"></i></a></td><td class="listTdicons"><a onclick=\'deleteUser("'.$data->id.'","'.$data->email.'")\'><i class="fa fa-trash-o icon" style="color:red"></i></a></td></tr>';
				}
				$listUser.='</table>';
			}
			else
			{
				$listUser='<div class="messageNullUser">No hay Usuarios registrados</div>';
			}
			echo $listUser;
		}else
		{
			redirect("/session_user");
			delete_cookie("login",$domain,$path);
		}
	}
	public function selectUserRolData($id)
	{
		if($this->session->userdata('login'))
		{
			$this->load->model("user_model");
			$data=$this->user_model->select_user_role($id);
			echo json_encode($data);

		}else
		{
			redirect("/session_user");
			delete_cookie("login",$domain,$path);
		}
	}
	public function selectUserData($id)
	{
		if($this->session->userdata('login'))
		{
			$this->load->model("user_model");
			$data = $this->user_model->select_user_id($id);
				echo json_encode($data);
		}else
		{
			redirect("/session_user");
			delete_cookie("login",$domain,$path);
		}
	}
	public function ValidName()
	{
		if($this->session->userdata('login'))
		{
			$this->input->post("name");
			$this->load->library("form_validation");
			$this->form_validation->set_rules("name","Nombre","required");
			$this->form_validation->set_message("required","El %s, es requerido");
			if($this->form_validation->run()==true)
			{
				echo json_encode(1);
			}else
			{
				echo json_encode(0);
			}
			
		}else
		{
			redirect("/session_user");
			delete_cookie("login",$domain,$path);
		}
	}
		public function Valid_users_phone()
	{
		if($this->session->userdata('login'))
		{
			$this->load->library("form_validation");
			$this->form_validation->set_rules("phone","Telefono","required");
			$this->form_validation->set_message("required","El %s, es requerido");
			if($this->form_validation->run()==true)
			{
				echo json_encode(1);
			}else
			{
				echo json_encode(0);
			}
		}else
		{
			redirect("/session_user");
			delete_cookie("login",$domain,$path);
		}
	}
		public function valid_users_email()
	{
		if($this->session->userdata('login'))
		{
			$this->load->library("form_validation");
			$this->form_validation->set_rules("email","Email","required");
			if($this->form_validation->run()==true)
			{
				$this->form_validation->set_rules("email","Email","valid_email");
				if($this->form_validation->run()==true)
				{
						
					if(isset($_POST["id"]))
					{
						$id=$_POST["id"];
						$this->load->helper("email_correct");
						$this->form_validation->set_rules("email","Email","email_correct[".$id."]");
						if($this->form_validation->run()==true)
						
						{
							echo json_encode(3);
						}else
						{
							echo json_encode(2);
						}
					}else
					{
						$this->form_validation->set_rules("email","Email","is_unique[users.email]");
						if($this->form_validation->run()==true)
						
						{
							echo json_encode(3);
						}else
						{
							echo json_encode(2);
						}
					}
					
				}else
				{
					echo json_encode(1);
				}
			}else
			{
				echo json_encode(0);
			}
		}else
		{
			redirect("/session_user");
			delete_cookie("login",$domain,$path);
		}
	}
		public function valid_users_roles()
	{
		if($this->session->userdata('login'))
		{
			$this->load->library("form_validation");
			$this->form_validation->set_rules("roles[]","Rol","required");
			$this->form_validation->set_message("required","El %s, es requerido");
			if($this->form_validation->run()==true)
			{
				echo json_encode(1);
			}else
			{
				echo json_encode(0);
			}
		}else
		{
			redirect("/session_user");
			delete_cookie("login",$domain,$path);
		}
	}
		public function valid_users_date()
	{
		if($this->session->userdata('login'))
		{
			$this->load->helper("valid_date");
			$this->load->library("form_validation");
			$this->form_validation->set_rules("age","Fecha","required|valid_date");
			$this->form_validation->set_message("required","El %s, es requerido");
			$this->form_validation->set_message("valid_date","No es una fecha valida ej: 2000-05-12");
			if($this->form_validation->run()==true)
			{
				echo json_encode(1);
			}else
			{
				echo json_encode(0);
			}
		}else
		{
			redirect("/session_user");
			delete_cookie("login",$domain,$path);
		}
	}
}
