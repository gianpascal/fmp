<fieldset  style="margin:auto;width:40%;height:80%; "> 
    <input id="htxtidCodigoEmpleado" name="htxtidCodigoEmpleado"  type="hidden" size="60" />
    <table align="center" border="1" width="550">
        <tr align="center">
            <td width="120">Nombre Empleado:
            </td>
            <td width="120">
                <input id="txtNombreEmpleados" name="txtNombreEmpleados" type="text"  size="60" disabled=/>
            </td>
            <td width="5">
                <input id="btnBusquedaEmpleado" type="button" name="btnBusquedaEmpleado"
                       value="......." onclick="busquedaEmpleadoRegularizado()" style="cursor: pointer"/> 
            </td>  
        </tr>
    <!--<input id="hidIdAreax" name="hidIdAreax" type="hidden" value="" size="40" />-->
        <tr> 
            <td colspan="3" align="center">
                <table align="center" border="1">
                    <tr>
                        <td colspan="2" align="center"> 
                            Seleccione la fecha
                        </td>
                        <td colspan="2" align="center">
                            <input id="txtFecha" name="txtFecha" type="text" onclick="calendarioHtmlx('txtFecha')" />
                        </td> 

                    </tr>
                    <tr>
                        <td>
                            Hora Inicio
                        </td>
                        <td>
                            <input id="txtHoraInicio" name="txtHoraInicio" type="text" maxlength="5" value="HH:MM"  onblur="if (this.value==''){this.value=this.defaultValue;} else {mensajeHoraMinuto('txtHoraInicio')}" onfocus="if (this.value==this.defaultValue) this.value='';"  onkeypress="return validar(event,3)" />
                        </td>
                        <td>
                            Hora Fin
                        </td>
                        <td>
                            <input id="txtHoraFin" name="txtHoraFin" type="text"       maxlength="5" value="HH:MM"  onblur="if (this.value=='') {this.value=this.defaultValue;} else {mensajeHoraMinuto('txtHoraFin')}" onfocus="if (this.value==this.defaultValue) this.value='';"  onkeypress="return validar(event,3)"/>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr> 
            <td colspan="3" align="center">
                <a href="javascript:guardarEmpleadoRegularizar();">
                    <img border="0" title="Buscar" alt="" src="../../../../fastmedical_front/imagen/btn/b_grabar_off.gif"/></a>
            </td>
        </tr>

    </table>
    <div id="resultadosRegularizacionEspecial" align="center"></div>
</fieldset>