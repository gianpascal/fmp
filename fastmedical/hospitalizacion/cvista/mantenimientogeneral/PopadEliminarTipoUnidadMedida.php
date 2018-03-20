<div class="titleform">
    <h1>Eliminar Tipo Unidad Medida</h1>
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
?>" readonly="" style=" font-size: 16px; width:240px;"/>
</div>
<br><br>
<div style="float:left; padding-left: 100px">
    <?php
    $toolbar3 = new ToollBar();
    ?>
</div>
<div style="float:inherit; padding-left: 140px;">
    <?php
    $toolbar3->SetBoton("eliminarTipoUnidadMedida", "Eliminar  ", "btn", "onclick,onkeypress", "eliminarTipoUnidadMedida()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/i_nomailappt.png", "", "", 1);
    $toolbar3->Mostrar();
    ?> 
</div>  



