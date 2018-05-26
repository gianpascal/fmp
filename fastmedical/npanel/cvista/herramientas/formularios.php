<?php
    require_once("../../ccontrol/control/ActionFormulario.php");
    $id_sistema=$_REQUEST["id_sistema"];
    $id_formulario=$_REQUEST["id_formulario"];//Identificador del formulario para asignar permisos
    $nomForm='%';//Criterio para la busqueda de formularios

    $o_ActionFormulario = new ActionFormulario();
    $htmlFormulario = $o_ActionFormulario->listaDetalleFormulario($id_sistema,$nomForm);
?>
<form action="" id="form_detalle" name="form_detalle" method="get" onsubmit="return false">
    <div id="detalle">
        <table cellpadding="0" cellspacing="0" class="texto_interior">
            <tr>
                <td height="20">
                    <div>
                        <div style="float:left">
                            <span class="blue negrita">LISTADO FORMULARIOS</span>
                            <input type="text" name="nombre_formulario" id="nombre_formulario" size="20" onkeyup="buscarFormulario()"/>
                        </div>
                        <div style="text-align:right; margin-top:5px; float:right;" class="blue negrita">TOTAL REGISTROS: <?php //echo $total?></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <div id="contenido_detalle" style="overflow: auto;">
                        <?php echo $htmlFormulario; ?>
                    </div>
                    <div id="botones">
                        <a href='#' onclick="CargarVentana('popupManteFormulario','Registro de Formularios','../herramientas/manteFormulario.php?accion=insertar&id_sistema=<?php echo $id_sistema?>','305','350',false,true,'',1,'',10,10,10,10);"><img src="../../../../fastmedical_front/imagen/btn/b_nuevo_on.gif" alt='Nuevo' title='Nuevo' border='0'/></a>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <input type="hidden" name="idSistema" id="idSistema" value="<?php echo $id_sistema?>"/>
</form>