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
	require_once '../clases/ClasePersona.php';

	try{
		$nom = $_POST['nom_cli'];
		$correo = $_POST['correo_cli'];
		$fono = $_POST['fono_cli'];
		$fec_nac_cli = $_POST['fec_nac_cli'];

		$fec_plan_cli = $_POST['fec_plan_cli'];

		$fec_evo = date("Y-m-d", time());
		$est_cli = $_POST['est_cli'];
		$peso_cli = $_POST['peso_cli'];
		$vig = 1;
		
		$fun = new Funciones(); 
		
		$id = 2;//identificador de usuario cliente

		if ($correo != ''){
		$val = $fun->validar_correo($correo,$id);

		if ($val <> ""){
			echo"<script type=\"text/javascript\">alert('El correo ya se encuentra en el sistema, favor utilizar otro correo o restablezca su contraseña'); window.location='../paginas_co/crear_cli.php'; </script>";  
			
			
		}else{
			$nueva_pass = $fun->generaPass();

			$dao = new ClienteDAO('', $correo,md5($nueva_pass),$nom, $fono, $fec_nac_cli,$fec_plan_cli, $vig);
		
			$crear_cli = $dao->crear_cliente();
			$reg_evo = $dao->reg_evo($correo,$fec_evo,$est_cli,$peso_cli);
			
			if (count($crear_cli)>0){
			echo"<script type=\"text/javascript\">alert('Error de base de datos, comuniquese con el administrador'); window.location='../paginas_co/crear_cli.php';</script>";    
			} else {
				$enviar_pass = $fun->enviar_correo_pass($nom,$correo,$nueva_pass);
				echo"<script type=\"text/javascript\">alert('Cliente ".$nom." Creado, favor verifique en su correo (Buzon de entrada, correos no deseados o spam) la contraseña para ingresar.'); window.location='../paginas_co/crear_cli.php';		
				</script>"; 
					}
		}}else{
		echo"Error";
	}

	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/crear_co.php';</script>"; 



	}
?>