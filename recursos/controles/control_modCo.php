<?php
 session_start();
 	//$_SESSION["correo"];
	if(  isset($_SESSION['id']) and $_SESSION['tipo'] == 1  ){
		//Si la sesión esta seteada no hace nada
 		$us = $_SESSION['id'];
	}
 	else{
		//Si no lo redirige a la pagina index para que inicie la sesion	
 		header("location: ../../index.html");
	}      
	     
	require_once '../clases/Funciones.php';
	require_once '../clases/ClasePersona.php';

	try{
		$coach = $_POST['coach'];
		$nom = $_POST['nom_co'];
		$correo = $_POST['correo_co'];
		$fono = $_POST['fono_co'];


		if (isset($_POST['super'])) {
			$super = 1;
		}else{
			$super = 0;
		}

		if (isset($_POST['vig'])) {
			$vig = 1;
		}else{
			$vig = 0;
		}


			$dao = new CoachDAO($coach, $nom, $correo, $fono, '', $vig, $super, '');
			$mod_co = $dao->modificar_coach();

			
			if (count($mod_co)>0){
			echo"<script type=\"text/javascript\">alert('Error de base de datos, comuniquese con el administrador'); window.location='../paginas_co/mod_co.php';</script>";    
			} else {
				echo"<script type=\"text/javascript\">alert('Coach ".$nom." modificado.'); window.location='../paginas_co/mod_co.php';		
				</script>"; 
					}

	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/mod_co.php';</script>"; 



	}
?>