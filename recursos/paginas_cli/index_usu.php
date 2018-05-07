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

<title>D3safío</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>

<style>
 #borg {
    width: 30%;
</style>

<script>

function validar(f){
f.btnAc.value="Enviando Evaluación";
f.btnAc.disabled=true;
return true}

</script>
<style>
 
@media (max-width: 800px) {
    
        body{font-size: 2.5vw;}
        #tabla{width: 100%;}
        #borg{width: 100%;}
        


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
                  <ul class="navbar-nav ml-auto">
                  <li class="nav-item"><a class="nav-link" href="index_usu.php">Hoy</a></li>
                    <li class="nav-item"><a class="nav-link" href="calendario.php">Calendario</a></li>
                    <li class="nav-item"><a class="nav-link" href="nutricion.php">Nutrición</a></li>
                    <li class="nav-item"><a class="nav-link" href="evolucion.php">Evolución</a></li>
                    <li class="nav-item"><a class="nav-link" href="mi_cuenta.php">Mi Cuenta</a></li>
                    <li class="nav-item"><a class="nav-link" href="../controles/logout.php" onclick="return confirm('¿Deseas finalizar sesión?');">Cerrar Sesión</a></li>
                  </ul>
              </div>
            </nav>
<div class="container-fluid" style="padding-top: 5px">

<div class="row">
<div class="col-sm">

<center><h3>Entrenamiento <?php echo strftime("%A %d %b %Y",time()); ?> de  
 <?php  $re = $fun->cargar_cli($id); 
                            foreach($re as $row)      
                      {echo $row['nom_cli'];} 
                        ?> </h3>

</h3></center>
<?php    
if (strtotime('+1 month',strtotime($row['fec_plan_cli'])) >= time()) {
  $div = '<div class="alert alert-success" role="alert">';
}else{
  $div = '<div class="alert alert-danger" role="alert">';
}


 echo $div.'Vigencia Desde '.date('d-m-Y',strtotime($row['fec_plan_cli'])).' Hasta '.date('d-m-Y', strtotime('+1 month',strtotime($row['fec_plan_cli']))); ?></div>

<?php

              $hoy = date('Y-m-d', time());
              $re1 = $fun->coach_rutina($id,$hoy);
               foreach($re1 as $row1){
                echo '<a href="https://m.me/'.$row1['fb_coach'].'" class="btn btn-outline-primary" target="_blank"><img src="../img/me.png" alt="messenger" height="22" width="22"> '.$row1['nom_coach'].'</a>';
               }
              
            
?>
<br>
<br>
<div class="table-responsive">
 <table class="table table-sm table-dark" id="tabla" name="tabla">
  <thead>
    <tr>
      <th scope="col">Ejercicio</th>
      <th scope="col">Musculo</th>
      <th scope="col">Series</th>
      <th scope="col">Repeticiones</th>
      <th scope="col">Pausas</th>
      <th scope="col">Velocidad</th>
      <th scope="col">Nota de Ejecución</th>
      <th scope="col">Nota Personal</th>
      <th scope="col">Video</th>

    </tr>
  </thead>
  <tbody>
  <?php

              $hoy = date('Y-m-d', time());
              $re = $fun->cargar_entrenamiento($id,$hoy);
              foreach($re as $row){

            
                
                echo ('<tr><td>'.$row['nom_ejer'].'</td>');
                echo ('<td>'.$row['nom_musc'].'</td>');
                echo ('<td>'.$row['series_rut'].'</td>');
                echo ('<td>'.$row['rep_rut'].'</td>');
                echo ('<td>'.$row['pausas_rut'].'</td>');
                echo ('<td>'.$row['vel_rut'].'</td>');
                echo ('<td>'.$row['nota_ejer'].'</td>');
                echo ('<td>'.$row['nota_rut'].'</td>');
                echo ('<td><iframe width="360" height="115" src="https://www.youtube.com/embed/'.$row['video'].'?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></td></tr>');
                  
 

              }
?>
  
  </tbody>
</table>
</div>


<form role="form" action="../controles/control_enviarBorg.php" method="post">
    <div name="borg" >
      <input type="hidden" name="id_rut" value="<?php echo ($row['id_rut']);?>">
      <label for="sel1">¿Como sentiste tu entrenamiento el día de hoy?</label>
      <select class="form-control" id="borg" name="borg" required>
        <option value="1">Muy, muy ligero </option>
        <option value="2">Muy ligero</option>
        <option value="3">Ligero</option>
        <option value="4">Moderado</option>
        <option value="5">Un poco pesado</option>
        <option value="6">Pesado</option>
        <option value="7">Muy pesado</option>
        <option value="8">Extremadamente pesado</option>
      </select>
      <br>
      <input type="submit" class="btn btn-outline-success" id="btnAc" name="btnAc" value="Enviar" title="Recuerda que puedes enviar solo una evaluacion de entrenamiento por rutina">
    </div>

</form>


</div>

</body>
</html>