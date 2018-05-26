<?php
require_once("../../ccontrol/control/ActionMantenimientoGeneral.php");

$o_ActionMantGeneral = new ActionMantenimientoGeneral();

$descTurno="%";
$htmlTablaTurnos = $o_ActionMantGeneral->listaTurno($descTurno);
?>

<div style="width:100%;height: 650px">
    <div id="Div_AmbFisicoGeneral" style="width: 85%;height: 95%;margin: 1px auto; border: medium solid rgb(0, 102, 0);display:block">
        <div>
            <!--<div id="encabezadoMedicoEspecialidad" style="display:block">-->
                <div style="width:100%;height:5%;background: white">
                    <div class="titleform">
                        <h1>MANTENIMIENTO&nbsp;&nbsp;&nbsp;DE&nbsp;&nbsp;&nbsp;TURNOS</h1>
                    </div>
                </div>
                <div style="width:100%;height:10%">
                    
                </div>
                <div style="width:100%;height:85%">
                    <div id="contenido_detalle" style="height:90%;overflow: auto;">
                        <?php echo 'JCQA'.$htmlTablaTurnos; ?>
                    </div>
                    <div id="botones" style="height:10%;">
                        //<?php
//                            if($_SESSION["permiso_formulario_servicio"][206]["NUEVO_TURNO"]==1){
//                                echo "<a href='#' onclick=\"CargarVentana('popupMantTurno','Registro de Turnos','../mantenimientogeneral/manteTurno.php?accion=insertar','400','220',false,true,'',1,'',10,10,10,10);\"><img src=\"../../../../fastmedical_front/imagen/btn/b_nuevo_on.gif\" alt='Nuevo' title='Nuevo' border='0'/></a>";
//                            }
//                        ?>
                        
                    </div>
                </div>
            <!--</div>-->
        </div>
    </div>
</div>