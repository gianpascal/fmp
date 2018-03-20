
<?php
require_once("../../ccontrol/control/ActionActoMedico.php");
$o_ActionActoMedico = new ActionActoMedico();
$datos['servicio'] = '%';
?>
<div style="background-color:white;height: 100%;width: 100%;">
    <div style="width: 96%;height:5%;padding:2%;">
        <table style="border:0px solid;width: 60%;height: 100%;">
            <tr>
                <td style="width:90px;">
                    <p style="font-size:24px;font-family: segoe UI;color:#006631"> Buscar:
                </td>
                <td>
                    <input id="txtBusquedaServicio" type="text" style="background-color:#E9E9E9;border:1px solid #006631;font-size:24px;font-family: segoe UI;color:#006631;float:left;" onkeyup="filtrarServiciosManteni(event)"/>
                </td>   
                <td>

                </td>
            </tr>
        </table>
    </div>
    <script>
                        document.getElementById('txtBusquedaServicio').focus();
    </script>
    <div style="border:0px solid;width: 40%;height:600px;float:left;padding:20px;">
        <div id="contenedorServicios"style=" height:600px;border:1px solid">
            <?php
            echo $o_ActionActoMedico->cargarTablaServicios($datos);
            ?>
        </div>
    </div>
    <div style="border:0px solid;width:6%;height:600px;float:left;padding:20px;">

    </div>
    <div style="border:0px solid;width: 39.5%;height:600px;float:left;background-color: white;">
        <div id="contenidoMantenimiento" style="border:0px solid;width: 100%;height: 90%;">

        </div>
    </div>
</div>

<input type="hidden" id="idServicio"/>
