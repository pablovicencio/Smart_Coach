<?php
 session_start();
if( isset($_SESSION['id'])){
 		//Si la sesión esta seteada no hace nada
 		$us = $_SESSION['id'];
 	}
 	else{
		//Si no lo redirige a la pagina index para que inicie la sesion	
		header("location: ../../index.html");
	}       

	require_once '../clases/Funciones.php';

	try{

		$rut = stripcslashes ($_POST['rut']);
		

		 $fun = new Funciones();
		 $re = $fun->ver_ejercicio($us,$rut);
		 


          $ejercicio = array();


          foreach($re as $row){

                $ejercicio[] = $row;
    
              }
		ob_end_clean();
		
		echo json_encode($ejercicio);
	
	} catch (Exception $e) {
		//echo($e);
		echo"'Error, verifique los datos'",  $e->getMessage(); 

	}
?>