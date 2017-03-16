<?php
function head()
{
	$head = '<html lang="es"><head>';
	$head.="<meta charset='utf-8'>";
	$head.="<title>Test</title>";
	$head.="<meta name='viewport' content='width=device-width, initial-scale=1'>";
	$head.="<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>";
	$head.="<link rel='stylesheet' href='".base_url()."public/css/style.css'>";
	$head.="<link rel='stylesheet' href='".base_url()."public/font-awesome/css/font-awesome.min.css'>";
	$head.="<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css'>";
	$head.="<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>";
	$head.="<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>";
	$head.="<script src='".base_url()."public/js/moment.min.js'></script>";
	$head.="<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js'></script>";
	$head.="<script src='".base_url()."public/js/index.js'></script>";
	$head.="</head>";
	$head.="<body>";
	return $head;
}
?>