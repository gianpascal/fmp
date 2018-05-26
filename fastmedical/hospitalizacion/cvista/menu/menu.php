<?php
//session_start();
//require_once('../../ccontrol/control/ActionLogin.php');
//$oActionLogin = new ActionLogin();
//$Rs=$oActionLogin->getCargaMenu();
//print_r($Rs);

$alineacion=1;
$path='../menu/';
$id_sistema='1';
//var_dump($_SESSION);
$num = count($_SESSION['permiso_formulario']);

if($num>0) {
    $dep_ant=-1;
    $depende_ant=-1;
    $menu=0;
    $nivel_anterior=-1;
    $count_menu=0;
    $count[]='';
    $numero[]='';

    ?>
<script type="text/javascript">
    stm_bm(["menu4878",830,"","<?php echo $path?>blank.gif",0,"","",<?php echo $alineacion?>,0,25,0,50,1,0,0,"","",0,0,1,2,"default","hand",""],this);
    stm_bp("p0",[0,4,0,0,0,2,18,7,100,"",-2,"",-2,50,0,0,"#799BD8","FFFFFF","<?php echo $path?>../../../../medifacil_front/imagen/menu/bg_menu.png",3,0,0,"#000000"]);

    <?php
    $primero=1;
    $var=0;

    foreach($_SESSION['permiso_formulario'] as $indice => $valor) {

        $row = $_SESSION['permiso_formulario'][$indice];

        $file=$row['vfile_formulario'];

        if($row['idepende_formulario']<>$dep_ant) {
            if($row['inivel_formulario']<$nivel_anterior) {
                $x=$nivel_anterior-$row['inivel_formulario'];
                while($x>0) {
                    ?>

stm_ep();

                    <?php
                    $x--;
                }
                $menu--;
                $pri=0;
            }
            else {
                $pri=1;
            }
            $nivel_anterior=$row['inivel_formulario'];
            if(isset ($numero[$row['idepende_formulario']])) { // se pone isset porque no esta inicializado
                if(trim($numero[$row['idepende_formulario']])=='') {
                    $numero[$row['idepende_formulario']]=$menu;
                }
            }else {
                $numero[$row['idepende_formulario']]=$menu;
            }

            $dep_ant=$row['idepende_formulario'];
            $band=1;
            if(isset ($count[$row['idepende_formulario']])) {
                if(trim($count[$row['idepende_formulario']])=='') {
                    $count[$row['idepende_formulario']]=0;
                }
                else {
                    $count[$row['idepende_formulario']]++;
                }
            }else {
                //$count[$row['idepende_formulario']]++; se pone =1 porque recien se inicializa
                $count[$row['idepende_formulario']]=1;

            }


            //if($row['orden_formulario']==1 and $row['inivel_formulario']==1)
            if($pri==1 and $row['inivel_formulario']==1) {
                ?>

stm_bp("p1",[1,4,0,0,0,4,18,7,100,"",-2,"",-2,50,0,0,"#799BD8","#001860","",3,1,1,""]);

                <?php
                $pri=0;
            }
            //elseif($row['orden_formulario']==1 and $row['idepende_formulario']<>1 and $row['idepende_formulario']<>0)
            elseif($pri==1 and $row['idepende_formulario']<>1 and $row['idepende_formulario']<>0) {
                ?>

stm_bpx("p<?php echo $numero[$row['idepende_formulario']]?>","p1",[1,2,2]);

                <?php
                $pri=0;
            }
        }
        else {
            $band=0;

            $count[$row['idepende_formulario']]++;
        }

        /////////////////////////
        /////// CABECERAS ///////
        /////////////////////////
        if($row['bfinal_formulario']==0) {

            if($row['inivel_formulario']==0 and $primero==1) //$row['orden_formulario']==1)
            {
                ?>

stm_ai("p<?php echo $row['inivel_formulario']?>i<?php echo $count[$row['idepende_formulario']]?>",[0,"<?php echo $row['vnom_formulario']?>","","",-1,-1,0,"","_self","","","","<?php echo $path?>tclarrow.gif",18,7,0,"<?php echo $path?>flecha_derecha.gif","<?php echo $path?>flecha_derecha.gif",7,7,0,0,1,"#FFFFF7",1,"B5BED6",1,"","<?php echo $path?>../../../../medifacil_front/imagen/menu/bg_menu_on.png",2,3,0,0,"#FFFFF7","#000000","#FFffFF","#FFFFFF","bold 10pt Arial","bold 10pt Arial",0,0],60,20);
stm_bp("p1",[1,4,0,0,0,4,18,7,100,"",-2,"",-2,50,0,0,"#799BD8","#001860","",3,1,1,""]);

                <?php
                $primero=0;
            }
            else {
                ?>
stm_aix("p<?php echo $numero[$row['idepende_formulario']]?>i<?php echo $count[$row['idepende_formulario']]?>","p0i0",[0,"<?php echo $row['vnom_formulario']?>"],60,20);
                <?php
            }
        }
        else {

            $niv=$row['inivel_formulario'];
            if($depende_ant<>$row['idepende_formulario'])$count_menu++;
            ?>

stm_aix("p<?php echo $numero[$row['idepende_formulario']]?>i<?php echo $count[$row['idepende_formulario']]?>","p0i0",[0,"<?php echo $row['vnom_formulario']?>","","",-1,-1,0,"<?php echo $file?>","<?php echo $row['vabrir_formulario']?>","","","","<?php echo $path?>tclarrow.gif",18,7,0,"","",0,0],60,20);


            <?php
        }

        if($band==1)	$menu++;

        //$Rs->pg_Move_Next();
        $var++;
    }
    ?>

stm_ep();
stm_em();
</script>
    <?php
}
else { //header("Location: ../../../index.php?out=1");
    //echo 'Datos de menu no registrados';
    ?>
<script type="text/javascript">
//alert('peche');
  //  caduca_sesion()
</script>
    <?php
}
?>