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
f.btnAc.value="Creando Coach";
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
                        <a class="dropdown-item" href="mod_co.php">Modificar Usuario</a>
                      </div>
                    </li>
                <li class="nav-item"><a class="nav-link" href="../controles/logout.php" onclick="return confirm('¿Deseas finalizar sesión?');">Cerrar Sesión</a></li>
              </ul>
</nav>
<div class="container" style="padding-top: 5px">
<form role="form" action="../controles/control_crearCoach.php" method="post" id="new_co" name="new_co" onsubmit="return validar(this)">
  <div class="row">
  <div class="col-12">
    <h3>Crear Coach</h3>
    <hr>
  </div>
  </div>
  <div class="row" id="form_co">
  <div class="col-6">

          <div class="form-group">
            <label for="nom">Nombre:</label>
            <input type="text" class="form-control" id="nom_co" name="nom_co" maxlength="200" required>
          </div>
          <div class="form-group">
              <label for="nom">Correo:</label>
              <input type="text" class="form-control" name="correo_co" id="correo_co" maxlength="100" required>
            </div>
          <div class="form-group">
             <label for="fono">Telefono (8 digitos):</label>
             <input type="tel"  class="form-control" id="fono_co" name="fono_co" pattern="[0-9]{8}" required>
          </div>
  </div>
  <div class="col-6">
          <div class="form-check">
            <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="super" id="super"> Super Usuario
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="vig" id="vig"> Vigencia
            </label>
          </div>
          <input type="submit" name="btnAc" id="btnAc" class="btn btn-outline-danger" value="Crear Coach">
        </form>
  </div>
  </div>


</div>
</body>
</html>