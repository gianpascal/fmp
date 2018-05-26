<?php
require_once("../../ccontrol/control/ActionActoMedico.php");
$o_ActionActoMedico = new ActionActoMedico();
?>
<br/>
<fieldset class="examenes" style="width:800px">
    <legend>B&uacute;squeda</legend>
    Nombre Cie:
    <input style=" width:300px; " type="text" name="txtbusquedaNombreDiagnostico" value="" id="txtbusquedaNombreDiagnostico" onkeyup='busquedaDiagnosticoNombre(event);'>
    Código:
    <input style=" width:70px; " type="text" name="txtbusquedaCodigoDiagnostico" value="" id="txtbusquedaCodigoDiagnostico" onkeyup='buscarDiagnosticoCodigo();'>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="javascript:;" onclick="javascript:agregarOtro_ActoMedico('diagnostico');">
        <img id="btn_agregarotro" src='../../../../fastmedical_front/imagen/btn/btn_agregarotro.png' alt="">
    </a>
</fieldset>

<div id="Div_TablaDiagnosticoHC" style="width:85%;height: 25%"></div>
<fieldset class="examenes" style="width:85%">
    <div style="float: right; margin-top:3px;"  >
        <a href="javascript:;" onclick="javascript:verDiagnosticosAnteriores();">
            <img id="icono_abrirDiagnosticosAnteriores" src='../../../../fastmedical_front/imagen/icono/abrir.png' alt="">
        </a>
    </div>
    <a href="javascript:;" onclick="javascript:verDiagnosticosAnteriores();">
        <h2>Diagn&oacute;sticos Anteriores</h2>
    </a>
    <input type="hidden" id="habiertoDiagnosticosAnteriores" value="0" />
    <div id="Div_DiagnosticosAnteriores" style="height:100px; display: none; margin:3px;  ">

    </div>
</fieldset>

<input type="hidden" id="htxtcodigosDiagnosticos" name="htxtcodigosDiagnosticos" value="" />
<input type="hidden" id="hEstadoAgregarDiagnostico" name="hEstadoAgregarDiagnostico" value="0" />
<input type="hidden" id="hIdDiagnostico" name="hIdDiagnostico" value="0" /><!-- idcDiagnostico de nsmCabeceraDiagnosticos -->

<div id="Div_DiagnosticoHC" style="width:85%;height: auto;">
    <div id="Div_TablaDiagnosticoCIE" style="width:100%;height: auto;border-width: 1px;border-style: solid;display: none">
        <table width="95%" border="0" style="background-image:url(../../../estilo/imgs/dhxgrid_dhx_blue/hdr.png);font-family: Tahoma;font-size: 11px">
            <tr>
                <td width="12%"><div align="center" style="border-style: solid;border-width: 1px">C&oacute;digo CIE</div></td>
                <td width="40%"><div align="center" style="border-style: solid;border-width: 1px">Descripci&oacute;n</div></td>
                <td width="16%"><div align="center" style="border-style: solid;border-width: 1px">Tipo Diagn&oacute;stico</div></td>
                <td width="16%"><div align="center" style="border-style: solid;border-width: 1px">Tipo Ingreso</div></td>
                <td width="16%"><div align="center" style="border-style: solid;border-width: 1px">Acci&oacute;n</div></td>
            </tr>
        </table>
    </div>
    <br/>
    <div id="Div_ObservacionDiagnostico" style="display:none">
        <table width="95%" border="0">
            <tr>
                <td width="100%"><div align="center" style="display:none" class="examenes">Observaci&oacute;n</div></td>
            </tr>
            <tr>

                <td width="85%"><div align="center"><textarea style="display:none" id="txtareaObservacionDiagnostico" name="txtareaObservacionDiagnostico" cols="85" rows="5" onchange="cambiarEstadoDiagnostico()"></textarea></div></td>
            </tr>
        </table>

    </div>
</div>
