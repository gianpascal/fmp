<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<input name="txthidCodigoPersonaEmpleada" type="hidden" id="txthidCodigoPersonaEmpleada" size="20" />
<input name="txthidCodnsdHorarioRealesAsistencia" type="hidden" id="txthidCodnsdHorarioRealesAsistencia" size="20"/>

<fieldset  style="margin:auto;width:50%;height:80%; "> 
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
            <td>Hora Entrada:</td>
            <td>Hora Salida: </td>
        </tr>
        <tr>
            <td>
<!--                fechaActual-->
<input id="txtHoraEntrada" name="txtHoraEntrada" type="text" size="40" onblur="mensajeCajonesTextoFechaHora('txtHoraEntrada')" onkeypress="return validar(event,2)" maxlength="19"/>
            </td>
            <td> 
                <input type="text" id="txtHSDia" size="1" maxlength=2 value="DD"  onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';"/>/<input size="1" type="text" id="txtHSMes" maxlength=2 value="MM"  onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';"/>/<input size="2" type="text" id="txtHSAnio" maxlength=4 value="YYYY"  onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';"/> <input size="1" type="text" id="txtHSHH" maxlength=2 value="hh"  onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';"/>:<input size="1" type="text" id="txtHSMM" maxlength=2 value="mm"  onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';"/>:<input size="1" type="text" id="txtHSSS" maxlength=2 value="ss"  onblur="if (this.value=='') this.value=this.defaultValue;validarFecha(document.getElementById('txtHSDia').value,document.getElementById('txtHSMes').value,document.getElementById('txtHSAnio').value,document.getElementById('txtHSHH').value,document.getElementById('txtHSMM').value,document.getElementById('txtHSSS').value)" onfocus="if (this.value==this.defaultValue) this.value='';"/>
            </td>
        </tr>
        <tr  align="center">
            <td colspan="2">
                <?php
                if (isset($_SESSION["permiso_formulario_servicio"][224]["ACT_ASISTENCIA_EMP"]) && ($_SESSION["permiso_formulario_servicio"][224]["ACT_ASISTENCIA_EMP"] == 1)) {
                    //<a href="javascript:ActualizarTablansdHorarioRealesAsistencia();"><img border="0" title="Actualizar" alt="" src="../../../../medifacil_front/imagen/btn/b_actualizar_off.gif"/></a>
                    echo "<a href=\"javascript:ActualizarTablansdHorarioRealesAsistencia();\"><img border=\"0\" title=\"Actualizar\" alt=\"\" src=\"../../../../medifacil_front/imagen/btn/b_actualizar_off.gif\"/></a>";
                } else {
                    echo "<img border=\"0\" title=\"Actualizar\" alt=\"\" src=\"../../../../medifacil_front/imagen/btn/b_actualizar_off.gif\"/>";
                }
                ?>
            </td>       
        </tr>
        <tr>
            <td>   
<!--                <input type="button" value="mostrar" name="mostrar" onclick="alert(document.getElementById('txtHSDia').value+ ' '+ document.getElementById('txtHSMes').value+ ' '+ document.getElementById('txtHSAnio').value+ ' '+ document.getElementById('txtHSHH').value+ ' '+ document.getElementById('txtHSMM').value+ ' '+ document.getElementById('txtHSSS').value)"/>-->
           
                
<!--                <input type="button" value="mostrar" name="mostrar" onkeypress="validarFechaPropuestaSolProgSOP(document.getElementById('txtHoraEntrada').value)"/>-->
<!--            <input type="button" value="mostrar" name="mostrar" onclick="alert(currentYear())"/>-->
          
                <input type="button" value="mostrar" name="mostrar" onclick="validaFechaHora(document.getElementById('txtHoraEntrada').value)"/>
            </td> 
        </tr>

    </table>
</fieldset>
