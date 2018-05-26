<?php
//require_once("../../ccontrol/control/ActionCronograma.php");
//$o_ActionCronograma = new ActionCronograma();
//$cb_combo_afiliacionesnoasignadas = $o_ActionCronograma->obtenerlistaAfiliacionesNOAsignadas();
//$cb_combo_afiliacionesasignadas = $o_ActionCronograma->obtenerlistaAfiliacionesAsignadas();
?>
<center>
    <div style="">
        <table style="border:1px dashed black;border-radius:5px;padding:15px;background-color: #C5E8B0;">
            <tr>
                <td><p style="font-size:14px; font-family:verdana;">Nombre Medico:</td>
                <td><input id="nombreMedico" type=""  style="width:300px;border:1px dotted"></td>
            </tr>
            <tr>
                <td><p style="font-size:14px; font-family:verdana;">Nro. Programacion</td>
                <td><input id="numProgramacion" type=""  style="width:50px;border:1px dotted"></td>
            </tr>
            <tr>
                <td><p style="font-size:14px; font-family:verdana;">Fecha</td>
                <td><input id="fecha" type=""  style="width:55px;border:1px dotted"></td>
            </tr>
            <tr>
                <td><p style="font-size:14px; font-family:verdana;">Turno</td>
                <td><input id="turno" type=""  style="width:100px;border:1px dotted"></td>
            </tr>
        </table>
    </div>
</center><br>
<div id="Div_CronogramaxAfiliacion" align="center" style="width: 100%;height: 50%">
    <table style="width:100%;height: 50%">
        <tr>
            <td width="45%" height="100%">
                <table style="width:100%;height: 50%">
                    <tr style="width:100%;height: 10%">
                        <td align="center" width="100%">
                            No Seleccionadas
                        </td>
                    </tr>
                    <tr style="width:100%;height: 90%">
                        <td width="100%">
                            <div id="Div_afiliacionesnoasignadas">
                                <?php //echo html_entity_decode($cb_combo_afiliacionesnoasignadas); ?>
                            </div>
                        </td>
                    </tr>
                </table>
                <input type="hidden" id="hafiliacionesnoasignadas" name="hafiliacionesnoasignadas" value="" />
            </td>
            <td align="center" width="10%" height="100%">
                <div>&nbsp;
                </div>
                <div>
                    <?php
                    if ($_SESSION["permiso_formulario_servicio"][119]["SELEC_AFIL"] == 1) {
                        echo "<a href=\"javascript:agregarAfiliacionesPopad()\"><img src=\"../../../../fastmedical_front/imagen/icono/b_adelante.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                    ?>
                </div>
                <div>&nbsp;
                </div>
                <div>
                    <?php
                    if ($_SESSION["permiso_formulario_servicio"][119]["DESELEC_AFIL"] == 1) {
                        echo "<a href=\"javascript:quitarAfiliacionesPopad()\"><img src=\"../../../../fastmedical_front/imagen/icono/b_atras.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                    ?>
                </div>
                <div>&nbsp;
                </div>
            </td>
            <td width="45%" height="100%">
                <table style="width:100%;height: 50%">
                    <tr style="width:100%;height: 10%">
                        <td align="center" width="100%">
                            Seleccionadas
                        </td>
                    </tr>
                    <tr style="width:100%;height: 90%">
                        <td width="100%">
                            <div id="Div_afiliacionesasignadas">
                                <?php //echo html_entity_decode($cb_combo_afiliacionesasignadas); ?>
                            </div>
                        </td>
                    </tr>
                </table>
                <input type="hidden" id="hafiliacionesasignadas" name="hafiliacionesasignadas" value="" />
            </td>
        </tr>
    </table>
</div>
<br><br><br>
    
<table style="width: 100%;border:0px solid">
    <tr>
        <td  style="width: 45%;"><br></td>
         <td style="width: 40%;">
             <?php
        $toolbar1 = new ToollBar("center");
        $toolbar1->SetBoton("AgregarNuevaUnidad", "Guardar", "btn", "onclick,onkeypress", "guardarAfiliacionesXMedico()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/grabar.png", "", "", 1);
        $toolbar1->Mostrar();
        ?>
         </td>
          <td style="width: 30%;"><br></td>
    </tr>
</table>
