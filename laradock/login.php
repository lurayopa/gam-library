<?php
header('Content-Type: text/html; charset=utf-8');
require_once('bd/conexion.php');
session_start();
function validar_usuario($usuario,$clave)
{
$conectarse = new database();
$conexion=$conectarse->conectar();
$consulta = "SELECT * FROM usuarios WHERE usu_documento='$usuario' OR usu_email='$usuario'";
$datos = $conexion->query($consulta)->fetch(PDO::FETCH_OBJ);
$conectarse->desconectar();
if ($datos): //Si existe usuario registrado con el numero de documento o email digitado		
	if ($datos->usu_clave===$clave): //Clave Correcta
		if ($datos->usu_estado!=='Activo'):
			echo '<script type="text/javascript">alert("Usuario Inactivo");</script>';
		else:		
			$_SESSION['login_validar']='si';
			$_SESSION['login_idusuario']=$datos->usu_id;	
			$_SESSION['login_rolusuario']=$datos->usu_rol;
			$_SESSION['login_nombreusuario']=$datos->usu_nombres.' '.$datos->usu_apellidos;
			header('Location: inicio.php');
		endif;
	else:
		echo '<script type="text/javascript">alert("Usuario o Contraseña Incorrecta");</script>';//De mensaje mejor poner Usuario o Contraseña Incorrecta
	endif;
else:
	echo '<script type="text/javascript">alert("No existe usuario registrado con el numero de documento o email digitado");</script>';//De mensaje mejor poner Usuario o Contraseña Incorrecta
endif;
}
?>