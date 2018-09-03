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

		if (isset($_POST['enf_car'])) {
			$enf = $_POST['enf_car'];
		}else{
			$enf = 'No';
		}

		if (isset($_POST['les_art'])) {
			$les = $_POST['les_art'];
		}else{
			$les = 'No';
		}

		if (isset($_POST['enf_tab'])) {
			$enf_cro_tab = $_POST['enf_tab'];
		}else{
			$enf_cro_tab = 0;
		}

		if (isset($_POST['enf_dia'])) {
			$enf_cro_dia = $_POST['enf_dia'];
		}else{
			$enf_cro_dia = 0;
		}

		if (isset($_POST['enf_asm'])) {
			$enf_cro_asm = $_POST['enf_asm'];
		}else{
			$enf_cro_asm = 0;
		}

		if (isset($_POST['enf_hip'])) {
			$enf_cro_hip = $_POST['enf_hip'];
		}else{
			$enf_cro_hip = 0;
		}

		
		$dia_sen = $_POST['dia_sen'];
		

		$obj = $_POST['opt_obj'];

		if (isset($_POST['aler_ali'])) {
			$aler_ali = $_POST['aler_ali'];
		}else{
			$aler_ali = 'No';
		}

		if (isset($_POST['into_ali'])) {
			$into_ali = $_POST['into_ali'];
		}else{
			$into_ali = 'No';
		}

		if (isset($_POST['alco'])) {
			$alco = $_POST['alco'];
		}else{
			$alco = 'No';
		}

		$apet = $_POST['apet'];
		$def = $_POST['def'];
		$agua = $_POST['agua'];
		$act_fis = $_POST['act_fis'];
		$enc_rec_des = $_POST['enc_rec_des'];
		$enc_rec_col = $_POST['enc_rec_col'];
		$enc_rec_alm = $_POST['enc_rec_alm'];
		$enc_rec_once = $_POST['enc_rec_once'];
		$enc_rec_cena = $_POST['enc_rec_cena'];
		$enc_frec_pan = $_POST['enc_frec_pan'];
		$enc_frec_fru = $_POST['enc_frec_fru'];
		$enc_frec_ens = $_POST['enc_frec_ens'];
		$enc_frec_hue = $_POST['enc_frec_hue'];
		$enc_frec_pes = $_POST['enc_frec_pes'];
		$enc_frec_leg = $_POST['enc_frec_leg'];
		$enc_frec_gol = $_POST['enc_frec_gol'];
		$enc_frec_fri = $_POST['enc_frec_fri'];
		$enc_frec_azu = $_POST['enc_frec_azu'];





		$id_cli = $us;



			$fun = new Funciones(); 
		
			$reg_eva = $fun->reg_evaluacion($enf, $les, $enf_cro_tab, $enf_cro_dia, $enf_cro_asm, $enf_cro_hip, $dia_sen, $obj, $aler_ali, $into_ali, $alco, $apet, $def, $agua, $act_fis, $enc_rec_des, $enc_rec_col, $enc_rec_alm, $enc_rec_once, $enc_rec_cena, $enc_frec_pan, $enc_frec_fru, $enc_frec_ens, $enc_frec_hue, $enc_frec_pes, $enc_frec_leg, $enc_frec_gol, $enc_frec_fri, $enc_frec_azu, $id_cli);
			if (count($reg_eva)>0){
			echo"<script type=\"text/javascript\">alert('Error de base de datos, comuniquese con el administrador'); window.location='../../index.html';</script>";    
			} else {
				echo"<script type=\"text/javascript\">alert('Evaluación registrada, ¡Ahora tu Coach tiene todo lo necesario para ayudarte en tu entrenamiento y cumplir tu objetivo!'); window.location='../paginas_cli/index_usu.php';		
				</script>"; 
					}


	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/entrenamiento.php';</script>"; 



	}
?>