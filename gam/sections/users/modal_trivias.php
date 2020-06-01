<!DOCTYPE html>
<head>
<?php
require("../helpCode/headerScripts.php");
require("../../controllers/DataBase.php");
?>
</head>

<?php
$action="create";


if(isset($_POST['answerForm']))
{
	if($_POST['action']=='create')
	{
		if($_POST["correct"]!=null)
		{
			//--------------------Query-------------------
			$cols="*";
			$table="trivias_answers";
			$where="idquestion = ".$_GET["id_question"]." AND correct = 1";
			$result=query($table,$cols,$where,false);
			if($result)
			{
				$alert = true;
				$type="danger";
				$message = "Ya existe una respuesta marcada como correcta, desmarquela primero";
			}
			else
			{
				$campos  = "idquestion,answer,correct";
				$valores = "'$_GET[id_question]','$_POST[nombre]','1'";
				$alert=true;
				if(add("trivias_answers",$campos,$valores,false)){
					$type="success";
					$message = "Registro guardado correctamente";
				}
				else{
					$type="danger";
					$message = "Error al guardar el registro";
				}
			}
		}
		else
		{
			$campos  = "idquestion,answer";
			$valores = "'$_GET[id_question]','$_POST[nombre]'";
			$alert=true;
			if(add("trivias_answers",$campos,$valores,false)){
				$type="success";
				$message = "Registro guardado correctamente";
			}
			else{
				$type="danger";
				$message = "Error al guardar el registro";
			}
		}	
	}

	if($_POST['action']=='update')
	{
		if($_POST["correct"]!=null)
		{
			//--------------------Query-------------------
			$cols="*";
			$table="trivias_answers";
			$where="idquestion = ".$_GET["id_question"]." AND correct = 1 AND id_answer != ".$_POST["id_elemento"];
			$result=query($table,$cols,$where,0);
			if($result)
			{
				$alert = true;
				$type="danger";
				$message = "Ya existe una respuesta marcada como correcta, desmarquela primero";
			}
			else
			{
				$cadena  = "answer='".$_POST["nombre"]."',correct=1";
				$where   = "id_answer = '".$_POST["id_elemento"]."'";
				$alert= true;
				if(update("trivias_answers",$cadena,$where,0)){
					$type="success";
					$message = "Registro actualizado correctamente";
				}
				else{
					$type="danger";
					$message = "Error al guardar el registro";
				}
				//header("location:modal_trivias.php?id_trivia=".$_GET["id_trivia"]."&id_question=".$_GET["id_question"]);
			}
		}
		else
		{
			$cadena  = "answer='".$_POST["nombre"]."'";
			$where   = "id_answer = '".$_POST["id_elemento"]."'";
			$alert= true;
			if(update("trivias_answers",$cadena,$where,0)){
				$type="success";
				$message = "Registro actualizado correctamente";
			}
			else{
				$type="danger";
				$message = "Error al guardar el registro";
			}
			//header("location:modal_trivias.php?id_trivia=".$_GET["id_trivia"]."&id_question=".$_GET["id_question"]);
		}	

		
	}
}
else if(isset($_GET["itemA"]))
{
	$itemEdit = array();
	//--------------------Query-------------------
	$action="update";
	$id="id_question";
	$cols="*";
	$table="trivias_answers";
	$where="id_answer = ".$_GET["itemA"];
	$result=query($table,$cols,$where,false);
	if($result)
		$itemEdit=$result[0];

}
else if(isset($_GET["itemD"]))
{
	$itemEdit = array();
	//--------------------Query-------------------
	$cols="*";
	$table="trivias_answers";
	$where="id_answer = ".$_GET["itemD"];
	$alert=true;
	if(delete($table,$where,false))
	{
		$type="success";
		$message = "Registro elimnado";
	}
	else{
		$type="danger";
		$message = "Error al eliminar el registro";
	}

}
else
{
	if($_POST['action']=='create')
	{
		$campos  = "idtrivia,question";
		$valores = "'$_GET[id_trivia]','$_POST[nombre]'";
		$alert=true;
		if(add("trivias_questions",$campos,$valores,0)){
			$type="success";
			$message = "Registro guardado correctamente";
		}
		else{
			$type="danger";
			$message = "Error al guardar el registro";
		}
	}
	if($_POST['accionEdit']=='desactivar')
	{
		$cadena  = "estado=0";
		$where   = "id_question = '".$_POST["idElemento"]."'";
		$alert= true;
		if(update("trivias_questions",$cadena,$where,false)){
			$type="success";
			$message = "Registro actualizado correctamente";
		}
		else{
			$type="danger";
			$message = "Error al guardar el registro";
		}
	}
	if($_POST['accionEdit']=='activar')
	{	
		$cadena  = "estado=1";
		$where   = "id_question = '".$_POST["idElemento"]."'";
		$alert= true;
		if(update("trivias_questions",$cadena,$where,0)){
			$type="success";
			$message = "Registro actualizado correctamente";
		}
		else{
			$type="danger";
			$message = "Error al guardar el registro";
		}
	}
	if($_POST['action']=='update')
	{
		$cadena  = "question='".$_POST["nombre"]."'";
		$where   = "id_question = '".$_POST["id_elemento"]."'";
		$alert= true;
		if(update("trivias_questions",$cadena,$where,0)){
			$type="success";
			$message = "Registro actualizado correctamente";
		}
		else{
			$type="danger";
			$message = "Error al guardar el registro";
		}
		header("location:modal_trivias.php?id_trivia=".$_GET["id_trivia"]);
	}
	$itemEdit = array();
	if($_GET['item'])
	{
		//--------------------Query-------------------
		$action="update";
		$id="id_question";
		$cols="*";
		$table="trivias_questions";
		$where="id_question = ".$_GET["item"];
		$result=query($table,$cols,$where,false);
		if($result)
			$itemEdit=$result[0];
	}
}
?>
<script>
	function asignarAccion(action)
	{
		$("#accion").val(action);
	}
	function asignarAccion1(action,id)
	{
		$("#accionEdit").val(action);
		$("#idElemento").val(id);
		document.forma1.submit();
	}
	function filtro(filtro)
	{
		$("#filtro").val(filtro);
		document.forma1.submit();
	} 
	generarModal("adminT",90,650,0,false,"");
</script>

<body style="background-color: #E9E8E8">
	<div style="margin-left:1%;margin-right:3%;margin-top:2%;">
	<div class="box box-warning" style="margin: 10px;">
		<div class="box-header with-border">
			<h3 style="margin: 5px !important">
				<i class="fa fa-fw fa-cog"></i> Administrar Trivia
			</h3>
		</div>

		<div class="box-body">
	
			<div class="row">
			    <div style="margin-left:20%;margin-right:20%;">
					<?php
						if($alert)
						{
						?>
							<script>	
								document.write(alerts('<?=$type?>','<?=$message?>'));		
							</script>
						<?php
						}
					?>
				</div>
				<div class="panel-body">
					
					<?php
					if(isset($_GET["id_question"]))
					{
					?>
					<section class="content-header">
						<h1>   
						Respuestas
						</h1>
						<ol class="breadcrumb">
						<li><a href="?id_trivia=<?=$_GET["id_trivia"]?>"><i class="fa fa-dashboard"></i>volver</a></li>
						</ol>
					</section>
					<form name="forma" method="post" action="" class="form-horizontal" enctype="multipart/form-data" accept-charset="UTF-8">
						<div style="padding: 50px">
							
						<div class="form-group">
							<label class="col-lg-2 col-sm-2 control-label" for="asunto"></label>
							<div class="col-lg-8">
								<input type="text" required="required" id="nombre" name="nombre" value="<?=$itemEdit["answer"]?>" class="form-control" placeholder="Nueva respuesta">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 col-sm-2 control-label" for="asunto">Correcta</label>
							<div class="col-lg-8">
							<?php
							if(!empty($itemEdit))
							{
								if($itemEdit["correct"]==1)
								{
								?>
									<input type="checkbox" id="correct" name="correct" value="1" checked >
								<?php
								}
								else
								{
									?>
									<input type="checkbox" id="correct" name="correct" value="1" >
									<?php	
								}
							}
							else
							{
							?>
							<input type="checkbox" id="correct" name="correct" value="1" >
							<?php
							}
							?>
							
							</div>
						</div>

							<!-- Button -->
							<div class="text-center">
								<input type="submit" class="btn btn-success" value="Guardar" name="subir" id="subir" />
							</div>
						</div>
						<input type="hidden" id="action" name="action" value="<?=$action?>" /> 
						<input type="hidden" id="action" name="answerForm" value="<?=$action?>" /> 
						<input type="hidden" name="id_elemento" id="id_elemento" value="<?=$itemEdit["id_answer"]?>">
					</form>
					<?php
					}
					else
					{
					?>
					<section class="content-header">
						<h1>   
						Preguntas 
						</h1>
						<ol class="breadcrumb">
						</ol>
					</section>
					<form name="forma" method="post" action="" class="form-horizontal" enctype="multipart/form-data" accept-charset="UTF-8">
						<div style="padding: 50px">
							
						<div class="form-group">
							<label class="col-lg-2 col-sm-2 control-label" for="asunto"></label>
							<div class="col-lg-8">
								<input type="text" required="required" id="nombre" name="nombre" value="<?=$itemEdit["question"]?>" class="form-control" placeholder="Nueva Pregunta">
							</div>
						</div>

							<!-- Button -->
							<div class="text-center">
								<input type="submit" class="btn btn-success" value="Guardar" name="subir" id="subir" />
							</div>
						</div>
						<input type="hidden" id="action" name="action" value="<?=$action?>" /> 
						<input type="hidden" name="id_elemento" id="id_elemento" value="<?=$itemEdit["id_question"]?>">
					</form>
					<?php	
					}
					?>

				</div>
			</div>
		</div>

		

		<!--Table-->
		<div style="margin:3%">

		<?php
		if(isset($_GET["id_question"]))
		{
			//--------------------Query-------------------
			$id="id_answer";
			$cols="*";
			$table="trivias_answers";
			$where="idquestion = ".$_GET["id_question"]." ORDER BY answer";
			$result=query($table,$cols,$where,false);
		?>
				<div style="overflow-x:scroll"><!--Answers-->
						<form name="forma1" method="post" action="">
						<table id="generalDataTable" class="table table-bordered table-striped">
						<thead>
							<tr>
								<td class="text-center"><b>Respuesta</b></td>
								<td class="text-center"><b>Tipo</b></td>
								<td class="text-center"><b>Acciones</b></td>
							</tr>
						</thead>
						<tbody>
						<?php
							if($result)
							{
									foreach ($result as $res) {
									?>
										<tr>
											<td class="text-center"><?=$res["answer"]?></td>
											<?php
											if($res["correct"]==0)
											{
											?>
												<td class="text-center"><font color="red">Incorrecta</font></td>
											<?php
											}
											else
											{
											?>
												<td class="text-center"><font color="green">Correcta</font></td>
											<?php	
											}
											?>
											<td class="text-center">
												<a href="?id_question=<?=$_GET["id_question"]?>&id_trivia=<?=$_GET["id_trivia"]?>&itemA=<?=$res["id_answer"]?>" >		
													<input type="button" value="Editar" class="btn btn-primary btn-xs" />									
												</a>
												<a href="?id_question=<?=$_GET["id_question"]?>&id_trivia=<?=$_GET["id_trivia"]?>&itemD=<?=$res["id_answer"]?>"">
													<input type="button" name="desactivar" id="desactivar" value="Eliminar" class="btn btn-danger btn-xs" />																	
												</a>
											</td>
										</tr>
									<?php
									}
							}
						?>
						</tbody>
						</table>
						<input type="hidden" id="accionEdit" name="accionEdit" />
						<input type="hidden" id="answerEdit" name="answerEdit" />
						<input type="hidden" id="filtro" name="filtro" />
						<input type="hidden" id="idElemento" name="idElemento" />
						</form><!-- Form -->
						<br>
					</div><!-- Scroll -->
		<?php
		}
		else
		{
		//--------------------Query-------------------
		$id="id_question";
		$cols="*";
		$table="trivias_questions";
		$where="idtrivia = ".$_GET["id_trivia"]." ORDER BY estado ASC,datecreated ASC";
		$result=query($table,$cols,$where,false);
		?>
		<div style="overflow-x:scroll">
			<form name="forma1" method="post" action="">
			<table id="generalDataTable" class="table table-bordered table-striped">
			<thead>
				<tr>
					<td class="text-center"><b>Pregunta</b></td>
					<td class="text-center"><b>Estado</b></td>
					<td class="text-center"><b>Acciones</b></td>
				</tr>
			</thead>
			<tbody>
			<?php
				if($result)
				{
						foreach ($result as $res) {
						?>
							<tr>
								<td class="text-center"><?=$res["question"]?></td>
								<?php
								if($res["estado"]==0)
								{
								?>
									<td class="text-center"><font color="red">Inactivo</font></td>
								<?php
								}
								else
								{
								?>
									<td class="text-center"><font color="green">Activo</font></td>
								<?php	
								}
								?>
								<td class="text-center">
									<a href="?id_question=<?=$res["id_question"]?>&id_trivia=<?=$_GET["id_trivia"]?>" >
										<input type="button" value="Respuestas" class="btn btn-info btn-xs" />									
									</a>
									<a href="?id_trivia=<?=$_GET["id_trivia"]?>&item=<?=$res["id_question"]?>" >		
										<input type="button" value="Editar" class="btn btn-primary btn-xs" />									
									</a>
									<?php
									if($res["estado"]==0)
									{
									?>
										<input type="button" name="activar" id="activar" value="Activar" class="btn btn-success btn-xs" onclick="asignarAccion1('activar',<?=$res['id_question']?>)"/> 
									<?php	
									}
									else
									{
									?>
										<input type="button" name="desactivar" id="desactivar" value="Desactivar" class="btn btn-danger btn-xs" onclick="asignarAccion1('desactivar',<?=$res['id_question']?>)" />
									<?php	
									}
									?>																	
								</td>
							</tr>
						<?php
						}
				}
			?>
			</tbody>
			</table>
			<input type="hidden" id="accionEdit" name="accionEdit" />
			<input type="hidden" id="filtro" name="filtro" />
			<input type="hidden" id="idElemento" name="idElemento" />
			</form><!-- Form -->
			<br>
		</div><!-- Scroll -->
		<?php	
		}
		?>
	 </div>

	</div> 
	<br>
    </div>
    <?php
    include("../helpCode/footerScripts.php");
    ?>
</body>
