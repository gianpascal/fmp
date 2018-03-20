<style>
    .cuerpoCentro{
        width: 1215px;
        height:750px;
        position: relative; 
        top: 5px; 
        left: 5px;
    }
    .filtrosChecked{
        background-color: rgba(95,158,160,0.5);
        width: 140px;
        height:85px;
        padding: 5px;
        padding-left: 10px;
        border:1px solid green;
    }
    .label{
        font-family: verdana;
        font-size: 12px;
        font-weight: bold;
        padding: 5px;
    }
    .btnReporte{
        width: 20px;
        font-size:14px;
        font-family: verdana;
        color:white;
        background-color: green;
        text-align: center;
        border:1px solid;
    }
    .btnReporte:hover{
        background: cadetblue;
        cursor: pointer;
        border:1px solid green;
        color:white;
    }
</style>
<center><div style="height: 750px;width: 100%;overflow-y: scroll;overflow-x: hidden">
    <div class="cuerpoCentro" id="parentId1">

    </div>
</center>
</div>
<div id="contenedorFiltros">
    <table border="0">
        <tr width="140">
            <td>
                <div class="filtrosChecked"> 
                    <table>
                        <tr>
                            <td>
                                <input type="checkbox" id="chkSede" title="Sede" onChange="ocultarFiltros('sede','chkSede')"/>
                            </td>
                            <td>
                                <p class="label">&nbsp;Sede</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" id="chkAfiliacion" title="Afiliacion" onChange="ocultarFiltros('afiliacion','chkAfiliacion')"/>
                            </td>
                            <td>
                                <p class="label">&nbsp;Afiliacion</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" id="chkDiagnostico" title="Diagnostico" onChange="ocultarFiltros('diagnostico','chkDiagnostico')"/> 
                            </td>
                            <td>
                                <p class="label">&nbsp;Diagnostico</p>
                            </td>
                        </tr>
                    </table>
                </div>

            </td>
            <td width="1080">
                <table border="0" width="1000">
                    <tr>
                        <td style="padding:5px;">
                            <div id="dia1" style="float:left;">
                                <p style="font-size:12px;">&nbsp;Desde :  
                                    <input id="txtfecha1" type="text" name="txtfecha1" size="9" onclick="calendarioHtmlxActoMedicoEstadistica('txtfecha1')"  maxlength="10" value="<?php echo date("d/m/Y"); ?>" >
                            </div>
                            <div id="dia2" style="float:left;">
                                <p style="font-size:12px;">&nbsp;Hasta :  
                                    <input id="txtfecha2" type="text" name="txtfecha2" size="9" onclick="calendarioHtmlxActoMedicoEstadistica('txtfecha2')" maxlength="10" value="<?php echo date("d/m/Y"); ?>" >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:5px;">
                            <?php
                            require_once("../../cdatos/DReporte.php");
                            $o_DatosReporte = new DReporte();
                            $resultado = $o_DatosReporte->tablaAmbiFi();
                            ?>
                            <div id="afiliacion" style="float:left;display: none">
                                <p style="font-size:12px;">Afiliacion :  
                                    <select id="cbxafiliacion">
                                        <?php foreach ($resultado as $key => $value) { ?>
<option value="<?php echo $value[0]; ?>"><?php echo $value[1]; ?></option>
                                        <?php }
                                        ?>
                                    </select>   
                            </div>
                            <div id="sede" style="float:left;display: none">                                    
                                <table>
                                    <tr>
                                         <td>&nbsp;<input type="checkbox" id="chkHMLO" title="HMLO" /></td>
                                        <td>HMLO</td>
                                       <td>&nbsp;<input type="checkbox" id="chkTREBOL" title="TREBOL" /></td>
                                        <td>TREBOL</td>
                                         <td>&nbsp;<input type="checkbox" id="chkVILLASOL" title="VILLASOL" /></td>
                                        <td>VILLASOL</td>
                                       <td>&nbsp;<input type="checkbox" id="chkPROLIMA" title="PROLIMA" /></td>
                                        <td>PROLIMA</td>
                                        
                                    </tr>
                                </table>
                                
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:5px;">
                            <div id="diagnostico" style="float:left;display: none">
                                <p style="font-size:12px;">&nbsp;Diagnostico :  
                                    <input type="hidden" id="txtIdDiagnostico">
                                    <input  id="txtDiagnostico" size="80" disabled type="text" >
                                    <input type="text" class="btnReporte"  value="..." onClick="abrirPopudDiagnosticos()">
                            </div>
                        </td>
                    </tr>
                </table>
            </td>

        </tr>
    </table>
    <center><button class="btnReporte" style="width:100px;height: 35px;" onClick="mostrarReportesEstadisticos();">Ver Reporte</button></center>
</div>
<div id="contenedorGraficos" style="width:99.8%;height:98%;">
    

</div>