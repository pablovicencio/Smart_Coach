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
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>D3safío</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>


<script>

function validar(f){
f.btnAc.value="Enviando Evaluación";
f.btnAc.disabled=true;
return true}

function horario(h) { 
  if (h == 1) {
  document.getElementById('hora_eva').style.display = 'block'; 
 }else if(h == 0){
  document.getElementById('hora_eva').style.display = 'none'; 
 }
} 


function impDiv() {

      
     document.getElementById("collapseOne").className = "collapse show"; 
     document.getElementById("collapseTwo").className = "collapse show"; 
     document.getElementById("collapseThree").className = "collapse show"; 
     document.getElementById("collapseFour").className = "collapse show"; 
     document.getElementById("collapseFive").className = "collapse show"; 

     var contenido= document.getElementById('accordion').innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
     document.getElementById("collapseOne").className = "collapse"; 
     document.getElementById("collapseTwo").className = "collapse"; 
     document.getElementById("collapseThree").className = "collapse"; 
     document.getElementById("collapseFour").className = "collapse"; 
     document.getElementById("collapseFive").className = "collapse"; 
}

</script>

<style>
 #eva{
    width: 40%;}

@media print {
    
    
    #tabla {
      font-size: 14px;
        line-height: 0.8;
        background-color: white;
        color: black;
        border: 1px solid black;


    }
    
    .card-body{
      padding: 0;
    }
    .card-header{
      padding: .1rem .1rem;
    }

    
    }
@media (max-width: 800px) {
    
        body{font-size: 2.5vw;}
        #eva{width: 100%;}
        


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

<div class="row">
<div class="col-sm">

<center><h3>Plan Nutricional de  
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
              $re1 = $fun->coach_dieta($id);
               foreach($re1 as $row1){
                echo '<a href="https://m.me/'.$row1['fb_coach'].'" class="btn btn-outline-primary" target="_blank"><img src="../img/me.png" alt="messenger" height="22" width="22"> '.$row1['nom_coach'].'</a>';
               }
              
            
?>
<br>
<br>

<input type="button" class="btn btn-outline-success" onclick="impDiv()" value="Imprimir Dieta" />
<br>

<div id="accordion">

  <div class="card">
    <div class="card-header">
      <a class="card-link" data-toggle="collapse" href="#collapseOne">
       Desayuno 06:00 - 09:00
      </a>
    </div>
    <div id="collapseOne" class="collapse" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-sm table-dark" id="tabla" name="tabla">
          <thead>
            <tr>
              <th scope="col">Alimento</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Unidad de medida</th>
              <th scope="col">Imagen referencial</th>
              <th scope="col">Nota</th>
            </tr>
          </thead>
          <tbody>
          <?php
                      $com = 1;
                      $re = $fun->cargar_dieta($id, $com);
                      foreach($re as $row){

                    
                        
                        echo ('<tr><td>'.$row['desc_nut_ali'].'</td>');
                        echo ('<td>'.$row['cant_nut_ali'].'</td>');
                        echo ('<td>'.$row['uni'].'</td>');
                        echo ('<td>'.$row['img_nut_uni'].'</td>');
                        echo ('<td>'.$row['nota_nut_det'].'</td></tr>');

                      }
        ?>
          
          </tbody>
        </table>

      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
        Almuerzo 12:00 - 16:00
      </a>
    </div>
    <div id="collapseTwo" class="collapse" >
      <div class="card-body">
        <table class="table table-sm table-dark" id="tabla" name="tabla">
          <thead>
            <tr>
              <th scope="col">Alimento</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Unidad de medida</th>
              <th scope="col">Imagen referencial</th>
              <th scope="col">Nota</th>
            </tr>
          </thead>
          <tbody>
          <?php
                      $com = 3;
                      $re = $fun->cargar_dieta($id, $com);
                      foreach($re as $row){

                    
                        
                        echo ('<tr><td>'.$row['desc_nut_ali'].'</td>');
                        echo ('<td>'.$row['cant_nut_ali'].'</td>');
                        echo ('<td>'.$row['uni'].'</td>');
                        echo ('<td>'.$row['img_nut_uni'].'</td>');
                        echo ('<td>'.$row['nota_nut_det'].'</td></tr>');

                      }
        ?>
          
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
        Once 16:30 - 20:00
      </a>
    </div>
    <div id="collapseThree" class="collapse" >
      <div class="card-body">
        <table class="table table-sm table-dark" id="tabla" name="tabla">
          <thead>
            <tr>
              <th scope="col">Alimento</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Unidad de medida</th>
              <th scope="col">Imagen referencial</th>
              <th scope="col">Nota</th>
            </tr>
          </thead>
          <tbody>
          <?php
                      $com = 4;
                      $re = $fun->cargar_dieta($id, $com);
                      foreach($re as $row){

                    
                        
                        echo ('<tr><td>'.$row['desc_nut_ali'].'</td>');
                        echo ('<td>'.$row['cant_nut_ali'].'</td>');
                        echo ('<td>'.$row['uni'].'</td>');
                        echo ('<td>'.$row['img_nut_uni'].'</td>');
                        echo ('<td>'.$row['nota_nut_det'].'</td></tr>');

                      }
        ?>
          
          </tbody>
        </table>
      </div>
    </div>
  </div>

   <div class="card">
    <div class="card-header">
      <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
        Cena 19:00 - 00:00
      </a>
    </div>
    <div id="collapseFour" class="collapse" >
      <div class="card-body">
        <table class="table table-sm table-dark" id="tabla" name="tabla">
          <thead>
            <tr>
              <th scope="col">Alimento</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Unidad de medida</th>
              <th scope="col">Imagen referencial</th>
              <th scope="col">Nota</th>
            </tr>
          </thead>
          <tbody>
          <?php
                      $com = 5;
                      $re = $fun->cargar_dieta($id, $com);
                      foreach($re as $row){

                    
                        
                        echo ('<tr><td>'.$row['desc_nut_ali'].'</td>');
                        echo ('<td>'.$row['cant_nut_ali'].'</td>');
                        echo ('<td>'.$row['uni'].'</td>');
                        echo ('<td>'.$row['img_nut_uni'].'</td>');
                        echo ('<td>'.$row['nota_nut_det'].'</td></tr>');

                      }
        ?>
          
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">
        Colación 
      </a>
    </div>
    <div id="collapseFive" class="collapse" >
      <div class="card-body">
        <table class="table table-sm table-dark" id="tabla" name="tabla">
          <thead>
            <tr>
              <th scope="col">Alimento</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Unidad de medida</th>
              <th scope="col">Imagen referencial</th>
              <th scope="col">Nota</th>
            </tr>
          </thead>
          <tbody>
          <?php
                      $com = 2;
                      $re = $fun->cargar_dieta($id, $com);
                      foreach($re as $row){

                    
                        
                        echo ('<tr><td>'.$row['desc_nut_ali'].'</td>');
                        echo ('<td>'.$row['cant_nut_ali'].'</td>');
                        echo ('<td>'.$row['uni'].'</td>');
                        echo ('<td>'.$row['img_nut_uni'].'</td>');
                        echo ('<td>'.$row['nota_nut_det'].'</td></tr>');

                      }
        ?>
          
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>




         
 


<form role="form" action="../controles/control_enviarEvaDieta.php" method="post">
    <div name="eva" id="eva" >
      <input type="hidden" name="id_dieta" value="<?php echo ($row['id_nut_dieta']);?>">
      <label for="sel1">¿Dentro de estos días, has pasado hambre?</label>
      <br>
        <label class="radio-inline">
          <input type="radio"  name="hambre_eva" value="1" onclick="horario(1)" required>Si
        </label>
      <label class="radio-inline">
        <input type="radio"  name="hambre_eva" value="0" onclick="horario(0)">No
      </label>
      <br>
      <select class="form-control" id="hora_eva" name="hora_eva" style="display: none;">
        <option value="" selected disabled>¿En que horario?</option>
        <option value="1">Mañana </option>
        <option value="2">Media Mañana</option>
        <option value="3">Tarde</option>
        <option value="4">Noche</option>
      </select>
      <br>
       <label for="sel2">En el rango de 1 a 7, siendo 1 <b>Muy mal</b> y 7 <b>Excelente </b>, ¿Como evaluiarías tu seguimiento de la pauta nutricional?</label>
      <br>
        <label class="radio-inline">
          <input type="radio"  name="nota_eva" value="1" required>1
        </label>
      <label class="radio-inline">
        <input type="radio"  name="nota_eva" value="2">2
      </label>
      <label class="radio-inline">
        <input type="radio"  name="nota_eva" value="3">3
      </label>
      <label class="radio-inline">
        <input type="radio"  name="nota_eva" value="4">4
      </label>
      <label class="radio-inline">
        <input type="radio"  name="nota_eva" value="5">5
      </label>
      <label class="radio-inline">
        <input type="radio"  name="nota_eva" value="6">6
      </label>
      <label class="radio-inline">
        <input type="radio"  name="nota_eva" value="7">7
      </label>
      <br>
      <input type="submit" class="btn btn-outline-success" id="btnAc" name="btnAc" value="Enviar" title="Recuerda que puedes enviar solo una evaluacion de dieta">
   
</div>
</form>
 

</div>

</body>
  
</div>
</html>