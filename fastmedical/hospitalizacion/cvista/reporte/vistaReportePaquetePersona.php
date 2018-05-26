<table border="0" style="float:left;width:100%; ">
    <tr>
        <td style="float:left;width:40%; ">
            <div>
                <input name="textfield3" type="hidden" id="funcion" size="40" value=""   />
                <input name="textfield3" type="hidden" id="heditar" size="40" value=""   />
                <div id="toolbar" style="height:100px">
                    <form>
                        <div style="width:100%; height:25%; "  > 
                            <div id="divEtiquetaNroOrden" style="width:20%;  float:left; ">
                                Nro Orden: 
                            </div>
                            <div id="DivTextNroOrden" style="width:30%;  float:left; ">
                                <input name="txtOrden" type="text"  maxlength='12' id="txtOrden"
                                       onfocus="if (this.value==this.defaultValue) this.value='';"
                                       onblur="if (this.value=='') this.value=this.defaultValue;"
                                       onkeypress="getBuscarPersonasReporte(event,this,'01');" value="Buscar..." size="12"/>
                            </div>
                            <div id="divEtiquetaCodigo" style="width:20%;  float:left;">
                                C&oacute;digo: 
                            </div>
                            <div id="DivTextCodigo" style="width:30%;  float:left;">
                                <input name="txtCodigo" type="text"   id="txtCodigo" maxlength='7'
                                       onfocus="if (this.value==this.defaultValue) this.value='';"
                                       onblur="if (this.value=='') this.value=this.defaultValue;"
                                       onkeypress="getBuscarPersonasReporte(event,this,'02');" value="Buscar..." size="12"/>
                            </div>
                        </div>


                        <div style="width:100%; height:25%;"  >

                            <div id="divEtiquetaNroOrden" style="width:20%;  float:left;">
                                Tipo Doc: 
                            </div>
                            <div id="DivSelectTipoDoc" style="width:30%;  float:left;">
                                <select name="select" id="comboTipoDocumentos" style="width:80px; font-size:9px" onchange="validaTxtNroDocBuscar();">
                                    <option value="0001">DNI</option>
                                </select>
                            </div>
                            <div id="divEtiquetaNroDoc" style="width:20%;  float:left;">
                                Nro Doc: 
                            </div>
                            <div id="DivTextDoc" style="width:30%;  float:left;">
                                <input name="txtDoc" type="text"  maxlength='8'  id="nroDoc"
                                       onfocus="if (this.value==this.defaultValue) this.value='';"
                                       onblur="if (this.value=='') this.value=this.defaultValue;"
                                       onkeypress="getBuscarPersonasReporte(event,this,'06');" value="Buscar..." size="12"/>
                            </div>
                        </div> 


                        <div style="width:100%; height:25%;"  >   

                            <div id="divEtiquetaApePat" style="width:20%;  float:left; ">
                                Ape. Pat: 
                            </div>
                            <div id="DivtextApePat" style="width:30%; float:left; ">
                                <input name="textfield3" type="text" id="apellidoPaterno"  
                                       onfocus="if (this.value==this.defaultValue) this.value='';"
                                       onblur="if (this.value=='') this.value=this.defaultValue;"
                                       onkeyup="getBuscarPersonasNombreReporte(event,this,'1');"  value="" size="12" />
                            </div>
                            <div id="divEtiquetaApeMat" style="width:20%;  float:left; ">
                                Ape. Mat: 
                            </div>
                            <div id="DivTextapeMat" style="width:30%; float:left;">
                                <input name="textfield4" type="text" id="apellidoMaterno" 
                                       onfocus="if (this.value==this.defaultValue) this.value='';"
                                       onblur="if (this.value=='') this.value=this.defaultValue;"
                                       onkeyup="getBuscarPersonasNombreReporte(event,this,'2');" value="" size="12" />
                            </div>
                        </div>


                        <div style="width:100%; height:25%;"  >   

                            <div id="divEtiquetaNombre" style="width:20%; float:left; ">
                                Nombre: 
                            </div>
                            <div id="DivtextNombre" style="width:30%; float:left; ">
                                <input 
                                    name="textfield5" 
                                    type="text" 
                                    id="nombres" 
                                    onfocus="if (this.value==this.defaultValue) this.value='';"
                                    onblur="if (this.value=='') this.value=this.defaultValue;"
                                    onkeyup="getBuscarPersonasNombreReporte(event,this,'3');" 
                                    value="" 
                                    size="12" 
                                    />
                            </div>
                            <div id="divEtiquetaBuscar" style="width:17%;  float:left; ">
                                <a href="javascript:buscarPersonasReporte();"><img src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif" alt=""  border="0" title="Buscar"/></a>
                            </div>
                            <div id="DivLimpiar" style="width:16%; float:left; ">
                                <a href="javascript:limpiarCampos('0');"><img src="../../../../fastmedical_front/imagen/btn/btn_limpiar.gif" alt=""  border="0" title="Limpiar"/></a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div id="divResultadoBusqueda" style="width: 99.5%;height: 445px;border:1px solid #87A57E;border-radius: 5px;">

            </div>
        </td>
        <td  style="float:left;width:59.5%; ">
            <div id="divContendorDetalleGrupoPaquete" style="overflow-y:scroll;width:100%;height:562px;border:1px solid #87a57E;border-radius: 5px;">

            </div>
        </td>
    </tr>
</table>


