<?php
 session_start();
 if( isset($_SESSION['id'])and $_SESSION['tipo'] == 2  ){
 		//Si la sesión esta seteada no hace nada
 		$us = $_SESSION['id'];
 	}
 	else{
		//Si no lo redirige a la pagina index para que inicie la sesion	
		header("location: ../../index.html");
	}         
	     
	require_once '../clases/ClaseAlimento.php';

	try{
		$nom = $_POST['nom_ali'];
		$grupo = $_POST['ga'];
		$vigencia = 1;


			$dao = new AlimentoDAO('',$nom, $grupo, $vigencia);
		
			$crear_ali = $dao->crear_alimento();
			
			if (count($crear_ali)>0){
			echo"<script type=\"text/javascript\">alert('Error de base de datos, comuniquese con el administrador'); window.location='../paginas_co/nutricion.php';</script>";    
			} else {
				echo"<script type=\"text/javascript\">alert('Alimento ".$nom." Creado.'); window.location='../paginas_co/nutricion.php';		
				</script>"; 
					}


	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/nutricion.php';</script>"; 



	}
?>