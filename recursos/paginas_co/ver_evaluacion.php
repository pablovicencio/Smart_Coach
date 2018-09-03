<?php  
 session_start(); 
 if( isset($_SESSION['id']) and ($_SESSION['tipo'] == 1 or $_SESSION['tipo'] == 2 ) ){
     //Si la sesión esta seteada no hace nada
     $id = $_SESSION['id'];
   }
   else{
     //Si no lo redirige a la pagina index para que inicie la sesion 
     header("location: ../../index.html");
   }   
  $cli = $_GET['cli'];

  require_once '../clases/Funciones.php';

  $fun = new Funciones(); 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>D3 - Ver Evaluación</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>


</head>

<body>
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
              <img class="img-fluid" src="../img/logo/logo_d3safio3.png" alt="D3safio" width="150" height="30">
              </ul>
            </nav>
<div class="container" style="padding-top: 5px">

<div class="row">
<div class="col-sm">

<center><h3>Evaluación de  
 <?php  $re = $fun->cargar_cli($cli); 
                            foreach($re as $row)      
                      {echo $row['nom_cli'];} 
                        ?> </h3>

</h3></center>

<?php  $re1 = $fun->cargar_eva($cli); 
                            foreach($re1 as $row1)      
                      {

                      } 
                        ?> 

<hr>
<div class="row" >
    
      <label>¿Tiene alguna enfermedad Cardiaca?</label>
      <br>
        <textarea class="form-control" id="enf_car" maxlength="150" readonly><?php echo $row1['enf_car_desc_eva']; ?></textarea>
      <br>

      <label>¿Sufre alguna lesión Osteo-articular?</label>
      <br>
        <textarea class="form-control" id="les_art" maxlength="150" readonly><?php echo $row1['les_ost_desc_eva']; ?></textarea>
      <br>

      <label>¿Tiene alguna de las siguientes enfermedades cronicas no transmisibles?</label>
      <br>
        <input type="text" class="form-control" name="enf_cro" maxlength="150" value="<?php echo $row1['tab'].$row1['diab'].$row1['asma'].$row1['hip']; ?>" readonly>
      <br>

      <label>Actualmente, ¿qué porcentaje del día usted esta sentado?</label>
      <br>
        <input type="text" class="form-control" name="dia_sen" maxlength="4" value="<?php echo $row1['porc_sent_eva'].'%'; ?>" readonly>
      <br>

      <label>¿Cuál es tu objetivo a lograr con tu entrenamiento?</label>
      <br>
        <input type="text" class="form-control" name="obj" maxlength="150" value="<?php echo $row1['obj']; ?>" readonly>
    
<hr>
      
      <label>¿Tiene alergia a algún alimento?</label>
      <br>       
      <textarea class="form-control" id="aler_ali" maxlength="150" readonly><?php echo $row1['alerg_ali_desc_eva']; ?></textarea>
      <br>

      <label>¿Tiene intoleracia a algún alimento?</label>
      <br>       
      <textarea class="form-control" id="into_ali" maxlength="150" readonly><?php echo $row1['into_ali_desc_eva']; ?></textarea>
      <br>

      <label>¿Bebe alcohol?,¿Con que frecuencia y que tipo?</label>
      <br>       
      <textarea class="form-control" id="alco" maxlength="150" readonly><?php echo $row1['alco_desc_ali_eva']; ?></textarea>
      <br>

      <label>Su apetito esta:</label>
      <br>       
      <input type="text" class="form-control" name="apet" maxlength="50" value="<?php echo $row1['apet']; ?>" readonly>
      <br>

      <label>Para medir su digestión, indique su frecuencia para defecar</label>
      <br>       
      <textarea class="form-control" id="def" maxlength="150" readonly><?php echo $row1['digest_desc_eva']; ?></textarea>
      <br>


      <label>¿Cuantos vasos de agua ingiere al dia?</label>
      <br>       
      <input type="number" class="form-control" name="agua" id="agua" value="<?php echo $row1['agua_eva']; ?>" readonly>
      <br>

      <label>Describa la actividad fisica que realiza, cuantas veces a la semana y por cuanto tiempo</label>
      <br>       
      <textarea class="form-control" id="act_fis" maxlength="150" readonly><?php echo $row1['act_fisica_desc_eva']; ?></textarea>
      <br>

      <label>Encuesta de recordatorio 24 Hrs. (Escribe lo que consumiste de alimentos el día de ayer en porciones aproximadas en cucharadas, cucharaditas y tazas, incluyendo picoteos y bebestibles)</label>
      <br>       
      <textarea class="form-control" id="enc_rec_des" maxlength="150" readonly><?php echo 'Desayuno: '.$row1['desayuno_desc_eva']; ?></textarea>
      <br>
      <br>       
      <textarea class="form-control" id="enc_rec_col" maxlength="150" readonly><?php echo 'Colación: '.$row1['colacion_desc_eva']; ?></textarea>
      <br>
      <br>       
      <textarea class="form-control" id="enc_rec_alm" maxlength="150" readonly><?php echo 'Almuerzo: '.$row1['almuerzo_desc_eva']; ?></textarea>
      <br>
      <br>       
      <textarea class="form-control" id="enc_rec_once" maxlength="150" readonly><?php echo 'Once: '.$row1['once_desc_eva']; ?></textarea>
      <br>
      <br>       
      <textarea class="form-control" id="enc_rec_cena" maxlength="150" readonly><?php echo 'Once: '.$row1['cena_desc_eva']; ?></textarea>
      <br>

      <label>Encuesta frecuencia de consumo: Indica cuantos de los 7 días de la semana, consumes estos alimentos:</label>     
      <br>       
      <input type="text" class="form-control" name="enc_frec_pan" id="enc_frec_pan" value="Pan: <?php echo $row1['enc_frec_pan_eva']; ?> dia(s) a la semana" readonly>
      <br>   
      <br>       
      <input type="text" class="form-control" name="enc_frec_fru" id="enc_frec_fru" value="Frutas: <?php echo $row1['enc_frec_frut_eva']; ?> dia(s) a la semana" readonly>
      <br>  
      <br>       
      <input type="text" class="form-control" name="enc_frec_ens" id="enc_frec_ens" value="Ensaladas o verduras: <?php echo $row1['enc_frec_ens_eva']; ?> dia(s) a la semana" readonly>
      <br> 
      <br>       
      <input type="text" class="form-control" name="enc_frec_hue" id="enc_frec_hue" value="Huevo: <?php echo $row1['ens_frec_huevo_eva']; ?> dia(s) a la semana" readonly>
      <br> 
      <br>       
      <input type="text" class="form-control" name="enc_frec_pes" id="enc_frec_pes" value="Pescado: <?php echo $row1['enc_frec_pes_eva']; ?> dia(s) a la semana" readonly>
      <br>     
      <br>       
      <input type="text" class="form-control" name="enc_frec_leg" id="enc_frec_leg" value="Legumbres: <?php echo $row1['enc_frec_leg_eva']; ?> dia(s) a la semana" readonly>
      <br>   
      <br>       
      <input type="text" class="form-control" name="enc_frec_gol" id="enc_frec_gol" value="Golosinas: <?php echo $row1['enc_frec_golo_eva']; ?> dia(s) a la semana" readonly>
      <br>     
      <br>       
      <input type="text" class="form-control" name="enc_frec_fri" id="enc_frec_fri" value="Frituras: <?php echo $row1['enc_frec_frit_eva']; ?> dia(s) a la semana" readonly>
      <br>   
      <br>       
      <input type="text" class="form-control" name="enc_frec_azu" id="enc_frec_azu" value="Azucar: <?php echo $row1['enc_frec_azu_eva']; ?> dia(s) a la semana" readonly>
      <br>   

</div>


</body>
</html>