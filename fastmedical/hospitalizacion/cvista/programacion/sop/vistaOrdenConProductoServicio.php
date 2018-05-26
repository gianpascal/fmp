<div id="divContenidoOrdenConProductoServicio">
    <!--<div id="divTablaDatos" style="height: 20%">-->
    <div id="divTablaDatos">
        <div id="divFilaDatosPaciente" style="clear:left;width:100%">
            <div style="float:left; width:50%;">
                <label>Paciente:</label>
            </div>
            <div style="float:left; width:50%;">
                <label style="float:left"><?php
                        //echo $hidden."|".$text."|".$cCodPerPaciente."|".$nomCompletoPaciente."|".$cIdAfiliacion;
                        echo $nomCompletoPaciente; ?></label>
            </div>
            <input type="hidden" id="hdnCodPerPacienteOrden" name="hdnCodPerPacienteOrden" value="<?php echo $cCodPerPaciente; ?>"/>
        </div>

        <div id="divFilaDatosOrden" style="clear:left;width:100%">
            <div style="float:left; width:50%;">
                <label>Nro de orden:</label>
            </div>
            <div style="float:left; width:50%;">
                <label style="float:left">Nuevo</label>
            </div>
        </div>
        
        <div id="divFilaDatosAfiliacion" style="clear:left;width:100%">
            <div style="float:left; width:50%;">
                <label>Afiliaci&oacute;n:</label>
            </div>
            <div style="float:left; width:50%;">
                <label style="float:left"><?php echo $descAfiliacion; ?></label>
            </div>
            <input type="hidden" id="hdnIdAfiliacionOrden" name="hdnIdAfiliacionOrden" value="<?php echo $cIdAfiliacion; ?>"/>
        </div>
        
        <div id="divFilaDatosFecha" style="clear:left;width:100%">
            <div style="float:left; width:50%;">
                <label>Fecha:</label>
            </div>
            <div style="float:left; width:50%;">
                <label style="float:left"><?php echo $fechaActualServidor; ?></label>
            </div>
        </div>
    </div>

    <div id="divTablaDatosProductoServicio" style="height: 10%">
        <div id="divFilaDatosProductoServicio" style="clear:left;width:100%;display:none">
            <div style="float:left; width:20%;">
                <label>Producto/Servicio:</label>
            </div>
            <div style="float:left; width:80%;">
                <input type="text" id="txtCodProdServSeleccionado" name="txtCodProdServSeleccionado" size="10" readonly/>
                <input type="hidden" id="hdnCodTipoProdServSeleccionado" name="hdnCodTipoProdServSeleccionado"/>
                <input type="text" id="txtDescProdServSeleccionado" name="txtDescProdServSeleccionado" size="50" readonly/>
                <input type="text" id="txtPrecioProdServSeleccionado" name="txtPrecioProdServSeleccionado" size="10" readonly/>
                <input type="text" id="txtCantProdServSeleccionado" name="txtCantProdServSeleccionado" size="10"/>
                <a href="javascript:aceptarProductoServicio();"><img src="../../../../fastmedical_front/imagen/icono/agt_action_success.png" title="Aceptar" alt="Aceptar"/></a>
                <!--<img src="../../../../fastmedical_front/imagen/icono/edit2.png" title="Editar precio" alt="Editar precio"/>-->
            </div>
        </div>

    </div>

    <div id="divTablaProductoServicioSeleccionados" style="overflow:auto; width:99%; height:40%; margin:0px auto;"></div>

    <div id="divInferior" style="width:99%; height:25%">
        <!--<div style="clear:left;width:70%">-->
        <div style="width:70%">
            <div style="float:left; width:100%; clear:right;">
                <label>Leyenda &nbsp; Observado &nbsp; Pendiente &nbsp; Atendido &nbsp; Cancelado P. &nbsp; Cancelado A. &nbsp; Devoluci&oacute;n</label>
            </div>
            <div style="float:left; width:100%;">
                <label style="float:left">Botoncitos y acciones</label>
            </div>
        </div>

        <div id="divTablaMontos" style="width:30%; float:left;">
            <div id="divFila1" style="width:100%;">
                <div style="width: 50%; float: left;">
                    Pendientes
                </div>
                <div style="width: 50%; float: left;">
                    Seleccionado
                </div>
            </div>
            <div id="divFila2" style="width:100%;">
                <div style="width: 50%; float: left;">
                    <input type="text" size="5" readonly />
                </div>
                <div style="width: 50%; float: left;">
                    <input type="text" id="txtMontoTotalProdServSeleccionado" name="txtMontoTotalProdServSeleccionado" style="background-color: yellow;" size="5" value="0" readonly />
                </div>
            </div>
            <div id="divFila3" style="width:100%;">
                <div style="width: 50%; float: left;">
                    Atendido
                </div>
                <div style="width: 50%; float: left;">
                    Cancelado
                </div>
            </div>
            <div id="divFila4" style="width:100%;">
                <div style="width: 50%; float: left;">
                    <input type="text" size="5" readonly />
                </div>
                <div style="width: 50%; float: left;">
                    <input type="text" size="5" readonly />
                </div>
            </div>
        </div>
    </div>

    <div id="divAccionesyBotonesProdServSeleccionado" align="right" style="width: 100%; height: 50px; background: white">
        <div style="float:right;">
            <a href="javascript:manteOrdenConProductoServicio('insertar');">
                <img src="../../../../fastmedical_front/imagen/btn/b_grabar_on.gif" title="Guardar" border="0" alt="Guardar"/>
            </a>
            <a href="javascript:cerrarVentanaOrdenConProductoServicio();">
                <img src="../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif" title="Cancelar" border="0" alt="Cancelar"/>
            </a>
        </div>
    </div>
</div>