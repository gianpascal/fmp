<div class="titleform">
    <h1>Tipo Unidad Medida</h1>
</div>
<br>
<div id="lblCodigoTipoUnidadMedida" style="float:left ;padding-left: 20px;font-family: verdana; heigth:50px; width: 30px;">Id:</div>
<div style="float:left; padding-left: 20px; heigth:150px; width: 250px;">
    <input type="text" id="txtIdTipoUnidadMedida" name="txtIdTipoUnidadMedida" value="<?php
echo utf8_encode($arrayDatosUnidad[0][0]);
?>" readonly="" style=" font-size: 16px; width:40px;"/>
</div>
<br><br>
<div id="lblTipoUnidadMedida" style="float:left ;padding-left: 20px;font-family: verdana; heigth:50px; width: 30px;">Tipo:</div>
<div style="float:left; padding-left: 20px; heigth:150px; width: 250px;">
    <input type="text" id="txtTipoUnidadMedida" name="txtTipoUnidadMedida" value="<?php
           echo utf8_encode($arrayDatosUnidad[0][1]);
?>" style=" font-size: 16px; width:240px;"/>
</div>
<br><br><br><br>
<div style="float:left; padding-left: 100px">
    <?php
    $toolbar1 = new ToollBar();
    $toolbar2 = new ToollBar();
    ?>
    <?php
    $toolbar1->SetBoton("grabarTipoUnidadMedida", "Guardar", "btn", "onclick,onkeypress", "grabarTipoUnidadMedida()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/grabar.png", "", "", 1);
    $toolbar1->Mostrar();
    ?> 
</div>
<div style="float:left; padding-left: 15px;">
    <?php
    $toolbar2->SetBoton("cerrarMantenimientoTipoUnidadMedida()", "Cerrar  ", "btn", "onclick,onkeypress", "cerrarMantenimientoTipoUnidadMedida()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/cerrar1.gif", "", "", 1);
    $toolbar2->Mostrar();
    ?> 
</div>  
<br><br>




