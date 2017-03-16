<?php function header_responsive($items)
{
	$header = '<div class="container-fluid">';
	$header .= '<div class="row">';
	$header .= '<div class="col-md-12" style="padding:0px !important;">';
	$header .= '<header class="xsHeader">';
	$header .= '<div class="logo"></div>';
	$header .= '</header>';
	$header .= '<nav class="navbar navbar-inverse menu" style="margin-bottom:0px !important;">';
	$header .= '<div class="navbar-header">';
	$header .= '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="background-color:rgb(59, 52, 52) !important;">';
	$header .= '<span class="icon-bar"></span>';
	$header .= '<span class="icon-bar"></span>';
	$header .= '<span class="icon-bar"></span>';
	$header .= '</button>';
	$header .= '<div class="min-logo">';
	$header .= '<p class="koc-p">Plantilla personal KOC</p>';
	$header .= '</div>';
	$header .= '</div>';
	$header .= '<div class="collapse navbar-collapse" id="myNavbar">';
	$header .= '<ul class="nav navbar-nav">';
	$header .= '<li><a href="'.base_url().'userlog/">Inicio</a></li>';
	foreach($items as $item)
	{
		$header .= '<li><a href="'.base_url().'userlog/'.$item.'">'.$item.'</a></li>';
	}
	$header .= '<li class="logoutList"><a href="'.base_url().'Userlog/session_finish"><div class="imgLogout"><p class="logoutP">Cerrar Sesión</p></div></a></li>';
	$header .= '</u>';
	$header .= '</div>';
	$header .= '<a class="aLogout" href="'.base_url().'Userlog/session_finish">';
	$header .= '<div class="logout">';
	$header .= '<div class="imgLogout"><p class="logoutP">Cerrar Sesión</p></div>';
	$header .= '</a>';
	$header .= '</div>';
	$header .= '</nav>';
	$header .= '</div>';
	$header .= '</div>';
	$header .= '</div>';
	$header .= '<div class="container"  id="content2">';
	$header .= '<div class="row">';
	$header .= '<div class="col-sm-12">';
	return $header;
} 
?>