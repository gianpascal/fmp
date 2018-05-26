<?php
    $o_LPersona = new LPersona();
    $resultado = $o_LPersona->obtenerDatosPersonaContribuyente($datos);

?>
<input id="hcodigocontribuyente" type="hidden"></input>
<input id="hnombrecontribuyente" type="hidden"></input>
<div id="Div_consultaweb" style="border:1px solid #CCCCCC; width:700px; height:365px;">	
    <div id="div_opcionesfiltro" style="height:100px; border:0px solid #CCCCCC;">
        <fieldset>
            <legend>Opciones de Busqueda</legend>
            <table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr>
                    <td width="27%"><input type="radio"  style="cursor:pointer;" onclick="contribuyentepuntual.opcionesfiltro(3)" value="3" id="rdb_opcfiltro" name="rdb_opcfiltro">
			Codigo Contribuyente  </td>
                    <td width="46%"><input type="radio" checked="checked" style="cursor:pointer;" value="1" onclick="contribuyentepuntual.opcionesfiltro(1)" id="rdb_opcfiltro" name="rdb_opcfiltro">
			  Nombre contribuyente</td>
                    <td width="27%" align="right">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div id="div_consultaporcodigo" style="display:none;"><input type="text" onkeypress=" " value="<?php echo $resultado[0]["cContribuyente"]?>" onchange="contribuyentepuntual.completar_ceros(this.id)" maxlength="7" style="width:50%;" name="txtpcodigo" id="txtpcodigo"></div>
                        <div id="div_consultapornombre" style="display:block;"><input type="text" style="width:99%;" value="<?php echo $resultado[0]["apellidos"]?>" onkeyup="this.value=this.value.toUpperCase()" name="txtpbuscar" id="txtpbuscar"></div></td>
                    <td align="right"><a href="javascript:contribuyentepuntual.buscarcontribuyentes()"><img src="../../../../fastmedical_front/imagen/btn/b_buscar_on.gif"></a>
<!--                        <input name="button" type="button" style="cursor:pointer;" onclick="contribuyentepuntual.buscarcontribuyentes()" value="Buscar" />-->
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
    <div id="Div_gridContribuyentes" style="height:170px; width:98%; margin-left:2px; overflow:hidden;">
        
    </div>
    <hr />
<!--    <div id="Div_btnopciones" style="border:1px solid; color:#CCCCCC">
        <input type="button" id="btn_verestado[]" value="[Ver Estado]" style="cursor:pointer;" disabled="disabled" onclick="jsconsulta.consultaestado_contrib()"  size="7" />
    </div>-->
    <div id="Div_estado_contrib" style="height:50px; color: #000000; background:#FFFFFF; font:bold; border:1px dashed ; margin-top:2px;">
        <a style="margin-left:4px; font:bold; margin-right:4px;">Para ver el estado del contribuyente, seleccione uno de la lista.</a>	</div>
</div>
<input type="hidden" disabled="disabled" id="filtrarpor" name="filtrarpor" value="1" />
<input type="hidden" readonly="true" id="c_idcont00" name="c_idcont00" value="" />
<script>
    document.getElementById("txtpbuscar").select();
</script>
<br />
Consultas  : Sra. Teresa (MUNICIPALIDAD)<br/>
Anexos MUNICIPALIDAD : 2202 y 2208