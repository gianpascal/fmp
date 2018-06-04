<?php
    session_start();
    require_once("../../ccontrol/control/ActionFormulario.php");
    $id_sistema=$_REQUEST["id_sistema"];
    $id_formulario=$_REQUEST["id_formulario"];
    $login_usuario=$_SESSION["vlogin_usuario"];
    $idpersona=$_SESSION["c_cod_per"];

    $o_ActionFormulario = new ActionFormulario();
    $htmlPermiso = $o_ActionFormulario->listaDetallePermiso($id_sistema,$idpersona,'');
?>
<form action="" id="form_detalle" name="form_detalle" method="get" onsubmit="return false">
    <div id="detalle">
        <table cellpadding="0" cellspacing="0" class="texto_interior">
            <tr>
                <td height="20">
                    <div style="float:left">
                        <span class="blue negrita">ADMINISTRADOR DE PERMISOS: </span>
                        <input type="text" name="login_usuario" id="login_usuario" size="40" class="texto_combo" ondblclick="CargarVentana('buscador3','Usuarios','../busqueda/buscadorPersona.php?p1=buscarUsuarios&id_sistema=<?php echo $id_sistema?>','850','300',false,true,'',1,'',10,10,10,10);" value="<?php echo $login_usuario?>" readonly="1"/>
                        <a href="#" onclick="CargarVentana('buscador3','Usuarios','../busqueda/buscadorPersona.php?p1=buscarUsuarios&id_sistema=<?php echo $id_sistema?>','850','300',false,true,'',1,'',10,10,10,10);"><img src="../../../../fastmedical_front/imagen/icono/kappfinder.png" alt="Buscar" title="Buscar" border="0"/></a>
                    </div>
                    <div style="float:right">
                        <span class="blue negrita">FORMULARIO</span>
                        <input type="text" name="nombre_formulario_permiso" id="nombre_formulario_permiso" size="20" onkeyup="buscarFormularioDePermiso()"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <div id="contenido_detalle" style="overflow: auto;">
                        <?php echo $htmlPermiso; ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <input type="hidden" name="idsistema" id="idsistema" value="<?php echo $id_sistema?>"/>
    <input type="hidden" name="idpersona" id="idpersona" value="<?php echo $idpersona?>"/>
</form>