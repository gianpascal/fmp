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
            <input name="txthidCodigoPersona" type="hidden" id="txthidCodigoPersona" size="20" />  
            <input name="txthidCodigoEmpleado" type="hidden" id="txthidCodigoEmpleado" size="20" />  
            <input name="txthidCodigoPersonaX" type="hidden" id="txthidCodigoPersonaX" size="20" />
            <input name="txthidNombreCompletoPersona" type="hidden" id="txthidNombreCompletoPersona" size="100" />
            <input name="txthidHoraIni" type="hidden" id="txthidHoraIni" size="20"  />
            <input name="txthidHoraFinal" type="hidden" id="txthidHoraFinal" size="20"  />
            <input name="txthidCodigonsdHorarioRealesAsistencia" type="hidden" id="txthidCodigonsdHorarioRealesAsistencia" size="20"/>
            <table width="100%" border="1"><tr><td align="center">
                <tr>  
                    <td> 
                        <fieldset  style="margin:auto;width:40%;height:40%; "> 
                            <legend>&nbsp; Reporte Regularizacion &nbsp;</legend>
                            <table border="0" cellspacing="3" cellpadding="3" align="center" width="500">
                                <tr>
                                    <td>Fecha Inicial</td>
                                    <td>
                                        <input name="txtFechaIni" type="text" id="txtFechaIni" size="20" onclick="calendarioHtmlx('txtFechaIni')" />
                                    </td>
                                    <td>Fecha Final</td>
                                    <td>
                                        <input name="txtFechaFinal" type="text" id="txtFechaFinal" size="20" onclick="calendarioHtmlx('txtFechaFinal')" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Estado</td>
                                    <td colspan="3">

                                        <select id="cboRegularizado"  name="cboRegularizado" style="width: 150px;">
                                            <option  value="-1"> Seleccionar Estado</option>
                                            <!--                                   actualizado Jose 2012/03/29 antes 1 era R y 0 era NR -->
                                            <option value="1"> Regularizado</option>
                                            <option value="0"> No Regularizado</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="4">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="javascript:BusquedaEmpleado();"><img border="0" title="Codigo de Persona" alt="" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif"/></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="javascript:LimpiaTablansdHorarioRealesAsistenciaRefrescar();"><img border="0" title="Limpiar" alt="" src="../../../../medifacil_front/imagen/btn/btn_limpiar.gif"/></a>

                                        <div style="width: 100px;" align="center">
                                            <?php
                                        if (isset($_SESSION["permiso_formulario_servicio"][224]["REG_ESPECIAL_ASISTENCIA_EMP"]) && ($_SESSION["permiso_formulario_servicio"][224]["REG_ESPECIAL_ASISTENCIA_EMP"]==1)){
                                            $toolbar1->SetBoton("RegularizacionEspecial","Regularizacion Especial","btn","onclick,onkeypress","RegularizacionEspecial()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/filenew.png","","",1);
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
        <!--<fieldset  style="margin:auto;width:40%;height:40%; "> -->
        <div id="div_tablaXEmpleadosRegulados" align="center" style="width:160%;height:400px;">

        </div>
        <!--</fieldset>-->
    </body>
</html>
