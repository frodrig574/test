<?php
class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function select_user()
	{
		$this->db->select("*");
		$this->db->from("users");
		return $this->db->get()->result();
	}
		public function select_user_role($id)
	{
		$this->db->select("role_user.id_role,role.role");
		$this->db->from("role_user, role, users");
		$this->db->where("users.id",$id);
		$this->db->where("role_user.id_users=users.id");
		$this->db->where("role.id=role_user.id_role");
		return $this->db->get()->result();
	}
	public function select_user_id($id)
	{
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("id",$id);
		return $this->db->get()->result_array();
	}
	public function insert_user($name,$email,$phone,$date_nat,$roles=array())
	{
		$data = array(
			"name" => $name,
			"email" => $email,
			"phone" => $phone,
			"date_nat" => $date_nat
			);
		$this->db->insert("users",$data);
		$id_user =$this->db->insert_id();
		$cant=count($roles);
		$role=implode(",",$roles);
		$role=explode(",",$role);

		foreach ($role as $rol => $value) {
			
			$dataRolUser=array(
				"id_users"=>$id_user,
				"id_role"=>$role[$rol]
				);
			$this->db->insert("role_user",$dataRolUser);
		}
	} 
	public function update_user($id_user,$name,$email,$phone,$date_nat,$roles=array())
	{
		$data = array(
			"name" => $name,
			"email" => $email,
			"phone" => $phone,
			"date_nat" => $date_nat
			);
		$this->db->where("id",$id_user);
		$this->db->update("users",$data);
		$this->db->where("id_users",$id_user);
		$this->db->delete("role_user");
		$cant=count($roles);
		$role=implode(",",$roles);
		$role=explode(",",$role);

		foreach ($role as $rol => $value) {
			
			$dataRolUser=array(
				"id_users"=>$id_user,
				"id_role"=>$role[$rol]
				);
			$this->db->insert("role_user",$dataRolUser);
		}

	}
	public function delete_user($id)
	{
		$this->db->where("id_users",$id);
		$this->db->delete("role_user");
		$this->db->where("id",$id);
		$this->db->delete("users");
	}
	public function email_correct($email,$id)
	{
		$this->db->select("email");
		$this->db->from("users");
		$this->db->where("id!=".$id);
		$this->db->where("email",$email);
		return $cont = $this->db->get()->row();
	}
}

?>