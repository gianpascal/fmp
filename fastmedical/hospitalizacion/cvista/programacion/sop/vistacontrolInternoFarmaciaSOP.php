<?php
//agregar medicamentos
$toolbar1 = new ToollBar("right");
$toolbar1->SetBoton("Agregar Productos", "Agregar Productos", "btn", "onclick,onkeypress", "mostrarVentanaNuevosMedicamentosCISOP()", "../../../../medifacil_front/imagen/icono/abrir16.png", "", "", true);
//botones totales
$toolbar = new ToollBar("right");
$toolbar->SetBoton("Generar Orden", "Finalizar", "btn", "onclick,onkeypress", "generarOrdenCuentaCorrienteFarmaciaCISOP()", "../../../../medifacil_front/imagen/icono/apply.png", "", "", true);
$toolbar->SetBoton("Impresion de la Pre Orden", "Imprimir", "btn", "onclick,onkeypress", "enviandoImprimirFarmaciaCISOP()", "../../../../medifacil_front/imagen/icono/printer.png", "", "", true);
$toolbar->SetBoton("Limpiar", "Limpiar", "btn", "onclick,onkeypress", "restaurarTablaGeneracionPreOrdenFarmaciaSOP()", "../../../../medifacil_front/imagen/icono/limpiar.png", "", "", true);
$toolbar->SetBoton("Guardar Nueva Cantidad Entregados", "Guardar Nueva Cantidad", "btn", "onclick,onkeypress", "actualizarNuevaCantidadEntregadaCISOP()", "../../../../medifacil_front/imagen/icono/grabar.png", "", "", true);
$toolbar->SetBoton("Volver a Programacion SOP", "Volver", "btn", "onclick,onkeypress", "volveraProgramacionSOPdesdeCIFarmaciaSOP()", "../../../../medifacil_front/imagen/icono/14_rotateactivo.png", "", "", true);
?>
<div>
    <!--  cabecera  -->
    <div style="width:100%;height:5%;background: white">
        <div class="titleform">
            <h1>GENERACIÓN PREORDEN - FARMACIA SOP</h1>
        </div>
    </div>

    <!--  datos del paciente  -->   
    <div id="Div_datos" style="width: 100%;height:20%;">
        <table style="font: 12px Arial">
            <tr>
                <td>Código :</td>
                <td><input id="txtcodigopersona" type="text" size="20" readonly="true"></input>
                <a id="busquedaPersonaCISOP" style ="display:none" href="#"><img onclick="javascript:mostrarBusquedadePersonasCISOP()" border="0" title="Buscar Paquete" alt="" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif"></a>
                </td>
                

            <td>DNI :</td>
            <td><input id="txtdnipaciente" type="text" size="20" readonly="true"></input></td>
            </tr>
            <tr>
                <td>Paciente  :</td>
                <td><input id="txtnombrepaciente" type="text" size="50" readonly="true"></input></td>
            </tr>
            <tr>
                <td>Edad  :</td>
                <td><input id="txtedadpaciente" type="text" size="50" readonly="true"></input></td>
            </tr>            
            <tr>
                <td>Cod. Paquete Farmaceútico :</td>
                <td>
                    <input id="txtcodigopaquete" type="text" size="20" readonly="true"></input>
                    &nbsp;&nbsp;<a href="#"><img onclick="javascript:mostrarPaquetesFarmaceuticosSOP()" border="0" title="Buscar Paquete" alt="" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif"></a>
                </td>
            </tr>
            <tr>
                <td>Nombre Paquete Farmaceútico :</td>
                <td><input id="txtnombrepaquete" type="text" size="50" readonly="true"></input></td>
            </tr>
        </table>

    </div>
    <input id="hdatospaquete" type="hidden"></input>
    <input id="hdatosactualizarcantidadproductosCISOP" type="hidden"></input>
    <div id="Div_agregarmedicamentos" style="width: 100%;height:5%;">
        <?php $toolbar1->Mostrar(); ?>
    </div>   
    <div id="Div_tablamovimientosCIFarmaciaSOP" style="width: 100%;height:60%;">

    </div>
    <div id="Div_botones" style="width: 100%;height:10%;">
        <?php $toolbar->Mostrar(); ?>
    </div>


</div>        
