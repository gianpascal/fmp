<?php
$toolbar1 = new ToollBar("center");
$toolbar2 = new ToollBar("center");
$toolbar3 = new ToollBar("center");
$hoy = date("d/m/Y");
?>
<div style="width:1000px; height:600px;  margin:1px auto; border: #006600 solid" id="divContenidoProcesarPuntoControl">
    <div class="titleform">
        <h1>Procesar Punto Control</h1>
    </div>
    <div class="toolbar" style="width: 900px">
        <table border="0">

            <tr>
                <td>Punto de Control</td>
                <td> <select name="select" id="cboPuntoControl" style="width:120px; font-size:9px" onchange="obtenerPersonasPuntoControl();">
                        <?php
                        echo $comboHTML;
                        ?>
                    </select></td>
                <td>Fecha</td>
                <td>
                    <input type="checkbox" name="checkFecha" value="1" checked onclick="noeditarFecha();" id="checkFecha"/>
                    <input id="textFecha" type="text" name="" value="<?php echo $hoy; ?>" onclick="calendarioHtmlx('textFecha')"  />
                    <input id="htextFecha" type="hidden" name="" value="<?php echo $hoy; ?>" />
                </td>
                <td> 
                    <?php
                    $toolbar3->SetBoton("Refrescar", "Refrescar", "btn", "onclick,onkeypress", "obtenerPersonasPuntoControl()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/kservices.png", "", "", 1);
                    $toolbar3->Mostrar();
                    ?>
                </td>
            </tr>

        </table>



    </div>
    <div id="divTablaProcesarPuntoControl" style="width:990px; height: 500px;">

    </div>
    <div id="divBotonRecibir" align="center" style="width:200px; height:30px; float: left">
        <?php
        $toolbar1->SetBoton("recibir", "Recibir", "btn", "onclick,onkeypress", "recibirPuntoControl()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/Drawer-Open.png", "", "", 1);
        $toolbar1->Mostrar();
        ?>
    </div>
    <div id="divBotonRecibir" align="center" style="width:200px; height:30px; float: left;">
        <?php
        $toolbar2->SetBoton("procesar", "Procesar", "btn", "onclick,onkeypress", "procesarPuntocontrol()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/kservices.png", "", "", 1);
        $toolbar2->Mostrar();
        ?>
    </div>



</div>
