<?php
// session_start();
// 	//$_SESSION["correo"];
// 	if( isset($_SESSION['id_coach']) ){
// 		//Si la sesión esta seteada no hace nada
// 		$us = $_SESSION['id_coach'];
// 	}
// 	else{
// 		//Si no lo redirige a la pagina index para que inicie la sesion	
// 		header("location: ../../index.html");
// 	}      
	     
	//require_once '../clases/Funciones.php';
	require_once '../clases/ClaseRutina.php';

	try{
				// unescape los valores de cadena en la matriz JSON
$TableData = stripcslashes ($_POST['data']);

//$form = stripcslashes ($_POST['data1']);

// Decodificar el array JSON
$TableData= json_decode($TableData,TRUE);

//$form = json_decode($form,TRUE);

// ahora $ TableData se puede acceder como una matriz PHP
//echo stripcslashes ($_POST['id']);


	
		$fec = stripcslashes ($_POST['fec_rut']);
		$id_cli = stripcslashes ($_POST['cli']);
		$id_coach = 1;
		$vig = 1;
		$fec_reg = date("Y-m-d h:i:s", time());
		
		

		
		$dao = new RutinaDAO('',$fec,$TableData,$vig);
		
		
		$guardar_rut = $dao->guardar_rutina($id_cli, $id_coach, $fec_reg);
			
			if (count($guardar_rut)>0){
			echo"Error de base de datos, comuniquese con el administrador";    
			} else {
				echo"Rutina para el dia ".date('d-m-Y', strtotime($fec))." cargada"; 
	}
		
		
			

	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/entrenamiento.php';</script>"; 



	}
?>