<?php
session_start(); 
if( isset($_SESSION['id']) and $_SESSION['tipo'] == 2 ){
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

<title>D3 - Nutrición</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>


<script>



function validar(f){
f.btnAc.value="Creando Alimento";
f.btnAc.disabled=true;
return true}

</script>


</head>

<body>
      <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
              <a  href="entrenamiento.php"><img class="img-fluid" src="../img/logo/logo_d3safio3.png" alt="D3safio" width="150" height="30"></a>
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
                <li class="nav-item"><a class="nav-link" href="nutricion.php">Nutrición</a></li>
                <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Coach</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="crear_co.php">Crear Coach</a>
                        <a class="dropdown-item" href="mod_co.php">Modificar Coach</a>
                      </div>
                    </li>
                <li class="nav-item"><a class="nav-link" href="../controles/logout.php" onclick="return confirm('¿Deseas finalizar sesión?');">Cerrar Sesión</a></li>
              </ul>
</nav>
<div class="container" style="padding-top: 5px">

<div class="row">
<div class="col-sm">
  <h3>Cargar Dieta</h3>
  <br>
  <form role="form" action="carga_Dieta.php" method="get" >
  <label>Cliente:</label>
  <select class="form-control" name="cli" style="width: 60%; display: inline-block;">
    <option value="" selected disabled>Seleccione el cliente</option>
                 <?php 
                  $re = $fun->cargar_clientes_dd(2);   
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
  <input type="submit" class="btn btn-outline-success" style=" display: inline-block; margin-left: 10px;" value="Ir">
  </form>
  <br>
  <br>
</div>
</div>
<hr>
  <div class="row">
  <div class="col-12">
    <h3>Crear Alimento</h3>
    <br>
  </div>
  </div>
  <div class="row">
    <div class="col-6">
          <form role="form" action="../controles/control_crearAlimento.php" method="post">
            <div class="form-group">
              <label for="nom">Nombre:</label>
              <input type="text" class="form-control" name="nom_ali" id="nom_ali" maxlength="200" required>
            </div>
            <div class="form-group">
              <label for="ga">Grupo de Alimento:</label>
              <select class="form-control" name="ga" id="ga" required>
                      <option value="" selected disabled>Seleccione Grupo</option>
                                   <?php 
                                    $re1 = $fun->cargar_g_a();   
                                    foreach($re1 as $row1)      
                                        {
                                          ?>
                                          
                                           <option value="<?php echo ($row1['id_nut_grup']); ?>"><?php echo ($row1['desc_nut_grup']); ?></option>
                                              
                                          <?php
                                        }    
                                    ?>       
                    </select>
            </div>
            <input type="submit" class="btn btn-outline-success" id="btnAc" name="btnAc" value="Crear Alimento">
          </form>
    </div>
    </div>

    <br>
    <hr>

<h3>Modificar Alimento</h3><br>
         
  <table class="table table-sm table-dark">
    <thead >
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Grupo Alimento</th>
        <th>Vigencia</th>
      </tr>
    </thead>
    <tbody>
     <?php
              $re2 = $fun->cargar_ali();
              foreach($re2 as $row2){

                $id_ali = $row2['id_nut_ali'];
                $link = '<a href=alimento.php?ejer='.$id_ali.' class="badge badge-light">';
                
                echo ('<tr><td ><center>'.$link.$row2['id_nut_ali'].'</a></center></td>');
                echo ('<td>'.$row2['desc_nut_ali'].'</td>');
                echo ('<td>'.$row2['desc_nut_grup'].'</td>');
                echo ('<td>'.$row2['vig'].'</td></tr>');
 
              }
?>
    </tbody>
  </table>








</div>

</body>
</html>