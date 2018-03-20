<?php

    $botonBuscar = new ToollBar("right");
    $botonBuscar->SetBoton("Buscar", "Buscar", "btn", "onclick,onkeypress", "ventanaBuscarAutoriza()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/kappfinder.png");
    $botonAceptar = new ToollBar("right");
    $botonAceptar->SetBoton("Aceptar", "Aceptar", "btn", "onclick,onkeypress", "aceptarDescuento()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/button_ok.png");
    
    
?>
<input type="hidden" id="hidProductoSeleccionado" name="hidProductoSeleccionado" value="<?php echo $datos['idSeleccionado'];  ?>" />
<fieldset id="fsProductos">
    <legend>Productos</legend>
    <div id="divTablaDatosProducto" >
        <div id="divDatosProducto" style="clear:left;width:300px">
            <div style="float:left; width:50%;">
                <label>Producto:</label>
            </div>
            <div style="float:left; width:50%;">
                <?php echo $datos['nombreProducto']; ?>
            </div>
        </div>

        <div id="divDatosCodigoProducto" style="clear:left;width:300px">
            <div style="float:left; width:50%;">
                <label>Codigo:</label>
            </div>
            <div style="float:left; width:50%;">
                <?php echo $datos['codigo']; ?>
            </div>
        </div>

        <div id="divDatosPrecio" style="clear:left;width:300px">
            <div style="float:left; width:50%;">
                <label>Precio Unitario:</label>
            </div>
            <div style="float:left; width:50%;">
                <?php echo "S/. " . $datos['precioUnitario']; ?> 
                <input type="text" id="txtPrecio" name="txtPrecio" value="<?php echo $datos['precioUnitario']; ?>" readonly size="10">
            </div>
        </div>

        <div id="divDatosCantidad" style="clear:left;width:300px">
            <div style="float:left; width:50%;">
                <label>Cantidad:</label>
            </div>
            <div style="float:left; width:50%;">
                <?php echo $datos['cantidad']; ?>
            </div>
        </div>
        <div id="divDatosTotal" style="clear:left;width:300px">
            <div style="float:left; width:50%;">
                <label>Todos:</label>
            </div>
            <div style="float:left; width:50%;">
                <?php echo "S/. " . $datos['total']; ?>
            </div>
        </div>
    </div>
</fieldset>

<fieldset id="fsDescuento">
    <legend>Descuento</legend>
    <div id="divtablaDescuentos" >
        <div id="divTipoDescuento" style="clear:left;width:300px">
            <div style="float:left; width:50%;">
                <label>Tipo Descuento:</label>
            </div>
            <div style="float:left; width:50%;">
                <select onchange="cambioTipoDescuento();" name="cboTipoDescuento" id="cboTipoDescuento">
                    <option value="3">Nuevo Precio</option>
                    <option value="1">Porcentaje</option>
                    <option value="2">Descuento Fijo</option>
                   
                </select>
            </div>
        </div>

        <div id="divDatosDescuento" style="clear:left;width:300px">
            <div style="float:left; width:50%;">
                <label >Descuento:</label>
            </div>
            <div style="float:left; width:50%;">
                <input onchange="cambioDescuento();" type="text" id="txtDescuento" name="txtDescuento" value="0" readonly size="10">
            </div>
        </div>

        <div id="divDatosPorcentaje" style="clear:left;width:300px">
            <div style="float:left; width:50%;">
                <label>Porcentaje:</label>
            </div>
            <div style="float:left; width:50%;">
                <input onchange="cambioPorcentaje();" type="text" id="txtPorcentaje" name="txtPorcentaje" value="0" readonly size="10">
            </div>
        </div>

        
        <div id="divNuevoPrecio" style="clear:left;width:300px">
            <div style="float:left; width:50%;">
                <label>Nuevo Precio:</label>
            </div>
            <div style="float:left; width:50%;">
                <input onchange="cambioPrecio();" type="text" id="txtNuevoPrecio" name="txtNuevoPrecio" value="<?php echo $datos['precioUnitario']; ?>"  size="10">
            </div>
        </div>
        <div id="divCantidad" style="clear:left;width:300px">
            <div style="float:left; width:50%;">
                <label>Cantidad:</label>
            </div>
            <div style="float:left; width:50%;">
                <input type="text" id="txtCantidad" name="txtCantidad" value="<?php echo $datos['cantidad']; ?>" readonly size="10">
            </div>
        </div>
        <div id="divTotal" style="clear:left;width:300px">
            <div style="float:left; width:50%;">
                <label>Total Nuevo:</label>
            </div>
            <div style="float:left; width:50%;">
                <input type="text" id="txtTotalNuevo" name="txtTotalNuevo" value="<?php echo $datos['total']; ?>" readonly size="10">
            </div>
        </div>
        <div id="divLabelAutoriza" style="clear:left;width:300px; display:none;">
            <div style="float:left; width:50%;">
                <label>Autorizado por:</label>
            </div>
            
            
            
        </div>
        <div id="divLabelAutoriza" style="clear:left;width:380px; display:none">
            
            <div id="divNombreAutoriza" style="margin:2px; padding:6px;-moz-border-radius : 5px;height:22px;float:left; width: 260px; border:1px solid #87A57E;">
                
                buscar...
                 
            </div>
            <input type="hidden" id="txtidPuestoEmpleado" name="txtidPuestoEmpleado" value="" />
            <div id="toolbar"style="float:left; width: 80px;">
                <?php $botonBuscar->Mostrar();?>
            </div>
            
            
        </div>
        <div id="divObservaciones" style="clear:left;width:300px">
            <div style="float:left; width:50%;">
                <label>Observacion:</label>
            </div>
            <div style="float:left; width:50%;">
                <textarea id="txtObservacion"></textarea>
                
            </div>
        </div>
        
            
                
            
            
            
     
    </div>
</fieldset>

<div id="toolbar"style="float:left; width: 350px;">
                <?php $botonAceptar->Mostrar();?>
       </div>
        



