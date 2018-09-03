<?php
 session_start();
 
if( isset($_SESSION['id'])and $_SESSION['tipo'] == 2  ){
 		//Si la sesión esta seteada no hace nada
 		$us = $_SESSION['id'];
 	}
 	else{
		//Si no lo redirige a la pagina index para que inicie la sesion	
		header("location: ../../index.html");
	}      
	     
	//require_once '../clases/Funciones.php';
	require_once '../clases/ClaseDieta.php';

	try{
				// unescape los valores de cadena en la matriz JSON
$TableData = stripcslashes ($_POST['data']);

//$form = stripcslashes ($_POST['data1']);

// Decodificar el array JSON
$TableData= json_decode($TableData,TRUE);

//$form = json_decode($form,TRUE);

// ahora $ TableData se puede acceder como una matriz PHP
//echo stripcslashes ($_POST['id']);

		$id_cli = stripcslashes ($_POST['cli']);
		$id_coach = $us;
		$vig = 1;
		$fec = date("Y-m-d h:i:s", time());
		
		

		
		$dao = new DietaDAO('',$fec,$TableData,$vig);
		
		
		$guardar_dieta = $dao->guardar_dieta($id_cli, $id_coach);
			
			if (count($guardar_dieta)>0){
			echo"Error de base de datos, comuniquese con el administrador";    
			} else {
				echo"Dieta cargada"; 
	}
		
		
			

	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/nutricion.php';</script>"; 



	}
?>