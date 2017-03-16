<?php
class Session_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function check_user($user)
	{
		$this->db->select("id");
		$this->db->from("session");
		$this->db->where("user",$user);
		$user = $this->db->get()->row();
		return $user;	
	}
	function init_session($user,$pass)
	{
		$this->db->select('id, user');
		$this->db->from('session');
		$this->db->where('user',$user);
		$this->db->where('pass',$pass);
		$data_session = $this->db->get();
		$cont = $data_session->row();
		return $cont;
	}
}
?>