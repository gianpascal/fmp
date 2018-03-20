<?php
$toolbar9 = new ToollBar("center");
$toolbar10 = new ToollBar("center");
?>

<div id="asignacionAreas" style=" float:right;width:100%; height:50%; " align="center">
    <div  id ="divInfoSedes">
        <fieldset style="margin:1px;width:80%;height:auto;padding: 0px; font-size:14px">
            <legend style="margin:4%">Asignaci&oacute;n de &Aacute;reas a Sedes</legend>
            <div id="divCheckBoxSedes" align="left" style="margin-left:25%">
                <form id="ckbSucursales">
                    <?php foreach ($comboSucursal as $i => $value) { ?>                            
                        <input type="checkbox" name="<?php echo $comboSucursal[$i][14] ?>" id="<?php echo $comboSucursal[$i][0] ?>" value=0  onclick="if(this.checked){this.value=1}else{this.value=0;}" onchange="cargarIdSucursal('<?php echo $comboSucursal[$i][0] ?>',this.value)"/><?php echo utf8_encode($comboSucursal[$i][14]) ?><br>
                    <?php } ?>
                </form>
                <?php
                if (isset($_SESSION["permiso_formulario_servicio"][237]["SELECCIONAR_TODAS_SEDES"]) && ($_SESSION["permiso_formulario_servicio"][237]["SELECCIONAR_TODAS_SEDES"] == 1)) {
                    $verBotonSeleccionarTodasSedes = 1;
                } else {
                    $verBotonSeleccionarTodasSedes = 0;
                }
                if (isset($_SESSION["permiso_formulario_servicio"][237]["LIMPIAR_SEDES_SELECCIONADAS"]) && ($_SESSION["permiso_formulario_servicio"][237]["LIMPIAR_SEDES_SELECCIONADAS"] == 1)) {
                    $verBotonLimpiarTodasSedesSeleccionadas = 1;
                } else {
                    $verBotonLimpiarTodasSedesSeleccionadas = 0;
                }
                $toolbar9->SetBoton("btnSeleccionaTodasSucurles", "Seleccionar Todas", "btn", "onclick,onkeypress", "opcionCkbSucursales(1)", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/op_atendido.gif", "", "", $verBotonSeleccionarTodasSedes);
                $toolbar9->SetBoton("btnLimpiaCkbSucursales", "Limpiar", "btn", "onclick,onkeypress", "opcionCkbSucursales(0)", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/limpiar.png", "", "", $verBotonLimpiarTodasSedesSeleccionadas);
                $toolbar9->Mostrar();
                ?>
            </div>
        </fieldset>
    </div> 
    <br>


    <div align="center" style="margin-left: 45%">
        <?php
        if (isset($_SESSION["permiso_formulario_servicio"][237]["GRABAR_AREA_A_SEDES_MASIVAMENTE"]) && ($_SESSION["permiso_formulario_servicio"][237]["GRABAR_AREA_A_SEDES_MASIVAMENTE"] == 1)) {
            $toolbar10->SetBoton("btnAsignarArea", "Asignar", "btn", "onclick,onkeypress", "asignarAreaASucursal('nuevo')", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/clean.png", "", "", 1);
            $toolbar10->Mostrar();
        }
        ?>
    </div>
</div>