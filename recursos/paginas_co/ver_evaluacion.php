<?php  
 session_start(); 
 if( isset($_SESSION['id']) and $_SESSION['tipo'] == 1   ){
     //Si la sesión esta seteada no hace nada
     $id = $_SESSION['id'];
   }
   else{
     //Si no lo redirige a la pagina index para que inicie la sesion 
     header("location: ../../index.html");
   }   
  $cli = $_GET['cli'];

  require_once '../clases/Funciones.php';

  $fun = new Funciones(); 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>D3 - Ver Evaluación</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>


</head>

<body>
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
              <img class="img-fluid" src="../img/logo/logo_d3safio3.png" alt="D3safio" width="150" height="30">
              </ul>
            </nav>
<div class="container" style="padding-top: 5px">

<div class="row">
<div class="col-sm">

<center><h3>Evaluación de  
 <?php  $re = $fun->cargar_cli($cli); 
                            foreach($re as $row)      
                      {echo $row['nom_cli'];} 
                        ?> </h3>

</h3></center>

<?php  $re1 = $fun->cargar_eva($cli); 
                            foreach($re1 as $row1)      
                      {

                      } 
                        ?> 

<hr>
<div class="row" >
    
      <label>Tiene alguna enfermedad Cardiaca</label>
      <br>
        <input type="text" class="form-control" name="enf" maxlength="2" value="<?php echo $row1['enf']; ?>" required>
      <br>

      <label>Sufre de dolor en el pecho, cansancio o desmayos</label>
      <br>
        <input type="text" class="form-control" name="can" maxlength="2" value="<?php echo $row1['can']; ?>" required>
      <br>

      <label>Sufre de problemas osteo - articulares, dolor de espalda</label>
      <br>
        <input type="text" class="form-control" name="prob" maxlength="2" value="<?php echo $row1['prob']; ?>" required>
      <br>

      <label>Toma algún medicamento</label>
      <br>
        <input type="text" class="form-control" name="med" maxlength="2" value="<?php echo $row1['med']; ?>" required>
      <br>

      <label>Tiene alguna razón que le impida hacer actividad física</label>
      <br>
        <input type="text" class="form-control" name="imp" maxlength="2" value="<?php echo $row1['imp']; ?>" required>
    
<hr>
      
      <label>¿Actualmente cuántas veces a la semana practica actividad física o deporte?</label>
      <br>       
      <input type="number" class="form-control" name="act_sem" value="<?php echo $row1['act']; ?>" required>
      <br>

      <label>¿En su trabajo ¿Qué porcentaje de la jornada laboral se encuentra de pie o activo físicamente?</label>
      <br>       
      <input type="number" class="form-control" name="act_lab" value="<?php echo $row1['act_lab']; ?>" required>
      <br>

      <label>¿En su infancia acostumbraba a realizar deporte o actividad física?</label>
      <br>       
      <input type="text" class="form-control" name="act_inf" maxlength="30" value="<?php echo $row1['act_inf']; ?>" required>
      <br>

      <label>Del tiempo en su casa, ¿la mayoría del tiempo está de pie o sentado?</label>
      <br>       
      <input type="text" class="form-control" name="tiempo" maxlength="30" value="<?php echo $row1['tiempo']; ?>" required>
      <br>

      <label>¿Cuál es tu objetivo a lograr con tu entrenamiento?</label>
      <br>       
      <input type="text" class="form-control" name="obj" maxlength="200" value="<?php echo $row1['obj']; ?>" required>
      <br>

</div>


</body>
</html>