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
		$cli = $_POST['cli'];
		$nom = $_POST['nom_cli'];
		$correo = $_POST['correo_cli'];
		$fono = $_POST['fono_cli'];
		$fec_nac_cli = $_POST['fec_nac_cli'];
		$fec_plan_cli = $_POST['fec_plan_cli'];
		$tipo = 1;

		if (isset($_POST['vig'])) {
			$vig = 1;
		}else{
			$vig = 0;
		}


			$dao = new ClienteDAO($cli, $correo,'',$nom, $fono, $fec_nac_cli,$fec_plan_cli, $vig);
			$mod_cli = $dao->modificar_cli($tipo);

			if (isset($_POST['cambio'])) {
				$fec_evo = date("Y-m-d", time());
				$est_cli = $_POST['est_cli'];
				$peso_cli = $_POST['peso_cli'];

				$reg_evo = $dao->reg_evo($correo,$fec_evo,$est_cli,$peso_cli);
			}

			
			
			if (count($mod_cli)>0){
			echo"<script type=\"text/javascript\">alert('Error de base de datos, comuniquese con el administrador'); window.location='../paginas_co/mod_cli.php';</script>";    
			} else {
				echo"<script type=\"text/javascript\">alert('Cliente ".$nom." modificado.'); window.location='../paginas_co/mod_cli.php';		
				</script>"; 
					}

	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/mod_cli.php';</script>"; 



	}
?>