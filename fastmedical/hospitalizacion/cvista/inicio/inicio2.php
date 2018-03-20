<html>
<head>
<title>.: Sistema Medico Hospitalario :: SIMEDH :.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="STYLESHEET" type="text/css" href="front/dhtmlXGrid.css">
<style type="text/css">
<!--
@import url("../../../estilo/simedh.css");
@import url("../../../estilo/default.css");
@import url("../../../estilo/alphacube.css");
@import url("../../../estilo/dhtmlxtree.css");
@import url("../../../estilo/dhtmlxtabbar.css");
@import url("../../../estilo/crir.css");
@import url("../../../estilo/dhtmlgoodies_calendar.css");
-->
</style>
<!-- ================ DHTML MENU   ========================== -->
<script language="javascript" src="../../../javascript/stmenu.js"></script>
<!-- ================ CALENDARIO dhtml_goodies   ========================== -->
<script language="javascript" src="../../../javascript/dhtmlgoodies_calendar.js"></script>
<!-- ================ ISIAJAX - ISIXML ====================== -->
<script language="javascript" src="../../../javascript/isiAJAX.js"></script>
<script language="javascript" src="../../../javascript/isiXML.js"></script>
<!-- ================ WINDOWS PROTOTYPE TOLLTYPE ============ -->
<script type="text/javascript" src="../../../javascript/windowsprotoype/prototype.js"></script>
<script type="text/javascript" src="../../../javascript/windowsprotoype/effects.js"></script>
<script type="text/javascript" src="../../../javascript/windowsprotoype/window.js"></script>
<script type="text/javascript" src="../../../javascript/windowsprotoype/window_effects.js"></script>
<script type="text/javascript" src="../../../javascript/windowsprotoype/debug.js"></script>
<!-- ================ FUNCIONES HOSPITALIZACION ============ -->
<script type="text/javascript" src="../../../javascript/hospitalizacion.js"></script>
<script type="text/javascript" src="../../../javascript/turnos.js"></script>
<script type="text/javascript" src="../../../javascript/citas/citas.js"></script>
<script type="text/javascript" src="../../../javascript/ordenes.js"></script>
<script type="text/javascript" src="../../../javascript/filtro_tabla.js"></script>
<script type="text/javascript" src="../../../javascript/rrhh.js"></script>
<script type="text/javascript" src="../../../javascript/cobertura_credito.js"></script>
<script type="text/javascript" src="../../../javascript/simedh_admision.js"></script>
<script type="text/javascript" src="../../../javascript/simedh_laboratorio.js"></script>
<!-- ================ TREE ============ -->
<script type="text/javascript" src="../../../javascript/dhtml_tree/dhtmlxcommon.js"></script>
<script type="text/javascript" src="../../../javascript/dhtml_tree/dhtmlxtree.js"></script>
<script type="text/javascript" src="../../../javascript/dhtml_tab/dhtmlxtabbar.js"></script>
<!-- ================ OTRAS FUNCIONES - REVISAR ============= -->
<script type="text/javascript" src="../../../javascript/dhtmlXCommon.js"></script>
<script type="text/javascript" src="../../../javascript/mover.js"></script>
<script type="text/javascript" src="../../../javascript/tooltip.js"></script>
<script type="text/javascript" src="../../../javascript/calendario.js"></script>
<script type="text/javascript" src="../../../javascript/corregir_bienes.js"></script>
<script type="text/javascript" src="../../../javascript/admincon.js"></script>
<script type="text/javascript" src="../../../javascript/maestros.js"></script>
<script type="text/javascript" src="../../../javascript/reporteador.js"></script>
<script type="text/javascript" src="../../../javascript/js_funciones.js"></script>
<script type="text/javascript" src="../../../javascript/js_GridSimple.js"></script>
<script type="text/javascript" src="../../../javascript/js_Simi.js"></script>
<script type="text/javascript" src="../../../javascript/prueba.js"></script>
<script type="text/javascript" src="../../../javascript/uploader.js"></script>
<!-- ================ FUNCIONES - MODULOS ============= -->
<script type="text/javascript" src="../../../javascript/cronograma.js"></script>
<script type="text/javascript" src="../../../javascript/caja.js"></script>
<script type="text/javascript" src="../../../javascript/hos_calendario.js"></script>
<script src="../../../javascript/HTML_TreeMenu/TreeMenu.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">
function cargar_form(vMenu,vSubMenu,vOpcion) {
	myRand = parseInt(Math.random()*999999999999999);
	myajax.Link('default.php?rand=' + myRand, 'Contenido');
}
</script>
</head>
<div id="VentanaTransparente">
	<div class="overlay_absolute"></div>
  <div id="cargador" style="z-index:2000">
    <table width="100%" height="10%" border="0">
    <tr valign="middle">
    <td>
    Por Favor Espere    </td>
    <td>
    <img src="../../../imagen/inicio/cargando.gif"  border="0" title="CARGANDO" /><a href="#" id="hider2"></a>	</td>
    </tr>
    </table>
  </div>
</div>
<body onLoad="myajax = new isiAJAX('Contenido', 'VentanaTransparente');cargar_form();parpadear_mensaje();">
    <div id="Main">
        <div id="Name">
            <div id="MainMenu">
                <div id="Menu" align="left">
                    <a href="#" onclick="javascript:myajax.Link('../admision/registro_personas_busqueda.php','Contenido')">Registro Paciente</a>&nbsp;
                    <a href="#" onclick="javascript:myajax.Link('../orden/gestion_orden3.php','Contenido')">Gestion Orden</a>&nbsp;
                </div>
                  </div>
                <div id="Contenedor" style="width:100%">
                    <div id="Contenido" style="border:1"></div>
                    <div id="ManteContenido"></div>
                    <div style="clear:both"></div>
                </div>
                <div id="Footer">
                    <div id="textizq">Copyright &copy; Todos los Derechos Reservados - 2010</div>
                </div>
            </div>
      
        <div id="cargador_grid" style="display:none">
            <div class="overlay_absolute"></div>
            <div id="cargador" style="z-index:2000">Cargando Grid...<img src="imagenes/cargando.gif"  border="0" title="CARGANDO" /><a href="#" id="hider2"></a></div>
        </div>
    </div>
</body>
</html>