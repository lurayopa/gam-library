//Mensajes de alerta
function alerts(tipoMensaje,mensaje)
{
	alerta ='<div class="alert alert-'+tipoMensaje+'" id="divAlertAction">' ;
	alerta+=  mensaje;
	alerta+= '<span class="tools pull-right">' ;
	alerta+= '<a href="javascript:;" onclick="document.getElementById(\'divAlertAction\').style.display=\'none\';">';
	alerta+=  '<i class="fa fa-times"></i>';
	alerta+=' </a>';
	alerta+=' </span>';
	alerta+='</div>';		
	return alerta;
}
//Mensajes de alerta con Id Propio
function alertsId(tipoMensaje,mensaje,id)
{
	alerta ='<div class="alert alert-'+tipoMensaje+'" id="'+id+'">' ;
	alerta+=  mensaje;
	alerta+= '<span class="tools pull-right">' ;
	alerta+= '<a href="javascript:;" onclick="document.getElementById(\''+id+'\').style.display=\'none\';">';
	alerta+=  '<i class="fa fa-times"></i>';
	alerta+=' </a>';
	alerta+=' </span>';
	alerta+='</div>';		
	return alerta;
}
function imgCargando(path,buttonId) 
{
	cad  =  '<div class="divCentrado">'; 
	cad=cad+'<img src="'+path+'/img/input-spinner.gif">';
	cad=cad+'</div>';
	$("body").append(cad);
	$("body").append(cad);
	$("#"+buttonId).attr("disabled","disabled");
	setTimeout ('alert("enviar");', 35000);
	//console.log("Enviar!!"); 
}