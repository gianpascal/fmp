<?php

function ultimoDiaMes($mes, $año) {
    for ($dia = 28; $dia <= 31; $dia++)
        if (checkdate($mes, $dia, $año))
            $fecha = "$dia/$mes/$año";
    return $fecha;
}
?>
<div  align="center">
    <table align="center" style="width:80%">
        <tr><td>&nbsp;</td></tr>
        <tr style="width:80%">
            <td colspan="7" align="center" style="width: 100%">Tiempo de Vigencia de Acreditación</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr style="width:80%">
            <td align="left" style="width: 20%">Desde</td>
            <td align="center" style="width: 20%"><input id="txtvigenciadesde" type="text" size="10" value="<?php echo date("d/m/Y"); ?>" readonly="true"/></td>
            <td align="left" style="width: 20%">
                <a href="javascript:mostrarcalendar('dhtmlxCalendar1')"><img id="calendar1" src="../../../../medifacil_front/imagen/icono/hos_calendar.png" alt=""></a>
                <div id="dhtmlxCalendar1" style="position:absolute;display:none"></div>
            </td>
            <td align="center" style="width: 20%">-</td>
            <td align="left" style="width: 20%">Hasta</td>
            <td align="center" style="width: 20%"><input id="txtvigenciahasta" type="text" size="10" value="<?php echo ultimoDiaMes(date("m"), date("Y")); ?>" readonly="true"/></td>
            <td align="left" style="width: 20%">
                <a href="javascript:mostrarcalendar('dhtmlxCalendar2')"><img id="calendar2" src="../../../../medifacil_front/imagen/icono/hos_calendar.png" alt=""></a>
                <div id="dhtmlxCalendar2" style="position:absolute;display:none"></div>
            </td>

        </tr>
        <tr><td>&nbsp;</td></tr>  
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td align="right" colspan="3">
                <div>
                    <?php if (isset($_SESSION["permiso_formulario_servicio"][177]["ACEPTAR_ACREDITACION_COMPLEMENTARIA"]) && ($_SESSION["permiso_formulario_servicio"][177]["ACEPTAR_ACREDITACION_COMPLEMENTARIA"] == 1))
                        echo "<a href=\"javascript:aceptarAcreditacionComplementaria('".$datos["cadena"]."');\"><img src=\"../../../../medifacil_front/imagen/btn/b_aceptar_on.gif\"></a>"; ?>
                </div>
            </td>
            <td align="left" colspan="3">
                <div>
                    <?php if (isset($_SESSION["permiso_formulario_servicio"][177]["CANCELAR_ACREDITACION_COMPLEMENTARIA"]) && ($_SESSION["permiso_formulario_servicio"][177]["CANCELAR_ACREDITACION_COMPLEMENTARIA"] == 1))
                        echo "<a href=\"javascript:cerrarVentanasEmergentes('Div_acreditaciónComplementaria');\"><img src=\"../../../../medifacil_front/imagen/btn/b_cancelar_on.gif\"></a>"; ?>
                </div>
            </td>            
        </tr>  
    </table>

</div>
