<?php
 session_start();

 	if( isset($_SESSION['id']) ){
 		//Si la sesión esta seteada no hace nada
 		$us = $_SESSION['id'];
 	}
 	else{
// 		//Si no lo redirige a la pagina index para que inicie la sesion	
 		header("location: ../../index.html");
 	}      

	require_once '../clases/Funciones.php';

	try{

		$co = stripcslashes ($_POST['co']);

		 $fun = new Funciones();
		 $re = $fun->cargar_datos_co($co);
		 


          $datos = array();


          foreach($re as $row){

                $datos[] = $row;
    
              }
		ob_end_clean();
		
		echo json_encode($datos);
	
	} catch (Exception $e) {
		//echo($e);
		echo"'Error, verifique los datos'",  $e->getMessage(); 

	}
?>