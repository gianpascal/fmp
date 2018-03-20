<?php


?>
<div id="Div_DatosMedicoServicioPopUp" align ="center" style="width:98%;height: auto;display: block">
    <table>
        <tr>
            <td><pre>Fecha      :</pre></td>
            <td>&nbsp;</td>
            <td><?php echo $resultado["dFechaServicio"];?></td>
        </tr>
        <tr>
            <td><pre>Médico     :</pre></td>
            <td>&nbsp;</td>
            <td><?php echo $resultado["nombremedico"];?></td>
        </tr>
        <tr>
            <td><pre>Servicio   :</pre></td>
            <td>&nbsp;</td>
            <td><?php echo $resultado["nombreservicio"];?></td>
        </tr>

    </table>
</div>
<br/>
<div id="Div_TablaDiagnosticoCIEPopUp" align ="center" style="width:98%;height: 50%;border-width: 1px;border-style: solid;display: block">

</div>
<br/>
<div id="Div_ObservacionDiagnosticoPopUp" style="width:98%;height: auto;display:block">
    <table width="95%" border="0">
        <tr>
            <td width="100%"><div align="center">Observación</div></td>
        </tr>
        <tr>

            <td width="85%"><div align="center"><textarea id="txtareaObservacionDiagnostico" name="txtareaObservacionDiagnostico" cols="85" rows="5" readonly="true"><?php echo $resultado["vObservacion"];?></textarea></div></td>
        </tr>
    </table>

</div>


