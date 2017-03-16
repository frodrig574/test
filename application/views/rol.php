<?php 
	if(isset($message))
	{
	echo "<script>alert('".$message."');</script>";
	}
		if(isset($message_first_user))
	{
	echo "<script>alert('".$message_first_user."');</script>";
	}
$rol=array(
	"name"=>"rol",
	"id" => "role",
	"class"=>"form-control",
	"required" =>"required"
	);

$saveRol=array(
	"name"=>"save",
	"value" => "Guardar",
	"class" => "btn btn-info"
	);
$cancel=array(
	"name" => "cancel",
	"content" => "Cancelar",
	"id" => "cancelRol",
	"class" => "btn btn-danger"
	);

?>
<div class="row">
	<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-md-6 col-md-offset-3">
		<div class="content-form-rol">
			<header><p>Rol</p><i class="icons fa fa-plus-circle addrole" ></i></header>
			<div class="addRole" id="addRol">
				<?=form_open(base_url()."Userlog/addrole")?>
					<div class="row">
						<div class="col-sm-12" style="padding:40px;">
							<div class="form-group">
								<?=form_label("Rol","rol")?>
								<?=form_input($rol)?>
							</div>
							<div class="form-group" style="text-align: center;">
								<?=form_submit($saveRol)?>
								<?=form_button($cancel)?>
							</div>
						</div>			
					</div>
					<div id="inputhide"></div>
				<?=form_close()?>
			</div>
			<div class="listRol">
			
			</div>
		</div>
	</div>
</div>
