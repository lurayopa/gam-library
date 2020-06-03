<?php
if (isset($_GET['contenido'])):
	$contenido=$_GET['contenido'];
	if (file_exists($contenido)) {
	require($contenido);
	}
	else
	{
		echo'<div align="center"><b>¡Error! no existe el contenido solicitado</b></div>';
		echo'<div align="center"><a style="text-decoration:none; font-size:14px;" href="inicio.php">Regresar a la página principal</a></div>';
	}
else:
	require('mod/usuarios/bienvenidos.php');
endif;
?>