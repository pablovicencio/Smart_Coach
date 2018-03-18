<?php
 session_start();
if( isset($_SESSION['id'])and $_SESSION['tipo'] == 1  ){
 		//Si la sesión esta seteada no hace nada
 		$us = $_SESSION['id'];
 	}
 	else{
		//Si no lo redirige a la pagina index para que inicie la sesion	
		header("location: ../../index.html");
	}        

	require_once '../clases/claseRutina.php';

	try{

		$rut = stripcslashes ($_POST['rut']);

		 $rutina = new RutinaDAO($rut);
		 $re = $rutina->vig_rutina();

		 echo ('rutina_quitada');
		 
	
	} catch (Exception $e) {
		//echo($e);
		echo"'Error, verifique los datos'",  $e->getMessage(); 

	}
?>