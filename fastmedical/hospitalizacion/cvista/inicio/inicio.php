<?php
if (!isset($_SESSION)) {
    session_start();
}

?>
<html>
    <head>
        <title>.: fastmedical :.</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <!--<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">-->
        <!-- ================ ESTILOS CSS   ========================== -->
        <style type="text/css">
            @import url("../../../../fastmedical_front/estilo/simedh.css");
            @import url("../../../../fastmedical_front/estilo/default.css");
            @import url("../../../../fastmedical_front/estilo/alphacube.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxtree.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxtabbar.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxcalendar.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlgoodies_calendar.css");
            @import url("../../../../fastmedical_front/estilo/tabs.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxcombo.css");
            @import url("../../../../fastmedical_front/estilo/autocomplete.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxgrid/dhtmlxgrid.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxgrid/dhtmlxgrid_pgn_bricks.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxgrid/dhtmlxgrid_dhx_skyblue1.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxgrid/dhtmlxgrid_dhx_blue.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxgrid/dhtmlxgrid_dhx_black.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxaccordion/dhtmlxaccordion_dhx_skyblue.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxvault.css");/*para upload*/
            @import url("../../../../fastmedical_front/estilo/dhtmlxcolorpicker.css");
            /*agregado 09 Octubre 2012*/
            @import url("../../../../fastmedical_front/estilo/dhtmlxlayout/dhtmlxlayout.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxlayout/dhtmlxlayout_dhx_black.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxlayout/dhtmlxlayout_dhx_skyblue.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxlayout/dhtmlxlayout_dhx_web.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxlayout/dhtmlxlayout_dhx_blue.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxgrid/dhtmlxgrid_dhx_terrace.css");


            @import url("../../../../fastmedical_front/estilo/dhtmlxlayout/dhtmlx_custom.css");

            /*agregado 11 Octubre 2012*/

            @import url("../../../../fastmedical_front/estilo/dhtmlxchart/dhtmlxchart.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxchart/dhtmlxchart_debug.css");

            /*agregado 22 Octubre 2012*/
            @import url("../../../../fastmedical_front/estilo/dhtmlxwindows/dhtmlxwindows.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxwindows/dhtmlxwindows_dhx_black.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxwindows/dhtmlxwindows_dhx_blue.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxwindows/dhtmlxwindows_dhx_skyblue.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxwindows/dhtmlxwindows_dhx_terrace.css");
            @import url("../../../../fastmedical_front/estilo/dhtmlxwindows/dhtmlxwindows_dhx_web.css");

        </style>
        <style>
            .cs_colorBox {
                float:right;
            }
        </style>
        <script src="https://www.gstatic.com/firebasejs/5.0.4/firebase.js"></script>
        <script>
        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyDR9uIGZ7dzeZOwUmhvSMIWMC2Nofr3RWs",
            authDomain: "fastmedical-2197c.firebaseapp.com",
            databaseURL: "https://fastmedical-2197c.firebaseio.com",
            projectId: "fastmedical-2197c",
            storageBucket: "fastmedical-2197c.appspot.com",
            messagingSenderId: "1008905646985"
        };
        firebase.initializeApp(config);
        </script>
        <!-- ================ DHTML MENU   ========================== -->
        <script type="text/javascript" src="../../../javascript/stmenu.js"></script>
        <!-- ================ DHTML CALENDAR   ========================== -->
        <script type="text/javascript" src="../../../javascript/dhtmlxcalendar/dhtmlxcalendar.js"></script>
        <!-- ================ CALENDARIO dhtml_goodies   ========================== -->
        <script type="text/javascript" src="../../../javascript/dhtmlgoodies_calendar.js"></script>
        <!-- ================ ISIAJAX - ISIXML ====================== -->
        <script type="text/javascript" src="../../../javascript/isiAJAX.js"></script>
        <script type="text/javascript" src="../../../javascript/isiXML.js"></script>

        <!-- ================ FUNCIONES HOSPITALIZACION ============ -->
        <script type="text/javascript" src="../../../javascript/hospitalizacion.js"></script>
        <!-- ================ FUNCIONES PROGRAMACION CITAS ============ -->
        <script type="text/javascript" src="../../../javascript/citas/citas.js"></script>
        <script type="text/javascript" src="../../../javascript/citas/informescitas.js"></script>
        <script type="text/javascript" src="../../../javascript/citas/apoyoaldiagnostico.js"></script>
        <!-- ================ FUNCIONES PROGRAMACION MEDICOS ============ -->
        <script type="text/javascript" src="../../../javascript/programacion/programacionMedicos.js"></script>
        <!-- ================ FUNCIONES PROGRAMACION SOP ============ -->
        <script type="text/javascript" src="../../../javascript/programacion/sop.js"></script>
        <!-- ================ ACTO MEDICO ============ -->
        <script type="text/javascript" src="../../../javascript/actomedico/actomedico.js"></script>
        <script type="text/javascript" src="../../../javascript/actomedico/llamarPaciente2.js"></script>
        <!-- ================ FARMACIA ============ -->
        <script type="text/javascript" src="../../../javascript/farmacia/farmacia.js"></script>

        <!--<script type="text/javascript" src="../../../javascript/ordenes.js"></script>-->
        <script type="text/javascript" src="../../../javascript/rrhh.js"></script>
        <script type="text/javascript" src="../../../javascript/menus.js"></script>
        <script type="text/javascript" src="../../../javascript/buscarPersona.js"></script>
        <script type="text/javascript" src="../../../javascript/buscadorPersona.js"></script><!--Buscador Pendex-->
        <script type="text/javascript" src="../../../javascript/simedh_admision.js"></script>
        <script type="text/javascript" src="../../../javascript/simedh_laboratorio.js"></script>
        <script type="text/javascript" src="../../../javascript/tesoreria/tarifas.js"></script>
        <script type="text/javascript" src="../../../javascript/tesoreria/ordenes.js"></script>
        <script type="text/javascript" src="../../../javascript/farmacia/farmacia.js"></script>
        <!-- ================ MANTENIMIENTO GENERAL ============ -->
        <script type="text/javascript" src="../../../javascript/mantenimientogeneral/ambienteslogicos.js"></script>
        <script type="text/javascript" src="../../../javascript/mantenimientogeneral/ambientesfisicos.js"></script>
        <script type="text/javascript" src="../../../javascript/mantenimientogeneral/turnos.js"></script>
        <script type="text/javascript" src="../../../javascript/mantenimientogeneral/mantenimientoArea.js"></script>
        <script type="text/javascript" src="../../../javascript/mantenimientogeneral/mantenimientoIP.js"></script>


        <!-- ================ RRHH ============ -->
        <script type="text/javascript" src="../../../javascript/rrhh/personal.js"></script>
        <script type="text/javascript" src="../../../javascript/rrhh/serviciosXpuestos.js"></script>
        <script type="text/javascript" src="../../../javascript/rrhh/PuestosXcentroDeCostos.js"></script>


        <!-- ================ LABORATORIO ============ -->
        <script type="text/javascript" src="../../../javascript/laboratorio/laboratorioPeche.js"></script>

        <!-- ================ CARNETIZACION ============ -->
        <script type="text/javascript" src="../../../javascript/carnetizacion/carnetizacion.js"></script>
        <!-- ================ REPORTES PARA ESSALUD ============ -->
        <script type="text/javascript" src="../../../javascript/reportes/reportes.js"></script>

        <!-- ================ FUNCION MANUAL DE AYUDA ============ -->
        <script type="text/javascript" src="../../../javascript/ayuda/manualayuda.js"></script>
        <!-- ================ GESTION DE USUARIO ============ -->
        <script type="text/javascript" src="../../../javascript/usuario/usuarios.js"></script>
        <!-- ================ FUNCION MANUAL DE AYUDA ============ -->
        <script type="text/javascript" src="../../../javascript/ayuda/acercade.js"></script>

        <!-- ================ WINDOWS PROTOTYPE TOLLTYPE ============ -->
        <script type="text/javascript" src="../../../javascript/windowsprotoype/prototype.js"></script>
        <script type="text/javascript" src="../../../javascript/windowsprotoype/effects.js"></script>
        <script type="text/javascript" src="../../../javascript/windowsprotoype/window.js"></script>
        <script type="text/javascript" src="../../../javascript/windowsprotoype/window_effects.js"></script>
        <script type="text/javascript" src="../../../javascript/windowsprotoype/debug.js"></script>
        <script type="text/javascript" src="../../../javascript/windowsprotoype/autocomplete.js"></script>
        <!--<script type="text/javascript" src="../../../javascript/windowsprotoype/deserialize.js"></script>-->
        <!-- ================ TREE ============ -->
        <script type="text/javascript" src="../../../javascript/dhtml_tree/dhtmlxcommon.js"></script>
        <script type="text/javascript" src="../../../javascript/dhtml_tree/dhtmlxtree.js"></script>
        <script type="text/javascript" src="../../../javascript/dhtml_tab/dhtmlxtabbar.js"></script>
        <script type="text/javascript" src="../../../javascript/dhtml_tab/dhtmlxtabbar_start.js"></script>
        <!-- ================ OTRAS FUNCIONES - REVISAR ============= -->
        <script type="text/javascript" src="../../../javascript/tooltip.js"></script>
        <script type="text/javascript" src="../../../javascript/admincon.js"></script>
        <script type="text/javascript" src="../../../javascript/js_funciones.js"></script>
        <script type="text/javascript" src="../../../javascript/js_Simi.js"></script>
        <script type="text/javascript" src="../../../javascript/uploader.js"></script>
        <!-- ================ FUNCIONES - MODULOS ============= -->
        <script type="text/javascript" src="../../../javascript/cronograma.js"></script>
        <!--CRONOGRAMA-->
        <!--=============================CAJA===================================-->
        <script type="text/javascript" src="../../../javascript/caja/caja.js"></script>
        <script src="../../../javascript/HTML_TreeMenu/TreeMenu.js" type="text/javascript"></script>
        <!--HTML_TreeMenu-->
        <!-- poo_pholivo-->
        <script type="text/javascript" src="../../../javascript/pholivo/poo_pholivo.js"></script>
        <!-----------       FUNCIONES PARA RADIO  Y CHECBOX    --------- -->
        <!--<script src="../../../javascript/crir.js" type="text/javascript"></script>-->

        <!-----------       FUNCIONES PARA DHTMLXGRID    --------- -->
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
        <script src="../../../javascript/dhtml_grid/dhtmlxgrid_export.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxtreegrid/dhtmlxtreegrid.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxtreegrid/dhtmlxtreegrid_lines.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxtreegrid/dhtmlxtreegrid_filter.js" type="text/javascript"></script>


        <!-----------       FUNCIONES PARA WINDOWS    --------- -->
        <script src="../../../javascript/dhtml_windows/dhtmlxwindows.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtml_windows/dhtmlxcontainer.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtml_windows/dhtmlxcommon.js" type="text/javascript"></script>


        <!-----------       FUNCIONES PARA DHTMLXACCORDION    --------- -->
        <script src="../../../javascript/dhtmlxaccordion/dhtmlxaccordion.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxaccordion/dhtmlxcontainer.js" type="text/javascript"></script>
        <!-----------       FUNCIONES PARA AFILIACIONES    --------- -->
        <script src="../../../javascript/afiliaciones/afiliaciones.js" type="text/javascript"></script>

        <!-----------       FUNCIONES PARA DHTMLXCOLORPICKER agregado 18 Abril 2012 --------- -->

        <script src="../../../javascript/dhtmlxcolorpicker/dhtmlxcommon.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxcolorpicker/dhtmlxcolorpicker.js" type="text/javascript"></script>

        <!-----------       FUNCIONES PARA DHTMLXLAYOUT agregado 09 Octubre del 2012 --------- -->

        <script src="../../../javascript/dhtmlxlayout/dhtmlxcommon.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxlayout/dhtmlxcontainer.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxlayout/dhtmlxlayout.js" type="text/javascript"></script>

        <script src="../../../javascript/dhtmlxlayout/patterns/dhtmlxlayout_pattern4a.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxlayout/patterns/dhtmlxlayout_pattern4c.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxlayout/patterns/dhtmlxlayout_pattern4e.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxlayout/patterns/dhtmlxlayout_pattern4f.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxlayout/patterns/dhtmlxlayout_pattern4g.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxlayout/patterns/dhtmlxlayout_pattern4j.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxlayout/patterns/dhtmlxlayout_pattern4l.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxlayout/patterns/dhtmlxlayout_pattern4w.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxlayout/patterns/dhtmlxlayout_pattern5e.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxlayout/patterns/dhtmlxlayout_pattern5u.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxlayout/patterns/dhtmlxlayout_pattern5w.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxlayout/patterns/dhtmlxlayout_pattern6c.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxlayout/patterns/dhtmlxlayout_pattern6e.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxlayout/patterns/dhtmlxlayout_pattern7h.js" type="text/javascript"></script>

        <!--       fin-->

        <!-----------       FUNCIONES PARA DHTMLXCHART agregado 09 Octubre del 2012 --------- -->

        <script src="../../../javascript/dhtmlxchart/dhtmlxchart.js" type="text/javascript"></script>
        <script src="../../../javascript/dhtmlxchart/dhtmlxchart_debug.js" type="text/javascript"></script>


        <!-- =================== Para el editor de texto =================
        <script type="text/javascript" src="../../../javascript/editor_texto/jscripts/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript" src="../../../javascript/editor_texto/tinyMCE.js"></script>
        -->
        <script type="text/javascript" src="../../../javascript/edit_text/ckeditor.js"></script>
        <script type="text/javascript" src="../../../javascript/uploaderCV.js"></script>
        <script type='text/javascript' src='../../../javascript/colorpicker/procolor.compressed.js'></script>
        <!--  plugin para los tabs mejora -->
        <script type="text/javascript" src="../../../javascript/pluginTabs.js"></script>
        <script type="text/javascript" src="../../../javascript/mant_reportes/mant_reportes.js"></script>
        <script type="text/javascript" src="../../../javascript/emergencia/emergencia.js"></script>
        <script type="text/javascript" src="../../../javascript/hospitalizacion/hospitalizacion.js"></script>
        <!--  fin plugin para los tabs mejora  -->
        <!--      plugin para upload         -->
        <script type="text/javascript" src="../../../javascript/dhtml_grid/dhtmlxvault.js"></script>
        <script type="text/javascript" src="../../../javascript/procesing/processing.min.js"></script>
        <!--      fin plugin para upload      -->
        <!--       para módulo de carga de horarios      -->
        <!--     fin para módulo de carga de horarios    -->
        <script type="text/javascript" src="../../../javascript/canvas-toBlob.js"></script>
        <!-- ===================           fin           =================== -->
        <!-----------       CARGAR IMAGEN DE FONDO    --------- -->
        <script type="text/javascript" src="../../../javascript/inicio.js"></script>

        <link rel="icon" type="image/png" href="../../../../fastmedical_front/fotos/icono_f.png" />
    </head>


    <body onLoad="cargar_form();" onunload="actualiza_sesion()">
     <!-----------       VENTANA DE CARGA DE DATOS    --------- -->
     <div id="VentanaTransparente">
        <div id="overlayPeche" class="overlay_absolute"></div>
        <div id="cargador" style="z-index:2000">
            <table width="100%" height="100%" border="0">
                <tr>
                    <td>
                        <div id="cssload-wrapper">
                            <div class="cssload-loader">
                                <div class="cssload-line"></div>
                                <div class="cssload-line"></div>
                                <div class="cssload-line"></div>
                                <div class="cssload-line"></div>
                                <div class="cssload-line"></div>
                                <div class="cssload-line"></div>
                                <div class="cssload-subline"></div>
                                <div class="cssload-subline"></div>
                                <div class="cssload-subline"></div>
                                <div class="cssload-subline"></div>
                                <div class="cssload-subline"></div>
                                <div class="cssload-loader-circle-1"><div class="cssload-loader-circle-2"></div></div>
                                <div class="cssload-needle"></div>
                                <div class="cssload-loading">Espere porfavor</div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

        </div>
    </div>
        <!-----------       CABECERA CON DATOS DEL USUARIO   ----------->
        <div id="Main">
            <div id="Fondo"></div>
            <div id="Name">
                <div id="Mi"></div>
                <div id="Md"></div>
                <div id="user">

                    <p><span>
                            <a href='#' onclick="abrirotraventana();"><img src="../../../../fastmedical_front/../fastmedical_front/imagen/icono/icono_mundo_f.png" title="Abrir otra ventana" border="0"></a>
                            <a href='#' onclick="menuDatosUsuario();"><img src="../../../../fastmedical_front/../fastmedical_front/imagen/icono/kuser.png" alt='Opciones de Usuarios' title='Opciones de Usuarios' border='0'/></a>
                            <a href='#' onclick="CargarVentana('popupManteUsuario', 'Cambiar Contraseña', '../usuario/manteUsuario.php', '265', '150', false, true, '', 1, '', 10, 10, 10, 10);"><img src="../../../../fastmedical_front/../fastmedical_front/imagen/icono/decrypted.png" alt='Cambiar contraseña' title='Cambiar contraseña' border='0'/></a><?php echo strtoupper($_SESSION["login_user"]); ?></span></p>

                </div>

                <a href="#" title="INICIO" onClick="javascript:cargar_form();">
                    <!--                    <div id="MainLogo01"></div>
                                        <div id="MainLogo02"></div>-->
                    <div id="MainLogo"></div>
                </a>
                <div id="salir" style="cursor:pointer;"  onClick="cierra_sesionSimedh();"></div>
                <div id="MainMenu">
                    <div id="Menu">
                        <?php include '../menu/menu.php';?>
                    </div>
                </div>
            </div>
            <input type="hidden" id="hCodigoCentroCosto" name="hCodigoCentroCosto" value="<?php echo strtoupper($_SESSION["c_cod_ccos"]); ?>" />
            <div id="Contenedor" style="width:100%;">
                <div id="Contenido" ></div>
                <div id="ManteContenido"></div>
                <div style="clear:both"></div>
            </div>
            <div id="Footer">
                <div id="textizq">Copyright &copy; Todos los Derechos Reservados - 2017</div>
                <div id="textder"><?php echo "Ing. Giancarlo Arroyo - gianpascal@gmail.com"; //$_SESSION["nom_empresa"]                                                 ?></div>
            </div>
        </div>
    </body>
</html>
