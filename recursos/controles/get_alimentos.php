<?php


require_once '../clases/Funciones.php';

try{
$gr = intval($_GET['gr']);


$fun = new Funciones(); 


									echo'<option value="" selected disabled >Seleccione Alimento</option>';  
									$re = $fun->cargar_alimentos($gr); 

                                    foreach($re as $row)      
                                        {
                                           echo '<option value="'.$row['id_nut_ali'].'">'.$row['desc_nut_ali'].'</option>'; 
                                        }    



	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/entrenamiento.php';</script>"; 



	}

?>