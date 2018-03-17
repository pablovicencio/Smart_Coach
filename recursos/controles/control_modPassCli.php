<?php
	session_start();
	//$_SESSION["correo"];
	if( isset($_SESSION['id']) ){
		//Si la sesión esta seteada no hace nada
		$id = $_SESSION['id'];
	}
	else{
		//Si no lo redirige a la pagina index para que inicie la sesion	
		header("location: ../../index.html");
	}          
	
	require_once '../clases/Funciones.php';
	require_once '../clases/ClasePersona.php';
	try{
		$pass = $_POST['pass'];
		$nueva_pass = $_POST['nueva_pass'];
		$nueva_pass1 = $_POST['nueva_pass1'];
		$mail = $_SESSION['correo'];
 		$usuario = $_SESSION['nom'];
 		$tipo = $_SESSION['tipo'];
		
		
		$fun = new Funciones();
		if ($pass != ''){
			$old_pass = $fun->old_pass($id,$tipo);
			
			if (md5($pass) != $old_pass){
				if ($tipo == 1) {
					echo"<script type=\"text/javascript\">alert('Error, la contraseña actual no es valida'); window.location='../paginas_co/entrenamiento.php';</script>";  
				}elseif ($tipo == 2) {
					echo"<script type=\"text/javascript\">alert('Error, la contraseña actual no es valida'); window.location='../paginas_cli/mi_cuenta.php';</script>";  
				}
			
			} else { 
			
			if ($nueva_pass == $nueva_pass1){
			$upd_pass = PersonaDAO::actualizar_contraseña($id,md5($nueva_pass),$tipo);
			//$enviar_pass = $fun->correo_upd_pass($mail,$nueva_pass);
			session_destroy();
				echo"<script type=\"text/javascript\">alert('Contraseña actualizada correctamente, favor vuelva a ingresar con su nueva contraseña'); 		window.location='../../index.html';  </script>"; 
				
			}else{
					if ($tipo == 1) {
					echo"<script type=\"text/javascript\">alert('Error, las contraseñas nuevas no coinciden, favor vuelta a intentarlo'); window.location='../paginas_co/entrenamiento.php';</script>";  
					}elseif ($tipo == 2) {
						echo"<script type=\"text/javascript\">alert('Error, las contraseñas nuevas no coinciden, favor vuelta a intentarlo'); window.location='../paginas_cli/mi_cuenta.php';</script>";  
					}
				}
	}
		}else{
		echo"Error";
	}	
	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>"; 
		}
?>