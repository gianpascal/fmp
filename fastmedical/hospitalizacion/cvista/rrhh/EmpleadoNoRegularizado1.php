<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>

        <?php
        $toolbar1 = new ToollBar("left");
        ?>
        <div style="width:800px; margin:1px auto; border: #006600 solid;">
            <div class="titleform">
                <h2>REGULARIZACION DE ASISTENCIA</h2>
            </div>

            <div id="div_NombreCompleto" class="titleform" >

            </div>
            <input name="txthidCodigoPersona" type="text" id="txthidCodigoPersona" size="20" /> 
            <input name="txthidCodigoPersonaX" type="text" id="txthidCodigoPersonaX" size="20" />
            <input name="txthidCodigoEmpleado" type="text" id="txthidCodigoEmpleado" size="20" /> 
            <input name="txthidCodigoEmpleadoX" type="text" id="txthidCodigoEmpleadoX" size="20" />  
            <input name="txthidNombreCompletoPersona" type="text" id="txthidNombreCompletoPersona" size="100" />
            <input name="txthidHoraIni" type="text" id="txthidHoraIni" size="20" />
            <input name="txthidHoraFinal" type="text" id="txthidHoraFinal" size="20" />
            <input name="txthidFecha" type="text" id="txthidFecha" size="20" />
            <input name="txthidHorarioAsistencia" type="text" id="txthidHorarioAsistencia" size="20"/>
            <input name="txthidProgramacionEmpleados" type="text" id="txthidProgramacionEmpleados" size="20"/>
            <input name="txthidTurno" type="text" id="txthidTurno" size="20"/>
            <table width="100%" border="1"><tr><td align="center">
                <tr>  
                    <td> 
                        <fieldset  style="margin:auto;width:40%;height:40%; "> 
                            <legend>&nbsp; Reporte Regularizacion &nbsp;</legend>
                            <table border="0" cellspacing="3" cellpadding="3" align="center" width="500">
                                <tr>
                                    <td>Fecha Inicial</td>
                                    <td>
                                        <input name="txtFechaIni" type="text" id="txtFechaIni" size="20" onclick="calendarioHtmlx('txtFechaIni')" onkeypress="return validar(event,4)" maxlength="10" onfocus="estadoCambioFechas('0')"  />
                                    </td>
                                    <td>Fecha Final</td>
                                    <td>
                                        <input name="txtFechaFinal" type="text" id="txtFechaFinal" size="20" onclick="calendarioHtmlx('txtFechaFinal')" onkeypress="return validar(event,4)" maxlength="10" onfocus="estadoCambioFechas('1')" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Estado</td>
                                    <td colspan="3">

                                        <select id="cboRegularizado"  name="cboRegularizado" style="width: 150px;">
                                            <option  value="-1"> Seleccionar Estado</option>
                                            <option value="1"> Regularizado</option>
                                            <option value="0" selected> No Regularizado</option>
                                            <option value="2">Faltas</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="4">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <?php
                                        if (isset($_SESSION["permiso_formulario_servicio"][224]["BUSCAR_REGISTRO_ASISTENCIA_EMP"]) && ($_SESSION["permiso_formulario_servicio"][224]["BUSCAR_REGISTRO_ASISTENCIA_EMP"] == 1)) {
                                            echo '<a href="javascript:BusquedaEmpleado();"><img border="0" title="Codigo de Persona" alt="" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif"/></a>';
                                        }
                                        ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <?php
                                        if (isset($_SESSION["permiso_formulario_servicio"][224]["LIMPIAR_CRITERIOS_BUSQUEDA_REGISTRO_ASISTENCIA"]) && ($_SESSION["permiso_formulario_servicio"][224]["LIMPIAR_CRITERIOS_BUSQUEDA_REGISTRO_ASISTENCIA"] == 1)) {
                                            echo '<a href="javascript:LimpiaTablansdHorarioRealesAsistenciaRefrescar();"><img border="0" title="Limpiar" alt="" src="../../../../medifacil_front/imagen/btn/btn_limpiar.gif"/></a>';
                                        }
                                        ?>
                                        <div style="width: 100px;" align="center">
                                            <?php
                                            if (isset($_SESSION["permiso_formulario_servicio"][224]["BUSCAR_EMP_POPPAD"]) && ($_SESSION["permiso_formulario_servicio"][224]["BUSCAR_EMP_POPPAD"] == 1)) {
                                                $toolbar1->SetBoton("BusquedaEmpleado", "Buscar Empleado", "btn", "onclick,onkeypress", "podpadBusquedaEmpleado()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/kopeteavailable.png", "", "", 1);
                                                $toolbar1->Mostrar();
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>

                    </td>
                </tr> 
                <tr>
                    <td>


                    </td>

                </tr>
            </table>

            </br>
        </div>
        </br></br></br></br>
        <!--                <div  align="center" style="width:980px;height:400px; overflow: scroll"  >-->
        <!--        970,915-->
        <div id="div_tablaXEmpleadosRegulados" style="width:970px;height: 400px;" align="center " ></div>
        <!--                </div>-->

    </body>
</html>
