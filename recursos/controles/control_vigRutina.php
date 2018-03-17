<?php
// session_start();
// 	//$_SESSION["correo"];
// 	if( isset($_SESSION['id_usu']) ){
// 		//Si la sesión esta seteada no hace nada
// 		$us = $_SESSION['id_usu'];
// 	}
// 	else{
// 		//Si no lo redirige a la pagina index para que inicie la sesion	
// 		header("location: ../../index.html");
// 	}      

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