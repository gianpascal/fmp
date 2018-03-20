<?php
require_once("../../ccontrol/control/ActionMantenimientoGeneral.php");
for ($i = 0; $i < 24; $i++) {
    for ($j = 0; $j < 60; $j = $j + 30) {
        if ($i < 10) {
            if ($j < 10) {
                $arrayComboHoraInicioTurno[$i . "." . $j] = "0" . $i . ":" . "0" . $j;
            } else {
                $arrayComboHoraInicioTurno[$i . "." . $j] = "0" . $i . ":" . $j;
            }
        } else {
            if ($j < 10) {
                $arrayComboHoraInicioTurno[$i . "." . $j] = $i . ":" . "0" . $j;
            } else {
                $arrayComboHoraInicioTurno[$i . "." . $j] = $i . ":" . $j;
            }
        }
    }
}
$o_Combo = new Combo($arrayComboHoraInicioTurno);
$opcionesHTMLHoraInicioTurno = $o_Combo->getOptionsHTML($horaInicioTurno);
//Combo Hora Final
for ($i = 6; $i < 24; $i++) {
    for ($j = 0; $j < 60; $j = $j + 30) {
        if ($i < 10) {
            if ($j < 10) {
                $arrayComboHoraFinalTurno[$i . "." . $j] = "0" . $i . ":" . "0" . $j;
            } else {
                $arrayComboHoraFinalTurno[$i . "." . $j] = "0" . $i . ":" . $j;
            }
        } else {
            if ($j < 10) {
                $arrayComboHoraFinalTurno[$i . "." . $j] = $i . ":" . "0" . $j;
            } else {
                $arrayComboHoraFinalTurno[$i . "." . $j] = $i . ":" . $j;
            }
        }
    }
    if ($i == 23) {
        $arrayComboHoraFinalTurno["24.0"] = "24:00";
    }
}
$o_Combo = new Combo($arrayComboHoraFinalTurno);
$opcionesHTMLHoraFinalTurno = $o_Combo->getOptionsHTML($horaFinalTurno);
$arrayComboTipoHorarioTurno = array("D" => "Dia", "M" => "Mañana", "N" => "Noche", "T" => "Tarde");
$o_Combo = new Combo($arrayComboTipoHorarioTurno);
$opcionesHTMLTipoHorarioTurno = $o_Combo->getOptionsHTML($tipoHorarioTurno);
?>
<br/>
<fieldset style="padding: 10px;">
    <form id="mante_ambiente_fisico" name="mante_ambiente_fisico" action="">
        <table  cellpadding="4" cellspacing="4" border="0"  >
            <tr>
                <td align="left" style="font-family: verdana;font-size: 12px;">C&oacute;digo</td>
                <td><input style="font-family: verdana;font-size: 12px;width: 100px;height: 22px;" type="text" name="codTurno" id="codTurno"  class="texto_combo" size="8" readonly/></td>
            </tr>
            <tr>
                <td align="left" style="font-family: verdana;font-size: 12px;">Descripci&oacute;n</td>
                <td><input style="font-family: verdana;font-size: 12px;width: 300px;height: 22px;" type="text" name="descTurno" id="descTurno"  class="texto_combo" size="40" readonly tabindex="1"/></td>
            </tr>
            <tr>
                <td align="left" style="font-family: verdana;font-size: 12px;">Hora Inicio</td>
                <td>
                    <select style="font-family: verdana;font-size: 12px;width: 100px;height: 22px;" name="horaInicioTurno" id="horaInicioTurno" onchange="actDescTurno()">
                        <?php echo $opcionesHTMLHoraInicioTurno; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="left" style="font-family: verdana;font-size: 12px;">Hora Final</td>
                <td>
                    <select style="font-family: verdana;font-size: 12px;width: 100px;height: 22px;" name="horaFinalTurno" id="horaFinalTurno" onchange="actDescTurno()">
                        <?php echo $opcionesHTMLHoraFinalTurno; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="left" style="font-family: verdana;font-size: 12px;">Total Horas</td>
                <td><input style="font-family: verdana;font-size: 12px;width: 100px;height: 22px;" type="text" name="totalHorasTurno" id="totalHorasTurno"  class="texto_combo" size="8" readonly tabindex="4"/></td>
            </tr>
            <tr>
                <td align="left" style="font-family: verdana;font-size: 12px;">Tipo Horario</td>
                <td>
                    <select style="font-family: verdana;font-size: 12px;width: 100px;height: 22px;" name="tipoHorarioTurno" id="tipoHorarioTurno" onchange="presentacionTurnos();">
                        <?php echo $opcionesHTMLTipoHorarioTurno; ?>                  
                    </select>
                </td>
            </tr>
            <tr>
                <td align="left" style="font-family: verdana;font-size: 12px;">Nomenclatura</td>
                <td><input style="font-family: verdana;font-size: 12px;width: 100px;height: 22px;" type="text" name="nomenclatura" id="nomenclatura"  class="texto_combo" size="8"/></td>
            </tr>
        </table>
    </form>
</fieldset>
<br/>
<fieldset>
    <legend>Nomenclaturas ya utilizadas</legend>
    <div id="divreporteDescripcion" style="font-family: verdana;font-size: 12px;overflow:auto;border:1px solid;height: 50px;width:445px;">

    </div>
</fieldset>
<p>&nbsp;</p>
<center>
<fieldset style="border: 0px;">
    <?php
    if ($_SESSION["permiso_formulario_servicio"][206]["GRABAR_TURNO"] == 1) {
        $toolbar = new ToollBar("center");
        $toolbar->SetBoton("GRABAR", "GRABAR", "btn", "onclick,onkeypress", "validarManteTurno()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/grabar.png");
        $toolbar->Mostrar();
    }
    ?>
</fieldset>
</center>
