<?php


require_once '../clases/Funciones.php';

try{
$musc = intval($_GET['q']);

$fun = new Funciones(); 


									echo'<option value="" selected disabled >Seleccione Ejercicio</option>';  
									$re = $fun->cargar_ejercicios($musc); 

                                    foreach($re as $row)      
                                        {
                                           echo '<option value="'.$row['id_ejer'].'">'.$row['nom_ejer'].'</option>'; 
                                        }    



	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/entrenamiento.php';</script>"; 



	}

?>