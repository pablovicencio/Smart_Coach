<?php  
 session_start(); 
 if( isset($_SESSION['id']) ){
     //Si la sesión esta seteada no hace nada
     $id = $_SESSION['id'];
   }
   else{
     //Si no lo redirige a la pagina index para que inicie la sesion 
     header("location: ../../index.html");
   }   

  require_once '../clases/Funciones.php';

  $fun = new Funciones(); 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>D3 - Evaluación</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>


<script language="JavaScript" type="text/javascript">
  function validar(f){
f.btnAc.value="Enviando Evaluación";
f.btnAc.disabled=true;
return true}


</script>
<style>
 
@media (max-width: 800px) {
    
        body{font-size: 2.6vw;}
        


}

</style>
</head>

<body>

 <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
              <a  href="index_usu.php"><img class="img-fluid" src="../img/logo/logo_d3safio3.png" alt="D3safio" width="150" height="30"></a>
              <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="false">
              <span class="navbar-toggler-icon"></span>
              </button>
              <div class="navbar-collapse collapse" id="navb" style="">
                  <ul class="navbar-nav ml-auto" >
                <li class="nav-item"><a class="nav-link" href="../controles/logout.php" onclick="return confirm('¿Deseas finalizar sesión?');">Cerrar Sesión</a></li>
              </ul>
              </div>
            </nav>

<div class="container" style="padding-top: 5px">

<div class="row">
<div class="col-sm">

<center><h3>Evaluación de  
 <?php  $re = $fun->cargar_cli($id); 
                            foreach($re as $row)      
                      {echo $row['nom_cli'];} 
                        ?> </h3>

</h3></center>


<h5>¡Felicidades, estas a punto de cambiar tu estilo de vida! Para ingresar a la plataforma de entrenamiento debes entregarnos algunos datos para crear tu perfil de entrenamiento</h5>


<hr>
<div class="row" >
  <form action="../controles/control_evaCli.php" method="POST" onsubmit="return validar(this)">

  <div <?php if ($_SESSION['super'] == 2) echo "style=\"display: none;\""; ?>>
    
      <label>¿Tiene alguna enfermedad Cardiaca?</label>
      <br>
        <textarea class="form-control" id="enf_car" maxlength="150"></textarea>
      <br>

      <label>¿Sufre alguna lesión Osteo-articular?</label>
      <br>
        <textarea class="form-control" id="les_art" maxlength="150"></textarea>
      <br>

      <label>¿Tiene alguna de las siguientes enfermedades cronicas no transmisibles?</label>
      <br>
        <label class="radio-inline">
          <input type="radio"  name="enf_tab" value="1"> Tabaquismo  
        </label>
      <label class="radio-inline">
        <input type="radio"  name="enf_dia" value="1"> Diabetes  
      </label>
      <label class="radio-inline">
        <input type="radio"  name="enf_asm" value="1"> Asma  
      </label>
      <label class="radio-inline">
        <input type="radio"  name="enf_hip" value="1"> Hipertensión  
      </label>
      <br>


      <label>Actualmente, ¿qué porcentaje del día usted esta sentado?</label>
      <br>       
      <label class="radio-inline">
          <input type="radio"  name="dia_sen" value="10" required> 10%
        </label>
      <label class="radio-inline">
        <input type="radio"  name="dia_sen" value="30"> 30%
      </label>
      <label class="radio-inline">
        <input type="radio"  name="dia_sen" value="50"> 50%
      </label>
      <label class="radio-inline">
        <input type="radio"  name="dia_sen" value="70"> 70%
      </label>
      <label class="radio-inline">
        <input type="radio"  name="dia_sen" value="90"> 90%
      </label>
      <br>


      <label>¿Cuál es tu objetivo a lograr con tu entrenamiento?</label>
      <br> 
            <select class="form-control" id="opt_obj" name="opt_obj" required>
              <option value="1">Aumentar mi masa muscular</option>
              <option value="2">Disminuir mi % de grasa</option>
              <option value="3">Disminuir mi % de grasa y aumentar levemente la masa muscular simultáneamente</option>
              <option value="4">Sólo mejorar mi condición física de manera general</option>
            </select>

      <br>

</div>





<div <?php if ($_SESSION['super'] == 1) echo "style=\"display: none;\""; ?>>

      <label>¿Tiene alergia a algún alimento?</label>
            <br>
              <textarea class="form-control" id="aler_ali" maxlength="150"></textarea>
            <br>

      <label>¿Tiene intoleracia a algún alimento?</label>
            <br>
              <textarea class="form-control" id="into_ali" maxlength="150"></textarea>
            <br>

      <label>¿Bebe alcohol?,¿Con que frecuencia y que tipo?</label>
            <br>
              <textarea class="form-control" id="alco" maxlength="150"></textarea>
            <br>

      <label>Su apetito esta:</label><br>
            <label class="radio-inline">
                <input type="radio"  name="apet" id="apet" value="0" required> Normal
            </label>
            <label class="radio-inline">
                <input type="radio"  name="apet" id="apet" value="1"> Ansioso
            </label>
            <label class="radio-inline">
              <input type="radio"  name="apet" id="apet" value="2"> Disminuido
            </label>
            <br>

      <label>Para medir su digestión, indique su frecuencia para defecar</label>
      <br>
        <textarea class="form-control" id="def" name="def" maxlength="150" required></textarea>
      <br>

      <label>¿Cuantos vasos de agua ingiere al dia?</label>
      <br>       
      <input type="number" class="form-control" name="agua" id="agua" required>
      <br>

      <label>Describa la actividad fisica que realiza, cuantas veces a la semana y por cuanto tiempo</label>
      <br>
        <textarea class="form-control" id="act_fis" name="act_fis" maxlength="150" required></textarea>
      <br>

      <hr>

      <label>Encuesta de recordatorio 24 Hrs. (Escribe lo que consumiste de alimentos el día de ayer en porciones aproximadas en cucharadas, cucharaditas y tazas, incluyendo picoteos y bebestibles)</label>
      <br>
        <textarea class="form-control" id="enc_rec_des" name="enc_rec_des" maxlength="150" placeholder="Desayuno" required></textarea>
      <br>
      
        <textarea class="form-control" id="enc_rec_col" name="enc_rec_col" maxlength="150" placeholder="Colación" required></textarea>
      <br>

        <textarea class="form-control" id="enc_rec_alm" name="enc_rec_alm" maxlength="150" placeholder="Almuerzo" required></textarea>
      <br>
   
        <textarea class="form-control" id="enc_rec_once" name="enc_rec_once" maxlength="150" placeholder="Once" required></textarea>
      <br>
      
        <textarea class="form-control" id="enc_rec_cena" name="enc_rec_cena" maxlength="150" placeholder="Cena" required></textarea>
      <br>

      <label>Encuesta frecuencia de consumo: Indica cuantos de los 7 días de la semana, consumes estos alimentos:</label>
      <br>
        <input type="number" class="form-control" name="enc_frec_pan" id="enc_frec_pan" placeholder="Pan" required>
      
      <br>
        <input type="number" class="form-control" name="enc_frec_fru" id="enc_frec_fru" placeholder="Frutas" required>
      
      <br>
        <input type="number" class="form-control" name="enc_frec_ens" id="enc_frec_ens" placeholder="Ensaladas o Verduras" required>
      
      <br>
        <input type="number" class="form-control" name="enc_frec_hue" id="enc_frec_hue" placeholder="Huevo" required>
      
      <br>
        <input type="number" class="form-control" name="enc_frec_pes" id="enc_frec_pes" placeholder="Pescado" required>
      
      <br>
        <input type="number" class="form-control" name="enc_frec_leg" id="enc_frec_leg" placeholder="Legumbres" required>
      
      <br>
        <input type="number" class="form-control" name="enc_frec_gol" id="enc_frec_gol" placeholder="Golosinas" required>
      
      <br>
        <input type="number" class="form-control" name="enc_frec_fri" id="enc_frec_fri" placeholder="Frituras" required>
     
      <br>
        <input type="number" class="form-control" name="enc_frec_azu" id="enc_frec_azu" placeholder="Azucar" required>
      <br>
</div>
</div>
<center>
<input type="submit" name="btnAc" id="btnAc" class="btn btn-outline-success" value="Enviar Evaluación">
</center>
</form>


</body>
</html>