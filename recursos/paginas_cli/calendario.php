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
$fecha = strtotime($fec."-01");
$week = 1;

  for($i=1;$i<=date('t', $fecha);$i++) {

    $day_week = date('N', strtotime(date('Y-m', $fecha).'-'.$i));

    $calendar[$week][$day_week] = $i;

    if ($day_week == 7) { $week++; };

  }
  require_once '../clases/Funciones.php';
    $mes_lbl = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre', 'Octubre', 'Noviembre','Diciembre');

    $numeroMes = date('m', $fecha) -1;

    setlocale(LC_ALL,"es_ES");

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


<script language="javascript">



function modal(fec_rut,fec,nom,cli) {
    console.log(fec);
    document.getElementById('fec').innerText = fec;
    document.getElementById('nom').innerHTML = nom;
    document.getElementById('cli').innerHTML = cli;
    var table = document.getElementById("tabla");
    //or use :  var table = document.all.tableid;
    for(var i = table.rows.length - 1; i > 0; i--)
    {
      table.deleteRow(i);
    }
     $.ajax({
      url: '../controles/control_verRutina.php',
      type: 'POST',
      data: {"cli":cli,"fec":fec_rut},
      dataType:'json',
      success:function(result){
        
        var filas = Object.keys(result).length;
     
        for (  i = 0 ; i < filas; i++){ //cuenta la cantidad de registros
          var nuevafila= "<tr><td>" +
          result[i].nom_ejer + "</td><td>" +
          result[i].nom_musc + "</td><td>" +
          result[i].series_rut + "</td><td>" +
          result[i].rep_rut + "</td><td>" +
          result[i].pausas_rut + "</td><td>" +
          result[i].vel_rut + "</td><td>" +
          result[i].nota_rut + "</td><td>"
     
          $("#tabla").append(nuevafila)
        }
  


      }
  })
    

}





</script>

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
<div class="container-fluid" style="padding-top: 5px">

<center><h3>Calendario de <?php  $re = $fun->cargar_cli($id); 
                            foreach($re as $row)      
                      {echo $row['nom_cli'];} 
                        ?> </h3></center>
 <?php    
if (strtotime('+1 month',strtotime($row['fec_plan_cli'])) >= time()) {
  $div = '<div class="alert alert-success" role="alert">';
}else{
  $div = '<div class="alert alert-danger" role="alert">';
}


 echo $div.'Vigencia desde '.date('d-m-Y',strtotime($row['fec_plan_cli'])).' Hasta '.date('d-m-Y', strtotime('+1 month',strtotime($row['fec_plan_cli']))); ?></div>
                      
<center> 
<h4><?php echo $mes_lbl[$numeroMes].' '.date('Y', $fecha); ?></h4>
<a class="badge badge-dark"  href=calendario.php?dato=<?php echo date("Y-m",(strtotime("-1 month", $fecha))).'&cli='.$id;?> class="l" style='margin-right: 6em'>Anterior</a>
<a class="badge badge-dark"  href=calendario.php?dato=<?php echo date("Y-m",(strtotime("+1 month", $fecha))).'&cli='.$id;?> class="l">Siguiente</a>


<table border="1" class="table table-bordered" style="width: 70%; height: 35%;">

    <thead class="thead-inverse">

      <tr>

        <th>Lunes</th>
        <th>Martes</th>   
        <th>Miércoles</th>   
        <th>Jueves</th>   
        <th>Viernes</th>   
        <th>Sábado</th>   
        <th>Domingo</th>   

      </tr>

    </thead>

    <tbody>

      <?php foreach ($calendar as $days) : ?>

        <tr>

          <?php for ($i=1;$i<=7;$i++) : 
            ?>


              <?php

              
              
    
              echo '<td class="td-cal">';
              echo isset($days[$i]) ? '<a class="badge badge-dark" title="Cargar Entrenamiento" href="#modal" data-id="'.$days[$i].'" data-toggle="modal" data-target="#modal" onclick="modal(\''.($fec.'-'.$days[$i]).'\',\''.strftime("%A %d %b %Y",(strtotime($fec.'-'.$days[$i]))).'\',\''.$row['nom_cli'].'\',\''.$id.'\');">'.$days[$i].'</a>' : ''; 




              ?>


            </td> 

          <?php endfor; ?>

        </tr>

      <?php endforeach ?>

    </tbody>
    </table> 
</center>

</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 70%">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Entrenamiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="carga" name="carga" enctype="multipart/form-data">
          <div class="form-group">
            <label class="font-weight-bold">Día</label>
            <span id="fec"></span>
            <span id="fec_rut" style="display: none;"></span>
          </div>
          <div class="form-group">
            <span id="nom"></span>
            <span id="cli" style="display: none;"></span>
          </div>
         
      <table class="table table-sm table-dark" id="tabla" name="tabla">
  <thead>
    <tr>
      <th scope="col">Ejercicio</th>
      <th scope="col">Musculo</th>
      <th scope="col">Series</th>
      <th scope="col">Repeticiones</th>
      <th scope="col">Pausas</th>
      <th scope="col">Velocidad</th>
      <th scope="col">Nota</th>

    </tr>
  </thead>
  <tbody>
  
  </tbody>
</table>
    </div>
  </div>
</div>

</body>
</html>