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
    
        body{font-size: 2.5vw;}
        


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


<h5>Para ingresar a la plataforma de entrenamiento debes entregarnos algunos datos para crear tu perfil de entrenamiento</h5>


<hr>
<div class="row" >
  <form action="../controles/control_evaCli.php" method="POST" onsubmit="return validar(this)">
    
      <label>Tiene alguna enfermedad Cardiaca</label>
      <br>
        <label class="radio-inline">
          <input type="radio"  name="opt_enf" value="1">Si
        </label>
      <label class="radio-inline">
        <input type="radio"  name="opt_enf" value="0">No
      </label>
      <br>

      <label>Sufre de dolor en el pecho, cansancio o desmayos</label>
      <br>
        <label class="radio-inline">
          <input type="radio"  name="opt_can" value="1">Si
        </label>
      <label class="radio-inline">
        <input type="radio"  name="opt_can" value="0">No
      </label>
      <br>

      <label>Sufre de problemas osteo - articulares, dolor de espalda</label>
      <br>
        <label class="radio-inline">
          <input type="radio"  name="opt_prob" value="1">Si
        </label>
      <label class="radio-inline">
        <input type="radio"  name="opt_prob" value="0">No
      </label>
      <br>

      <label>Toma algún medicamento</label>
      <br>
        <label class="radio-inline">
          <input type="radio"  name="opt_med" value="1">Si
        </label>
      <label class="radio-inline">
        <input type="radio"  name="opt_med" value="0">No
      </label>
      <br>

      <label>Tiene alguna razón que le impida hacer actividad física</label>
      <br>
        <label class="radio-inline">
          <input type="radio"  name="opt_imp" value="1">Si
        </label>
      <label class="radio-inline">
        <input type="radio"  name="opt_imp" value="0">No
      </label>
    
<hr>
      
      <label>¿Actualmente cuántas veces a la semana practica actividad física o deporte?</label>
      <br>       
      <input type="number" class="form-control" name="act_sem">
      <br>

      <label>¿En su trabajo ¿Qué porcentaje de la jornada laboral se encuentra de pie o activo físicamente?</label>
      <br>       
      <input type="number" class="form-control" name="act_lab" placeholder="%">
      <br>

      <label>¿En su infancia acostumbraba a realizar deporte o actividad física?</label>
      <br>       
      <label class="radio-inline">
          <input type="radio"  name="opt_inf" value="0">No
        </label>
      <label class="radio-inline">
        <input type="radio"  name="opt_inf" value="1">Ocacionalmente
      </label>
      <label class="radio-inline">
        <input type="radio"  name="opt_inf" value="2">Regularmente
      </label>
      <label class="radio-inline">
        <input type="radio"  name="opt_inf" value="3">Siempre
      </label>
      <br>

      <label>Del tiempo en su casa, ¿la mayoría del tiempo está de pie o sentado?</label>
      <br>       
      <label class="radio-inline">
          <input type="radio"  name="opt_casa" value="0">De pie
        </label>
      <label class="radio-inline">
        <input type="radio"  name="opt_casa" value="1">Sentado
      </label>
      <br>

      <label>¿Cuál es tu objetivo a lograr con tu entrenamiento?</label>
      <br>       
      <label class="radio-inline">
          <input type="radio"  name="opt_obj" value="1">Aumentar la masa muscular
        </label>
        <br> 
      <label class="radio-inline">
        <input type="radio"  name="opt_obj" value="2">Disminuir el % de grasa
      </label>
      <br> 
      <label class="radio-inline">
        <input type="radio"  name="opt_obj" value="3">Disminuir tu % de grasa y aumentar levemente la masa muscular simultáneamente
      </label>
      <br> 
      <label class="radio-inline">
        <input type="radio"  name="opt_obj" value="4">Sólo mejorar su condición física de manera general
      </label>
      <br>

</div>
<center>
<input type="submit" name="btnAc" id="btnAc" class="btn btn-outline-success" value="Enviar Evaluación">
</center>
</form>


</body>
</html>