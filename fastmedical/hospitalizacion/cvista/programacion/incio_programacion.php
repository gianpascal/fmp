<?php
require_once("../../../pholivo/Html.php");
$toolbar=new ToollBar("left");
//$toolbar->SetBoton("PROFESIONAL","Profesional","btn","onclick,onkeypress","cargar_profesional",$_SESSION['path_principal']."../medifacil_front/imagen/icono/add_user2.png");
$toolbar->SetBoton("BUSCAR","Buscar","btn","onclick,onkeypress","myajax.Link('../../ccontrol/control.php?p1=cro_busca_profesional&p2='+document.getElementById('campo').value,'busca_tipo')","../../../../medifacil_front/imagen/icono/add_user2.png");
?>
<html>
    <head>
        <!-- ================ ISIAJAX - ISIXML ====================== -->
        <script language="javascript" src="../../../javascript/isiAJAX.js"></script>
        <script language="javascript" src="../../../javascript/isiXML.js"></script>
    </head>
    <div id="VentanaTransparente">
    <div class="overlay_absolute"></div>
      <div id="cargador" style="z-index:2000">
        <table width="100" height="40" border="0">
        <tr valign="middle">
        <td>
        Por Favor Espere    </td>
        <td>
        <img src="../../../imagen/inicio/cargando.gif"  border="0" title="CARGANDO"/><a href="#" id="hider2"></a></td>
        </tr>
        </table>
      </div>
    </div>
    <body onLoad="myajax = new isiAJAX('Contenido', 'VentanaTransparente');">
        <fieldset>
            <legend>BUSQUEDA DE MEDICOS</legend>
            <div id="toolbar_interior" style="width:95%; height:40px;">
                <table>
                    <tr>
                        <td>PROFESIONAL: <input type="text" id="campo" name="campo"/></td>
                        <td><?php $toolbar->Mostrar()?></td>
                    </tr>
                </table>
            </div>
            <div id="busca_tipo" style="width:100%;"></div>
        </fieldset>
    </body>
</html>