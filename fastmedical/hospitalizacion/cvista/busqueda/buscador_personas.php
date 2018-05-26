<div style="float:left;width:100%; ">
    <div id="toolbar" style="height:100px">

        <?php
        /* leyenda de parametro para la busqueda:
          01: por numero de Orden,
          02: por Codigo:
          03: por nombre y apellido

          06: por tipo y numro de documento

         */
        ?>
        <form>

            <input name="textfield3" type="hidden" id="funcion" size="40" value="<?php echo $arrayParametros['funcion'] ?>"   />
            <input name="textfield3" type="hidden" id="heditar" size="40" value="<?php echo $arrayParametros['editar'] ?>"   />
            <div style="width:100%; height:25%; "  > 
                <div id="divEtiquetaNroOrden" style="width:20%;  float:left; display: <?php echo $arrayParametros['nroOrden'] == true ? 'anone' : ''; ?>">
                    Nro Orden: 
                </div>
                <div id="DivTextNroOrden" style="width:30%;  float:left; display: <?php echo $arrayParametros['nroOrden'] == true ? 'anone' : ''; ?>">
                    <input name="txtOrden" type="text"  maxlength='12' id="txtOrden"
                           onfocus="if (this.value==this.defaultValue) this.value='';"
                           onblur="if (this.value=='') this.value=this.defaultValue;"
                           onkeypress="getBuscarPersonas(event,this,'01');" value="Buscar..." size="12"/>
                </div>
                <div id="divEtiquetaCodigo" style="width:20%;  float:left; display: <?php echo $arrayParametros['codigo'] == true ? 'anone' : ''; ?>">
                    C&oacute;digo: 
                </div>
                <div id="DivTextCodigo" style="width:30%;  float:left; display: <?php echo $arrayParametros['codigo'] == true ? 'anone' : ''; ?>">
                    <input name="txtCodigo" type="text"   id="txtCodigo" maxlength='7'
                           onfocus="if (this.value==this.defaultValue) this.value='';"
                           onblur="if (this.value=='') this.value=this.defaultValue;"
                           onkeypress="getBuscarPersonas(event,this,'02');" value="Buscar..." size="12"/>
                </div>
            </div>


            <div style="width:100%; height:25%; display: <?php echo $arrayParametros['documento'] == true ? 'anone' : ''; ?>"  >

                <div id="divEtiquetaNroOrden" style="width:20%;  float:left;">
                    Tipo Doc: 
                </div>
                <div id="DivSelectTipoDoc" style="width:30%;  float:left;">
                    <select name="select" id="comboTipoDocumentos" style="width:80px; font-size:9px" onchange="validaTxtNroDocBuscar();">
                        <?php
                        echo $comboTipoDocumentos;
                        ?>
                    </select>
                </div>
                <div id="divEtiquetaNroDoc" style="width:20%;  float:left;">
                    Nro Doc: 
                </div>
                <div id="DivTextDoc" style="width:30%;  float:left;">
                    <input name="txtDoc" type="text"  maxlength='8'  id="nroDoc"
                           onfocus="if (this.value==this.defaultValue) this.value='';"
                           onblur="if (this.value=='') this.value=this.defaultValue;"
                           onkeypress="getBuscarPersonas(event,this,'06');" value="Buscar..." size="12"/>
                </div>
            </div> 


            <div style="width:100%; height:25%;"  >   

                <div id="divEtiquetaApePat" style="width:20%;  float:left; display: <?php echo $arrayParametros['apellidoPaterno'] == true ? 'anone' : ''; ?> ">
                    Ape. Pat: 
                </div>
                <div id="DivtextApePat" style="width:30%; float:left; display: <?php echo $arrayParametros['apellidoPaterno'] == true ? 'anone' : ''; ?> ">
                    <input name="textfield3" type="text" id="apellidoPaterno"  class="textPatronNombreBusqueda"
                           onfocus="if (this.value==this.defaultValue) this.value='';"
                           onblur="if (this.value=='') this.value=this.defaultValue;"
                           onkeyup="getBuscarPersonasNombre(event,this,'1');"  value="" size="12" />
                </div>
                <div id="divEtiquetaApeMat" style="width:20%;  float:left; display: <?php echo $arrayParametros['apellidoMaterno'] == true ? 'anone' : ''; ?>">
                    Ape. Mat: 
                </div>
                <div id="DivTextapeMat" style="width:30%; float:left; display: <?php echo $arrayParametros['apellidoMaterno'] == true ? 'anone' : ''; ?> ">
                    <input name="textfield4" type="text" id="apellidoMaterno" class="textPatronNombreBusqueda"
                           onfocus="if (this.value==this.defaultValue) this.value='';"
                           onblur="if (this.value=='') this.value=this.defaultValue;"
                           onkeyup="getBuscarPersonasNombre(event,this,'2');" value="" size="12" />
                </div>
            </div>


            <div style="width:100%; height:25%;"  >   

                <div id="divEtiquetaNombre" style="width:20%; float:left; display: <?php echo $arrayParametros['nombre'] == true ? 'anone' : ''; ?> ">
                    Nombre: 
                </div>
                <div id="DivtextNombre" style="width:30%; float:left; display: <?php echo $arrayParametros['nombre'] == true ? 'anone' : ''; ?> ">
                    <input name="textfield5" type="text" id="nombres" class="textPatronNombreBusqueda"
                           onfocus="if (this.value==this.defaultValue) this.value='';"
                           onblur="if (this.value=='') this.value=this.defaultValue;"
                           onkeyup="getBuscarPersonasNombre(event,this,'3');" value="" size="12" />
                </div>
                <div id="divEtiquetaBuscar" style="width:17%;  float:left; display: <?php echo $arrayParametros['bbuscar'] == true ? 'anone' : ''; ?> ">
                    <a href="javascript:buscarPersonas();"><img src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif" alt=""  border="0" title="Buscar"/></a>
                </div>
                <div id="DivLimpiar" style="width:16%; float:left; display: <?php echo $arrayParametros['blimpiar'] == true ? 'anone' : ''; ?> ">
                    <a href="javascript:limpiarCampos('0');"><img src="../../../../fastmedical_front/imagen/btn/btn_limpiar.gif" alt=""  border="0" title="Limpiar"/></a>
                </div>
                <div id="DivLimpiar" style="width:17%; float:left; display: <?php echo $arrayParametros['bnuevo'] == true ? 'anone' : ''; ?> ">
                    <a href="javascript:ventana_formulario_persona('<?php echo $arrayParametros['fnuevo'] ?>');"><img src="../../../../fastmedical_front/imagen/btn/nbtn_nuevo.gif" alt="" border="0" title="Codigo de Persona"/></a>
                </div>
            </div>

        </form>
    </div>

    <div id="divResultadoBusqueda"  style=" height:<?php echo $arrayParametros['alto']; ?>; overflow: auto;">
        <?php
        //echo $o_ActionTesoreria->obtenerPersonas('','');
        echo $obtenerPersonas;
        ?>
    </div>
</div>