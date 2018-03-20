<?php
$toolbar1 = new ToollBar();
$toolbar2 = new ToollBar();
$toolbar3 = new ToollBar();
?>
<div id="DivAfiliacion">
    <div class="titleform">
        <h1>Generar Nueva Orden</h1>
    </div>

    <div style="padding-left: 35px; padding-right: 35px;">
        <div id="toolbar" style="height:25px; width:670px;">
                    
                        <div id="lblAfiliacion" style=" display: none;float:left ;padding-left: 20px;font-family: verdana; heigth:50px; width:50px;">Afiliacion:</div>
                        <div style="display: none; float:left; padding-left: 20px; heigth:150px; width: 160px;">
                            <input type="text" id="txtAfiliacion" name="txtAfiliacion" value="<?php echo utf8_encode($arrayDatosAfiliacion[0][1]); ?>" readonly="" style=" font-size: 16px; width:160px;"/>
                        </div>
            

            <div id="lblBusqueda" style="float:left ;padding-left: 20px;font-family: verdana; heigth:50px; width: 50px;">Producto:</div>
            <div style="float:left; padding-left: 20px; heigth:150px; width: 160px;">
                <input type="text" id="txtBusqueda" name="txtBusqueda" value="" onKeyUp="listartablaproductos(event)" style=" font-size: 16px; width:395px;"/>
            </div>
        </div>
    </div>

    <div style="padding-left: 35px; padding-right: 35px;">
        <div class="titleform" style="border-radius: 10px; height: 120px; width: 690px; ">
            <h1>Productos</h1>
            <div  id="divTablaProductos" style="height: 100px;width: 690px; background-color:#8CD74F;"> 
            </div>
        </div>

    </div>
    <br>
    <div style="display:none;">
        <div id="lblActoMedico" style="float:left ;padding-left: 50px;font-family: verdana; heigth:50px; width: 100px;">Acto Medico:</div>
        <div style="float:left; padding-left: 20px; heigth:150px; width: 425px;">
            <input type="text" id="txtActoMedico" name="txtActoMedico" value="" readonly=""  style=" font-size: 16px; width:395px;"/>
        </div>
        <div style="float:left; heigth:150px;">
            <?php
            $toolbar3->SetBoton("Buscar", "Buscar", "btn", "onclick,onkeypress", "PopadBuscarActoMedico()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/Search.png", "", "", 1);
            $toolbar3->Mostrar();
            ?> 
        </div>
    </div>

    
    <div style="padding-left: 35px; padding-right: 35px;">
        <div class="titleform" style="border-radius: 10px; height: 130px; width: 690px;">
            <h1>Detalle de Orden Generada</h1>
            <div  id="divDetalleOrdenGenerada" style="height: 130px;width: 690px;background-color:#A9F5D0"> 
            </div>
        </div>
            
    </div>
    <br><br>
    <div id="lblTotalOrdenGenerada" style="float:left ;padding-left: 550px;font-family: verdana; heigth:50px; width: 25px;">Total:</div>
    <div style="float:left; padding-left: 20px; heigth:150px; width:90px;">
        <input type="text" id="txtTotalOrdenGenerada" name="txtTotalOrdenGenerada" value="" readonly="" style=" font-size: 16px; width:80px;"/>
    </div>
    <div style="float:left; padding-left: 20px; heigth:150px; width: 60px;">
        <input type="text" id="txtGenerado" name="txtGenerado" value="" readonly="" style="display:none ;font-size: 16px; width:150px;"/>
    </div>
    
    <div style="padding-left: 280px; float:left;">
        <?php
        $toolbar1->SetBoton("Aceptar", "Aceptar", "btn", "onclick,onkeypress", "grabarOrdenGenerada()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/apply.png", "", "", 1);
        $toolbar1->Mostrar();
        ?>
    </div>
    <div style="padding-left: 30px; float:left;">
        <?php
        $toolbar2->SetBoton("Cancelar", "Cancelar", "btn", "onclick,onkeypress", "cerrarPopapGenerarOrden()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/cancel.png", "", "", 1);
        $toolbar2->Mostrar();
        ?> 
    </div>
    <div style="float:left; padding-left: 20px; heigth:150px; width: 60px;">
        <input type="text" id="txtCodAfiliacion" name="txtCodAfiliacion" value="<?php echo utf8_encode($arrayDatosAfiliacion[0][0]); ?>" readonly="" style="display:none; font-size: 16px; width:60px;"/>
    </div>
    <div style="float:left; padding-left: 20px; heigth:150px; width: 60px;">
        <input type="text" id="txtCodActoMedico" name="txtCodActoMedico" value="" readonly="" style="display:none; font-size: 16px; width:150px;"/>
    </div>
</div>

