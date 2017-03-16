<?php
class rol_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	} 
	public function update_rol($rol,$id)
	{
		$rolData =array("role"=>$rol);
		$this->db->where("id",$id);
		$this->db->update("role",$rolData);
	}
		public function select_role()
	{
		$this->db->select("id,role");
		$this->db->from("role");
		$result = $this->db->get();
		$resultObject = $result->result();
		return $resultObject;
	}
		public function select_role_comp()
	{
		$this->db->select("id,role");
		$this->db->from("role");
		$result = $this->db->get()->row();
		return $result;
	}
	public function insert_role($rol)
	{
		$this->db->select("id");
		$this->db->from("role");
		$this->db->where("role",$rol);
		$result = $this->db->get();
		$cont = $result ->row();
		$rolData =array(
			"role"=>$rol);
		if($cont==null)
		{
			$this->db->insert("role",$rolData);	
		}
		return $cont;
	}
	public function deleteRole($id)
	{
		$this->db->select("id_users");
		$this->db->from("role_user");
		$this->db->where("id_role",$id);
		$result = $this->db->get()->result();
		$this->db->where("id_role",$id);
		$this->db->delete("role_user");
		$this->db->where("id",$id);
		$this->db->delete("role");
		foreach($result as $user)
		{
		$this->db->select("id");
		$this->db->from("users");
		$this->db->where("id",$user->id_users);
		$this->db->where("id=(select id_users from role_user)");
		$cant =$this->db->get()->row();
			if(!$cant)
			{
				$this->db->where("id",$user->id_users);
				$this->db->delete("users");
			}
		}
	}
}
?>