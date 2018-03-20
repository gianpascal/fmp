<div align="center">
    <table>
        <tr align="center" >
            <td>
                <div class="titleform" id="divCabeceraConsultaEstadoExamenes"style="width:100%; height:100%;background-color: #D6E9FE; color: #770088">
                    <h1>Reporte de Caja</h1>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 1210px;background: #D6E9FE">
                    <tr>
                        <td align="left">Fecha Entre
                            <input type="text"   maxlength="10"  onclick="calendarioHtmlx('txtFechaInicial')" size="20" id="txtFechaInicial" name="txtFechaInicial">
                            Y
                            <input type="text"  maxlength="10"  onclick="calendarioHtmlx('txtFechaFinal')" size="20" id="txtFechaFinal" name="txtFechaFinal">


                            <img id="imgBuscar" border="0" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif" alt="" title="Buscar" onclick="buscarReporteCaja()">
                            <img id="imgBuscar" border="0" src="../../../../medifacil_front/imagen/btn/b_validar_on.gif" alt="" title="Buscar" onclick="calcularTotalesReporteCaja()">
                        </td> 
                        <td>
                            Exportar:
                        </td>
                        <td>
                            <a href="javascript:exportarReporteCaja('.xls');">
                                <img  style="height: 30px;width: 35px" border="0" src="../../../../medifacil_front/imagen/icono/2003.jpg" alt="" title="excel2003">
                            </a> 
                            <a href="javascript:exportarReporteCaja('.xlsx');">
                                <img style="height: 30px;width: 35px"  border="0" src="../../../../medifacil_front/imagen/icono/Excel2007.jpg" alt="" title="excel2007">
                            </a>
                            <a href="javascript:exportarReporteCaja('.ods');">
                                <img style="height: 30px;width: 35px" border="0" src="../../../../medifacil_front/imagen/icono/libreofficecal3.jpg" alt="" title="libreofficecal">
                            </a>
                        </td>

                    </tr>

                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 1210px">
                    <tr align="center" >
                        <td>
                            <div class="titleform" id="divCaberaEstadoExamenes"style="width:100%; height:100%;background-color: #D6E9FE; color: #770088">
                                <h1>Estado de Caja</h1>
                            </div>
                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                            <div id="divReporteCaja" align="center" style="width:1210px; height:450px;"> a</div>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</div>