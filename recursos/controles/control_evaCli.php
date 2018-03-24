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
	     
	require_once '../clases/Funciones.php';

	try{
		$enf = $_POST['opt_enf'];
		$can = $_POST['opt_can'];
		$prob = $_POST['opt_prob'];
		$med = $_POST['opt_med'];
		$imp = $_POST['opt_imp'];
		$sem = $_POST['act_sem'];
		$lab = $_POST['act_lab'];
		$inf = $_POST['opt_inf'];
		$casa = $_POST['opt_casa'];
		$obj = $_POST['opt_obj'];
		$id_cli = $us;



			$fun = new Funciones(); 
		
			$reg_evo = $fun->reg_evaluacion($enf, $can, $prob, $med, $imp, $sem, $lab, $inf, $casa, $obj, $id_cli);
			if (count($reg_evo)>0){
			echo"<script type=\"text/javascript\">alert('Error de base de datos, comuniquese con el administrador'); window.location='../../index.html';</script>";    
			} else {
				echo"<script type=\"text/javascript\">alert('Evaluación registrada, ¡Ahora tu Coach tiene todo lo necesario para ayudarte en tu entrenamiento y cumplir tu objetivo!'); window.location='../paginas_cli/index_usu.php';		
				</script>"; 
					}


	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/entrenamiento.php';</script>"; 



	}
?>