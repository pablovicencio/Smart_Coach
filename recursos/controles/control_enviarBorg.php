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
	     
	require_once '../clases/ClaseRutina.php';

	try{
		$id_rut = $_POST['id_rut'];
		$esc = $_POST['borg'];
		$fec_esc = date("Y-m-d h:i:s", time());
		$id_cli = $us;



			$dao = new RutinaDAO($id_rut);
		
			$reg_borg = $dao->borg_rutina($esc,$fec_esc,$id_cli);
			if (count($reg_borg)>0){
			echo"<script type=\"text/javascript\">alert('Error de base de datos, comuniquese con el administrador'); window.location='../../index.html';</script>";    
			} else {
				echo"<script type=\"text/javascript\">alert('¡Gracias por compartir tu evaluación!'); window.location='../paginas_cli/index_usu.php';		
				</script>"; 
					}


	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/entrenamiento.php';</script>"; 



	}
?>