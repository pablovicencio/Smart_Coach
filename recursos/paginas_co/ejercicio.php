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
if (isset($_GET['ejer'])) {
  $ejer = $_GET['ejer'];
}else{
  echo"<script type=\"text/javascript\">alert('Favor, seleccione un ejercicio para modificar'); window.location='entrenamiento.php';</script>"; 
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
function validar(f){
f.btnAc.value="Modificando Ejercicio";
f.btnAc.disabled=true;
return true}
</script>
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
  <div class="col-12">
    <h3>Modificar Ejercicio</h3>
    <hr>
  </div>
  </div>

  <?php
              $re = $fun->ejercicio($ejer);
              foreach($re as $row){    
              }
              
?>



  <div class="row">
    <div class="col-6">
          <form role="form" action="../controles/control_modEjercicio.php" method="post" id="mod_ejer" name="mod_ejer" onsubmit="return validar(this)">
            <div class="form-group">
              <input type="number" class="form-control" name="id_ejer" value="<?php echo $ejer; ?>" required style="display: none;">
              <label for="nom">Nombre:</label>
              <input type="text" class="form-control" name="nom_ejer" maxlength="150" value="<?php echo $row['nom_ejer']; ?>" required>
            </div>
            <div class="form-group">
              <label for="nom">Musculo:</label>
              <select class="form-control" name="musc" id="musc" required>
                      <option value="" selected disabled>Seleccione Musculo</option>
                                   <?php 
                                    $re1 = $fun->cargar_musculos();   
                                    foreach($re1 as $row1)      
                                        {
                                          if ($row1['id_musc'] == $row['fk_id_musc']) {
                                            echo "<option selected";
                                          }else{
                                            echo "<option ";
                                          }
                                          ?>
                                            value="<?php echo $row1['id_musc'] ?> ">
                                           <?php echo $row1['nom_musc'] ?>
                                           </option>
                                              
                                          <?php
                                        }    
                                    ?>       
                    </select>
            </div>
            <div class="form-group">
               <label for="video">Link Video:</label>
              <input type="text" class="form-control" name="link_ejer" id="link_ejer" value="<?php echo $row['link_ejer']; ?>"  required>
            </div>
    </div>
    <div class="col-6">
           <div class="form-group">
              <label for="nota">Nota de ejecucion:</label>
              <textarea class="form-control" rows="5" id="nota_ejer" name="nota_ejer" ><?php echo $row['nota_ejer']; ?></textarea>
            </div>
            <div class="form-check">
            <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="vig" id="vig" <?php if ($row['vig_ejer'] == 1) { echo 'checked'; } ?> > Vigencia
            </label>
          </div>
            <input type="submit" class="btn btn-outline-danger" id="btnAc" name="btnAc" value="Modificar Ejercicio">
          </form>
    </div>
    <iframe width="460" height="215" src="https://www.youtube.com/embed/<?php echo $row['video']; ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
</body>
</html>