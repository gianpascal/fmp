<?php
$toolbar1 = new ToollBar();
$toolbar2 = new ToollBar();
$toolbar3 = new ToollBar();
?>
<div class="titleform">
    <h1>Mantenimiento</h1>
</div>
<br> 
<div id="divMantenimientoAlmacen">
    <div  style="float:left; padding-left:30px; heigth:150px; width: 50px;">
        <input id="txtCodAlmacen" name="txtCodAlmacen" type:text style="display:none; font-size: 16px; width:20px;" value="<?php
echo utf8_encode($arrayDatosAlmacen[0][7]);
?>">
    </div>
    <div  style="float:left; padding-left:30px; heigth:150px; width: 50px;">
        <input id="txtCodAmbienteFi"  name="txtCodAmbienteFi" type:text style="display:none;  font-size: 16px; width:20px;" value="<?php
               echo utf8_encode($arrayDatosAlmacen[0][6]);
?>">
    </div>
    <br><br> 
    <div id="lblCodigoPer" style="float:left ;padding-left: 30px; font-family: verdana; heigth:50px; width: 110px;">Codigo Persona:</div>
    <div style="float:left; padding-left: 30px; heigth:150px; width: 330px;">
        <input id="txtCodPer" name="txtCodPer" type:text readonly="" style=" font-size: 16px; width:70px;" value="<?php
               echo utf8_encode($arrayDatosAlmacen[0][8]);
?>">
    </div>
    <br><br>
    <div id="lblNombre" style="float:left ;padding-left: 30px; font-family: verdana; heigth:50px; width: 110px;">Nombre Almacen:</div>
    <div style="float:left; padding-left: 30px; heigth:150px; width: 330px;">
        <input id="txtNombre" name="txtNombre" type:text style=" font-size: 16px; width:300px;" value="<?php
               echo utf8_encode($arrayDatosAlmacen[0][0]);
?>">
    </div>
    <br><br>
    <div id="lblSucursal"style="float:left ;padding-left: 30px; font-family: verdana; heigth:50px; width: 110px;">Sucursal:  </div>
    <div id="cbxSucursal" style="float:left; padding-left:30px; heigth:150px; width: 330px;">
        <select id="cboSucursal"  name="cboSucursal" onchange="limpiardatos()" style="width: 120px; font-size: 14px" value="<?php
               echo utf8_encode($arrayDatosAlmacen[0][1]);
?>">                    <?php
                    echo $comboM;
                    ?>
        </select></div>
    <br><br>
    <div id="lblCodigo" style="float:left ;padding-left: 30px; font-family: verdana; heigth:50px; width: 110px;">Codigo:</div>  
    <div  style="float:left; padding-left:30px; heigth:150px; width: 330px;">
        <input id="txtCodigo" name="txtCodigo" type:text  readonly="" style="  font-size: 16px; width:200px;"  value="<?php
                    echo utf8_encode($arrayDatosAlmacen[0][3]);
                    ?>">
    </div>
    <br><br>
    <div id="lblAmbiFisico" style="float:left ;padding-left: 30px; font-family: verdana; heigth:50px; width: 110px;">Almacen Fisico: </div>
    <div  style="float:left; padding-left:30px; heigth:150px; width: 230px;">
        <input id="txtAmbiFisico"   name="txtAmbiFisico" type:text readonly="" style=" font-size: 16px; width:200px;"  value="<?php
               echo utf8_encode($arrayDatosAlmacen[0][4]);
                    ?>">
    </div>
    <div style="float:left;">
        <?php
        $toolbar2->SetBoton("asignarAlmacenFisico()", "Buscar", "btn", "onclick,onkeypress", "asignarAlmacenFisico()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/Search.png", "", "", 1);
        $toolbar2->Mostrar();
        ?>
    </div>
    <br><br><br>
    <div id="lblDescripcion" style="float:left ;padding-left: 30px; font-family: verdana; heigth:50px; width: 110px;">Descripcion:  </div>
    <div   style="float:left; padding-left:30px; heigth:10px; width: 230px;">
        <input id="txtDescripcion" name="txtDescripcion" style="font-size: 16px; width:300px;" value="<?php
        echo utf8_encode($arrayDatosAlmacen[0][5]);
        ?>"> 
    </div>
    <br><br><br><br>
    <div style="float:left; padding-left: 150px; padding-top: 35px;">
        <?php
        $toolbar1->SetBoton("grabarMantenimientoAlmacenEvento", "Guardar", "btn", "onclick,onkeypress", "grabarMantenimientoAlmacenEvento()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/grabar.png", "", "", 1);
        $toolbar1->Mostrar();
        ?> 
    </div>
    <div style="float:left; padding-left: 15px; padding-top: 35px;">
        <?php
        $toolbar3->SetBoton("cerrarMantenimientoAlmacenEvento()", "Cerrar  ", "btn", "onclick,onkeypress", "cerrarMantenimientoAlmacenEvento()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/cerrar1.gif", "", "", 1);
        $toolbar3->Mostrar();
        ?> 
    </div>
</div>



