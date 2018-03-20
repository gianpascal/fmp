<?php
$toolbarx = new ToollBar("LEFT");
$toolbar1 = new ToollBar("LEFT");
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div style="width:1000px; height:600px;margin:1px auto; border: #006600 solid">
            <div class="titleform">
                <h1>REPORTE DE CAJA</h1>
            </div>
            <div align="center">  
                <table border="1">
                    <tr>
                        <td colspan="2">
                            <select name="cboCajeroC" id="cboCajeroC">
                                <option value="0">Seleccionar</option>
                                <?php foreach ($resultado as $i => $val) { ?>
                                    <option value="<?php echo $val[0] ?>"> <?php echo $val[0] ?></option>                 
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            Fechas Inicial  : <input id="txtFechaIniC" type="text" onclick="calendarioHtmlx('txtFechaIniC')" size="20" name="txtFechaIniC" />                                              
                        </td>
                        <td>
                            Fechas Final  : <input id="txtFechaFinalC" type="text" onclick="calendarioHtmlx('txtFechaFinalC')" size="20" name="txtFechaFinalC" />                                              
                        </td>
                    </tr> 
                </table>

                <table border="1" style="height: auto; overflow: auto;">  
                    <tr>
                        <td>
                            <table> 
                                <tr>
                                    <td align="center">
                                        <?php
                                        $toolbarx->SetBoton("cajeroXcaja", "REPORTE CAJERO POR DIA", "btn", "onclick", "reporteCajaPorCajero(1)", $_SESSION['path_principal']."../medifacil_front/imagen/icono/filenew.png", "", "", 1);
                                        $toolbarx->Mostrar();
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <?php
                                        $toolbar1->SetBoton("cajeroXPersona", "REPORTE CAJERO POR EMPLEADO", "btn", "onclick,onkeypress", "reporteCajaPorCajero(2)", $_SESSION['path_principal']."../medifacil_front/imagen/icono/filenew.png", "", "", 1);
                                        $toolbar1->Mostrar();
                                        ?>                                                              
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td  style="width: 700px; height: auto; overflow: auto;">
                            <table>
                                <tr>  
                                    <td>
                                        <div id="divReportePorNumeroCaja"   align="center">
                                        </div>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>


            </div>

    </body>
</html>

