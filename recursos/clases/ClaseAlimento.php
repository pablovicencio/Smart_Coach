<?php
require_once '../db/db.php';    


/*/////////////////////////////
Clase Alimento
////////////////////////////*/

class AlimentoDAO 
{
    private $id;
    private $desc;
    private $grupo;
    private $vigencia;

    public function __construct($id=null,$desc=null,$grupo=null,$vigencia=null) {
        $this->id  = $id;
        $this->desc = $desc;
        $this->grupo = $grupo;
        $this->vigencia = $vigencia;

}

        /*///////////////////////////////////////
        Crear Alimento
        //////////////////////////////////////*/
        public function crear_alimento() {

           
                try{
                     
                        $pdo = AccesoDB::getCon();

                        $sql_crear_ali = "INSERT INTO `nut_ali`(`desc_nut_ali`,`vig_nut_ali`,`fk_id_ali_ga`)
                                            VALUES(:nom, :vig, :grupo)";
                        

                        $stmt = $pdo->prepare($sql_crear_ali);
                        $stmt->bindParam(":nom", $this->desc, PDO::PARAM_STR);
                        $stmt->bindParam(":vig", $this->vigencia, PDO::PARAM_BOOL);
                        $stmt->bindParam(":grupo", $this->grupo, PDO::PARAM_INT);
                        $stmt->execute();

                    } catch (Exception $e) {
                        echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/sucursales.php';</script>"; 
                    }
            }




    /*///////////////////////////////////////
    Modificar Alimento
    //////////////////////////////////////*/

    public function modificar_ali()  {


        try{
                $pdo = AccesoDB::getCon();

                $sql_mod_ali = "UPDATE `nut_ali`
                                    SET
                                    `desc_nut_ali` = :nom,
                                    `vig_nut_ali` = :vig,
                                    `fk_id_ali_ga` = :grupo
                                    WHERE `id_nut_ali` = :id";


                $stmt = $pdo->prepare($sql_mod_ali);
                $stmt->bindParam(":nom", $this->desc, PDO::PARAM_STR);
                $stmt->bindParam(":vig", $this->vigencia, PDO::PARAM_BOOL);
                $stmt->bindParam(":grupo", $this->grupo, PDO::PARAM_INT);
                $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

                $stmt->execute();
                        
            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/sucursales.php'; </script>"; 
            }
    } 



}
?>

