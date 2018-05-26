<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<input name="txthidCodigoPersonaEmpleada" type="hidden" id="txthidCodigoPersonaEmpleada" size="20" />
<input name="txthidCodnsdHorarioRealesAsistencia" type="hidden" id="txthidCodnsdHorarioRealesAsistencia" size="20"/>

<fieldset  style="margin:auto;width:470px;height:125px; "> 
    <table align="center" border="0" width="450">
        <tr align="center">

            <td colspan="2" >
                <input id="txtDatosEmpleados" name="txtDatosEmpleados" type="text"  size="80" disabled=/>
            </td>
        </tr>
    <!--<input id="hidIdAreax" name="hidIdAreax" type="hidden" value="" size="40" />-->
        <tr>
            <td>
                Hora Entrada:  <input id="txtdisabHoraEntrada" name="txtdisabHoraEntrada" type="text" size="40" disabled />
            </td>
            <td>
                Hora Salida: <input id="txtdisabHoraSalida" name="txtdisabHoraSalida" type="text" size="40" disabled />
            </td>
        </tr>
        <tr>
            <td>
                Hora Entrada:  <input id="txtHoraEntrada" name="txtHoraEntrada" type="text" size="40" onkeypress="return validar(event,2)" onblur="mensajeCajonesTextoFechaHora('txtHoraEntrada')" maxlength="19" style="color: blue"/>
            </td>
            <td> 
                Hora Salida: <input id="txtHoraSalida" name="txtHoraSalida" type="text" size="40" onkeypress="return validar(event,2)" onblur="mensajeCajonesTextoFechaHora('txtHoraSalida')" maxlength="19" style="color: blue"/>
            </td>
        </tr>
        <tr  align="center">
            <td colspan="2">
                <?php
                if (isset($_SESSION["permiso_formulario_servicio"][224]["ACT_ASISTENCIA_EMP"]) && ($_SESSION["permiso_formulario_servicio"][224]["ACT_ASISTENCIA_EMP"] == 1)) {
                    //<a href="javascript:ActualizarTablansdHorarioRealesAsistencia();"><img border="0" title="Actualizar" alt="" src="../../../../fastmedical_front/imagen/btn/b_actualizar_off.gif"/></a>
                    echo "<a href=\"javascript:ActualizarTablansdHorarioRealesAsistencia();\"><img border=\"0\" title=\"Actualizar\" alt=\"\" src=\"../../../../fastmedical_front/imagen/btn/b_actualizar_off.gif\"/></a>";
                } else {
                    echo "<img border=\"0\" title=\"Actualizar\" alt=\"\" src=\"../../../../fastmedical_front/imagen/btn/b_actualizar_off.gif\"/>";
                }
                ?>
            </td>       
        </tr>
    </table>
</fieldset>
</br>

<div align="center">
    <?php
    require_once("../../cvista/rrhh/marcacionEmpleadosAuditoria.php");
    ?>  
</div>