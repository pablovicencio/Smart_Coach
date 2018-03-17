<?php
require_once '../db/db.php';    


/*/////////////////////////////
Clase Rutina
////////////////////////////*/

class RutinaDAO 
{
    private $id;
    private $fecha;
    private $data;
    private $vigencia;

    public function __construct($id=null,$fecha=null,$data=null,$vigencia=null) {
        $this->id  = $id;
        $this->fecha  = $fecha;
        $this->data = $data;
        $this->vigencia = $vigencia;

}

        /*///////////////////////////////////////
        Guardar Rutina
        //////////////////////////////////////*/
        public function guardar_rutina($id_cli, $id_coach,$fec_reg_rut) {

            try{

                
                $pdo = AccesoDB::getCon();


                foreach ($this->data as $row) {
                              $rut = $row['rutina'];
                              $rep = $row['rep'];
                              $series = $row['series'];
                              $pausas = $row['pausas'];
                              $vel = $row['vel'];
                              $nota = $row['nota'];
                              $ejer = $row['ejercicio'];

                              if ($rut == 0) {
                                  $sql_rut = "INSERT INTO `rutina`
                                (`fec_rut`,`rep_rut`,`series_rut`,`pausas_rut`,`vel_rut`,`nota_rut`,`fk_id_cli`,`fk_id_ejer`,`fk_id_coach`,`vig_rut`,`fec_reg_rut`)
                                VALUES(:fec, :rep, :series, :pausas, :vel, :nota, :cli, :ejer, :coach, :vig, :fec_reg)";



                $stmt = $pdo->prepare($sql_rut);
                        $stmt->bindParam("fec", $this->fecha, PDO::PARAM_STR);
                        $stmt->bindParam("rep", $rep, PDO::PARAM_INT);
                        $stmt->bindParam("series", $series, PDO::PARAM_INT);
                        $stmt->bindParam("pausas", $pausas, PDO::PARAM_INT);
                        $stmt->bindParam("vel", $vel, PDO::PARAM_INT);
                        $stmt->bindParam("nota", $nota, PDO::PARAM_STR);
                        $stmt->bindParam("cli", $id_cli, PDO::PARAM_INT);
                        $stmt->bindParam("ejer", $ejer, PDO::PARAM_INT);
                        $stmt->bindParam("coach", $id_coach, PDO::PARAM_INT);
                        $stmt->bindParam("vig", $this->vigencia, PDO::PARAM_INT);
                        $stmt->bindParam("fec_reg", $fec_reg_rut, PDO::PARAM_STR);
                $stmt->execute();
                              }

                
    }
        

            } catch (Exception $e) {
                 echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/carga_entrenamiento.php';</script>"; 
            }
        }


        /*///////////////////////////////////////
        Quitar Vigencia Rutina
        //////////////////////////////////////*/
        public function vig_rutina() {

            try{

                
                $pdo = AccesoDB::getCon();


               

                $sql_vig_rut = "update rutina
                                set vig_rut = 0
                                where id_rut = :rut";



                $stmt = $pdo->prepare($sql_vig_rut);
                        $stmt->bindParam("rut", $this->id, PDO::PARAM_INT);
                $stmt->execute();

        

            } catch (Exception $e) {
                 echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/carga_entrenamiento.php';</script>"; 
            }
        }




}
?>

