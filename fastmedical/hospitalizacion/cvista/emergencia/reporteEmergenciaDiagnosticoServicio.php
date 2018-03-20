
<fieldset align="center"  style="margin:auto;width:auto;height:auto; "> 
    <legend align="center">&nbsp;<h1> DIAGNOSTICO POR SERVICIO </h1> &nbsp;</legend>
    
    <fieldset style="margin:auto;width:50%;height:auto; ">
        <table border="1"  width="100%">
            <tr align="center">
                <td> FECHA INICIO :</td>
                <td align="center">
                    <input id="txtFechaIniServicio" type="text" onclick="calendarioHtmlx('txtFechaIniServicio')" size="20" name="txtFechaIniServicio"/>
                </td>
                <td> FECHA FINAL :</td>
                <td><input id="txtFechaFinalServicio" type="text" onclick="calendarioHtmlx('txtFechaFinalServicio')" size="20" name="txtFechaFinalServicio"/></td>
            </tr>
            <tr>
                <td colspan="4" align="center" >
                    <a href="javascript:EmergenciaXFechaServicio();">
                        <img border="0" title="Buscar" alt="" src="../../../../medifacil_front/imagen/btn/b_buscar_on.gif"/></a>
                </td>
            </tr>
        </table>
    </fieldset>

    <fieldset style="margin:5px;padding:5px;height:90%;">
        <div id="divEmergenciaPacienteServicio">

        </div>
    </fieldset>
</fieldset > 