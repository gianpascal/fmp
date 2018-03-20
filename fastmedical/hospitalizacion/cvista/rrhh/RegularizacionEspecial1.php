<!--<fieldset  style="margin:auto;width:545px;height:125px; "> -->
<div align="center">
 <input name="htxtidCodigoEmpleado" type="txt" id="htxtidCodigoEmpleado" size="20" value="<?php echo $datos["codEmp"]  ?>" />
<input name="htxtidProgramacionEmpleado" type="txt" id="htxtidProgramacionEmpleado" size="20" value="<?php echo $datos["idProgramacionEmpleados"] ?>"/>
<input name="txthidCodnsdHorarioRealesAsistencia" type="txt" id="txthidCodnsdHorarioRealesAsistencia" size="20"/>
<input name="txthidFecha" type="txt" id="txthidFecha" size="20" value="<?php echo $datos["Fecha"] ?>"/>
    <table align="center" border="1" width="545">
        <tr>
            <td align="right">Nombre Empleado:&nbsp
            </td>
            <td colspan="3">
                <input id="txtDatosEmpleados" name="txtDatosEmpleados" type="text" size="84" value="<?php echo $datos["NombreCompleto"] ?>" disabled=/>
            </td>
        </tr>

        <tr>
            <td align="right"> 
                Fecha:&nbsp
            </td>
            <td align="left">
                <input id="txtFecha" name="txtFecha" type="text" disabled style="width:100%;color: blue;font-weight: bold" value="<?php echo $datos["Fecha"] ?>"/>
            </td> 
            <td align="right">
                Turno:&nbsp
            </td>    
            <td colspan="2" align="left">
                <input id="txtTurno" name="txtTurno" type="text" disabled style="width:100%;color: blue;font-weight: bold" value="<?php echo $datos["Turno"] ?>"/> 
            </td> 
        </tr>
        <tr>
            <td align="right">
                Hora Inicio:&nbsp
            </td> 
            <td>
                <input id="txtHoraInicio" name="txtHoraInicio" type="text" style="width:100%" maxlength="5" value="HH:MM"  onblur="if (this.value==''){this.value=this.defaultValue;} else {mensajeHoraMinuto('txtHoraInicio')}" onfocus="if (this.value==this.defaultValue) this.value='';"  onkeypress="return validar(event,3)" />
            </td>
            <td align="right">
                Hora Fin:&nbsp
            </td>
            <td>
                <input id="txtHoraFin" name="txtHoraFin" type="text"       style="width:100%" maxlength="5" value="HH:MM"  onblur="if (this.value=='') {this.value=this.defaultValue;} else {mensajeHoraMinuto('txtHoraFin')}" onfocus="if (this.value==this.defaultValue) this.value='';"  onkeypress="return validar(event,3)"/>
            </td>
        </tr>
        <tr> 
            <td colspan="4" align="center">
                <?php
                if (isset($_SESSION["permiso_formulario_servicio"][224]["GRABAR_FALTA_REGULARIZADA"]) && ($_SESSION["permiso_formulario_servicio"][224]["GRABAR_FALTA_REGULARIZADA"] == 1)) {
                    echo '<a id="btnGuardarEmpleadoRegularizar" href="javascript:guardarEmpleadoRegularizar();">' .
                    '<img border="0" title="Buscar" alt="" src="../../../../medifacil_front/imagen/btn/b_grabar_off.gif"/></a>' .
                    '<p id="resultadosRegularizacionEspecial" ></p>';
                }
                ?>

            </td>
        </tr>
    </table>
    </br>
</div>   
<!--</fieldset>-->
<br/>
<div align="center">
    <?php
    require_once("../../cvista/rrhh/marcacionEmpleadosAuditoria.php");
    ?>  
</div>