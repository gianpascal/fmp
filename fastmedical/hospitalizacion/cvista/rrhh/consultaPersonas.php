<?php
require_once '../../ccontrol/control/ActionPersona.php';
$o_ActionPersona = new ActionPersona();
?>
<div id="busqueda" style="width: 100%;height: auto;background-color: #FFFFF0">
                    <?php
                    $arrayParametros['funcion']="clickonFilaPersonaEncontrada";
                    $arrayParametros['alto']='200px';
                    $arrayParametros['nroOrden']=false;
                    $arrayParametros['codigo']=true;
                    $arrayParametros['documento']=true;
                    $arrayParametros['apellidoPaterno']=true;
                    $arrayParametros['apellidoMaterno']=true;
                    $arrayParametros['nombre']=true;
                    $arrayParametros['bbuscar']=true;
                    $arrayParametros['blimpiar']=true;
                    $arrayParametros['bnuevo']=true;
                    $arrayParametros['editar']='editar'; //editar: agrega el boton editar, otro valor no lo muestra
                    $o_ActionPersona->buscadorPersona($arrayParametros);
                   // echo "Hola";
                    ?>
 </div>