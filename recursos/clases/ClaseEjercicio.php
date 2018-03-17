<?php
require_once '../db/db.php';

/*/////////////////////////////
Clase Ejercicio
////////////////////////////*/

class EjercicioDAO 
{
    private $id;
    private $nombre;
    private $link;
    private $nota;
    private $vigencia;
    
    public function __construct($id=null,$nombre=null, $link=null, $nota=null, $vigencia=null) {
        $this->id  = $id;
        $this->nombre  = $nombre;
        $this->link  = $link;
        $this->nota  = $nota;
        $this->vigencia  = $vigencia;
}

public function getEjercicio() {
    return $this->id;
 }

   	/*///////////////////////////////////////
    Crear Ejercicio
    //////////////////////////////////////*/
    public function crear_ejercicio($musc) {


        try{
             
                $pdo = AccesoDB::getCon();

                $sql_crear_suc = "INSERT INTO `ejercicios`(`nom_ejer`,`link_ejer`,`nota_ejer`,`fk_id_musc`,`vig_ejer`)
                            VALUES(:nom,:link,:nota,:musc, :vig)";
                

                $stmt = $pdo->prepare($sql_crear_suc);
                $stmt->bindParam(":nom", $this->nombre, PDO::PARAM_STR);
                $stmt->bindParam(":link", $this->link, PDO::PARAM_STR);
                $stmt->bindParam(":nota", $this->nota, PDO::PARAM_STR);
                $stmt->bindParam(":musc", $musc, PDO::PARAM_INT);
                $stmt->bindParam(":vig", $this->vigencia, PDO::PARAM_BOOL);
                $stmt->execute();

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/sucursales.php';</script>"; 
            }
    }


    /*///////////////////////////////////////
    Modificar Ejercicio
    //////////////////////////////////////*/

    public function modificar_ejer($musc)  {


        try{
                $pdo = AccesoDB::getCon();

                $sql_mod_ejer = "UPDATE `ejercicios`
                                    SET
                                    `nom_ejer` = :nom,
                                    `link_ejer` = :link,
                                    `nota_ejer` = :nota,
                                    `fk_id_musc` = :musc,
                                    `vig_ejer` = :vig
                                    WHERE `id_ejer` = :id";


                $stmt = $pdo->prepare($sql_mod_ejer);
                $stmt->bindParam(":nom", $this->nombre, PDO::PARAM_STR);
                $stmt->bindParam(":link", $this->link, PDO::PARAM_STR);
                $stmt->bindParam(":nota", $this->nota, PDO::PARAM_STR);
                $stmt->bindParam(":musc", $musc, PDO::PARAM_INT);
                $stmt->bindParam(":vig", $this->vigencia, PDO::PARAM_BOOL);
                $stmt->bindParam(":id", $this->id, PDO::PARAM_STR);

                $stmt->execute();
                        
            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/sucursales.php'; </script>"; 
            }
    } 


}
?>