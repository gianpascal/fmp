<div id="divContenidoPuntoControl" style="width:1200px; height:600px;  margin:1px auto; border: #006600 solid" align="center">
    <table border="1">
        <tr>
            <td> 
                <div id="div_MostrarGrupoEtareo">
                    <table>
                        <tr>
                            <td>
                                <div class="titleform">
                                    <h1>GRUPO ETAREO</h1>
                                </div>
                                <div id="divGrupoEtareo" class="toolbar" style="width:550px;float: left; height: 500px; ">
                                    <table border="1" align="rigt">
                                        <tr> 
                                            <td colspan="2" style="width:400px;float: center; height: auto; ">
                                                <input type="button" onclick="tablaBuscarReporteGruposEtareos.toExcel('../../../grid-excel-php/generate.php')" value="Exportar Reporte aExcel" class="btnReportesExportar">
                                                <div id="div_TablaGrupoEtareo" style="width:550px;float: left; height: 500px; ">
                                                </div>
                                            </td>
                                        </tr>   
                                    </table> 
                                </div>

                            </td>

                            <td>
                                <div class="titleform">
                                    <h1>PACIENTES DENTRO DEL GRUPO </h1>
                                </div>
                                <div id="divPersonasGrupoEtareo" class="toolbar" style="width:550px;float: left; height: 500px;">
                                    <table border="1" align="left">
                                        <tr> 
                                            <td colspan="2" style="width:400px;float: center; height: auto; ">
                                                <input type="button" onclick="tablaBuscarPersonasGrupoEtareo.toExcel('../../../grid-excel-php/generate.php')" value="Exportar Reporte aExcel" class="btnReportesExportar">
                                                <div id="div_TablaPersonasGrupoEtareo" style="width:550px;float: left; height: 500px; ">
                                                </div>
                                            </td>
                                        </tr> 
                                    </table> 
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</div>


