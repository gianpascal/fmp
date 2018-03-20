<?php
$action = 'permiso_usuario';
require_once('../../ccontrol/control/control.php');
//require_once('../../ccontrol/control/loadsession.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><!--Est codificacion es importante para las ventanas emergentes-->
        <title>PANEL DE ADMINISTRACI&Oacute;N V.3.</title>
        <style>
            input[type='text'],select{
                border:1px solid #82A6C6 ;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="../../../../medifacil_front/estilo/panel.css" />
        <link rel="stylesheet" type="text/css" href="../../estilo/style.css" />

        <!-- ================ ESTILOS CSS   ========================== -->
        <style type="text/css">
            @import url("../../../../medifacil_front/estilo/default.css");
            @import url("../../../../medifacil_front/estilo/alphacube.css");
            @import url("../../../../medifacil_front/estilo/dhtmlxtree.css");
            @import url("../../../../medifacil_front/estilo/dhtmlxtabbar.css");
            @import url("../../../../medifacil_front/estilo/dhtmlxcalendar.css");
            @import url("../../../../medifacil_front/estilo/dhtmlxcombo.css");
            @import url("../../../../medifacil_front/estilo/dhtmlxgrid/dhtmlxgrid.css");
            @import url("../../../../medifacil_front/estilo/dhtmlxgrid/dhtmlxgrid_pgn_bricks.css");
            @import url("../../../../medifacil_front/estilo/dhtmlxgrid/dhtmlxgrid_dhx_skyblue1.css");
            @import url("../../../../medifacil_front/estilo/dhtmlxgrid/dhtmlxgrid_dhx_blue.css");
            @import url("../../../../medifacil_front/estilo/dhtmlxgrid/dhtmlxgrid_dhx_black.css");
            @import url("../../../../medifacil_front/estilo/dhtmlxaccordion/dhtmlxaccordion_dhx_skyblue.css");
            @import url("../../../../medifacil_front/estilo/dhtmlxvault.css");/*para upload*/
            @import url("../../../../medifacil_front/estilo/dhtmlxcolorpicker.css");
        </style>

        <!-- ================ DHTML MENU   ========================== -->
        <script type="text/javascript" src="../../../javascript/stmenu.js"></script>

        <!-----------       FUNCIONES PARA DHTMLXGRID    ----------->
        <script src="../../../javascript/dhtml_grid/dhtmlxcommon.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtml_grid/dhtmlxgrid.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtml_grid/dhtmlxgrid_hmenu.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtml_grid/dhtmlxgrid_pgn.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtml_grid/dhtmlxgridcell.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtml_grid/dhtmlxgrid_markers.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtml_grid/dhtmlxgrid_splt.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtml_grid/dhtmlxgrid_start.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtml_grid/dhtmlxgrid_excell_link.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtml_grid/dhtmlxgrid_filter.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtml_grid/dhtmlxgrid_srnd.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtml_grid/dhtmlxgrid_math.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtml_grid/dhtmlxcombo.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxcolorpicker/dhtmlxcommon.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxcolorpicker/dhtmlxcolorpicker.js" type="text/javascript"></script>
        <script type="text/javascript" src="../../../javascript/dhtml_grid/dhtmlxvault.js"></script>
<!--            <script type="text/javascript" src="../../../javascript/dhtml_tree/dhtmlxcommon.js"></script>-->
<!--        <script type="text/javascript" src="../../../javascript/dhtml_tree/dhtmlxtree.js"></script>-->
<!--        <script type="text/javascript" src="../../../javascript/dhtml_tab/dhtmlxtabbar.js"></script>
       <script type="text/javascript" src="../../../javascript/dhtml_tab/dhtmlxtabbar_start.js"></script>-->
        <!-- ================ DHTML CALENDAR   ========================== -->
        <script type="text/javascript" src="../../../javascript/dhtmlxcalendar/dhtmlxcalendar.js"></script>
        <!-- ================ CALENDARIO dhtml_goodies   ========================== -->
        <script type="text/javascript" src="../../../javascript/dhtmlgoodies_calendar.js"></script>

        <!-----------       FUNCIONES PARA DHTMLXACCORDION    ----------->
        <script src="../../../javascript/dhtmlxaccordion/dhtmlxaccordion.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxaccordion/dhtmlxcontainer.js" type="text/javascript"></script>

        <!-- ================ ISIAJAX - ISIXML ====================== -->
        <script type="text/javascript" src="../../../javascript/isiAJAX.js"></script>
        <script type="text/javascript" src="../../../javascript/isiXML.js"></script>

        <!-- ================ WINDOWS PROTOTYPE TOLLTYPE ============ -->
        <script type="text/javascript" src="../../../javascript/windowsprotoype/prototype.js"></script>
        <script type="text/javascript" src="../../../javascript/windowsprotoype/effects.js"></script>
        <script type="text/javascript" src="../../../javascript/windowsprotoype/window.js"></script>
        <script type="text/javascript" src="../../../javascript/windowsprotoype/window_effects.js"></script>
        <script type="text/javascript" src="../../../javascript/windowsprotoype/debug.js"></script>
        <script type="text/javascript" src="../../../javascript/js_Simi.js"></script><!-- Esto  trabaja junto a  ../../../javascript/js_funciones.js, Tiene implementado el método CargarVentana(...) -->
        <script type="text/javascript" src="../../../javascript/pholivo/poo_pholivo.js"></script><!-- Esto  trabaja con Html1.php -->

        <!-- ================ TREE ============ -->
        <script type="text/javascript" src="../../../javascript/dhtml_tree/dhtmlxcommon.js"></script>
        <script type="text/javascript" src="../../../javascript/dhtml_tree/dhtmlxtree.js"></script>
        <script type="text/javascript" src="../../../javascript/dhtml_tab/dhtmlxtabbar.js"></script>
        <script type="text/javascript" src="../../../javascript/dhtml_tab/dhtmlxtabbar_start.js"></script>

        <!-- ================ HEREDADOS ============ -->
        <!--<script type="text/javascript" src="../../../javascript/citas/citas.js"></script>-->
        <script type="text/javascript" src="../../../javascript/js_funciones.js"></script>
        <script type="text/javascript" src="../../../javascript/HTML_TreeMenu/TreeMenu.js"></script>
        <!-- ================ PROPIOS ============== -->
        <script type="text/javascript" src="../../../javascript/panel/formularios.js"></script>
        <!--<script type="text/javascript" src="../../../panel/java_scripts/panel.js"></script>
        <script type="text/javascript" src="../../../panel/java_scripts/js_funciones.js"></script>-->
        <script type="text/javascript" src="../../javascriptPanel/menu.js"></script>
        <script type="text/javascript" src="../../javascriptPanel/permisos.js"></script>
        <script type="text/javascript">
            var pathRequestControl = "../../ccontrol/control/control.php";
            function cargar_form() {
                myRand = parseInt(Math.random()*999999999999999);
                myajax.Link('fondo.php?rand=' + myRand, 'contenido_inicio');
            }
        </script>



    </head>

    <!--<body onLoad="myajax = new isiAJAX('intro_right_inicio', 'cargador'); myajax2 = new isiAJAX('contenido_detalle', 'cargador'); cargar_form(); ">-->
    <body style="background-color:white;" onLoad="myajax = new isiAJAX('contenido_inicio', 'cargador'); myajax2 = new isiAJAX('contenido_inicio', 'cargador'); cargar_form(); ">   
        <div id="cargador">
            Por Favor Espere &nbsp;&nbsp;&nbsp;&nbsp;
            <img src="../../../../medifacil_front/imagen/icono/cargando.gif"  border="0" title="CARGANDO" alt="Cargador"/><a href="#" id="hider2"></a>
        </div>
        <div id="VentanaTransparente" style="visibility: visible; display: none;">
            <div id="overlayPeche" class="overlay_absolute"></div>
            <div id="cargadorPeche" style="z-index:2000">
                <table width="100%" height="100%" border="0">
                    <tr valign="middle">
                        <td>
                            Por Favor Espere
                        </td>
                        <td>
                            <img src="../../../imagen/inicio/cargando.gif"  border="0" title="CARGANDO" alt="Cargador"/><a href="#" id="hider2"></a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="main">
            <div id="logo">
                <a href="#" onClick="javascript: myajax.Link('fondo.php', 'contenido_inicio');">
                    <h1>Panel de <span class="blue">Administraci&oacute;n</span> V.<span class="blue">3</span></h1>                   
                </a>
                <b class="blue">Usuario:</b>
                <b><?php echo $_SESSION["vlogin_usuario"] ?></b>
                <!--<b class="blue">Oficina:</b>
                <b><?php echo $_SESSION["v_desc_ccos"] ?></b>-->
            </div>
            <div id="relleno">
                <!--<b class="blue">Usuario:</b>
                <b><?php echo $_SESSION["vlogin_usuario"] ?></b>-->
            </div>
            <div id="menu_inicio">
                <?php
                include('../../../menu/menuPanel/menu.php');
                ?>
            </div>
            <div id="contenido_inicio">
            </div>
            <!--<div style="clear:both"></div>-->
            <div id="footer">
                &copy; Copyright <a href="#">Gr@njit@</a><img src="../../../../medifacil_front/imagen/icono/granjita.jpg" alt="Granjita" title="Gr@njit@"/> 2010 &middot;  Actualizado por <a href="#">SIMEDH</a> 2010 &middot; Resoluci&oacute;n de pantalla recomendada: 1024x768 p&iacute;xeles
            </div>
        </div>
    </body>
</html>
