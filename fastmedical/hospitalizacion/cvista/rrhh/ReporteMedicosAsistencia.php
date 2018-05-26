<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$cantidadRegistro=15;
?>
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
                <h2>ASISTENCIA MEDICO</h2>
            </div>

            <div id="div_NombreCompleto" class="titleform" >

            </div>
            <input name="txthidCodigoPersona" type="hidden" id="txthidCodigoPersona" size="20" /> 
            <input name="txthidCodigoPersonaX" type="hidden" id="txthidCodigoPersonaX" size="20" />
            <input name="txthidCodigoEmpleado" type="hidden" id="txthidCodigoEmpleado" size="20" /> 
            <input name="txthidCodigoEmpleadoX" type="hidden" id="txthidCodigoEmpleadoX" />  
            <input name="txthidNombreCompletoPersona" type="hidden" id="txthidNombreCompletoPersona" size="100" />
            <input name="txthidHoraIni" type="hidden" id="txthidHoraIni" size="20" />
            <input name="txthidHoraFinal" type="hidden" id="txthidHoraFinal" size="20" />
            <input name="txthidFecha" type="hidden" id="txthidFecha" size="20" />
            <input name="txthidHorarioAsistencia" type="hidden" id="txthidHorarioAsistencia" size="20"/>
            <input name="txthidProgramacionEmpleados" type="hidden" id="txthidProgramacionEmpleados" size="20"/>
            <input name="txthidTurno" type="hidden" id="txthidTurno" size="20"/>
            <input name="txthidcantidadRegistro" type="hidden" id="txthidcantidadRegistro" value="<?php echo $cantidadRegistro ?>" />
            <input name="txthidcantidadRegistroMinimo" type="hidden" id="txthidcantidadRegistroMinimo" value="<?php echo 0 ?>" />
            <input name="txthidcantidadTotalRegistros" type="hidden" id="txthidcantidadTotalRegistros" />
            
            <table width="100%" border="1"><tr><td align="center">
                <tr>  
                    <td> 
                        <fieldset  style="margin:auto;width:40%;height:40%; "> 
                            <legend>&nbsp; Reporte De Asistencia de Medicos &nbsp;</legend>
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
                                    <td align="center" colspan="4">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <?php
                                        if (isset($_SESSION["permiso_formulario_servicio"][224]["BUSCAR_REGISTRO_ASISTENCIA_EMP"]) && ($_SESSION["permiso_formulario_servicio"][224]["BUSCAR_REGISTRO_ASISTENCIA_EMP"] == 1)) {
                                            echo '<a href="javascript:reporteBusquedaMedico();"><img border="0" title="Codigo de Persona" alt="" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif"/></a>';
                                        }
                                        ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <?php
                                        if (isset($_SESSION["permiso_formulario_servicio"][224]["LIMPIAR_CRITERIOS_BUSQUEDA_REGISTRO_ASISTENCIA"]) && ($_SESSION["permiso_formulario_servicio"][224]["LIMPIAR_CRITERIOS_BUSQUEDA_REGISTRO_ASISTENCIA"] == 1)) {
                                            echo '<a href="javascript:LimpiaTablansdHorarioRealesAsistenciaRefrescar();"><img border="0" title="Limpiar" alt="" src="../../../../fastmedical_front/imagen/btn/btn_limpiar.gif"/></a>';
                                        }
                                        ?>
                                        <div style="width: 100px;" align="center">
                                            <?php
                                            if (isset($_SESSION["permiso_formulario_servicio"][224]["BUSCAR_EMP_POPPAD"]) && ($_SESSION["permiso_formulario_servicio"][224]["BUSCAR_EMP_POPPAD"] == 1)) {
                                                $toolbar1->SetBoton("BusquedaEmpleado", "Buscar Empleado", "btn", "onclick,onkeypress", "podpadBusquedaMedicos()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/kopeteavailable.png", "", "", 1);
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
                        <table>
                            <tr>
                                <td>
                                    <div id="div_listaMedicosPorParteAtras">
                                        <b><u> <a href="javascript:listaMedicosPorParteAtras();"><img border="0" title="Siguiente" alt="" />Anterior</a></u></b>
                                    </div>
                                </td>
                                <td>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                                <td>
                                    <div id="div_listaMedicosPorParteAdelante">
                                        <b><u> <a href="javascript:listaMedicosPorParteAdelante();"><img border="0" title="Siguiente" alt="" />Next</a></u></b>
                                    </div>
                                <td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            </br>
        </div>
        <div align="center">
            <div id="div_tablaXmedicos" style="width:800px;height: 400px;" align="center" ></div>
        </div>
    </body>
</html>
