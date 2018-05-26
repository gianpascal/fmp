<form name="frmBusquedaPersona" id="frmBusquedaPersona" action="">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td height="30">
                <div id="toolbar">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td valign="top"><a href="javascript:formateaOpcionBuscadorPersona('nombre');"><img src="../../../../fastmedical_front/imagen/btn/btn_nombres_persona.gif" title="Nombres y Apellidos" border="0"/></a></td>
                            <td valign="top"><a href="javascript:formateaOpcionBuscadorPersona('documento');"><img src="../../../../fastmedical_front/imagen/btn/btn_dni_persona.gif" title="Documento de Identidad" border="0"/></a></td>
                            <td valign="top"><a href="javascript:formateaOpcionBuscadorPersona('codigo');"><img src="../../../../fastmedical_front/imagen/btn/btn_cod_persona.gif" title="Codigo de Persona" border="0"/></a></td>
                            <td>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="85" align="right">
                                            <span id="lblPatron">
                                                AP. PAT:
                                            </span>
                                        </td>
                                        <td width="190">
                                            <input type="text" name="txtPatron" id="txtPatron"
                                                onkeypress="getBusquedaPersona(event);" onblur="if (this.value=='') this.value=this.defaultValue;"
                                                onfocus="if(this.value==this.defaultValue) this.value='';" value="Buscar..."/>
                                        </td>

                                        <td width="85" align="right">
                                            <span id="lblPatron2">
                                                AP. MAT:
                                            </span>
                                        </td>
                                        <td width="190">
                                            <input type="text" name="txtPatron2" id="txtPatron2"
                                                onkeypress="getBusquedaPersona(event);" onblur="if (this.value=='') this.value=this.defaultValue;"
                                                onfocus="if(this.value==this.defaultValue) this.value='';" value="Buscar..."/>
                                        </td>

                                        <td width="85" align="right">
                                            <span id="lblPatron3">
                                                NOMBRE:
                                            </span>
                                        </td>
                                        <td width="190">
                                            <input type="text" name="txtPatron3" id="txtPatron3"
                                                onkeypress="getBusquedaPersona(event);" onblur="if (this.value=='') this.value=this.defaultValue;"
                                                onfocus="if(this.value==this.defaultValue) this.value='';" value="Buscar..."/>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td valign="top">
                <div id="divResultadoBusquedaPersonas" style="overflow:auto; width:100%; height:250px; "></div>
            </td>
        </tr>
    </table>
    <input type="hidden" name="hdnTipoBuscador" id="hdnTipoBuscador" value="<?php echo $tipoBuscador; ?>"/>
    <input type="hidden" name="hdnOpcionBusqueda" id="hdnOpcionBusqueda" value="1"/>
    <input type="hidden" id="hdnRowId" value="<?php echo $rowId; ?>" />
    <input type="hidden" id="hdnCellInd" value="<?php echo $cellInd; ?>" />
</form>