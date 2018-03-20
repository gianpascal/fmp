
<div style="width:1050px; margin:1px auto; border: #006600 solid;">
    <div class="titleform">
        <h1>Reporte de Asistencia de Personal</h1>
    </div>
    <fieldset  style="margin:auto;width:60%;height:auto; ">
        <legend>&nbsp; Datos de Busqueda &nbsp;</legend>
        <table width="100%"><tr><td align="center">
                    <table border="0" cellspacing="3" cellpadding="0" align="center" width="600">
                        <tr>
                            <td>Selecionar Sede : </td>
                            <td>
                                <select id="cboSucursal"  name="cboSucursal" style="width: 120px;" onchange="cargarCboArea2()">
                                    <option value=""> Seleccionar</option>
                                    <?php foreach ($cboSucursal as $i => $value) { ?>
                                    <option value="<?php echo $value[0] ?>"> <?php echo $value[14] ?></option>
                                        <?php } ?>
                                </select>
                            </td>
                            <td>Area :</td>
                            <td>
                                <div id="div_cbo_area" style="width:100%;height:10%">
                                    <select id="cboArea"  name="cboArea" style="width: 200px;" disabled onchange="cargarCboCategoria2()">
                                        <option value=""> Seleccionar</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Categoria Puesto :</td>
                            <td>
                                <div id="div_cbo_categoria" style="width:100%;height:10%">
                                    <select id="cboCategoria"  name="cboCategoria" style="width: 200px;" disabled>
                                        <option value=""> Seleccionar</option>
                                    </select>
                                </div>
                            </td>
                            <td>Tipo Contrato :</td>
                            <td >
                                <select id="cboTipoContrato"  name="cboTipoContrato" style="width: 150px;"  onchange="PresentarHorarioEmpleadoTrabjados()">
                                    <option value=""> Seleccionar Contrato</option>
                                    <?php foreach ($cboTipoContrato as $i => $value) { ?>
                                    <option value="<?php echo $value[0]?>"> <?php echo htmlentities($value[1])?></option>
                                        <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Tipo Sueldo :</td>
                            <td>
                                <select id="cboTipoSueldo"  name="cboTipoSueldo" style="width: 150px;">
                                    <option value="0"> Seleccionar Sueldo</option>
                                    <?php foreach ($cboTipoSueldo as $i => $value) { ?>
                                    <option value="<?php echo $value[0]?>"> <?php echo htmlentities($value[1])?></option>
                                        <?php } ?>
                                </select><a style="color: red"> * Opcional</a>
                            </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Fecha Inicio : </td>
                            <td><input name="txtFechaIni" type="text" id="txtFechaIni" size="20" onclick="calendarioHtmlx('txtFechaIni')" /></td>
                            <td>Fecha Final  : </td>
                            <td> <input name="txtFechaFin" type="text" id="txtFechaFin" size="20" onclick="calendarioHtmlx('txtFechaFin')"/></td>
                        </tr>
                        <tr><td colspan="4"><br></td></tr>
                        <tr>
                            <td colspan="4"  align="center">
                                <?php
                                    if (isset($_SESSION["permiso_formulario_servicio"][223]["BUSCAR_REPORTE_ASISTENCIA_EMP"]) && ($_SESSION["permiso_formulario_servicio"][223]["BUSCAR_REPORTE_ASISTENCIA_EMP"]==1)){
                                        //<a href="javascript:PresentarHorarioEmpleadoTrabjados();"><img border="0" title="Agregar Documentos" alt="" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif"/></a>
                                        echo "<a href=\"javascript:PresentarHorarioEmpleadoTrabjados();\"><img border=\"0\" title=\"Agregar Documentos\" alt=\"\" src=\"../../../../medifacil_front/imagen/btn/nbtn_buscar.gif\"/></a>";
                                    }
                                    else{
                                        echo "<img border=\"0\" title=\"Agregar Documentos\" alt=\"\" src=\"../../../../medifacil_front/imagen/btn/nbtn_buscar.gif\"/>";
                                    }
                                ?>
                            </td>
                        </tr>
                    </table> </td></tr>
        </table>
    </fieldset><br>

    <fieldset  style="margin:auto;width:96%;height: auto; ">
        <h2 align="center">Lista de horas laboradas por empleado</h2>
        <div id="div_tablaXempleados_c" style="display: none; width:100%" align="center">
            <div id="div_tablaXempleados" align="center" style="width:96%;height:400px;">
            </div>
            <br>
            <div align="center">
                <?php
                    if (isset($_SESSION["permiso_formulario_servicio"][223]["EXPORTAR_EXCEL_REPORTE_ASISTENCIA_EMP"]) && ($_SESSION["permiso_formulario_servicio"][223]["EXPORTAR_EXCEL_REPORTE_ASISTENCIA_EMP"]==1)){
                        //<a href="javascript:ExportarExcelHorasTrabajadas();"><img border="0" title="Agregar Documentos" alt="" src="../../../../medifacil_front/imagen/btn/b_exportarexcel_on.gif"/></a>
                        echo "<a href=\"javascript:ExportarExcelHorasTrabajadas();\"><img border=\"0\" title=\"Agregar Documentos\" alt=\"\" src=\"../../../../medifacil_front/imagen/btn/b_exportarexcel_on.gif\"/></a>";
                    }
                    else{
                        echo "<img border=\"0\" title=\"Agregar Documentos\" alt=\"\" src=\"../../../../medifacil_front/imagen/btn/b_exportarexcel_on.gif\"/>";
                    }
                ?>
            </div>
            <br>
        </div>
    </fieldset>
    <br>
</div>
