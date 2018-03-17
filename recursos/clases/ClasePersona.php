<?php
require_once '../db/db.php';

/*/////////////////////////////
Clase abstracta Persona
////////////////////////////*/

 class PersonaDAO
{
    protected $id;
    protected $nombre;  
    protected $correo; 
    protected $fono; 
    protected $contraseña;
    protected $vigencia;

    /*///////////////////////////////////////
    Login 
    //////////////////////////////////////*/
    public static function login($correo,$pwd){

        try{

                
                $pdo = AccesoDB::getCon();

                $sql_login = "select id_coach id, correo_coach correo, pass_coach pass, nom_coach nom, super, 1 tipo
                                from coach 
                                where vig_coach = 1 and correo_coach = :correo
                                union all 
                                select id_cli, correo_cli,pass_cli,nom_cli,0 ,2 tipo
                                from clientes 
                                where vig_cli = 1 and correo_cli = :correo and fec_plan_cli > sysdate()";

                $stmt = $pdo->prepare($sql_login);
                $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
                $stmt->execute();


                $row = $stmt->fetch(PDO::FETCH_ASSOC);
             
                 if ($row["pass"] == $pwd) { 
                        session_start();
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['correo'] = $row['correo'];
                        $_SESSION['nom'] = $row['nom'];
                        $_SESSION['super'] = $row['super'];
                        $_SESSION['tipo'] = $row['tipo'];
                        $_SESSION['start'] = time();
                        $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
                        
                        if ($row['tipo'] == 1 ) {
                            echo"<script type=\"text/javascript\">      window.location='../paginas_co/entrenamiento.php';</script>"; 
                        }else if ($row['tipo'] == 2 ) {
                            echo"<script type=\"text/javascript\">      window.location='../paginas_cli/index_usu.php';</script>"; 
                        }
                        
                        }else { 
                           echo"<script type=\"text/javascript\">alert('Error, favor verifique sus datos e intente nuevamente o comuniquese con un Coach para revisar su vigencia.');window.location='../../index.html';        </script>"; 
                         }

        

        } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>"; 
        }
    }


    /*///////////////////////////////////////
    Actualizar contraseña
    //////////////////////////////////////*/
    public static function actualizar_contraseña($id,$nueva_pass,$tipo){
        try{
                
                $pdo = AccesoDB::getCon();

                if ($tipo == 1) {
                    $sql_act_pass = "UPDATE coach
                            SET pass_coach = :pass WHERE id_coach = :id";
                }elseif ($tipo == 2) {
                   $sql_act_pass = "UPDATE clientes
                            SET pass_cli = :pass WHERE id_cli = :id";
                }
                $stmt = $pdo->prepare($sql_act_pass);
                $stmt->bindParam(":id", $id, PDO::PARAM_STR);
                $stmt->bindParam(":pass", $nueva_pass, PDO::PARAM_STR);
                $stmt->execute();
        
        } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>"; 
        }
    }

}

/*/////////////////////////////
Clase Coach
////////////////////////////*/

class CoachDAO extends PersonaDAO
{
    
    private $super;
    private $color;

    public function __construct($id=null,$nombre=null, $correo=null, $fono=null, $contraseña=null,$vigencia=null,$super=null, $color=null) {
        $this->id  = $id;
        $this->nombre  = $nombre;
        $this->correo  = $correo;
        $this->fono  = $fono;
        $this->contraseña  = $contraseña;
        $this->vigencia  = $vigencia;
        $this->super  = $super;
        $this->color  = $color;
    }

    public function getCoach() {
    return $this->id;
    }


    /*///////////////////////////////////////
    Crear Coach
    //////////////////////////////////////*/
    public function crear_coach() {


        try{
             
                $pdo = AccesoDB::getCon();

                $sql_crear_usu = "INSERT INTO `coach`(`correo_coach`,`pass_coach`,`nom_coach`,`fono_coach`,`vig_coach`,`super`)
                            VALUES(:correo,:pass,:nom,:fono,:vig,:super)";


                $stmt = $pdo->prepare($sql_crear_usu);
                $stmt->bindParam(":correo", $this->correo, PDO::PARAM_STR);
                $stmt->bindParam(":pass", $this->contraseña, PDO::PARAM_STR);
                $stmt->bindParam(":nom", $this->nombre, PDO::PARAM_INT);
                $stmt->bindParam(":fono", $this->fono, PDO::PARAM_STR);
                $stmt->bindParam(":vig", $this->vigencia, PDO::PARAM_BOOL);
                $stmt->bindParam(":super", $this->super, PDO::PARAM_BOOL);
                $stmt->execute();
        

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>"; 
            }
    }


    /*///////////////////////////////////////
    Modificar Coach
    //////////////////////////////////////*/

    public function modificar_coach()  {

        

        try{
                $pdo = AccesoDB::getCon();

                $sql_mod_usu = "update coach
                            set  correo_coach = :correo, nom_coach = :nom, fono_coach = :fono, vig_coach = :vig, color = :color, super = :super
                            where id_coach =:id ";


                $stmt = $pdo->prepare($sql_mod_usu);
                $stmt->bindParam(":correo", $this->correo, PDO::PARAM_STR);
                $stmt->bindParam(":nom", $this->nombre, PDO::PARAM_STR);
                $stmt->bindParam(":fono", $this->fono, PDO::PARAM_INT);
                $stmt->bindParam(":vig", $this->vigencia, PDO::PARAM_BOOL);
                $stmt->bindParam(":color", $this->color, PDO::PARAM_STR);
                $stmt->bindParam(":super", $this->super, PDO::PARAM_BOOL);
                $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
                $stmt->execute();

        

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>"; 
            }
    }


    /*///////////////////////////////////////
    Actualizar contraseña coach
    //////////////////////////////////////*/
    public static function actualizar_contraseña($correo,$nueva_pass){

        try{


                
                $pdo = AccesoDB::getCon();

                $sql_act_pass = "UPDATE coach
                            SET pass_coach = :pass WHERE correo_coach = :correo";

                $stmt = $pdo->prepare($sql_act_pass);
                $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
                $stmt->bindParam(":pass", $nueva_pass, PDO::PARAM_STR);
                $stmt->execute();
        

        } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>"; 
        }
    }





}








/*/////////////////////////////
Clase Cliente
////////////////////////////*/

class ClienteDAO extends PersonaDAO
{
    private $fec_nac;
    private $fec_plan;

    public function __construct($id=null, $correo=null, $contraseña=null, $nombre=null, $fono=null, $fec_nac=null,$fec_plan=null, $vigencia=null) {
        $this->id  = $id;
        $this->correo  = $correo;
        $this->contraseña  = $contraseña;
        $this->nombre  = $nombre;
        $this->fono  = $fono;
        $this->fec_nac=$fec_nac;
        $this->fec_plan=$fec_plan;
        $this->vigencia  = $vigencia;
    }

    public function getCliente() {
    return $this->id;
    }

   /*///////////////////////////////////////
    Crear Cliente
    //////////////////////////////////////*/
    public function crear_cliente() {


        try{
             
                $pdo = AccesoDB::getCon();

                $sql_crear_cli = "INSERT INTO `clientes`(`correo_cli`,`pass_cli`,`nom_cli`,`fono_cli`,`fec_nac_cli`,`fec_plan_cli`,`vig_cli`)
                            VALUES(:correo,:pass,:nom,:fono,:fec_nac,:fec_plan,:vig)";


                $stmt = $pdo->prepare($sql_crear_cli);
                $stmt->bindParam(":correo", $this->correo, PDO::PARAM_STR);
                $stmt->bindParam(":pass", $this->contraseña, PDO::PARAM_STR);
                $stmt->bindParam(":nom", $this->nombre, PDO::PARAM_STR);
                $stmt->bindParam(":fono", $this->fono, PDO::PARAM_INT);
                $stmt->bindParam(":fec_nac", $this->fec_nac, PDO::PARAM_STR);
                $stmt->bindParam(":fec_plan", $this->fec_plan, PDO::PARAM_STR);
                $stmt->bindParam(":vig", $this->vigencia, PDO::PARAM_BOOL);
                $stmt->execute();

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>"; 
            }
    } 




    /*///////////////////////////////////////
    registrar evolucion
    //////////////////////////////////////*/
    public function reg_evo($correo,$fec,$est,$peso) {


        try{
             
                $pdo = AccesoDB::getCon();

                $sql_cli = "select id_cli from clientes where correo_cli = :correo";

                $stmt = $pdo->prepare($sql_cli);
                $stmt->bindParam(':correo', $this->correo, PDO::PARAM_STR);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $sql_evo_cli = "INSERT INTO `evo_cli`(`fec_evo`,`est_evo`,`peso_evo`,`fk_id_cli`)
                            VALUES(:fec,:est,:peso,:cli)";


                $stmt = $pdo->prepare($sql_evo_cli);
                $stmt->bindParam(":fec", $fec, PDO::PARAM_STR);
                $stmt->bindParam(":est", $est, PDO::PARAM_INT);
                $stmt->bindParam(":peso", $peso, PDO::PARAM_INT);
                $stmt->bindParam(":cli", $row['id_cli'], PDO::PARAM_INT);
                $stmt->execute();

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>"; 
            }
    } 

    /*///////////////////////////////////////
    Modificar Cliente
    //////////////////////////////////////*/

    public function modificar_cli($tipo)  {


        try{
                $pdo = AccesoDB::getCon();

                if ($tipo == 1) {
                    $sql_mod_cli = "update clientes
                            set  correo_cli = :correo, nom_cli = :nom, fono_cli = :fono ,fec_nac_cli = :fec_nac,fec_plan_cli = :fec_plan,  vig_cli = :vig where id_cli =:id ";

                            $stmt = $pdo->prepare($sql_mod_cli);
                $stmt->bindParam(":correo", $this->correo, PDO::PARAM_STR);
                $stmt->bindParam(":nom", $this->nombre, PDO::PARAM_STR);
                $stmt->bindParam(":fono", $this->fono, PDO::PARAM_INT);
                $stmt->bindParam(":fec_nac", $this->fec_nac, PDO::PARAM_STR);
                $stmt->bindParam(":fec_plan", $this->fec_plan, PDO::PARAM_STR);
                $stmt->bindParam(":vig", $this->vigencia, PDO::PARAM_BOOL);
                $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
                $stmt->execute();
                }elseif ($tipo == 2) {
                    $sql_mod_cli = "update clientes
                            set  correo_cli = :correo, nom_cli = :nom, fono_cli = :fono,fec_nac_cli = :fec_nac where id_cli =:id ";

                            $stmt = $pdo->prepare($sql_mod_cli);
                $stmt->bindParam(":correo", $this->correo, PDO::PARAM_STR);
                $stmt->bindParam(":nom", $this->nombre, PDO::PARAM_STR);
                $stmt->bindParam(":fono", $this->fono, PDO::PARAM_INT);
                $stmt->bindParam(":fec_nac", $this->fec_nac, PDO::PARAM_STR);
                $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
                $stmt->execute();
                }

                


                
                        
            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>"; 
            }
    }




}




