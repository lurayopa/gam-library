<?php
$path = ".";
?>
<!-------------- Generales del Front principal --------------> 
	<!-- Bootstrap 3.3.6 -->
	<script src="<?=$path?>/bootstrap/js/bootstrap.min.js"></script>
	<!-- Sparkline -->
	<script src="<?=$path?>/plugins/sparkline/jquery.sparkline.min.js"></script>
	<!-- jvectormap -->
	<script src="<?=$path?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?=$path?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="<?=$path?>/plugins/knob/jquery.knob.js"></script>
	<!-- daterangepicker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
	<script src="<?=$path?>/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- datepicker -->
	<script src="<?=$path?>/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="<?=$path?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<!-- Slimscroll -->
	<script src="<?=$path?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?=$path?>/plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?=$path?>/dist/js/app.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?=$path?>/dist/js/demo.js"></script>	
<!-------------- Generales del Front principal -------------->

<!------------------------- Personales adicionales ------------------------> 
	<!-- Modal color-box -->
	<script src="<?=$path?>/js/jquery.colorbox-min.js"></script>
	<!-- DataTables -->
	<script src="<?=$path?>/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?=$path?>/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<!-- Tabla general en los Modulos de CRUD -->
	<script>
		$(function () {
		    $("#generalDataTable").DataTable({ //Tabla de datos general en cada modulo
		        "language": {
		            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json" //Idioma de la tabla
		        }
		    } );
		});	
		//Asinar width vacio a la tabla para que maneje responsive sin problema
		setTimeout('$("#generalDataTable").css("width","");',1000);
		setTimeout('$("#generalDataTable").css("width","");',5000);
	</script>