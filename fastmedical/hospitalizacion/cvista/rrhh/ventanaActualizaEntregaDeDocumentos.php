<div>
    <fieldset>
        <b> FECHA DE ENTREGA </b>
    </fieldset>
</div>
<div id="divFecha">

</div>
<div style="margin: 10px;">
    <div style="height: 35%;">
        <div style="width:30%; float: left;">
            Fecha:
        </div>
        <div style="width:70%; float: left;">
            <input onclick="calendarioHtmlx('textInicio')" id="textInicio" type="text" style="width: 100px;" value="<?php echo $fecha; ?>" />
            <input  id="txtIdEmpleado" type="hidden" style="width: 100px;" value="<?php echo $cod; ?>" />
            <input  id="txtPuesto" type="hidden" style="width: 100px;" value="<?php echo $pto; ?>" />
            <input  id="txtDocumento" type="hidden" style="width: 100px;" value="<?php echo $doc; ?>" />
            <input  id="txtAccion" type="hidden" style="width: 100px;" value="<?php echo $accion; ?>" />
        </div>
    </div>
    
    <div style="height: 20%;">
        <div style="width:30%; margin:0px auto;">
            <?php if($accion==2){ ?>
               <a href="javascript:grabarEntregaDocumento(document.getElementById('txtAccion').value,document.getElementById('txtIdEmpleado').value,document.getElementById('txtPuesto').value, document.getElementById('txtDocumento').value,document.getElementById('textInicio').value);"><img  id="imgagenGuardar" src="../../../../medifacil_front/imagen/btn/b_grabar_on.gif"/></a>
            <?php }else{ ?>
               <a href="javascript:grabarEntregaDocumento(document.getElementById('txtAccion').value,document.getElementById('txtIdEmpleado').value,document.getElementById('txtPuesto').value, document.getElementById('txtDocumento').value,document.getElementById('textInicio').value);"><img  id="imgagenGuardar" src="../../../../medifacil_front/imagen/btn/b_eliminar_on.gif"/></a>
            <?php } ?>
            
        </div>

    </div>

</div>
