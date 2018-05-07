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

  if (isset($_GET['cli'])) {
  $cli = $_GET['cli'];
}else{
  echo"<script type=\"text/javascript\">alert('Favor, seleccione un cliente para cargar el entrenamiento'); window.location='entrenamiento.php';</script>"; 
}
  

  require_once '../clases/Funciones.php';

  $fun = new Funciones(); 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>D3 - Cargar Dieta</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src ="//cdnjs.cloudflare.com/ajax/libs/jquery-json/2.6.0/jquery.json.min.js"> </script>

<script>

function agregar(){




   console.log(document.forms['carga_dieta'].uni_med.value);




  tabla = document.getElementById('dieta_nueva');
  tr = tabla.insertRow(tabla.rows.length);

  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['carga_dieta'].com.value;
  td.style.display= "none";

  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['carga_dieta'].com.options[com.selectedIndex].innerText;

  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['carga_dieta'].gru_ali.value;
  td.style.display= "none";

  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['carga_dieta'].ali.value;
  td.style.display= "none";

  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['carga_dieta'].ali.options[ali.selectedIndex].innerText;

  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['carga_dieta'].cant.value;

  if (document.forms['carga_dieta'].uni_med.value == ''){
        td = tr.insertCell(tr.cells.length);
        td.innerHTML = '0';
        td.style.display= "none";

        td = tr.insertCell(tr.cells.length);
        td.innerHTML = td.innerHTML = ' ';
  }else{
        td = tr.insertCell(tr.cells.length);
        td.innerHTML = document.forms['carga_dieta'].uni_med.value;
        td.style.display= "none";

        td = tr.insertCell(tr.cells.length);
        td.innerHTML = document.forms['carga_dieta'].uni_med.options[uni_med.selectedIndex].innerText;
  }


  
  
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['carga_dieta'].nota.value;
  
  td = tr.insertCell(tr.cells.length);
  td.innerHTML ='<input type="button" value="X" onclick="deleteRow(this)" class="btn btn-outline-danger">';


  //document.getElementById("carga_dieta").reset();


}

function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("dieta_nueva").deleteRow(i);
}



function alimentos(gr) {
  //console.log(gr);
    $(document).ready(function(){
                                $("#ali").load('../controles/get_alimentos.php?gr='+gr);
                                gr = 0;
                        });
}

function horarios(id) {
    $(document).ready(function(){
      $.get('../controles/get_horario.php', 
        {id: id}, 
        function(result){
            $("#horario").val(result);
        });
                                
                        });
    
}


function validar(f){
f.btnAc.value="Cargando Dieta";
f.btnAc.disabled=true;
return true}


function storeTblValues()
        {
            var TableData = new Array();
    
            $('#dieta_nueva tr').each(function(row, tr){
                TableData[row]={
                     "com" : $(tr).find('td:eq(0)').text()
                    ,"ga" : $(tr).find('td:eq(2)').text()
                    ,"ali" : $(tr).find('td:eq(3)').text()
                    , "med" : $(tr).find('td:eq(6)').text()
                    , "nota" : $(tr).find('td:eq(8)').text()
                    , "cant" :$(tr).find('td:eq(5)').text()
                    
                    
                }
            }); 
            TableData.shift();  // first row will be empty - so remove
            TableData = $.toJSON(TableData);
            console.log(TableData);
            var cli = parseInt(document.getElementById('cli').innerText);
            $('#tbConvertToJSON').val('JSON array: \n\n' + TableData.replace(/},/g, "},\n"));
            $.ajax({
                type: "POST",
                url: "../controles/control_cargaDieta.php",
                data:   { "data" : TableData, "cli":cli},
                //data:   $("#new_v").serialize(), 
                cache: false,
                success: function(respuesta){
            alert(respuesta);
            window.location='carga_dieta.php?cli='.concat(cli);
        }

            });
        }


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


<div class="container-fluid" style="padding-top: 5px">
  <h3>Cargar Dieta de <?php  $re = $fun->cargar_cli($cli); 
                            foreach($re as $row)      
                      {echo $row['nom_cli']; } 
                        ?> </h3><a class="badge badge-dark" href="ver_evaluacion.php?cli=<?php echo $cli; ?>" target="_blank"> Ver Evaluacion</a>
  
  <div class="row">
    <div class="col rounded border border-success"><h5>Calculo por porciones de intercambio</h5>


<iframe width="469" height="392" frameborder="0" scrolling="no" src="https://onedrive.live.com/embed?resid=9712CA4BF3215165%21887&authkey=%21AEMRkD6z3v6NvPc&em=2&wdAllowInteractivity=False&AllowTyping=True&Item='Hoja1'!B2%3AG20&wdHideGridlines=True&wdDownloadButton=True&wdInConfigurator=True"></iframe>



      
       


    </div>

    <div class="col rounded border border-success"><h5>Carga Dieta</h5>
    <form id="carga_dieta" name="carga_dieta" enctype="multipart/form-data">
    <span id="cli" style="display: none;"><?php echo $cli; ?></span>
    <div class="row">
              <div class="col-6">
                  <div class="form-group">
                                        <select size="1" name="com" class="custom-select" id="com" type="text" onchange="horarios(this.value);" required>
                                                <option value="" selected disabled>Seleccione Comida</option>
                                                             <?php 
                                                              $re1 = $fun->cargar_comidas();   
                                                              foreach($re1 as $row1)      
                                                                  {
                                                                    ?>
                                                                     <option value="<?php echo ($row1['id_nut_com']); ?>"><?php echo ($row1['desc_nut_com']); ?></option> 
                                                                    <?php
                                                                  }    
                                                              ?>       
                                        </select>
                  </div>

              </div>

              <div class="col-6">
                  
                            <div class="col-sm-6">
                              <input type="text" class="form-control" id="horario" name="horario" placeholder="Horario">
                            </div>
                  

              </div>
              </div>
      <div class="row">
              <div class="col-6">
                  <div class="form-group">
                                        <select size="1" name="gru_ali" class="custom-select" id="gru_ali" type="text" onchange="alimentos(this.value);" required>
                                                <option value="" selected disabled>Seleccione Grupo Ali.</option>
                                                             <?php 
                                                              $re2 = $fun->cargar_grupo_ali();   
                                                              foreach($re2 as $row2)      
                                                                  {
                                                                    ?>
                                                                     <option value="<?php echo ($row2['id_nut_grup']); ?>"><?php echo ($row2['desc_nut_grup']); ?></option> 
                                                                    <?php
                                                                  }    
                                                              ?>       
                                        </select>
                  </div>

              </div>

              <div class="col-6">
                  <div class="form-group">
                            <select  size="1" class="custom-select" id="ali" name="ali">
                                <option value="" selected disabled >Seleccione Alimento</option>
                            </select>
                  </div>

              </div>
              </div>
              <div class="row">
              <div class="col-6">
                  <div class="form-group row">
                            <label  class="col-sm-3 col-form-label" >Cantidad:</label>
                            <div class="col-sm-9">
                              <input type="number" class="form-control" id="cant" style="width: 60%; display: inline-block;" name="cant">
                            </div>
                          </div>

              </div>

              <div class="col-6">
                  <div class="form-group">
                            <select  size="1" class="custom-select" id="uni_med" name="uni_med">
                                <option value="" selected disabled >Seleccione Unidad de Medida</option>
                                          <?php 
                                                              $re3 = $fun->cargar_uni_med_ali();   
                                                              foreach($re3 as $row3)      
                                                                  {
                                                                    ?>
                                                                     <option value="<?php echo ($row3['id_nut_uni']); ?>"><?php echo ($row3['desc_nut_uni']); ?></option> 
                                                                    <?php
                                                                  }    
                                                              ?>       
                            </select>
                  </div>

              </div>

              </div>
                             <div class="form-group">
                  <label for="message-text" class="col-form-label">Nota:</label>
                  <textarea class="form-control" id="nota" maxlength="200"></textarea>
              </div>
              <div class="col-6">
              </div>
              <div class="col-6">
              <button type="button" class="btn btn-outline-dark" onclick="agregar()">Agregar</button>
              <button type="button" class="btn btn-outline-success" onclick="storeTblValues()" >Guardar</button>
              </div>
</form>
  </div></div>
  <div class="row">

    <div class="col rounded border border-success">
    <div class="row">
    <div class="col-6">
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
                                    $re4 = $fun->cargar_evo_cli($cli);
                                    foreach($re4 as $row4){

                                  
                                      echo ('<tr><td>'.date('d-m-Y',strtotime($row4['fec_evo'])).'</td>');
                                      echo ('<td>'.$row4['est_evo'].'</td>');
                                      echo ('<td>'.$row4['peso_evo'].'</td>');
                                      echo ('<td>'.$row4['imc'].'</td></tr>');
                       
                                    }
                      ?>
                          </tbody>
                        </table>
        </div>
        <div class="col-6">
        <h5>Evaluación de Dieta</h5>
                               
                        <table class="table table-sm table-dark" name="tabla_evo" id="tabla_evo">
                          <thead >
                            <tr>
                              <th>Horario Hambre</th>
                              <th>Nota Seguimiento</th>
                              <th>Fecha Evaluación</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                                    $re6 = $fun->cargar_eva_die($cli);
                                    foreach($re6 as $row6){

                                  
                                      echo ('<tr><td>'.$row6['eva'].'</td>');
                                      echo ('<td>'.$row6['seg_dieta_eva'].'</td>');
                                      echo ('<td>'.date('d-m-Y',strtotime($row6['fec_eva'])).'</td></tr>');
                       
                                    }
                      ?>
                          </tbody>
                        </table>
        </div>
    </div>
    </div>

    <div class="col rounded border border-success"><h5>Carga de dieta</h5>

      <div class="row">
    <div class="col-6">
        <h5>Actual</h5>
                               
                        <table class="table table-sm table-dark" name="dieta_act" id="dieta_act">
                          <thead >
                            <tr>
                              <th>Comida</th>
                              <th>Alimento</th>
                              <th>Cantidad</th>
                              <th>Uni. Med</th>
                              <th>Nota</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                                    $re5 = $fun->cargar_dieta_act($cli);
                                    foreach($re5 as $row5){

                                      echo ('<tr><td>'.$row5['desc_nut_com'].'</td>');
                                      echo ('<td>'.$row5['desc_nut_ali'].'</td>');
                                      echo ('<td>'.$row5['cant_nut_ali'].'</td>');
                                      echo ('<td>'.$row5['uni'].'</td>');
                                      echo ('<td>'.$row5['nota_nut_det'].'</td></tr>');
                       
                                    }
                      ?>
                          
                          </tbody>
                        </table>
        </div>
        <div class="col-6">
        <h5>Nueva</h5>
                               
                        <table class="table table-sm table-dark" name="dieta_nueva" id="dieta_nueva">
                          <thead >
                            <tr>
                              <th style="display: none">Id_com</th>
                              <th>Comida</th>
                              <th style="display: none">Id_ga</th>
                              <th style="display: none">Id_ali</th>
                              <th>Alimento</th>
                              <th>Cantidad</th>
                              <th style="display: none">Id_uni</th>
                              <th>Uni. Med</th>
                              <th>Nota</th>
                            </tr>
                          </thead>
                          <tbody>
                          
                          </tbody>
                        </table>
        </div>
    </div>



    </div>

  </div>
</div>



</body>
</html>