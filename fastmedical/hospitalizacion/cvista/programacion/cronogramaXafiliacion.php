<?php
require_once("../../../pholivo/Html.php");
require_once("../../ccontrol/control/ActionCronograma.php");

$o_ActionCronograma = new ActionCronograma();

$cb_combo_afiliacionesnoasignadas = $o_ActionCronograma->obtenerlistaAfiliacionesNOAsignadas();
$cb_combo_afiliacionesasignadas = $o_ActionCronograma->obtenerlistaAfiliacionesAsignadas();
?>
<table style="width:90%;height: 100%">
    <tr>
        <td width="45%" height="100%">
            <table style="width:100%;height: 100%">
                <tr style="width:100%;height: 10%"><td align="center" width="100%">No Seleccionadas</td></tr>
                <tr style="width:100%;height: 90%"><td width="100%">
                        <div id="Div_afiliacionesnoasignadas"><?php echo ($cb_combo_afiliacionesnoasignadas); ?></div>
                    </td></tr>
            </table>
            <!--campo oculto-->                 <input type="hidden" id="hafiliacionesnoasignadas" name="hafiliacionesnoasignadas" value="" />
        </td>

        <td align="center" width="10%" height="100%">
            <div>&nbsp;</div>
            <div><?php if($_SESSION["permiso_formulario_servicio"][119]["SELEC_AFIL"]==1) echo"<a href=\"javascript:agregarAfiliaciones()\"><img src=\"../../../../medifacil_front/imagen/icono/b_adelante.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";?></div>
            <div>&nbsp;</div>
            <div><?php if($_SESSION["permiso_formulario_servicio"][119]["DESELEC_AFIL"]==1) echo"<a href=\"javascript:quitarAfiliaciones()\"><img src=\"../../../../medifacil_front/imagen/icono/b_atras.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";?></div>
            <div>&nbsp;</div>
        </td>
        <td width="45%" height="100%">
            <table style="width:100%;height: 100%">
                <tr style="width:100%;height: 10%"><td align="center" width="100%">Seleccionadas</td></tr>
                <tr style="width:100%;height: 90%">
                    <td width="100%">
                        <?php echo ($cb_combo_afiliacionesasignadas); ?>
                    </td></tr>
            </table>
            <!--campo oculto-->                 <input type="hidden" id="hafiliacionesasignadas" name="hafiliacionesasignadas" value="" />
        </td>
    </tr>
</table>