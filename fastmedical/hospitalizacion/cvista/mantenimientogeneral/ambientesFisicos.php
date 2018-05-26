<?php
require_once("../../ccontrol/control/ActionMantenimientoGeneral.php");

$o_ActionMantGeneral = new ActionMantenimientoGeneral();


//$nomEmpresa="%"; //Para listar todas las empresas

$codEmpresa="0110073";
$codSede="";
$disabled="";
$cb_empresas = $o_ActionMantGeneral->listaDatosEmpresa($codEmpresa,$codSede,$disabled);
//$tablaAmbFisico = $o_ActionMantGeneral->listaAmbientesFisicos();
?>

<div style="width:100%;height: 650px">
    <div id="Div_AmbFisicoGeneral" style="width: 85%;height: 95%;margin: 1px auto; border: medium solid rgb(0, 102, 0);display:block">
        <div>
            <!--<div id="encabezadoMedicoEspecialidad" style="display:block">-->
                <div style="width:100%;height:5%;background: white">
                    <div class="titleform">
                        <h1>MANTENIMIENTO&nbsp;&nbsp;&nbsp;DE&nbsp;&nbsp;&nbsp;AMBIENTES&nbsp;&nbsp;&nbsp;F&Iacute;SICOS</h1>
                    </div>
                </div>
                <div id="divEmpresas" style="width:100%;height:10%">
                    <?php echo $cb_empresas; ?>
                </div>
                <div style="width:100%;height:85%">
                    <div id="contenido_detalle" style="height:90%;overflow: auto;">
                        
                    </div>
                    <div id="botones" style="height:10%;">
                        <?php if($_SESSION["permiso_formulario_servicio"][202]["NUEVO_AMB_FISICO"]==1) echo "<a href='#' onclick=\"CargarVentana('popupMantAmbFisico','Registro de Ambientes Físicos','../mantenimientogeneral/manteAmbienteFisico.php?accion=insertar','500','320',false,true,'',1,'',10,10,10,10);\"><img src=\"../../../../fastmedical_front/imagen/btn/b_nuevo_on.gif\" alt='Nuevo' title='Nuevo' border='0'/></a>"?>
                    </div>
                </div>
            <!--</div>-->
        </div>
    </div>
</div>