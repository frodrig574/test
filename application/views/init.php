<?php
$email=array(
	"name"=>"email",
	"placeholder"=>"Email",
	"type" => "email",
	"id"=>"email",
	"class"=>"form-control",
	"required"=>"required"
	);
if(isset($msj_pass))
{
	$email["value"]=$user;
}
$pass = array(
	"name"=>"Password",
	"type"=>"password",
	"placeholder"=>"password",
	"id"=>"password",
	"class"=>"form-control",
	"required"=>"required"
	);
$btn = array(
	"name"=>"inicio",
	"value"=>"Iniciar Sessión",
	"class"=>"btn btn-info btn-session"
	);
$direct=base_url();
 ?>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-xs-12 col-md-offset-4">
			<div class="content-login">
				<header>
					<div class="logo"></div>
				</header>
				<?= form_open($direct."session_user/init_session")?>
				<div class="form-group">
					<?=form_label("Correo","Email");?>
					<?=form_input($email);?>
				</div>
				<div class="form-group">
					<?=form_label("Contraseña","password");?>
					<?=form_password($pass);?>
				</div>
				<div class="form-group">
					<?=form_submit($btn);?>
				</div>
				<?= form_close()?>
			</div>
		</div>	
	</div>
</div>
<?php
if(isset($msj_user))
{
	echo '<script type="text/javascript">'; 
	echo '	$("#email").attr("data-placement","top");';
	echo '	$("#email").attr("data-title","'.$msj_user.'");';
	echo '	$("#email").attr("data-togle","tooltips");';
	echo '	$("#email").tooltip("show");';
	echo '	$("#email").focus();';
	echo '</script>';
}
if(isset($msj_pass))
{
	echo '<script type="text/javascript">'; 
	echo '	$("#password").attr("data-placement","top");';
	echo '	$("#password").attr("data-title","'.$msj_pass.'");';
	echo '	$("#password").attr("data-togle","tooltips");';
	echo '	$("#password").tooltip("show");';
	echo '	$("#password").focus();';
	echo '</script>';
}
?>