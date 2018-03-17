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

if (isset($_GET['cli'])) {
  $cli = $_GET['cli'];
}else{
  echo"<script type=\"text/javascript\">alert('Favor, seleccione un cliente para cargar el entrenamiento'); window.location='entrenamiento.php';</script>"; 
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

function show(id) {
  console.log(id);
    $(document).ready(function(){
                                $("#ejercicio").load('../controles/get_ejercicios.php?q='+id);
                                id = 0;
                        });
}

function modal(fec_rut,fec,nom,cli) {
    console.log(fec);
    document.getElementById('fec').innerText = fec;
    document.getElementById('fec_rut').innerText = fec_rut;
    console.log(document.getElementById('fec_rut').innerText);
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
          var nuevafila= "<tr><td style='display:none;'>" +
          result[i].id_rut + "</td><td style='display:none;'>" +
          result[i].fk_id_ejer + "</td><td>" +
          result[i].nom_ejer + "</td><td>" +
          result[i].nom_musc + "</td><td>" +
          result[i].series_rut + "</td><td>" +
          result[i].rep_rut + "</td><td>" +
          result[i].pausas_rut + "</td><td>" +
          result[i].vel_rut + "</td><td>" +
          result[i].nota_rut + "</td><td>"+
          '<input type="button" value="X" onclick="deleteRow1('+result[i].id_rut+');deleteRow(this)" class="btn btn-outline-danger">' + "</td></tr>"
     
          $("#tabla").append(nuevafila)
        }
  


      }
  })
    

}

function agregar() {

  console.log(document.forms['carga'].ejercicio.value);




  tabla = document.getElementById('tabla');
  tr = tabla.insertRow(tabla.rows.length);
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = 0;
  td.style.display= "none";
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['carga'].ejercicio.value;
  td.style.display= "none";
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['carga'].ejercicio.options[ejercicio.selectedIndex].innerText;
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['carga'].musc.options[musc.selectedIndex].innerText;
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['carga'].series.value;
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['carga'].rep.value;
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['carga'].pausas.value;
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['carga'].vel.value;
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['carga'].nota.value;
  
  td = tr.insertCell(tr.cells.length);
  td.innerHTML ='<input type="button" value="X" onclick="deleteRow(this)" class="btn btn-outline-danger">';


  document.getElementById("carga").reset();


}

function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("tabla").deleteRow(i);
}


function deleteRow1( rut) {
    $.ajax({
      url: '../controles/control_vigRutina.php',
      type: 'POST',
      data: {"rut":rut},
      dataType:'string',
      success:function(result){
      }
  })
    
}


function storeTblValues()
        {
            var TableData = new Array();
    
            $('#tabla tr').each(function(row, tr){
                TableData[row]={
                  "rutina" : $(tr).find('td:eq(0)').text()
                    ,"ejercicio" : $(tr).find('td:eq(1)').text()
                    , "series" :$(tr).find('td:eq(4)').text()
                    , "rep" : $(tr).find('td:eq(5)').text()
                    , "pausas" : $(tr).find('td:eq(6)').text()
                    , "vel" : $(tr).find('td:eq(7)').text()
                    , "nota" : $(tr).find('td:eq(8)').text()
                }
            }); 
            TableData.shift();  // first row will be empty - so remove
            TableData = $.toJSON(TableData);
            console.log(TableData);
            var cli = parseInt(document.getElementById('cli').innerText);
            var nota = (document.forms['carga'].nota.value);
            var fec_rut = (document.getElementById('fec_rut').innerText);
            console.log(fec_rut);
            $('#tbConvertToJSON').val('JSON array: \n\n' + TableData.replace(/},/g, "},\n"));
            $.ajax({
                type: "POST",
                url: "../controles/control_cargaEntrenamiento.php",
                data:   { "data" : TableData, "cli":cli,"fec_rut":fec_rut},
                //data:   $("#new_v").serialize(), 
                cache: false,
                success: function(respuesta){
            alert(respuesta);
            window.location='carga_entrenamiento.php?cli='.concat(cli);
        }

            });
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
<h3>Cargar Entrenamiento de <?php  $re = $fun->cargar_cli($cli); 
                            foreach($re as $row)      
                      {echo $row['nom_cli'];} 
                        ?> </h3>
 <?php    
if (strtotime('+1 month',strtotime($row['fec_plan_cli'])) >= time()) {
  $div = '<div class="alert alert-success" role="alert">';
}else{
  $div = '<div class="alert alert-danger" role="alert">';
}


 echo $div.'Vigencia Desde '.date('d-m-Y',strtotime($row['fec_plan_cli'])).' Hasta '.date('d-m-Y', strtotime('+1 month',strtotime($row['fec_plan_cli']))); ?></div>
                      
<center> 
<h4><?php echo $mes_lbl[$numeroMes].' '.date('Y', $fecha); ?></h4>
<a class="badge badge-dark"  href=carga_entrenamiento.php?dato=<?php echo date("Y-m",(strtotime("-1 month", $fecha))).'&cli='.$cli;?> class="l" style='margin-right: 6em'>Anterior</a>
<a class="badge badge-dark"  href=carga_entrenamiento.php?dato=<?php echo date("Y-m",(strtotime("+1 month", $fecha))).'&cli='.$cli;?> class="l">Siguiente</a>


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
              echo isset($days[$i]) ? '<a class="badge badge-dark" title="Cargar Entrenamiento" href="#modal" data-id="'.$days[$i].'" data-toggle="modal" data-target="#modal" onclick="modal(\''.($fec.'-'.$days[$i]).'\',\''.strftime("%A %d %b %Y",(strtotime($fec.'-'.$days[$i]))).'\',\''.$row['nom_cli'].'\',\''.$cli.'\');">'.$days[$i].'</a>' : ''; 




              ?>


            </td> 

          <?php endfor; ?>

        </tr>

      <?php endforeach ?>

    </tbody>
    </table> 
</center>

<h5>Historial de avances</h5>
         
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
              $re1 = $fun->cargar_evo_cli($cli);
              foreach($re1 as $row1){

            
                echo ('<tr><td>'.date('d-m-Y',strtotime($row1['fec_evo'])).'</td>');
                echo ('<td>'.$row1['est_evo'].'</td>');
                echo ('<td>'.$row1['peso_evo'].'</td>');
                echo ('<td>'.$row1['imc'].'</td></tr>');
 
              }
?>
    </tbody>
  </table>

</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 70%">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Cargando entrenamiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="carga" name="carga" enctype="multipart/form-data">
          <div class="form-group">
            <label class="font-weight-bold">Cargar dia </label>
            <span id="fec"></span>
            <span id="fec_rut" style="display: none;"></span>
          </div>
          <div class="form-group">
            <label>Cliente</label>
            <span id="nom"></span>
            <span id="cli" style="display: none;"></span>
          </div>
          <div class="row">
            <div class="col-4">
                          <div class="form-group">
                              <select size="1" name="musc" class="custom-select" id="musc" type="text" onchange="show(this.value);" required>
                                      <option value="" selected disabled>Seleccione Musculo</option>
                                                   <?php 
                                                    $re = $fun->cargar_musculos();   
                                                    foreach($re as $row)      
                                                        {
                                                          ?>
                                                          
                                                           <option value="<?php echo $row['id_musc'] ?> ">
                                                           <?php echo $row['nom_musc'] ?>
                                                           </option>
                                                              
                                                          <?php
                                                        }    
                                                    ?>       
                                    </select>
                          </div>

                          <div class="form-group">
                            <select  size="1" class="custom-select" id="ejercicio" name="ejercicio">
                                <option value="" selected disabled >Seleccione Ejercicio</option>
                            </select>
                          </div>
            </div>
            <div class="col-4">

                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Series:</label>
                            <div class="col-sm-6">
                            <input type="number" class="form-control" id="series" style="width: 60%;" name="Series">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Repeticiones:</label>
                            <div class="col-sm-6">
                            <input type="number" class="form-control" id="rep"  style="width: 60%;" name="Repeticiones">
                            </div>
                            <br>
                          </div>
            </div>
            <div class="col-4">

                          <div class="form-group row">
                            <label  class="col-sm-3 col-form-label" >Pausas:</label>
                            <div class="col-sm-9">
                              <input type="number" class="form-control" id="pausas" style="width: 60%; display: inline-block;" name="Pausas"> <span>seg</span>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label  class="col-sm-3 col-form-label" >Velocidad:</label>
                            <div class="col-sm-9">
                              <input type="number" class="form-control" id="vel" style="width: 60%; display: inline-block;" name="Velocidad" placeholder="Velocidad"> <span>seg</span>
                            </div>
                          </div>
            </div>
                          
          </div>

          <div class="form-group">
            <label for="message-text" class="col-form-label">Nota:</label>
            <textarea class="form-control" id="nota" maxlength="200"></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark" onclick="agregar()">Agregar</button>
        <button type="button" class="btn btn btn-outline-danger" onclick="storeTblValues()" >Guardar</button>
      </div>
      </form>
      <table class="table table-sm table-dark" id="tabla" name="tabla">
  <thead>
    <tr>
      <th scope="col" style="display: none">Id_rutina</th>
      <th scope="col" style="display: none">Id_Ejercicio</th>
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