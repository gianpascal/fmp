<form name="frmBusquedaPersona" id="frmBusquedaPersona" action="">
    <div id="divContenidoBusquedaPersona">
        <div id="toolbar">
            <div style="float:left;">
                <a href="javascript:formateaOpcionBuscadorPersona('nombre');">
                    <img src="../../../../fastmedical_front/imagen/btn/btn_nombres_persona.gif" title="Nombres y Apellidos" border="0" alt="Nombre"/>
                </a>
            </div>
            <div style="float:left;">
                <a href="javascript:formateaOpcionBuscadorPersona('documento');">
                    <img src="../../../../fastmedical_front/imagen/btn/btn_dni_persona.gif" title="Documento de Identidad" border="0" alt="Documento"/>
                </a>
            </div>
            <div style="float:left;">
                <a href="javascript:formateaOpcionBuscadorPersona('codigo');">
                    <img src="../../../../fastmedical_front/imagen/btn/btn_cod_persona.gif" title="Codigo de Persona" border="0" alt="Codigo"/>
                </a>
            </div>
            <div style="float:left;">
                &nbsp;
            </div>
            <div style="float:left;">
                <div style="float:left;">
                    <label for="txtPatron" id="lblPatron" style="text-align: right;">AP. PAT:</label>
                </div>
                <div style="float:left;">
                    <input type="text" name="txtPatron" id="txtPatron"
                    onkeypress="getBusquedaMedicoParaReprogramacion(event);" onblur="if (this.value=='') this.value=this.defaultValue;"
                    onfocus="if(this.value==this.defaultValue) this.value='';" value="Buscar..." size="12"/>
                </div>
            </div>
            <div style="float:left;">
                &nbsp;
            </div>
            <div style="float:left;">
                <div style="float:left;">
                    <label for="txtPatron2" id="lblPatron2" style="text-align: right;">AP. MAT:</label>
                </div>
                <div style="float:left;">
                    <input type="text" name="txtPatron2" id="txtPatron2"
                    onkeypress="getBusquedaMedicoParaReprogramacion(event);" onblur="if (this.value=='') this.value=this.defaultValue;"
                    onfocus="if(this.value==this.defaultValue) this.value='';" value="Buscar..." size="12"/>
                </div>
            </div>
            <div style="float:left;">
                &nbsp;
            </div>
            <div style="float:left;">
                <div style="float:left;">
                    <label for="txtPatron3" id="lblPatron3" style="text-align: right;">NOMBRE:</label>
                </div>
                <div style="float:left;">
                    <input type="text" name="txtPatron3" id="txtPatron3"
                    onkeypress="getBusquedaMedicoParaReprogramacion(event);" onblur="if (this.value=='') this.value=this.defaultValue;"
                    onfocus="if(this.value==this.defaultValue) this.value='';" value="Buscar..." size="12"/>
                </div>
            </div>
        </div>
        <!--
            #contenedor_centrado {position:absolute;top: 50%;left: 50%;height:400px;width:600px;margin-top:-200px; /* El margin top es la mitad del alto de nuestro contenedor, en este ejemplo 400px/2=200px */margin-left:-300px /* El margin left es la mitad del ancho, en este ejemplo 600px/2=300px*/}
        -->
        <div id="divResultadoBusquedaPersonas" style="overflow:auto; width:100%; height:250px; margin: 0px auto;"></div>

        <input type="hidden" name="hdnOpcionBusqueda" id="hdnOpcionBusqueda" value="1"/>
    </div>
</form>