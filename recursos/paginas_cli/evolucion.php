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



if (isset($_GET{'dato'})) {
 $fec = $_GET{'dato'};
}else{
  $fec = date("Y-m");
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
  <script src ="//cdnjs.cloudflare.com/ajax/libs/jquery-json/2.6.0/jquery.json.min.js"> </script>
  <link href="../estilo.css" rel="stylesheet" type="text/css" />



<style>
 #div1, #div2 {
    float: left;
    display: flex;
    flex-direction: column;
    width: 100%;
    margin: 5px;
    padding: 5px;
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
<div class="container" style="padding-top: 5px">

<center><h3>Tu Evolución  <?php  $re = $fun->cargar_cli($id); 
                            foreach($re as $row)      
                      {echo $row['nom_cli'];} 
                        ?> </h3></center>

         
  <table class="table table-sm table-dark" name="tabla_evo" id="tabla_evo">
    <thead >
      <tr>
        <th>Fecha</th>
        <th>Estatura</th>
        <th>Peso</th>
        <th>IMC</th>
      </tr>
    </thead>
    <tbody>
    <?php
              $re = $fun->cargar_evo_cli($id);
              foreach($re as $row){

            
                echo ('<tr><td>'.date('d-m-Y',strtotime($row['fec_evo'])).'</td>');
                echo ('<td>'.$row['est_evo'].'</td>');
                echo ('<td>'.$row['peso_evo'].'</td>');
                echo ('<td>'.$row['imc'].'</td></tr>');
 
              }
?>
    </tbody>
  </table>
</div>

</body>
</html>