<?php
function valid_date($date)
{
	$parameter="/^(\d){4}\-(\d){2}\-(\d){2}$/i";
	if(preg_match($parameter, $date)==true)
	{
		return TRUE;
	}else
	{
		return FALSE;
	}
}
 ?>
