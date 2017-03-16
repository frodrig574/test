<?php 

$name=array(
	"name"=>"name",
	"id" => "name",
	"class"=>"form-control",
	"required"=>"required",
	"value" => set_value("name")
	);
$email=array(
	"name" => "email",
	"id" => "email",
	"class" => "form-control",
	"type" => "email",
	"required" => "required",
	"value" => set_value("email")
	);
$phone=array(
	"name"=>"phone",
	"id" => "phone",
	"class"=>"form-control",
	"required"=>"required",
	"value" => set_value("phone")

	);
$age=array(
	"name"=>"age",
	"type" => "text",
	"class"=>"form-control",
	"required"=>"required",
	"id" => "ageImput",
	"value" => set_value("age")
	);
$cancel=array(
	"name" => "cancel",
	"content" => "Cancelar",
	"id" => "cancelUsers",
	"class" => "btn btn-danger"
	);
$save=array(
	"name"=>"save",
	"value" => "Guardar",
	"class" => "btn btn-info",
	"id" => "send_user"
	);
$optionsrol = array();
foreach($result as $rowrole)
{
	$optionsrol[$rowrole->id] =$rowrole->role;
}
$classRol= array
(
 "class"=>"form-control"
	);
if(isset($msj_exito))
{
	echo "<script>alert('".$msj_exito."');</script>";
}

?>
<div class="row">
<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-md-6 col-md-offset-3">
<div class="content-form">
	<header><p>Usuarios</p><i class="icons fa fa-plus-circle" id="addusers"></i></header>
	<div class="addUser" id="addUser">
		<?=form_open("userlog/insert_users")?>
			<div class="row">
				<div class="col-sm-12" style="padding:40px;">
					<div class="form-group">
						<?=form_label("Nombre","name")?>
						<?=form_input($name)?>
						<div class="err" id="user"><?php echo form_error('name'); ?></div>
					</div>
					<div class="form-group">
						<?=form_label("Email","email")?>
						<?=form_input($email)?>
						<div class="err" id="email"><?php echo form_error('email'); ?></div>
					</div>
					<div class="form-group">
						<?=form_label("Telefono","phone")?>
						<?=form_input($phone)?>
						<div class="err" id="phone"><?php echo form_error('phone'); ?></div>

					</div>
					<div class="form-group">
						<?=form_label("Fecha de nacimiento","age")?>
						<div class='input-group date' id='datetimepicker10'>
                			<?=form_input($age);?>
                			<span class="input-group-addon">
                    			<span class="glyphicon glyphicon-calendar">
								</span>
							</span>
            			</div>
						<div class="err" id="age"><?php echo form_error('age'); ?></div>
					</div>
					<div class="form-group">
						<?=form_label("Rol","rol")?>
							<?=form_dropdown_role("rol",$optionsrol)?>
					</div>
					<div class="err" id="rol"><?php echo form_error('roles[]'); ?></div>
					<div class="form-group">
						<?=form_fieldset("Roles del usuario")?>
							<div class="fieldsetRoles" id="Roles"></div>
						<?=form_fieldset_close()?>
					</div>
					<div class="form-group" style="text-align: center;">
						<?=form_submit($save)?>
						<?=form_button($cancel)?>
					</div>
				</div>			
			</div>
			<div id="inputHiddenRol"><?=form_hidden("roles[]",set_value("age"),"rolInput")?></div>
		<?=form_close()?>
	</div>
	<div class="listUser"></div>
</div>
</div>
</div>
<script type="text/javascript">
            $('#datetimepicker10').datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD',
                minDate: new Date(1950, 10 - 1, 25),
                maxDate: new Date(1999, 12 - 1, 31)
            });
    </script>
    <?php
if($msj_e=="yes")
			{
				echo '<script>$(".addUser").css("display","block");</script>';
				echo '<script>$(".listUser").css("display","none");</script>';
			}
    ?>
<!--
-Nombre
-Email
-Teléfono 
-Edad
-Roles asociados (ojo, pueden ser más de uno) -->