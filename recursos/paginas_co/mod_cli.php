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


  <script language="JavaScript" type="text/javascript">
  function validar(f){
f.btnAc.value="Modificando Cliente";
f.btnAc.disabled=true;
return true}

function mod(cli) {
    
     $.ajax({
      url: '../controles/control_cargarDatosCli.php',
      type: 'POST',
      data: {"cli":cli},
      dataType:'json',
      success:function(result){
        console.log(result);
        $('#nom_cli').val(result[0].nom_cli);
        $('#correo_cli').val(result[0].correo_cli);
        $('#fono_cli').val(result[0].fono_cli);
        $('#fec_nac_cli').val(result[0].fec_nac_cli);
        $('#est_cli').val(result[0].est);
        $('#peso_cli').val(result[0].peso);
        $('#fec_plan_cli').val(result[0].fec_plan_cli);

        if ((result[0].vig_cli)==1) {  
          $('#vig').prop('checked', true);
              } 

  }
  })
    

}

function evo() {
  if($("#cambio").is(':checked')) { 
        $('#est_cli').removeAttr('readonly');
        $('#peso_cli').removeAttr('readonly');
        }else{
          $('#est_cli').prop('readonly','readonly');
          $('#peso_cli').prop('readonly','readonly');
        }
}
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
<form action="../controles/control_modCli.php" method="POST">
  <div class="row">
  <div class="col-12">
    <h3>Modificar Cliente</h3>
    <hr>
  </div>
  </div>
  <div class="col-12">
  <label for="cli">Cliente:</label>
  <select class="form-control" id="cli" name="cli" style="width: 500px" onchange="mod(this.value)">
      <option value="" selected disabled>Seleccione el cliente</option>
                 <?php 
                  $re = $fun->cargar_cli(0);   
                  foreach($re as $row)      
                      {
                        ?>
                        
                         <option value="<?php echo $row['id_cli'] ?> ">
                         <?php echo $row['nom_cli'] ?>
                         </option>
                            
                        <?php
                      }    
                  ?>  
  </select><hr>
</div>
  <div class="row" id="form_cli">
  <div class="col-6">

          <div class="form-group">
            <label for="nom">Nombre:</label>
            <input type="text" class="form-control" id="nom_cli" name="nom_cli" maxlength="200" required>
          </div>
          <div class="form-group">
              <label for="nom">Correo:</label>
              <input type="text" class="form-control" name="correo_cli" id="correo_cli" maxlength="100" required>
            </div>
          <div class="form-group">
             <label for="fono">Telefono (8 digitos):</label>
             <input type="tel"  class="form-control" id="fono_cli" name="fono_cli" pattern="[0-9]{8}" required>
          </div>
          <div class="form-group">
             <label for="fec_nac">Fecha Nacimiento:</label>
             <input type="date" class="form-control" id="fec_nac_cli" name="fec_nac_cli" required>
          </div>
  </div>
  <div class="col-6">
        <div class="form-check">
            <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="cambio" id="cambio" onchange="evo()"> Agregar evolución
            </label>
        <div class="form-group">
            <label for="est">Estatura (CM):</label>
            <input type="number" class="form-control" id="est_cli" name="est_cli" step="any" required readonly>
          </div>
          <div class="form-group">
            <label for="peso">Peso (KG):</label>
            <input type="number" class="form-control" id="peso_cli" name="peso_cli" step="any" required readonly>
          </div>
          <div class="form-group">
               <label for="fec_plan">Fecha Inicio del Plan(fecha de termino +1 mes):</label>
              <input type="date" class="form-control" id="fec_plan_cli" name="fec_plan_cli" required>
            </div>
          <div class="form-check">
            <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="vig" id="vig"> Vigencia
            </label>
          </div>
          <input type="submit" name="btnAc" id="btnAc" class="btn btn-outline-danger" value="Modificar Cliente">
        </form>
  </div>
  </div>


</div>

</body>
</html>