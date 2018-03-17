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

	require_once '../clases/Funciones.php';

	try{

		$id_cli = stripcslashes ($_POST['cli']);
		$fecha = stripcslashes ($_POST['fec']);

		 $fun = new Funciones();
		 $re = $fun->ver_rutina($id_cli,$fecha);
		 


          $rut = array();


          foreach($re as $row){

                $rut[] = $row;
    
              }
		ob_end_clean();
		
		echo json_encode($rut);
	
	} catch (Exception $e) {
		//echo($e);
		echo"'Error, verifique los datos'",  $e->getMessage(); 

	}
?>