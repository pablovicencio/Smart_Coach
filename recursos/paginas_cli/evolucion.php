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
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>D3safío - Evolución</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
  <script src ="//cdnjs.cloudflare.com/ajax/libs/jquery-json/2.6.0/jquery.json.min.js"> </script>
  <link href="../estilo.css" rel="stylesheet" type="text/css" />


</head>
<style>
 
@media (max-width: 800px) {
    
        body{font-size: 2.5vw;}
        


}

</style>

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