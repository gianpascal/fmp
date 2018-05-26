<?php
$toolbar = new ToollBar("right");
$toolbar->SetBoton("Cancelar Agregar Producto", "Cancelar", "btn", "onclick,onkeypress", "", "../../../../fastmedical_front/imagen/icono/borrar.png", "", "", true);
$toolbar->SetBoton("Agregar Producto", "Agregar", "btn", "onclick,onkeypress", "agregarProductoalPacienteCISOP()", "../../../../fastmedical_front/imagen/icono/inbox.png", "", "", true);
?>
<div align="center">
    <input id="hCodigoProductoIndividual" type="text"></input>
    <div id="Div_BusquedaNuevoMedicamentoFarmaciaCISOP">
        <table>
            <tr>
                <td>Codigo Producto :</td>
                <td><input id="txtcodigoproductoFarmaciaCISOP" type="text" onkeyup='busquedaCodigoProductoFarmaciaCISOP()'></input></td>
                <td>&nbsp;</td>
                <td>Nombre Producto :</td>
                <td><input id="txtnombreproductoFarmaciaCISOP" type="text" onkeyup='busquedaNombreProductoFarmaciaCISOP()'></input></td>
            </tr>        
        </table>
    </div>
    <div id="Div_TablaProductosFarmaciaCISOP" style="width: 90%;height:80%">

    </div>
    <div align="center">
        <table>
            <tr>
                <td>Cantidad a Entregar :</td>
                <td><input id="txtcantidadproductoaentregarCISOP" type="text"></input></td>
            </tr>
        </table>
    </div>
    <div id="botonesPaquetesFarmaceuticosCISOP" style="width: 90%;height:10%">
        <?php $toolbar->Mostrar(); ?>
    </div>
</div>    

