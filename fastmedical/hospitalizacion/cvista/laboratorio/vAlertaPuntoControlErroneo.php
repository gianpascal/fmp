
<?php
$toolbar1 = new ToollBar("center");

?>

<div style="width: 500px; float: left; height: 300px;" class="toolbar" id="divDetallePuntoControl">
    <fieldset style="margin:1px;width:500px;height: 296px;padding: 0px; font-size:1.2em;">
        <legend>Procesar Punto de Control</legend>
        <div style="padding: 10px;">
            <div id="fila1" style="height:30px; width:400px">
                <div id="cell11" style="float:left; width:100px;">Nombre:</div>
                <div id="cell12" style="float:left; width:300px;">
                    <?php echo $datos['nombre']; ?>
                </div>
            </div>
            <div style="clear: both;height: 10px"></div>

            <div id="fila2" style="height:30px; width:400px">
                <div id="cell21" style="float:left; width:100px;">Fecha:</div>
                <div id="cell22" style="float:left; width:300px;">
                    <?php echo $datos['fecha']; ?>
                </div>
            </div>
            <div id="fila2" style="height:30px; width:400px">
                <div id="cell21" style="float:left; width:100px;">Afiliacion:</div>
                <div id="cell22" style="float:left; width:300px;">
                    <?php echo $datos['afiliacion']; ?>
                </div>
            </div>
            <div id="fila2" style="height:30px; width:400px">
                <div id="cell21" style="float:left; width:100px;">Examen:</div>
                <div id="cell22" style="float:left; width:300px;">
                    <?php echo $datos['examen']; ?>
                </div>
            </div>
            <div id="fila2" style="height:30px; width:400px">
                <div id="cell21" style="float:left; width:100px;">Procedencia:</div>
                <div id="cell22" style="float:left; width:300px;">
                    <?php echo $datos['procedencia']; ?>
                </div>
            </div>
            <div id="fila2" style="height:30px; width:400px">
                <div id="cell21" style="float:left; width:100px;">Ubicación:</div>
                <div id="cell22" style="float:left; width:300px;">
                    <?php echo $datos['ubicacion']; ?>
                </div>
            </div>
            <div id="fila2" style="height:30px; width:400px">
                <div id="cell21" style="float:left; width:100px;">Estado:</div>
                <div id="cell22" style="float:left; width:300px;">
                    <?php echo $datos['estado']; ?>
                </div>
            </div>
            
            <div id="fila3" style="height:30px; width:400px">
                <table border="0">
                    <tr>
                        
                         <td>
                            <?php
                            $toolbar1->SetBoton("cerrar", "Cerrar", "btn", "onclick,onkeypress", "Windows.close('Div_alertaError', event)", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/agt_action_fail.png", "", "", 1);
                            $toolbar1->Mostrar();
                            ?>
                             <input id="cerrarVentanaError" type="text" style="width:0px;" onkeypress="cerrarVentanaPeche('Div_alertaError',event)" /> 
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </fieldset>
</div>