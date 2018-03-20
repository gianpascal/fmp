<div class="titleform">
    <h1>Unidad Medida</h1>
</div>
<div style="float:left; padding-left: 20px; heigth:150px; width: 160px;">
    <input type="text" id="txtidTIpoUnidad" name="txtidTIpoUnidad" value="<?php
echo $datos["idTipoUnidadMedida"];
?>" readonly=""  style="display:none ; font-size: 16px; width:40px;"/>
</div>
<br><br>
<div id="lblidUnidad" style="float:left ;padding-left: 20px;font-family: verdana; heigth:50px; width: 100px;">Id Unidad:</div>
<div style="float:left; padding-left: 20px; heigth:150px; width: 160px;">
    <input type="text" id="txtidUnidad" name="txtidUnidad" value="<?php
echo utf8_encode($arrayDatosUnidadMedida[0][1]);
?>" readonly="" style=" font-size: 16px; width:40px;"/>
</div>
<br><br>
<div id="lblUnidadMedida" style="float:left ;padding-left: 20px;font-family: verdana; heigth:50px; width: 100px;">Unidad Medida:</div>
<div style="float:left; padding-left: 20px; heigth:150px; width: 160px;">
    <input type="text" id="txtUnidadMedida" name="txtUnidadMedida" value="<?php
           echo utf8_encode($arrayDatosUnidadMedida[0][2]);
?>" style=" font-size: 16px; width:160px;"/>
</div>
<br><br>
<div id="lblPrincipal" style="float:left ;padding-left: 20px;font-family: verdana; heigth:50px; width: 100px;">Principal:</div>
<div style="float:left; padding-left: 20px; heigth:150px; width: 160px;">
   <input type="checkbox" name="bPrincipal" id="bPrincipal" <?php
if ($arrayDatosUnidadMedida[0][3] == 1) {
    echo "checked";
}
;
?>/>
</div>
<br><br>
<div id="lblEquivalencia" style="float:left ;padding-left: 20px;font-family: verdana; heigth:50px; width: 100px;">Equivalente:</div>
<div style="float:left; padding-left: 20px; heigth:150px; width: 160px;">
    <input type="text" id="txtEquivalencia" name="txtEquivalencia" onkeyup="validaDecimal(event,this,'')" value="<?php
           echo utf8_encode($arrayDatosUnidadMedida[0][4]);
?>" style=" font-size: 16px; width:160px;"/>
</div>
<br><br>
<br><br>
<div style="float:left; padding-left: 100px">
    <?php
    $toolbar1 = new ToollBar();
    $toolbar2 = new ToollBar();
    ?>
    <?php
    $toolbar1->SetBoton("grabarUnidadMedida", "Guardar", "btn", "onclick,onkeypress", "grabarUnidadMedida()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/grabar.png", "", "", 1);
    $toolbar1->Mostrar();
    ?> 
</div>
<div style="float:left; padding-left: 15px;">
    <?php
    $toolbar2->SetBoton("cerrarMantenimientoUnidadMedida", "Cerrar  ", "btn", "onclick,onkeypress", "cerrarMantenimientoUnidadMedida()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/cerrar1.gif", "", "", 1);
    $toolbar2->Mostrar();
    ?> 
</div>  





