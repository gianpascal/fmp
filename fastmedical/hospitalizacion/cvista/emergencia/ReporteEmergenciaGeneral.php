  

<fieldset align="center"  style="margin:auto;width:auto;height:auto; "> 
    <legend align="center">&nbsp;<h1> DIAGNOSTICO GENERAL</h1> &nbsp;</legend>
    
    <fieldset style="margin:auto;width:50%;height:auto; ">
        <table border="1"  width="100%">
            <tr align="center">
                <td> FECHA INICIO :</td>
                <td align="center">
                    <input id="txtFechaIni" type="text" onclick="calendarioHtmlx('txtFechaIni')" size="20" name="txtFechaIni">
                </td>
                <td> FECHA FINAL :</td>
                <td><input id="txtFechaFinal" type="text" onclick="calendarioHtmlx('txtFechaFinal')" size="20" name="txtFechaFinal"></td>
            </tr>
            <tr>
                <td colspan="4" align="center" >
                    <a href="javascript:EmergenciaXFecha();">
                        <img border="0" title="Buscar" alt="" src="../../../../fastmedical_front/imagen/btn/b_buscar_on.gif"/></a>
                </td>
            </tr>
        </table>
    </fieldset>

    <fieldset style="margin:5px;padding:5px;height:90%;">
        <div id="divEmergenciaPaciente">

        </div>
    </fieldset>
</fieldset > 