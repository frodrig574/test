<?php 
function email_correct($email,$id)
{
	$ci =& get_instance();
	$ci->load->model("user_model");
	$cant=$ci->user_model->email_correct($email,$id);
	if(!$cant)
	{
		return true;
	}else
	{

		return false;
	}
}
?>