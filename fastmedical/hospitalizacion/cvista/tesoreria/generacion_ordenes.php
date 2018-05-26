<div class="titleform">
    <h1>Generacion de Ordenes</h1>
</div>
<?php
require_once("../../ccontrol/control/ActionTesoreria.php");
$o_ActionTesoreria = new ActionTesoreria();
require_once("../../ccontrol/control/ActionPersona.php");
$o_ActionPersona = new ActionPersona();
$toolbar3 = new ToollBar("left");
$toolbar3->SetBoton("IMPRIMIR", "IMPRIMIR", "btn", "onclick,onkeypress", "imprimirRecibo('34030340186016')", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/imprimir.png");
$toolbar4 = new ToollBar("left");
$toolbar4->SetBoton("PAGAR", "PAGAR", "btn", "onclick,onkeypress", "cancelarOrdenesSeleccionadas()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/monedas.jpg");
$toolbar5 = new ToollBar("left");
$toolbar5->SetBoton("AGREGAR", "AGREGAR", "btn", "onclick,onkeypress", "agregarOrdenes()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/nuevo.png");
$toolbar6 = new ToollBar("left");
$toolbar6->SetBoton("Eliminar", "Eliminar Orden", "btn", "onclick,onkeypress", "anularOrden()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/borrar.png");
?>
<div style="float:left; width:420px; height:620px; margin:5px; background-color: white;" >
    <div style=" width:400px;">
        <?php
        $arrayParametros['funcion'] = 'setOrdenesPersona';
        $arrayParametros['fnuevo'] = 'setOrdenesPersona';
        $arrayParametros['alto'] = '150px';
        $arrayParametros['nroOrden'] = true;
        $arrayParametros['codigo'] = true;
        $arrayParametros['documento'] = true;
        $arrayParametros['apellidoPaterno'] = true;
        $arrayParametros['apellidoMaterno'] = true;
        $arrayParametros['nombre'] = true;
        $arrayParametros['bbuscar'] = true;
        $arrayParametros['blimpiar'] = true;
        $arrayParametros['bnuevo'] = true;
        $arrayParametros['editar'] = 'editar';
        $o_ActionPersona->buscadorPersona($arrayParametros);
        ?>
		<input type="hidden" id="hServicio" name="hServicio" value="">
    </div>
      
</div>
<div id="iddetalleOrden" style=" margin-left:5px; padding-top: 10px; ">
    <?php
    $o_ActionTesoreria->detalleOrden('', '');
    ?>
    
   
</div>
<div id="leyenda" style="margin:5px; height:30px; width: 600px;float: left; padding-left: 50px; ">
    <table class="tablaOrden" >
        <tr>
            <td style="text-align: center;">Leyenda:</td>
            <td style="text-align: center;" class="e1">Reservado</td>
            <td style="text-align: center;" class="e2">Pagado</td>
            <td style="text-align: center;" class="e3">Pagado Atendido</td>
            <td style="text-align: center;" class="e4">Atendido con Carta</td>
            <td style="text-align: center;" class="e5">Pendiente</td>
        </tr>
    </table>
   
    <table>
        <tr> 
            <td style="width: 150px;">
            </td>
            <td>
                <?php $toolbar3->Mostrar(); ?>
            </td>
            <td>
                <?php $toolbar5->Mostrar(); ?>
            </td>
            
            <td>
                <?php $toolbar4->Mostrar(); ?>
            </td>
             
        </tr>
    </table>
</div>
<div id="divAccionesyBotonesGeneracionDeOrdenes" align="center" style="width: 100%; height: auto; background: white; clear:both;">
    <input type="hidden" id="hdnIdCaja" name="hdnIdCaja" value="<?php echo $_SESSION["iIdCaja"]; ?>">
    <input type="hidden" id="hdnNumDocAperturadosHoy" name="hdnNumDocAperturadosHoy" value="<?php echo $hdnNumDocAperturadosHoy; ?>">
</div>











