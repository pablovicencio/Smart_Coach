<?php

require_once '../db/db.php';


class Funciones 
{



    /*///////////////////////////////////////
    Modal Ejercicio
    //////////////////////////////////////*/
        public function ver_ejercicio($cli, $rut) {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select a.id_rut, b.nom_ejer, c.nom_musc, a.rep_rut, a.pausas_rut, 
                        case when a.vel_rut = 1 then 'Lenta' when a.vel_rut = 2 then 'Moderada' when a.vel_rut = 3 then 'Rapida' end vel_rut ,
                        b.nota_ejer, a.nota_rut, SUBSTR(b.link_ejer, 33) video,if(a.circuito=0,concat(series_rut,' Series'),'Circuito') series
                                from rutina a inner join ejercicios b on a.fk_id_ejer = b.id_ejer 
                                inner join musculos c on b.fk_id_musc = c.id_musc
                                where  a.fk_id_cli = :cli and a.id_rut = :rut and a.vig_rut = 1";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);
                $stmt->bindParam(":rut", $rut, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }





    /*///////////////////////////////////////
    Cargar circuito
    //////////////////////////////////////*/
        public function cargar_circuito($cli,$fec, $circuito) {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select a.id_rut, b.nom_ejer, c.nom_musc
                                from rutina a inner join ejercicios b on a.fk_id_ejer = b.id_ejer 
                                inner join musculos c on b.fk_id_musc = c.id_musc
                                where  a.fk_id_cli = :cli and a.fec_rut = :fec and a.vig_rut = 1 and a.circuito = :circ";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);
                $stmt->bindParam(":fec", $fec, PDO::PARAM_STR);
                $stmt->bindParam(":circ", $circuito, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }






    /*///////////////////////////////////////
    Cargar circuitos diario
    //////////////////////////////////////*/
        public function cargar_circuitos($cli,$fec) {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select distinct circuito , series_rut
                        from rutina 
                        where fk_id_cli = :cli and fec_rut = :fec and vig_rut = 1 order by 1";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);
                $stmt->bindParam(":fec", $fec, PDO::PARAM_STR);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }






    /*///////////////////////////////////////
    Cargar evaluacion de dieta
    //////////////////////////////////////*/
        public function cargar_eva_die($cli){

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select CASE a.horario_eva
                            WHEN 0 THEN 'Sin Hambre'
                            WHEN 1 THEN 'Hambre en la Mañana'
                            WHEN 2 THEN 'Hambre en la Media Mañana'
                            WHEN 3 THEN 'Hambre en la Tarde'
                            WHEN 4 THEN 'Hambre en la Noche'
                            END eva, a.seg_dieta_eva, fec_eva
                                                         
                            from eva_dieta a 
                            inner join nut_dieta b on a.fk_eva_dieta = b.id_nut_dieta 
                            where b.vig_nut_dieta = 1 and a.fk_eva_cli = :cli
                            order by fec_eva desc";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }



    /*///////////////////////////////////////
    Cargar coach Dieta
    //////////////////////////////////////*/
        public function coach_Dieta($cli) {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select b.nom_coach, b.fb_coach
                                from nut_dieta a inner join coach b on a.fk_dieta_coach = b.id_coach
                                where  a.fk_dieta_cli =:cli  and a.vig_nut_dieta = 1";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }




    /*///////////////////////////////////////
    Cargar dieta cliente 
    //////////////////////////////////////*/
        public function cargar_dieta($cli,$com) {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select a.id_nut_dieta, d.desc_nut_ali, b.cant_nut_ali,if(e.desc_nut_uni=0,' ',e.desc_nut_uni) uni,e.img_nut_uni, b.nota_nut_det
                                from nut_dieta a, nut_det_dieta b left join nut_uni_med e on b.fk_nut_det_uni = e.id_nut_uni
                                , nut_comidas c, nut_ali d
                                where a.id_nut_dieta = b.fk_nut_dieta and a.vig_nut_dieta = 1 and b.fk_nut_det_com = c.id_nut_com 
                                and b.fk_nut_det_ali = d.id_nut_ali and a.fk_dieta_cli = :cli and b.fk_nut_det_com = :com";
                                                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);
                $stmt->bindParam(":com", $com, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }




    /*///////////////////////////////////////
    Cargar dieta actual carga dieta
    //////////////////////////////////////*/
        public function cargar_dieta_act($cli) {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select c.desc_nut_com, d.desc_nut_ali, b.cant_nut_ali,if(e.desc_nut_uni=0,' ',e.desc_nut_uni) uni, b.nota_nut_det
                                from nut_dieta a, nut_det_dieta b left join nut_uni_med e on b.fk_nut_det_uni = e.id_nut_uni
                                , nut_comidas c, nut_ali d
                                where a.id_nut_dieta = b.fk_nut_dieta and a.vig_nut_dieta = 1 and b.fk_nut_det_com = c.id_nut_com 
                                and b.fk_nut_det_ali = d.id_nut_ali and a.fk_dieta_cli = :cli";
                                                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }





    /*///////////////////////////////////////
    Cargar unidades de medida carga dieta
    //////////////////////////////////////*/
        public function cargar_uni_med_ali() {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select id_nut_uni, desc_nut_uni
                                from nut_uni_med where vig_nut_uni = 1";
                

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }



    /*///////////////////////////////////////
    Cargar alimentos carga dieta
    //////////////////////////////////////*/
        public function cargar_alimentos($gr) {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select id_nut_ali, desc_nut_ali
                                from nut_ali where vig_nut_ali = 1 and fk_id_ali_ga = :gr";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":gr", $gr, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }




    /*///////////////////////////////////////
    Cargar grupos de alimentos carga dieta
    //////////////////////////////////////*/
        public function cargar_grupo_ali() {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select id_nut_grup, desc_nut_grup
                                from nut_gru_ali where vig_nut_grup = 1";
                

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }





    /*///////////////////////////////////////
    Cargar horario comida
    //////////////////////////////////////*/
        public function cargar_horarios($com) {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = 'select CONCAT(DATE_FORMAT(desde_nut_com,"%H:%i"), \'-\', DATE_FORMAT(hasta_nut_com,"%H:%i")) horario
                                from nut_comidas where vig_nut_com = 1 and id_nut_com = :com';
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":com", $com, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchColumn();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }




    /*///////////////////////////////////////
    Cargar comidas para carga dieta
    //////////////////////////////////////*/
        public function cargar_comidas() {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select id_nut_com, desc_nut_com
                                from nut_comidas where vig_nut_com = 1";
                

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }



    /*///////////////////////////////////////
    Cargar alimento para modificar
    //////////////////////////////////////*/
        public function alimento($ali) {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select *
                                from nut_ali where id_nut_ali = :ali";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":ali", $ali, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }






    /*///////////////////////////////////////
    Cargar Alimentos
    //////////////////////////////////////*/
        public function cargar_ali() {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "SELECT a.id_nut_ali,a.desc_nut_ali, b.desc_nut_grup,if(a.vig_nut_ali = 1,'Si','No') vig FROM nut_ali a, nut_gru_ali b  where a.fk_id_ali_ga = b.id_nut_grup";
                

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }


    /*///////////////////////////////////////
    Cargar Grupos de Alimentos
    //////////////////////////////////////*/
        public function cargar_g_a() {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "SELECT id_nut_grup,desc_nut_grup FROM nut_gru_ali where vig_nut_grup = 1";
                

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }



    /*///////////////////////////////////////
    Ver Borg
    //////////////////////////////////////*/
    public function cargar_borg($cli) {


        try{
             
                $pdo = AccesoDB::getCon();

                $sql= "select b.fec_rut, CASE a.esc
                            WHEN 1 THEN 'Muy, muy ligero'
                            WHEN 2 THEN 'Muy ligero'
                            WHEN 3 THEN 'Ligero'
                            WHEN 4 THEN 'Moderado'
                            WHEN 5 THEN 'Un poco pesado'
                            WHEN 6 THEN 'Pesado'
                            WHEN 7 THEN 'Muy pesado'
                            WHEN 8 THEN 'Extremadamente pesado'    
                        END esc, a.fec_esc 
                        from esc_borg a inner join rutina b on a.fk_esc_rut = b.id_rut 
                        where fk_id_cli =  :cli order by 1";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);

                $stmt->execute();
                $response = $stmt->fetchAll();
                return $response;
        

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/entrenamiento.php';</script>"; 
            }
    }









        /*///////////////////////////////////////
            restablecer contraseña
        //////////////////////////////////////*/
        public function res_pass($mail,$new_pass, $val){

            try{
                //echo generaPass();
                //$pass = generaPass();
                
                $pdo = AccesoDB::getCon();

                if ($val == 1) {
                    $sql = "UPDATE clientes
                            SET pass_cli = MD5(:pass) WHERE correo_cli = :cli";
                }elseif ($val == 2) {
                    $sql = "UPDATE coach
                            SET pass_coach = MD5(:pass) WHERE correo_coach = :cli";
                }

                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":pass", $new_pass, PDO::PARAM_STR);
                $stmt->bindParam(":cli", $mail, PDO::PARAM_STR);
                $stmt->execute();
        

            } catch (Exception $e) {
               echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>"; 
            }
        }




    /*///////////////////////////////////////
    Validar Correo para resetear contraseña
    //////////////////////////////////////*/
    public function validacion($mail) {


        try{
             
                $pdo = AccesoDB::getCon();

                $sql= " select 2 id from clientes where correo_cli = :correo
                        union all
                        select 1 id from coach where correo_coach = :correo ";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":correo", $mail, PDO::PARAM_INT);

                $stmt->execute();
                $response = $stmt->fetchColumn();
                return $response;
        

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>"; 
            }
    }





   /*///////////////////////////////////////
    Ver Evaluación
    //////////////////////////////////////*/
    public function cargar_eva($cli) {


        try{
             
                $pdo = AccesoDB::getCon();

                $sql= "SELECT
                            `evaluacion`.`enf_car_desc_eva`,
                            `evaluacion`.`les_ost_desc_eva`,
                            if(`evaluacion`.`enf_tab_eva`= 1,'Tabaquismo ',' ') tab,
                            if(`evaluacion`.`enf_diab_eva`= 1,'Diabetes ',' ') diab,
                            if(`evaluacion`.`enf_asma_eva`= 1,'Asma ',' ') asma,
                            if(`evaluacion`.`enf_hip_eva`= 1,'Hipertensión ','No') hip,
                            `evaluacion`.`porc_sent_eva`,
                        case
                            when `evaluacion`.`obj_ent_eva`= 1 then 'Aumentar Masa'
                            when `evaluacion`.`obj_ent_eva`= 2 then 'Disminuir % Grasa'
                            when `evaluacion`.`obj_ent_eva`= 3 then 'Disminuir tu % de grasa y aumentar levemente la masa muscular simultáneamente'
                            when `evaluacion`.`obj_ent_eva`= 4 then 'Sólo mejorar su condición física de manera general'
                        end obj,
                            `evaluacion`.`alerg_ali_desc_eva`,
                            `evaluacion`.`into_ali_desc_eva`,
                            `evaluacion`.`alco_desc_ali_eva`,
                        case
                            when `evaluacion`.`apet_eva` = 0 then 'Normal'
                            when `evaluacion`.`apet_eva` = 1 then 'Ansioso'
                            when `evaluacion`.`apet_eva` = 2 then 'Disminuido'
                        end apet,
                            `evaluacion`.`digest_desc_eva`,
                            `evaluacion`.`agua_eva`,
                            `evaluacion`.`act_fisica_desc_eva`,
                            `evaluacion`.`desayuno_desc_eva`,
                            `evaluacion`.`colacion_desc_eva`,
                            `evaluacion`.`almuerzo_desc_eva`,
                            `evaluacion`.`once_desc_eva`,
                            `evaluacion`.`cena_desc_eva`,
                            `evaluacion`.`enc_frec_pan_eva`,
                            `evaluacion`.`enc_frec_frut_eva`,
                            `evaluacion`.`enc_frec_ens_eva`,
                            `evaluacion`.`ens_frec_huevo_eva`,
                            `evaluacion`.`enc_frec_pes_eva`,
                            `evaluacion`.`enc_frec_leg_eva`,
                            `evaluacion`.`enc_frec_golo_eva`,
                            `evaluacion`.`enc_frec_frit_eva`,
                            `evaluacion`.`enc_frec_azu_eva`
                        FROM `smart_coach`.`evaluacion`
                        where fk_id_cli_eva = :cli";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);

                $stmt->execute();
                $response = $stmt->fetchAll();
                return $response;
        

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>"; 
            }
    }





    /*///////////////////////////////////////
    Registrar Evaluación
    //////////////////////////////////////*/
    public function reg_evaluacion($enf, $les, $enf_cro_tab, $enf_cro_dia, $enf_cro_asm, $enf_cro_hip, $dia_sen, $obj, $aler_ali, $into_ali, $alco, $apet, $def, $agua, $act_fis, $enc_rec_des, $enc_rec_col, $enc_rec_alm, $enc_rec_once, $enc_rec_cena, $enc_frec_pan, $enc_frec_fru, $enc_frec_ens, $enc_frec_hue, $enc_frec_pes, $enc_frec_leg, $enc_frec_gol, $enc_frec_fri, $enc_frec_azu, $id_cli) {


        try{
             
                $pdo = AccesoDB::getCon();

                $sql= "INSERT INTO `smart_coach`.`evaluacion`(`enf_car_desc_eva`,`les_ost_desc_eva`,`enf_tab_eva`,`enf_diab_eva`,`enf_asma_eva`,`enf_hip_eva`,`porc_sent_eva`,`obj_ent_eva`,`alerg_ali_desc_eva`,`into_ali_desc_eva`,`alco_desc_ali_eva`,`apet_eva`,`digest_desc_eva`,`agua_eva`,`act_fisica_desc_eva`,`desayuno_desc_eva`,`colacion_desc_eva`,`almuerzo_desc_eva`,`once_desc_eva`,`cena_desc_eva`,`enc_frec_pan_eva`,`enc_frec_frut_eva`,`enc_frec_ens_eva`,`ens_frec_huevo_eva`,`enc_frec_pes_eva`,`enc_frec_leg_eva`,`enc_frec_golo_eva`,`enc_frec_frit_eva`,`enc_frec_azu_eva`,`fk_id_cli_eva`)
                VALUES(:enf, :les, :enf_cro_tab, :enf_cro_dia, :enf_cro_asm, :enf_cro_hip, :dia_sen, :obj, :aler_ali, :into_ali, :alco, :apet, :def, :agua, :act_fis, :enc_rec_des, :enc_rec_col, :enc_rec_alm, :enc_rec_once, :enc_rec_cena, :enc_frec_pan, :enc_frec_fru, :enc_frec_ens, :enc_frec_hue, :enc_frec_pes, :enc_frec_leg, :enc_frec_gol, :enc_frec_fri, :enc_frec_azu, :id_cli);
";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":enf", $enf, PDO::PARAM_STR);
                $stmt->bindParam(":les", $les, PDO::PARAM_STR);
                $stmt->bindParam(":enf_cro_tab", $enf_cro_tab, PDO::PARAM_BOOL);
                $stmt->bindParam(":enf_cro_dia", $enf_cro_dia, PDO::PARAM_BOOL);
                $stmt->bindParam(":enf_cro_asm", $enf_cro_asm, PDO::PARAM_BOOL);
                $stmt->bindParam(":enf_cro_hip", $enf_cro_hip, PDO::PARAM_BOOL);
                $stmt->bindParam(":dia_sen", $dia_sen, PDO::PARAM_INT);
                $stmt->bindParam(":obj", $obj, PDO::PARAM_INT);
                $stmt->bindParam(":aler_ali", $aler_ali, PDO::PARAM_STR);
                $stmt->bindParam(":into_ali", $into_ali, PDO::PARAM_STR);
                $stmt->bindParam(":alco", $alco, PDO::PARAM_STR);
                $stmt->bindParam(":apet", $apet, PDO::PARAM_INT);
                $stmt->bindParam(":def", $def, PDO::PARAM_STR);
                $stmt->bindParam(":agua", $agua, PDO::PARAM_INT);
                $stmt->bindParam(":act_fis", $act_fis, PDO::PARAM_STR);
                $stmt->bindParam(":enc_rec_des", $enc_rec_des, PDO::PARAM_STR);
                $stmt->bindParam(":enc_rec_col", $enc_rec_col, PDO::PARAM_STR);
                $stmt->bindParam(":enc_rec_alm", $enc_rec_alm, PDO::PARAM_STR);
                $stmt->bindParam(":enc_rec_once", $enc_rec_once, PDO::PARAM_STR);
                $stmt->bindParam(":enc_rec_cena", $enc_rec_cena, PDO::PARAM_STR);
                $stmt->bindParam(":enc_frec_pan", $enc_frec_pan, PDO::PARAM_INT);
                $stmt->bindParam(":enc_frec_fru", $enc_frec_fru, PDO::PARAM_INT);
                $stmt->bindParam(":enc_frec_ens", $enc_frec_ens, PDO::PARAM_INT);
                $stmt->bindParam(":enc_frec_hue", $enc_frec_hue, PDO::PARAM_INT);
                $stmt->bindParam(":enc_frec_pes", $enc_frec_pes, PDO::PARAM_INT);
                $stmt->bindParam(":enc_frec_leg", $enc_frec_leg, PDO::PARAM_INT);
                $stmt->bindParam(":enc_frec_gol", $enc_frec_gol, PDO::PARAM_INT);
                $stmt->bindParam(":enc_frec_fri", $enc_frec_fri, PDO::PARAM_INT);
                $stmt->bindParam(":enc_frec_azu", $enc_frec_azu, PDO::PARAM_INT);
                $stmt->bindParam(":id_cli", $id_cli, PDO::PARAM_INT);



                $stmt->execute();
        

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>"; 
            }
    }



    /*///////////////////////////////////////
    Cargar coach rutina
    //////////////////////////////////////*/
        public function coach_rutina($cli,$fec) {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select distinct b.nom_coach, b.fb_coach
                                from rutina a inner join coach b on a.fk_id_coach = b.id_coach
                                where  a.fk_id_cli =:cli and a.fec_rut = :fec and a.vig_rut = 1";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);
                $stmt->bindParam(":fec", $fec, PDO::PARAM_STR);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }




    /*///////////////////////////////////////
    Cargar datos para modificar coach
    //////////////////////////////////////*/
        public function cargar_datos_co($co) {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select nom_coach, correo_coach, fono_coach,vig_coach,super,fb_coach,tipo_coach from coach where id_coach = :co";
                                                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":co", $co, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }



        /*///////////////////////////////////////
        Cargar coach para modificar
        //////////////////////////////////////*/
        public function cargar_co($co) {

            try{
                
                
                $pdo = AccesoDB::getCon();


                switch ($co) {
                    case 0:
                        $sql = "SELECT * FROM coach order by nom_coach";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        break;
                    
                    default:
                       $sql = "SELECT * FROM coach where id_coach = :co order by nom_coach";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(":co", $co, PDO::PARAM_INT);
                        $stmt->execute();
                        break;
                }


                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php;</script>";
            }
        }


        /*///////////////////////////////////////
        Validar contraseña para cambio
        //////////////////////////////////////*/
        public function old_pass($id,$tipo) {

            try{
                
                
                $pdo = AccesoDB::getCon();

                if ($tipo == 1) {
                   $sql = "SELECT pass_coach FROM coach where id_coach = :id";
                }elseif ($tipo == 2) {
                    $sql = "SELECT pass_cli FROM clientes where id_cli = :id";
                }

                


                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchColumn();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>";
            }
        }


    /*///////////////////////////////////////
    Cargar entrenemiento diario
    //////////////////////////////////////*/
        public function cargar_entrenamiento($cli,$fec) {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select a.id_rut, b.nom_ejer, c.nom_musc
                                from rutina a inner join ejercicios b on a.fk_id_ejer = b.id_ejer 
                                inner join musculos c on b.fk_id_musc = c.id_musc
                                where  a.fk_id_cli = :cli and a.fec_rut = :fec and a.vig_rut = 1 and circuito = 0 ";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);
                $stmt->bindParam(":fec", $fec, PDO::PARAM_STR);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }




    /*///////////////////////////////////////
    Cargar ejercicio para modificar
    //////////////////////////////////////*/
        public function ejercicio($ejer) {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select *, SUBSTR(link_ejer, 33) video
                                from ejercicios where id_ejer = :ejer";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":ejer", $ejer, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }



    /*///////////////////////////////////////
    Cargar tabla de Ejercicios
    //////////////////////////////////////*/
        public function cargar_ejer() {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select a.id_ejer, a.nom_ejer,b.nom_musc,a.link_ejer,a.nota_ejer, if(a.vig_ejer = 1,'Si','No') vig
                                from ejercicios a inner join musculos b on a.fk_id_musc = b.id_musc";
                

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }


    /*///////////////////////////////////////
    Cargar evolución del cliente
    //////////////////////////////////////*/
        public function cargar_evo_cli($cli) {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select id_evo, fec_evo, est_evo, peso_evo, ROUND((peso_evo/((est_evo/100)*(est_evo/100))),2) IMC from evo_cli where fk_id_cli = :cli order by 1 desc";
                                                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }



    /*///////////////////////////////////////
    Cargar datos para modificar cliente
    //////////////////////////////////////*/
        public function cargar_datos_cli($cli) {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select a.nom_cli, a.correo_cli, a.fono_cli, a.fec_nac_cli,  (select est_evo  from evo_cli where fk_id_cli = a.id_cli order by fec_evo asc limit 1) est,
                                (select peso_evo  from evo_cli where fk_id_cli = a.id_cli order by fec_evo asc limit 1) peso ,a.fec_plan_cli, a.vig_cli, a.tipo_cli, a.servicio_cli
                                from clientes a where a.id_cli = :cli";
                                                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }





    /*///////////////////////////////////////
    Ver rutina Día
    //////////////////////////////////////*/
        public function ver_rutina($cli, $fec) {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select a.id_rut, a.fk_id_ejer, b.nom_ejer, c.nom_musc, a.series_rut, a.rep_rut, a.pausas_rut,case when a.vel_rut = 1 then 'Lenta' when a.vel_rut = 2 then 'Moderada' when a.vel_rut = 3 then 'Rapida' end vel_rut,a.nota_rut,ifnull(a.circuito,0) circuito
                                    from rutina a inner join ejercicios b on a.fk_id_ejer = b.id_ejer 
                                    inner join musculos c on b.fk_id_musc = c.id_musc
                                    where a.fk_id_cli = :cli and a.fec_rut = :fec and a.vig_rut = 1 order by a.circuito";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);
                $stmt->bindParam(":fec", $fec, PDO::PARAM_STR);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }



    /*///////////////////////////////////////
    Cargar Ejercicio x musculo
    //////////////////////////////////////*/
        public function cargar_ejercicios($musc, $cli) {

            try{
                
                
                $pdo = AccesoDB::getCon();

        
                        $sql = "SELECT a.id_ejer, a.nom_ejer, a.link_ejer, a.nota_ejer, a.fk_id_musc, 
                        a.vig_ejer, a.tipo_ejer
                        FROM ejercicios a, clientes b WHERE a.tipo_ejer = b.tipo_cli 
                        and b.id_cli = :cli and  fk_id_musc = :musc";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":musc", $musc, PDO::PARAM_INT);
                $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }



    /*///////////////////////////////////////
    Cargar Musculos
    //////////////////////////////////////*/
        public function cargar_musculos() {

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "SELECT id_musc, nom_musc FROM musculos order by nom_musc";
                

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }


        /*///////////////////////////////////////
        Cargar cliente para modificar
        //////////////////////////////////////*/
        public function cargar_cli($cli) {

            try{
                
                
                $pdo = AccesoDB::getCon();


                switch ($cli) {
                    case 0:
                        $sql = "SELECT * FROM clientes order by nom_cli";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        break;
                    
                    default:
                       $sql = "SELECT * FROM clientes where id_cli = :cli order by nom_cli";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);
                        $stmt->execute();
                        break;
                }
                

                

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php;</script>";
            }
        }

    /*///////////////////////////////////////
    Cargar clientes
    //////////////////////////////////////*/
        public function cargar_clientes_dd($ser) {

            try{
                
                
                $pdo = AccesoDB::getCon();

                if ($ser == 1) {
                    $sql = "SELECT id_cli, nom_cli FROM clientes where vig_cli = 1 and servicio_cli in (1,3) order by nom_cli";
                }else if ($ser == 2) {
                    $sql = "SELECT id_cli, nom_cli FROM clientes where vig_cli = 1 and servicio_cli in (2,3) order by nom_cli";
                }  
                

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }



    /*///////////////////////////////////////
    Validar correo nuevo
    //////////////////////////////////////*/
        public function validar_correo($correo, $id) {

            try{
                $pdo = AccesoDB::getCon();

                switch ($id) {
                    case '1':
                        $sql = "SELECT correo_coach FROM coach where correo_coach = :correo";
                        break;
                    
                    case '2':
                        $sql = "SELECT correo_cli FROM clientes where correo_cli = :correo";
                        break;
                }

                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
                $stmt->execute();

                $response = $stmt->fetchColumn();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/usuarios.php';</script>";
            }
        }

    /*///////////////////////////////////////
    Generar password
    //////////////////////////////////////*/
    public function generaPass(){
            //Se define una cadena de caractares. Te recomiendo que uses esta.
            $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
            //Obtenemos la longitud de la cadena de caracteres
            $longitudCadena=strlen($cadena);
             
            //Se define la variable que va a contener la contraseña
            $pass = "";
            //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
            $longitudPass=6;
             
            //Creamos la contraseña
            for($i=1 ; $i<=$longitudPass ; $i++){
                //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
                $pos=rand(0,$longitudCadena-1);
             
                //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
                $pass .= substr($cadena,$pos,1);
            }
            return $pass;
        }



        /*//////////////////////////////////////
         //////////////////////////////////////
         ///////////////////////////////////////
            Notificaciones mail
        //////////////////////////////////////
        //////////////////////////////////////
        //////////////////////////////////////*/

        /*///////////////////////////////////////
            enviar mail nuevo usuario
        //////////////////////////////////////*/
        public function enviar_correo_pass($nombre,$mail_usu,$nueva_pass) {
            try{
                $mail = new PHPMailer(true);
                                                                // Configuramos el protocolo SMTP con autenticación

                $mail->IsSMTP();

                $mail->SMTPAuth = true;
                                                                // Configuración del servidor SMTP
                $mail->SMTPSecure = 'ssl';

                $mail->Port = 465;
                $mail->Host = 'smtp.gmail.com';
                $mail->Username   = 'pablo.vicencioc@gmail.com';
                $mail->Password = 'jklas123';




                                                                $mail->FromName = "Smart Coach";

                                                                $mail->AddAddress($mail_usu); 
                    $mail->Subject = $nombre.", te damos la bienvenida a Smart Coach"; 
                    $mail->MsgHTML(' 
                    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
                    
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                       <title>'.$nombre.'<br>te damos la bienvenida a Smart Coach</title> 
                    </head> 
                    <body style="font: Verdana, Geneva, sans-serif">
 
                    Sus credenciales para ingresar son las siguientes:<p>
                    Usuario:    '.$mail_usu.'<br /> 
                    Contraseña: '.$nueva_pass.'<p>
                    Le recomendamos cambiar su contraseña al ingresar.

<p>         
                    
</body>
                    </html> 
                    '); 
                    $mail->CharSet = 'UTF-8';
                                        $exito = $mail->Send(); // Envía el correo.
        } catch (Exception $e) {
                throw $e;
        }
        }


        /*///////////////////////////////////////
            Actualizar contraseña usuario
        //////////////////////////////////////*/
        public function enviar_reset_pass($mail,$nueva_pass) {
            

            try{



        $to = $mail;
        $subject = "Reestablecer contraseña";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


                    
                    $message = ' 
                    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
                    
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                       <title>Reestablecer Contraseña</title> 
                    </head> 
                    <body style="font: Verdana, Geneva, sans-serif">
 
                    Estimad@ usuario se ha actualizado la contraseña de su cuenta Smart Coach.<p>
                    Contraseña: '.$nueva_pass.'<p>

<p>         
                    
</body>
                    </html> 
                    ';
                    $exito = mail($to, $subject, $message, $headers);


// if($exito){
//                                                     echo"<script type=\"text/javascript\">alert('Mensaje enviado correctamente');       window.location='index.html';</script>"; 
//                                         }else{
//                                             echo"<script type=\"text/javascript\">alert('Error, verifique los datos ingresados'); window.location='../../index.html';</script>";  
//                                         }

        } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../reset_password.html';</script>";
        }
        }











//funciones paulashes






    ////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////


        /*///////////////////////////////////////
        Validar usuario para documentar cita
        //////////////////////////////////////*/
        public function validar_est_cita($id_cita) {

            try{
                
                
                $pdo = AccesoDB::getCon();


                $sql = "select a.fk_id_estilista usu from citas a, grupos_usuarios u where a.fk_id_estilista = u.fk_id_usu and  u.fk_id_grupo = 1 and id_cita = :id_cita";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id_cita", $id_cita, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetch(PDO::FETCH_ASSOC);
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/index_usuario.php';</script>";
            }
        }


        /*///////////////////////////////////////
        Validar sucursal para quitar vigencia
        //////////////////////////////////////*/
        public function vigencia_suc($id_suc) {

            try{
                
                
                $pdo = AccesoDB::getCon();


                $sql = "select count(id_cita) citas from citas where fk_suc_cita = :id_suc and estado_cita in (1,2) and fec_cita > curdate()";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id_suc", $id_suc, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetch(PDO::FETCH_ASSOC);
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/index_usuario.php';</script>";
            }
        }


        /*///////////////////////////////////////
        Cargar Datos cita
        //////////////////////////////////////*/
        public function cargar_datos_cita($id_cita) {

            try{
                
                
                $pdo = AccesoDB::getCon();


                $sql = "select a.fec_cita, b.rut_cli, b.fono_cli, b.mail_cli,a.hora_cita,a.hora_ter_cita, ubi.nom_suc ubi, est.desc_item est , a.estado_cita, a.obs_age, u.nom_usu
                        from citas a, clientes b, sucursales ubi, parametros est, usuarios u
                        where  a.fk_id_cli = b.id_cli
                        and a.fk_suc_cita = ubi.id_suc and ubi.vigencia_suc = 1
                        and a.estado_cita = est.cod_item and est.cod_grupo = 1
                        and a.fk_id_estilista = u.id_usu
                        and id_cita = :id_cita";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id_cita", $id_cita, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/index_usuario.php';</script>";
            }
        }


        /*///////////////////////////////////////
        Cargar atenciones cliente
        //////////////////////////////////////*/
        public function cargar_atenciones($id_cita) {

            try{
                
                
                $pdo = AccesoDB::getCon();


                $sql = "select b.nom_cli, a.fec_cita, e.nom_usu, ubi.nom_suc ubi, a.obs_age, e.color_usu
                        from citas a, clientes b, sucursales ubi, usuarios e
                        where  a.fk_id_cli = b.id_cli
                        and a.estado_cita =  3
                        and a.fk_suc_cita = ubi.id_suc and ubi.vigencia_suc = 1
                        and a.fk_id_estilista = e.id_usu and b.id_cli = (select id_cli from citas where id_cita = :id_cita)
                        order by a.fec_cita;";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id_cita", $id_cita, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                 echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/index_usuario.php';</script>";
            }
        }


        /*///////////////////////////////////////
        Definir color de estado
        //////////////////////////////////////*/
        public function colorestado($estado) {

            try{
                
                if ($estado == "Agendada"){
                    $est = '<td style="background:#FE2E2E ; color:#FFFFFF">'.$estado.'</td> ';
                }else if ($estado == "Confirmada"){
                    $est = '<td style="background:#DBA901 ; color:#FFFFFF">'.$estado.'</td> ';
                }else if ($estado == "Atendida"){
                    $est = '<td style="background:#0B610B ; color:#FFFFFF">'.$estado.'</td> ';
                }else if ($estado == "Anulada"){
                    $est = '<td style="background:#0B243B ; color:#FFFFFF">'.$estado.'</td> ';
                }else {
                    $est = '<td>'.$estado.'</td> ';
                        }
                return $est;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/index_usuario.php';</script>";
            }
        }


        /*///////////////////////////////////////
        Cargar citas
        //////////////////////////////////////*/
        public function cargar_citas($us, $fecha) {

            try{
                
                
                $pdo = AccesoDB::getCon();

                switch ($us) {
                    case 0:
                       $sql = "select a.id_cita,b.nom_cli,b.fono_cli, a.hora_cita, a.hora_ter_cita,  c.nom_usu, d.nom_suc ubicacion, e.desc_item estado,c.color_usu
                            from citas a, clientes b, usuarios c, sucursales d, parametros e
                            where a.fk_id_cli = b.id_cli  and a.fk_suc_cita = d.id_suc and d.vigencia_suc = 1
                            and a.estado_cita = e.cod_item and e.cod_grupo = 1 and e.vigencia = 1  and a.fk_id_estilista = c.id_usu
                            and a.fec_cita = :fecha order by hora_cita;";

                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);
                        break;

                    default:
                        $sql = "select a.id_cita,b.nom_cli,b.fono_cli, a.hora_cita, a.hora_ter_cita,  c.nom_usu, d.nom_suc ubicacion, e.desc_item estado,c.color_usu
                            from citas a, clientes b, usuarios c, sucursales d, parametros e
                            where a.fk_id_cli = b.id_cli  and a.fk_suc_cita = d.id_suc and d.vigencia_suc = 1
                            and a.estado_cita = e.cod_item and e.cod_grupo = 1 and e.vigencia = 1  and a.fk_id_estilista = c.id_usu
                            and a.fk_id_estilista = :usu and a.fec_cita = :fecha order by hora_cita;";
                            
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(":usu", $us, PDO::PARAM_INT);
                            $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);
                        break;
                }
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/index_usuario.php';</script>";
            }
        }


        /*///////////////////////////////////////
        Control Choque de citas
        //////////////////////////////////////*/
        public function control_cita($fec_cita,$hora_cita,$hora_ter,$id_cli,$id_estilista) {

            try{

                $hora_cita = $hora_cita.":00";
                $hora_ter = $hora_ter.":00";
                
                $pdo = AccesoDB::getCon();


                $sql = "select id_cita from citas where fec_cita = :fec_cita 
                        and (cast(hora_cita as time) >= :hora_cita and cast(hora_cita as time) < :hora_ter)
                        and (fk_id_cli = :id_cli or fk_id_estilista = :id_estilista) and estado_cita <> 4
                        union all
                        select id_cita from citas where fec_cita = :fec_cita1
                        and (cast(hora_ter_cita as time) > :hora_cita1 and cast(hora_ter_cita as time) <= :hora_ter1)
                        and (fk_id_cli = :id_cli1 or fk_id_estilista = :id_estilista1) and estado_cita <> 4";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":fec_cita", $fec_cita, PDO::PARAM_STR);
                $stmt->bindParam(":hora_cita", $hora_cita, PDO::PARAM_STR);
                $stmt->bindParam(":hora_ter", $hora_ter, PDO::PARAM_STR);
                $stmt->bindParam(":id_cli", $id_cli, PDO::PARAM_INT);
                $stmt->bindParam(":id_estilista", $id_estilista, PDO::PARAM_INT);

                $stmt->bindParam(":fec_cita1", $fec_cita, PDO::PARAM_STR);
                $stmt->bindParam(":hora_cita1", $hora_cita, PDO::PARAM_STR);
                $stmt->bindParam(":hora_ter1", $hora_ter, PDO::PARAM_STR);
                $stmt->bindParam(":id_cli1", $id_cli, PDO::PARAM_INT);
                $stmt->bindParam(":id_estilista1", $id_estilista, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/agenda.php';</script>";
            }
        }



    /*///////////////////////////////////////
    Cargar Estilistas
    //////////////////////////////////////*/
        public function cargar_estilistas() {

            try{
                
                
                $pdo = AccesoDB::getCon();


                $sql = "SELECT a.id_usu, a.nom_usu
                        FROM usuarios a inner join grupos_usuarios b on a.id_usu = b.fk_id_usu inner join grupos c on c.id_grupo = b.fk_id_grupo where c.id_grupo = 1 and a.vigencia_usu = 1";

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/index_usuario.php';</script>";
            }
        }










        /*///////////////////////////////////////
        Cargar sucursal para modificar
        //////////////////////////////////////*/
        public function cargar_suc($id) {

            try{
                
                
                $pdo = AccesoDB::getCon();


                $sql = "SELECT id_suc, nom_suc, dir_suc,  fono_suc, vigencia_suc FROM sucursales where id_suc = :id";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/sucursales.php';</script>";
            }
        }

    /*///////////////////////////////////////
    Cargar sucursales
    //////////////////////////////////////*/
        public function cargar_sucursales($i) {

            try{
                
                
                $pdo = AccesoDB::getCon();

                switch ($i) {
                    case 0:
                        $sql = "SELECT id_suc, nom_suc, dir_suc,  fono_suc, if(vigencia_suc=1,'Si','No') as vigencia_suc FROM sucursales order by nom_suc";
                        break;

                    case 1:
                        $sql = "SELECT id_suc, nom_suc FROM sucursales where vigencia_suc = 1 order by nom_suc";
                        break;
                    
                    
                }


                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/sucursales.php';</script>";
            }
        }

    /*///////////////////////////////////////
    Validar datos sucursal
    //////////////////////////////////////*/
        public function validar_suc($nom, $dir) {

            try{
                $pdo = AccesoDB::getCon();

                $sql = "SELECT count(id_suc) FROM sucursales where nom_suc = :nom or dir_suc = :dir";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
                $stmt->bindParam(":dir", $dir, PDO::PARAM_STR);
                $stmt->execute();

                $response = $stmt->fetchColumn();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/sucursales.php';</script>";
            }
        }

    /*///////////////////////////////////////
    Validar rut cliente
    //////////////////////////////////////*/
        public function validar_rut($rut) {

            try{
                $pdo = AccesoDB::getCon();

                $sql = "SELECT rut_cli FROM clientes where rut_cli = :rut";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":rut", $rut, PDO::PARAM_STR);
                $stmt->execute();

                $response = $stmt->fetchColumn();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }

    


    /*///////////////////////////////////////
    Cargar usuario para modificar
    //////////////////////////////////////*/
        public function cargar_usu($id) {

            try{
                
                
                $pdo = AccesoDB::getCon();


                $sql = "SELECT * FROM usuarios where  id_usu = :id";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/usuarios.php';</script>";
            }
        }



   


    /*///////////////////////////////////////
    Cargar grupos
    //////////////////////////////////////*/
        public function cargar_grupos() {

            try{
                
                
                $pdo = AccesoDB::getCon();


                $sql = "SELECT * FROM grupos where vigencia_grupo = 1";

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/index_usuario.php';</script>";
            }
        }


    /*///////////////////////////////////////
    Cargar usuarios
    //////////////////////////////////////*/
        public function cargar_usuarios() {

            try{
                
                
                $pdo = AccesoDB::getCon();


                $sql = "SELECT a.id_usu, a.nom_usu, a.mail_usu,a.color_usu, a.fono_usu, c.desc_grupo, if(a.vigencia_usu=1,'Si','No') as vigencia_usu
                        FROM usuarios a inner join grupos_usuarios b on a.id_usu = b.fk_id_usu inner join grupos c on c.id_grupo = b.fk_id_grupo";

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/usuarios.php';</script>";
            }
        }














         









}
