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

  setlocale(LC_ALL,"es_ES");

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


<script>

$(document).ajaxStart(function() {
  $("#main").hide();
  $("#loading").show();
     }).ajaxStop(function() {
  $("#loading").hide();
  $("#main").show();
  });  

function validar(f){
f.btnAc.value="Enviando Evaluación";
f.btnAc.disabled=true;
return true}


function modal(rut) {
    console.log(rut);
     $.ajax({
      url: '../controles/control_modalEjercicio.php',
      type: 'POST',
      data: {"rut":rut},
      dataType:'json',
      success:function(result){
        $("#titulo_mod").text(result[0].nom_ejer +"-"+ result[0].series);
        $("#info_mod").text(result[0].nota_ejer);
        $("#rep_mod").text(result[0].rep_rut);
        $("#pausas_mod").text(result[0].pausas_rut+" Segundos");
        $("#vel_mod").text(result[0].vel_rut);
        $("#nota_mod").text(result[0].nota_rut);
        $("#video_mod").attr("src","https://www.youtube.com/embed/"+result[0].video+"?rel=0&amp;controls=0&amp;showinfo=0");

        console.log(result[0].nom_ejer);
        
  
      }
  })
    

}

</script>
<style>
 #borg {
    width: 30%;}

@media (max-width: 800px) {
    
        body{font-size: 2.5vw;}
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

<div id="loading" style="display: none;">
    <center><img src="../img/load.gif"></center>
  </div>

<div class="row" id="main">
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



<?php

              $hoy = date('Y-m-d', time());
              $re = $fun->cargar_circuitos($id,$hoy);
              if (isset($re)) {
                
                  foreach($re as $row){
                      $circuito = $row['circuito'];
                      if ($row['circuito'] <> '0') {
                        echo '<div id="accordion">

                              <div class="card">
                                <div class="card-header">
                                  <a class="card-link" data-toggle="collapse" href="#collapse'.$row['circuito'].'">
                                   Circuito '.$row['circuito'].' - Repetir '.$row['series_rut'].' veces
                                  </a>
                                </div>
                                <div id="collapse'.$row['circuito'].'" class="collapse" data-parent="#accordion">
                                  <div class="card-body">
                                    <div class="table-responsive">
                                    <table class="table table-sm" id="tabla" name="tabla">
                                      <thead class="thead-dark">
                                        <tr>
                                          <th scope="col">Ejercicio</th>
                                          <th scope="col">Musculo</th>
                                          <th scope="col">Realizado</th>
                                        </tr>
                                      </thead>
                                      <tbody>';
                                          //$circuito = $row['circuito'];
                                          $re2 = $fun->cargar_circuito($id,$hoy, $circuito);
                                          foreach($re2 as $row2){  
                                            echo ('<tr><td><a class="btn btn-dark" title="Cargar Entrenamiento" href="#modal"  data-toggle="modal" data-target="#modal" onclick="modal('.$row2['id_rut'].');">'.$row2['nom_ejer'].'</a></td>');
                                            echo ('<td>'.$row2['nom_musc'].'</td>');
                                            echo ('<td><label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                </label></tr>');
                                              }
                                              echo "</tbody>
                                            </table>
                                            </div>
                                            </div>
                                            </div>
                                          </div>";
                        
                      }else{
                            echo'<div class="table-responsive">
                                 <table class="table table-sm" id="tabla" name="tabla">
                                  <thead class="thead-dark">
                                    <tr>
                                      <th scope="col">Ejercicio</th>
                                      <th scope="col">Musculo</th>
                                      <th scope="col">Realizado</th>

                                    </tr>
                                  </thead>
                                  <tbody>';
                                  $re1 = $fun->cargar_entrenamiento($id,$hoy);
                                    foreach($re1 as $row1){                      
                                      echo ('<tr><td><a class="btn btn-dark" title="Cargar Entrenamiento" href="#modal"  data-toggle="modal" data-target="#modal" onclick="modal('.$row1['id_rut'].');">'.$row1['nom_ejer'].'</a></td>');
                                      echo ('<td>'.$row1['nom_musc'].'</td>');
                                      echo ('<td><label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                </label></td></tr>');
                                        
                       

                                    }
                                    echo '</tbody>
                                    </table>
                                    </div>';

                      }
     

                  }

              }
?>






<form role="form" action="../controles/control_enviarBorg.php" method="post">
    <div name="borg" >
      <input type="hidden" name="id_rut" value="<?php echo ($row1['id_rut']);?>">
      <label for="sel1" class="font-weight-bold">¿Como sentiste tu entrenamiento el día de hoy?</label>
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



<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="titulo_mod"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <label class="font-weight-bold">Información: </label>
            <span id="info_mod"></span>
          </div>
          
          <div class="row">
            <div class="col-6">

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label"><strong>Repeticiones: <span id="rep_mod"></span></strong></label>
                            
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-9 col-form-label"><strong>Velocidad de ejecución: <span id="vel_mod"></span></strong></label>
                            
                          </div>

            </div>
            <div class="col-6">

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label"><strong>Pausas: <span id="pausas_mod"></span></strong></label>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label"><strong>Peso: <span id="peso_mod"></span></strong></label>
                          </div>
                          
            </div>
                          
          </div>

          <div class="form-group">
            <label class="font-weight-bold">Nota Coach: </label>
            <span id="nota_mod"></span>
          </div>
        
      </div>
      <div class="modal-footer justify-content-center">
          <iframe id="video_mod" width="100%" height="115" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      
    </div>

  </div>
</div>


</body>
</html>