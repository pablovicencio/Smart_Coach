<?php
session_start(); 
if( isset($_SESSION['id']) and $_SESSION['tipo'] == 1 ){
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


<script>
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
}


function validar(f){
f.btnAc.value="Creando Ejercicio";
f.btnAc.disabled=true;
return true}

</script>

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
                <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Clientes</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="crear_cli.php">Crear Cliente</a>
                        <a class="dropdown-item" href="mod_cli.php">Modificar Cliente</a>
                      </div>
                    </li>
                <li class="nav-item"><a class="nav-link" href="entrenamiento.php">Entrenamiento</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Dieta</a></li>
                <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Usuarios</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="crear_co.php">Crear Usuario</a>
                        <a class="dropdown-item" href="#">Modificar Usuario</a>
                      </div>
                    </li>
                <li class="nav-item"><a class="nav-link" href="../controles/logout.php" onclick="return confirm('¿Deseas finalizar sesión?');">Cerrar Sesión</a></li>
              </ul>
</nav>
<div class="container" style="padding-top: 5px">

<div class="row">
<div class="col-sm">
  <h3>Cargar Entrenamiento</h3>
  <br>
  <form role="form" action="carga_entrenamiento.php" method="get" >
  <label>Cliente:</label>
  <select class="form-control" name="cli" style="width: 60%; display: inline-block;">
    <option value="" selected disabled>Seleccione el cliente</option>
                 <?php 
                  $re = $fun->cargar_clientes_dd();   
                  foreach($re as $row)      
                      {
                        ?>
                        
                         <option value="<?php echo $row['id_cli'] ?> ">
                         <?php echo $row['nom_cli'] ?>
                         </option>
                            
                        <?php
                      }    
                  ?>       
  </select>
  <input type="submit" class="btn btn-outline-danger" style=" display: inline-block; margin-left: 10px;" value="Ir">
  </form>
  <br>
  <br>
</div>
</div>
<hr>
  <div class="row">
  <div class="col-12">
    <h3>Crear Ejercicio</h3>
    <br>
  </div>
  </div>
  <div class="row">
    <div class="col-6">
          <form role="form" action="../controles/control_crearEjercicio.php" method="post">
            <div class="form-group">
              <label for="nom">Nombre:</label>
              <input type="text" class="form-control" name="nom_ejer" id="nom_ejer" maxlength="200" required>
            </div>
            <div class="form-group">
              <label for="musc">Musculo:</label>
              <select class="form-control" name="musc" id="musc" required>
                      <option value="" selected disabled>Seleccione Musculo</option>
                                   <?php 
                                    $re1 = $fun->cargar_musculos();   
                                    foreach($re1 as $row1)      
                                        {
                                          ?>
                                          
                                           <option value="<?php echo $row1['id_musc'] ?> ">
                                           <?php echo $row1['nom_musc'] ?>
                                           </option>
                                              
                                          <?php
                                        }    
                                    ?>       
                    </select>
            </div>
            <div class="form-group">
               <label for="video">Link Video:</label>
              <input type="text" class="form-control" name="link_ejer" id="link_ejer"  required>
            </div>
    </div>
    <div class="col-6">
          <div class="form-group">
              <label for="nota">Nota de ejecucion:</label>
              <textarea class="form-control" rows="5" id="nota_ejer" name="nota_ejer"></textarea>
            </div>
            <input type="submit" class="btn btn-outline-danger" id="btnAc" name="btnAc" value="Crear Ejercicio">
          </form>
    </div>
    </div>

    <br>
    <hr>

<h3>Modificar Ejercicio</h3><br>
         
  <table class="table table-sm table-dark">
    <thead >
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Musculo</th>
        <th>Video</th>
        <th>Notas</th>
        <th>Vigencia</th>
      </tr>
    </thead>
    <tbody>
     <?php
              $re2 = $fun->cargar_ejer();
              foreach($re2 as $row2){

                $id_ejer = $row2['id_ejer'];
                $link = '<a href=ejercicio.php?ejer='.$id_ejer.' class="badge badge-light">';
                
                echo ('<tr><td ><center>'.$link.$row2['id_ejer'].'</a></center></td>');
                echo ('<td>'.$row2['nom_ejer'].'</td>');
                echo ('<td>'.$row2['nom_musc'].'</td>');
                echo ('<td>'.$row2['link_ejer'].'</td>');
                echo ('<td>'.$row2['nota_ejer'].'</td>');
                echo ('<td>'.$row2['vig'].'</td></tr>');
 
              }
?>
    </tbody>
  </table>








</div>

</body>
</html>