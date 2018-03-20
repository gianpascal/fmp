<?php
    require_once("../../ccontrol/control/ActionPersona.php");
    $o_ActionPersona = new ActionPersona();
    $arrayParametros['funcion'] = "busquedaPersonaCISOP";
    $arrayParametros['alto'] = '200px';
    $arrayParametros['nroOrden'] = false;
    $arrayParametros['codigo'] = true;
    $arrayParametros['documento'] = true;
    $arrayParametros['apellidoPaterno'] = true;
    $arrayParametros['apellidoMaterno'] = true;
    $arrayParametros['nombre'] = true;
    if ($_SESSION["permiso_formulario_servicio"][110]["BUSCAR_PAC"] == 1)
        $arrayParametros['bbuscar'] = true;
    else
        $arrayParametros['bbuscar'] = false;
    if ($_SESSION["permiso_formulario_servicio"][110]["BUSCAR_PAC"] == 1)
        $arrayParametros['blimpiar'] = true;
    else
        $arrayParametros['blimpiar'] = false;
    $arrayParametros['bnuevo'] = false;
    $arrayParametros['editar'] = ''; //editar: agrega el boton editar, otro valor no lo muestra

    $obtenerPersonas = $o_ActionPersona->buscadorPersona($arrayParametros);
?>