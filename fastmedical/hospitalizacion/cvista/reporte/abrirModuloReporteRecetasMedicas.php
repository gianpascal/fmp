<style>
    .cuerpoCentro{
        width: 1215px;
        height:650px;
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
<center>
    <div style="height: 700px;width: 100%;overflow-y: scroll;overflow-x: hidden">
    <div class="cuerpoCentro" id="parentId1">

    </div>
</div>
    </center>
<div id="contenedorFiltros">
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
                <p style="font-size:12px;float:left;">&nbsp;Medicamento :  
                    <input type="checkbox" id="chkMedicamento" title="Medicamento" onChange="mostrarObjetosReporteRecetaMedica('medicamento','chkMedicamento','medico','chkMedico','txtIdMedico','txtMedico')"/>
</p>
                <div id="medicamento" style="float:left;display:none">

                    <input type="hidden" id="txtIdMedicamento" disabled >
                    &nbsp;&nbsp;<input  id="txtMedicamento" size="80"  type="text"  onKeyPress="buscarMedicamento(event)">
                </div>
            </td>
        </tr>
            <tr>
             <td style="padding:5px;">
                <p style="font-size:12px;float:left;">&nbsp;Medico :  
                    <input type="checkbox" id="chkMedico" title="Medico"  onChange="mostrarObjetosReporteRecetaMedica('medico','chkMedico','medicamento','chkMedicamento','txtIdMedicamento','txtMedicamento')"/>
</p>

                <div id="medico" style="float:left;display:none">
                    <input type="hidden" id="txtIdMedico">
                    &nbsp;&nbsp;<input  id="txtMedico" size="80"  type="text" onKeyPress="buscarMEdico(event)">
                </div>
            </td>
        </tr>
    </table>

    <center><button class="btnReporte" style="width:100px;height: 35px;" onClick="mostrarReportesEstadisticosREcetaMedica();">Ver Reporte</button></center>
</div>
<div id="contenedorGraficos" style="width:99.8%;height:98%;">

</div>