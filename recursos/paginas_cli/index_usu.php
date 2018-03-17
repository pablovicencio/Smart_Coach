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
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">

<title>Smart Coach</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>


<style>
 #div1, #div2 {
    float: left;
    display: flex;
    flex-direction: column;
    width: 100%;
    margin: 10px;
    padding: 10px;
    border: 1px solid #E6E6E6;
    -webkit-border-radius: 4px; /* recuerda la primera frase */
    -moz-border-radius: 4px; /* si quieres todas las esquinas iguales */
</style>
</head>

<body>
            <nav class="navbar navbar-expand-sm bg-danger navbar-dark">
              <a class="navbar-brand" href="#"><h2>Smart Coach</h2></a>
              <ul class="navbar-nav ml-auto" >
              <li class="nav-item"><a class="nav-link" href="index_usu.php">Hoy</a></li>
                <li class="nav-item"><a class="nav-link" href="calendario.php">Calendario</a></li>
                <li class="nav-item"><a class="nav-link" href="evolucion.php">Evolución</a></li>
                <li class="nav-item"><a class="nav-link" href="mi_cuenta.php">Mi Cuenta</a></li>
                <li class="nav-item"><a class="nav-link" href="../controles/logout.php" onclick="return confirm('¿Deseas finalizar sesión?');">Cerrar Sesión</a></li>
              </ul>
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

              $hoy = '2018-01-30';//date('Y-m-d', time());
              $re = $fun->cargar_entrenamiento(1,$hoy);
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

</body>
</html>