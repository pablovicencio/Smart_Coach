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
	     
	require_once '../clases/Funciones.php';
	require_once '../clases/ClaseEjercicio.php';

	try{
		$ejer = $_POST['id_ejer']; 
		$nom = $_POST['nom_ejer'];
		$musc = $_POST['musc'];
		$link = $_POST['link_ejer'];
		$nota = $_POST['nota_ejer'];

		if (isset($_POST['gym'])) {
			$gym = 1;
		}else{
			$gym = 0;
		}

		if (isset($_POST['vig'])) {
			$vig = 1;
		}else{
			$vig = 0;
		}


			$dao = new EjercicioDAO($ejer,$nom, $link, $nota, $vig, $gym);

		
			$mod_ejer = $dao->modificar_ejer($musc);
			
			if (count($mod_ejer)>0){
			echo"<script type=\"text/javascript\">alert('Error de base de datos, comuniquese con el administrador'); window.location='../paginas_co/entrenamiento.php';</script>";    
			} else {
				echo"<script type=\"text/javascript\">alert('Ejercicio ".$nom." Modificado.'); window.location='../paginas_co/entrenamiento.php';		
				</script>"; 
					}


	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/entrenamiento.php';</script>"; 



	}
?>