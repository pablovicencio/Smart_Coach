<?php


require_once '../clases/Funciones.php';

try{
$com = intval($_GET['id']);


$fun = new Funciones(); 


									$re = $fun->cargar_horarios($com); 

                                    
                                           echo $re; 
                                        



	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/entrenamiento.php';</script>"; 



	}

?>