$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
var roles = [];
disabledButton2();
$(document).on("click",".optionrole",function()
{
	var rol = $(this).val();
	var rolText = $(this).text();
		$("#Roles").append('<div class="rolItem">'+rolText+'<i id="'+rol+'"class="glyphicon glyphicon-remove RemoveRol"></i></div>');
		roles.push(rol);	
		$(this).css("display","none");	
		 buttonhiderol();
		 disabledButton2();
});


$(document).on("click",".RemoveRol",function()
{	
	var deletRol =$(this).attr("id");

	removeItemFromArr( roles, deletRol );
	var textRolfield = $(this).parent().text();
	$(this).parent().remove();
	$("#selectRole > #"+deletRol).css("display","block");
 buttonhiderol();
		 disabledButton2();
});

$(document).on("click",".addrole",function()
	{
		$("#addRol").css("display","block");
		$(".listRol").css("display","none");
	});
$(document).on("click","#addusers",function()
	{
		$(".addUser").css("display","block");
		$(".listUser").css("display","none");
	});
$(document).on("click","#cancelUsers",function()
	{
		$(".addUser").css("display","none");
		$(".listUser").css("display","block");
		$("input[type='text']").val("");
		$("input[type='email']").val("");
		$("")
		if($("#rolInput").length)
	{
		$("#rolInput").remove();
		$("#inputHiddenRol").append('<input type="hidden" id="rolInput" name="roles[]" value="'+roles+'">');
		roles.forEach(function(rol)
		{
			$("#selectRole > #"+rol).css("display","block");
		});
		$(".RemoveRol").parent().remove();
	}
	roles.length=0;
		if($("#inputHiddenRol > #id").length){
		$("#inputHiddenRol > #id").remove();
	}
	});
$(document).on("click","#cancelRol",function()
	{
		$("#addRol").css("display","none");
		$(".listRol").css("display","block");
		$("#role").val("");
	    $(".err > p").remove();
	if($("#inputhide >#id").length){
		$("#inputhide >#id").remove();
	}

	});
//Peticiones ajax
//lista de roles
$(document).ready(function()
	{
	    $.ajax({
	    	url:"http://localhost/test/ajax_selection/selectRole",
	    }).done(function(dataRol)
	    {
	    	$(".listRol").append(dataRol);
	    }
	    ).fail(function()
	    {
	    	$(".listRol").append('<div class="messageNullRol">No hay roles registrados</div>');
	    });
	});
$(document).ready(function()
	{
	    $.ajax({
	    	url:"http://localhost/test/ajax_selection/selectUser",
	    }).done(function(dataRol)
	    {
	    	$(".listUser").append(dataRol);
	    }
	    ).fail(function()
	    {
	    	$(".listUser").append('<div class="messageNullRol">No hay roles registrados</div>');
	    });
	});

//functions
var edit = function(id,content)
{
	$("#addRol").css("display","block");
	$(".listRol").css("display","none");
	$("#role").val(content);
		if($("#inputhide >#id").length){
		$("#inputhide >#id").remove();
	}
	$("#inputhide").append("<input type='hidden' id='id' name='id' value='"+id+"'>");
};
var editUser = function(id,content)
{
	$(".addUser").css("display","block");
	$(".listUser").css("display","none");
	if($("#inputHiddenRol > #id").length){
		$("#inputHiddenRol > #id").remove();
	}
	$("#inputHiddenRol").append("<input type='hidden' name='id' id='id' value='"+id+"'>");
	$.ajax({
		url:"http://localhost/test/ajax_selection/selectUserData/"+id,
	}).done(function(data)
	{
		var dat = JSON.parse(data);
		$("#name").val(dat[0].name);
		$("#phone").val(dat[0].phone);
		$("#email").val(dat[0].email);
		$("#ageImput").val(dat[0].date_nat);
	});
	$.ajax({
		url:"http://localhost/test/ajax_selection/selectUserRolData/"+id
	}).done(function(data){
		var dataRol = JSON.parse(data);
		dataRol.forEach(function(r)
			{
				$("#selectRole > #"+r.id_role).css("display","none");
				$("#Roles").append('<div class="rolItem">'+r.role+'<i id="'+r.id_role+'"class="glyphicon glyphicon-remove RemoveRol"></i></div>');
				roles.push(r.id_role);
				$("#rolInput").remove();
				$("#inputHiddenRol").append('<input type="hidden" id="rolInput" name="roles[]" value="'+roles+'">');
			});
	});
};
var deleteroles = function(id,rol)
{
	var sus = confirm("Seguro que desea eliminar el Rol "+rol);
	if(sus==true)
	{
		window.location="/test/userlog/deleteroles/"+id;
	}
}
var deleteUser = function(id,user)
{
	var sus = confirm("Seguro que desea eliminar el usuario de "+user);
	if(sus==true)
	{
		window.location="/test/userlog/deleteUser/"+id;
	}
}
var removeItemFromArr  =function ( arr, item ) 
{
    var i = arr.indexOf( item );
    if ( i !== -1 ) {
        arr.splice( i, 1 );
    }
}
var buttonhiderol=function()
{
	if($("#rolInput").length)
	{
		$("#rolInput").remove();
		$("#inputHiddenRol").append('<input type="hidden" id="rolInput" name="roles[]" value="'+roles+'">');
	}else
	{
		$("#inputHiddenRol").append('<input type="hidden" id="rolInput" name="roles[]" value="'+roles+'">');
	}
};
$(document).on("focusout","input[name='name']",function()
	{
		 $.ajax({
	    	url:"http://localhost/test/ajax_selection/ValidName",
	    	type:"POST",
	    	data:"name="+$("#name").val()
	    }).done(function(msj)
	    {
	    	if(msj==0)
	    	{
	    		$(".err#user > p").remove();
	    		$(".err#user").append("<p>El nombre es requerido. </p>");
	    		disabledButton();
	    	}
	    	else
	    	{
	    		$(".err#user > p").remove();
	    		disabledButton();
	    	}
	    });
	});

$(document).on("focusout","input[name='email']",function()
{
	if($("#id").length)
	{
		 $.ajax({
	    	url:"http://localhost/test/ajax_selection/valid_users_email/",
	    	type:"POST",
	    	data:{
	    		"email":$("#email").val(),
	    		"id":$("#id").val()
	    	}
	    }).done(function(msj)
	    {
	    	if(msj==0)
	    	{
	    		$(".err#email > p").remove();
	    		$(".err#email").append("<p>El email es requerido. </p>");
	    		disabledButton();
	    	}
	    	if(msj==1)
	    	{
	    		$(".err#email > p").remove();
	    		$(".err#email").append("<p>El formato del correo es erroneo. </p>");
	    		disabledButton();
	    	}
	    	if(msj==2)
	    	{
	    		$(".err#email > p").remove();
	    		$(".err#email").append("<p>El correo ya se encuentra registro. </p>");
	    		disabledButton();
	    	}
	    	if(msj==3)
	    	{
	    		$(".err#email > p").remove();
	    		disabledButton();
	    	}
	    });
	}else
	{
		 $.ajax({
	    	url:"http://localhost/test/ajax_selection/valid_users_email/",
	    	type:"POST",
	    	data:"email="+$("#email").val()
	    }).done(function(msj)
	    {
	    	if(msj==0)
	    	{
	    		$(".err#email > p").remove();
	    		$(".err#email").append("<p>El email es requerido. </p>");
	    		disabledButton();
	    	}
	    	if(msj==1)
	    	{
	    		$(".err#email > p").remove();
	    		$(".err#email").append("<p>El formato del correo es erroneo. </p>");
	    		disabledButton();
	    	}
	    	if(msj==2)
	    	{
	    		$(".err#email > p").remove();
	    		$(".err#email").append("<p>El correo ya se encuentra registro. </p>");
	    		disabledButton();
	    	}
	    	if(msj==3)
	    	{
	    		$(".err#email > p").remove();
	    		disabledButton();
	    	}
	    });
	}
});
$(document).on("focusout","select[name='rol']",function()
	{
		 $.ajax({
	    	url:"http://localhost/test/ajax_selection/valid_users_roles",
	    	type:"POST",
	    	data:"roles[]="+$("#rolInput").val()
	    }).done(function(msj)
	    {
	    	if(msj==0)
	    	{
	    		$(".err#rol > p").remove();
	    		$(".err#rol").append("<p>se requiere al menos un rol. </p>");
	    		disabledButton();
	    	}
	    	else
	    	{
	    		$(".err#rol > p").remove();
	    		disabledButton();
	    	}
	    });
	});
$(document).on("focusout","input[name='age']",function()
	{
		 $.ajax({
	    	url:"http://localhost/test/ajax_selection/valid_users_date",
	    	type:"POST",
	    	data:"age="+$("#ageImput").val()
	    }).done(function(msj)
	    {
	    	if(msj==0)
	    	{
	    		$(".err#age > p").remove();
	    		$(".err#age").append("<p>La fecha es requerida. </p>");
	    		disabledButton();
	    	}
	    	else
	    	{
	    		$(".err#age > p").remove();
	    		disabledButton();
	    	}
	    });
	});
$(document).on("focusout","input[name='phone']",function()
	{
		 $.ajax({
	    	url:"http://localhost/test/ajax_selection/Valid_users_phone",
	    	type:"POST",
	    	data:"phone="+$("#phone").val()
	    }).done(function(msj)
	    {
	    	if(msj==0)
	    	{
	    		$(".err#phone > p").remove();
	    		$(".err#phone").append("<p>El telefono es requerido. </p>");
	    		disabledButton();
	    	}
	    	else
	    	{
	    		$(".err#phone > p").remove();
	    		disabledButton();
	    	}
	    });
	});
function disabledButton (){
if($(".err").is(":not(:empty)"))
{
	$("#send_user").attr("disabled","disabled");
}else{
	$("#send_user").removeAttr("disabled");

}
	
};
function disabledButton2 (){
if(roles.length==0)
{
	$("#send_user").attr("disabled","disabled");
}else{
	$("#send_user").removeAttr("disabled");

}
	
};
$(document).on("change","input[type='text']",function()
	{
		if($("input[type='text']").is(":empty"))
		{
			$("#send_user").attr("disabled","disabled");
		}else
		{
			$("#send_user").removeAttr("disabled");
		}
	});