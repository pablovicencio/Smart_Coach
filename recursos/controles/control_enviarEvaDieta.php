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
	     
	require_once '../clases/ClaseDieta.php';

	try{
		$id_die = $_POST['id_dieta'];
		$ham = $_POST['hambre_eva'];
		if (isset($_POST['hora_eva'])) {
			$hora = $_POST['hora_eva'];
		}else{
			$hora = 0;
		}
		

		$seg = $_POST['nota_eva'];
		$fec = date("Y-m-d h:i:s", time());
		$cli = $us;



			$dao = new DietaDAO($id_die);
		
			$reg_eva = $dao->eva_dieta($ham,$hora,$seg,$fec,$cli);
			if (count($reg_eva)>0){
			echo"<script type=\"text/javascript\">alert('Error de base de datos, comuniquese con el administrador'); window.location='../../index.html';</script>";    
			} else {
				echo"<script type=\"text/javascript\">alert('¡Gracias por compartir tu evaluación!'); window.location='../paginas_cli/nutricion.php';		
				</script>"; 
					}


	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); ../paginas_cli/nutricion.php';</script>"; 



	}
?>