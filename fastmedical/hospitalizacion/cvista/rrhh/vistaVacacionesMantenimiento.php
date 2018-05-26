<div id="idDivFrmMantenimientoVacaciones" style="width: 540px;height: 229px" align="center">
    <fieldset style="width: 545px;height: auto">
        <table  border="1" style="width: 500px; height: auto">
            <tbody>
                <tr>
                    <td align="right">Id Contrato:&nbsp;</td>
                    <td align="left"><input id="txtIdContrato" type="text" disabled="" style="width:100%" name="txtIdContrato"></td>
                </tr>
                <tr>
                    <td align="right">Puesto:&nbsp;</td>
                    <td align="left"><input id="txtPuesto" type="text" disabled="" style="width:100%" name="txtPuesto"></td>
                </tr>
                <tr>
                    <td align="right">Fecha Inicio Contrato:&nbsp;</td>
                    <td align="left"><input id="txtFechaInicioContrato" type="text" disabled="" style="width:100%" name="txtFechaInicioContrato"></td>
                </tr>
                <tr>
                    <td align="right">Fecha Fin Contrato:&nbsp;</td>
                    <td align="left"><input id="txtFechaFinContrato" type="text" disabled="" style="width:100%" name="txtFechaFinContrato"></td>
                </tr>
                <tr>
                    <td align="right">Tipo de Descanso:&nbsp;</td>
                    <td>
                        <select id="cboTipoDescanso" name="cboTipoDescanso" style="width: 100%;">
                            <?php
                            echo $comboTipoDescanso;
                            ?>
                        </select>
                    </td>                            
                </tr>
                <tr>
                    <td align="right">Fecha Inicio Descanso:&nbsp;</td>
                    <td align="left">
                        <input id="txtFechaInicioVacacion" type="text" style="width:100%" name="txtFechaInicioVacacion" 
                               onfocus="calendarioHtmlx('txtFechaInicioVacacion')" maxlength="10" onkeypress="return validar(event,4)">
                    </td>
                </tr>
                <tr>
                    <td align="right">Fecha Fin Descanso:&nbsp;</td>
                    <td align="left"><input id="txtFechaFinVacacion" type="text" style="width:100%" name="txtFechaFinVacacion" onfocus="calendarioHtmlx('txtFechaFinVacacion')"></td>
                </tr>
                <tr>
                    <td align="center" colspan="2" style="visibility: inherit">
                        </br>
                        <div id="idDivGuardarVacaciones">
                            <a id="btnGuardarVacaciones" href="javascript:guardarVacaciones();">
                                <img border="0" src="../../../../fastmedical_front/imagen/btn/b_grabar_off.gif" alt="" title="Buscar">
                            </a>
                        </div>
                        <div id="idDivModificarVacaciones" style="display:none">
                            <a id="btnModificarVacaciones" href="javascript:actualizarVacaciones();">
                                <img border="0" src="../../../../fastmedical_front/imagen/btn/b_actualizar_on.gif" alt="" title="Buscar">
                            </a>
                        </div>
                        <div id="idDivCerrarVacaciones" style="display:none">
                            <a id="btnModificarVacaciones" href="javascript:cerrarVacaciones();">
                                <img border="0" src="../../../../fastmedical_front/imagen/btn/b_salir_on.gif" alt="" title="Buscar">
                            </a>
                        </div>
                        <p id="resultadoVacaciones" style="text-align: center"></p>
                    </td>
                </tr>
                <tr align="center"> 
                    <td align="center" colspan="2">
                        <div id="Div_cruceDeHorarioDescanso" style="width: 520px; height: 20px; float: left; margin-left:1%"></div> 
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
</div>