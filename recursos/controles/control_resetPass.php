<?php
	require_once '../clases/Funciones.php';

	try{

		$mail = $_POST['mail'];

		$fun = new Funciones();

		$val = $fun->validacion($mail);

		echo $val;

		if (isset($_POST['mail']) and isset($val) ){ 
			

		
			$new_pass = $fun->generaPass();
		
			$upd_pass = $fun->res_pass($mail,$new_pass,$val);
			
			if (count($upd_pass)>0){
			echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador del sistema'); window.location='../../index.php';</script>";  
			} else {
				$enviar_pass = $fun->enviar_reset_pass($mail,$new_pass);
				echo"<script type=\"text/javascript\">alert('Su nueva contraseña ha sido enviada al correo ".$mail."'); 		window.location='../../index.html';</script>"; 
					}
		}else{
		echo"<script type=\"text/javascript\">alert('El correo ingresado no se encuentra en el sistema'); window.location='../../index.html'; </script>"; 
	}
	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>"; 
	}
?>