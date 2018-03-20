<?php
$contador = count($arrayComboM);
?>
<table style="width: 100%;height:6%;border:0px solid;">
    <tr>
        <td style="width: 10%;">
            <p style="padding-left:15px;font-size:14px;font-family: segoe ui;color:#024683;"><b>Afiliaciones</b></p>
        </td>
        <td style="width: 70%;">
            <select id="cboAfiliaciones" style="font-size:14px; font-family: segoe ui;width: 210px; height: 25px;border:1px solid #D1BD9A;" onchange="CargarPaquetes()">
                <?php for ($x = 0; $x <= $contador - 1; $x++) { ?>
                    <option value="<?php echo $arrayComboM[$x][0]; ?>"><?php echo $arrayComboM[$x][1]; ?> </option>
                <?php } ?>
            </select>
        </td>
    </tr>
</table>

<table style="width: 100%;height:6%;border:0px solid;">
    <tr>
        <td style="width: 10%;">
            <p style="padding-left:15px;font-size:14px;font-family: segoe ui;color:#024683;"><b>Codigo :</b></p>
        </td>
        <td style="width: 70%;">
            <input type="text" id="idPaquete"  name="idPaquete" style="border:1px solid white; font-size:16px; font-family: segoe ui;color:black;height: 25px;width:110px;background-color: white;" />   
        </td>
    </tr>
</table>

<table style="width: 100%;height:6%;border:0px solid;">
    <tr>
        <td style="width: 10%;">
            <p style="padding-left:15px;font-size:14px;font-family: segoe ui;color:#024683;"><b>Paquete:</b></p>
        </td>
        <td style="width: 70%;">
            <input type="text" id="nombrePaquete"  name="nombrePaquete" style="border:1px solid white; font-size:16px; font-family: segoe ui;color:black;height: 25px;width: 620px;background-color: white;" />   
        </td>
    </tr>
</table>
<table style="width: 100%;height:70%;border:0px solid;">
    <tr>
        <td style="width: 100%;height: 90%">
            <div id="contenedorTablaProductosPaquete" style="width: 100%;height:80%;border:1px solid;">

            </div
        </td>
    </tr>
    <tr>
        <td style="width: 100%;height: 90%">
            <p style="padding-left:505px;font-size:14px;font-family: segoe ui;color:#024683;"><b>Total:</b><input type="text" id="txtTotal"  name="txtTotal" style="padding-left: 15px;border:1px solid white; font-size:16px; font-family: segoe ui;color:black;height: 25px;width:120px;background-color: white;" disabled/>   
        </td>
    </tr>
</table>
