<?php
$toolbar1 = new ToollBar("center");
$toolbar2 = new ToollBar("center");
?>

<div style="width: 500px; float: left; height: 250px;" class="toolbar" id="divDetallePuntoControl">
    <fieldset style="margin:1px;width:500px;height: 196px;padding: 0px; font-size:1.2em;">
        <legend>Procesar Punto de Control</legend>
        <div style="padding: 10px;">
            <div id="fila1" style="height:30px; width:400px">
                <div id="cell11" style="float:left; width:150px;">Punto de Control:</div>
                <div id="cell12" style="float:left; width:250px;">
                    <?php echo $nombrePuntoControl; ?>
                </div>
            </div>
            <div style="clear: both;height: 10px"></div>

            <div id="fila2" style="height:30px; width:400px">
                <div id="cell21" style="float:left; width:150px;">Código de Barras:</div>
                <div id="cell22" style="float:left; width:250px;">
                    <input type="text" value="" name="txtCodigoBarras" id="txtCodigoBarras" style="width:180px;" onkeypress="verificarProcesarPacientePuntoControl('enter',event)" >
                </div>
            </div>
            <div id="fila3" style="height:30px; width:400px">
                <table border="0">
                    <tr>
                        <td>
                            <?php
                            $toolbar1->SetBoton("procesar", "Procesar", "btn", "onclick,onkeypress", "verificarProcesarPacientePuntoControl('click','')", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/Drawer-Open.png", "", "", 1);
                            $toolbar1->Mostrar();
                            ?>
                        </td>
                         <td>
                            <?php
                            $toolbar2->SetBoton("cancelar", "Cancelar", "btn", "onclick,onkeypress", "cancelarProcesarPuntoControl()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/agt_action_fail.png", "", "", 1);
                            $toolbar2->Mostrar();
                            ?>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </fieldset>
</div>