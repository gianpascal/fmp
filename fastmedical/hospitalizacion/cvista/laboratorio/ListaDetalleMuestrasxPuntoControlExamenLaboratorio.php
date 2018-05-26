<input id="textAcordionMuestrasxPuntoControlxExamenLabo" type="hidden" value="<?php echo $cadenaAcordionMuestrasxPuntoControlxExamenLabo; ?>">
<div style="width:100%;height:5%;background: white">
    <div class="titleformjc">
        <h1>MUESTRAS POR PUNTO DE CONTROL DE EXAMEN DE LABORATORIO</h1>
    </div>
</div>

<div id="contenedorAcordionjc2" style="width: 1000px; height: 400px; background-color:#487595;margin: 0 auto;">

</div>

<div id="divDatosjc2" style="position: relative; width: 100%; height: 100%; display: none ">
    <div style="padding:15px;">

        <div style="padding:15px;">
            <div class="filaDatosPaciente" >
                <div class="labelDatosPaciente">
                    <b>Observaciones Muestras </b>
                </div>

            </div>

        </div>
    </div> 

</div>
<!--<div id="divMujc2" style="position: relative; width: 100%; height: 100%; display: none; ">
    <div style="padding:15px;">

        <div style="padding:15px;">
            <div class="filaDatosPaciente" >
                <div class="labelDatosPaciente">
                    <b>Nombre2 </b>
                </div>

            </div>

        </div>
    </div> 

</div>-->

<?php
foreach ($arrayListaMuestrasxPuntoDeControlxExamen as $i => $value) {
    $idMuestraPuntoControlLaboratorio = $value[0];
    $idMuestraLaboratorio = $value[2];
    $datos = array();
    $datos["idMaterialLaboratorio"] = $value[1];
    $datos["hIdMaterialLaboratorio"] = $value[1];
    $datos["TipoUnidadMedidaEscogida"] = $value[3];


    $datos["TipoUnidadMedidaEscogidaMuestra"] = $value[3];



    $nombreMuestra = $value[2];
    $idTipoUnidadMedida = $value[3];
    $nombreTipoUnidadDeMedida = $value[4];
    $idUnidadMedida = $value[5];
    $NombreUnidadMedida = $value[6];
    $nMinimoMuestra = $value[7];
    $nMaximoMuestra = $value[8];

    $arrayTipoUnidadMedida2 = $oLLaboratorio->LcargarComboTipoUnidadMedidaMuestraSeleccionado();
    $arrayComboUnidadMedidaMuestraSeleccionado = $oLLaboratorio->LcargarComboUnidadMedidaMuestraSeleccionado($datos);

    //Combo Tipo Unidad
    $ComboTipoUnidadMedidaMuestraSeleccionado = '<select id="cboTipoUnidadMedidaMuestraSeleccionada' . trim($value[0]) . '" onchange="cargarComboUnidadMedidaMuestraSeleccionadoHistorialMuestra(\'' . trim($value[0]) . '\');"  style="width:150px; font-size:12px" disabled="false" >';
    $ComboTipoUnidadMedidaMuestraSeleccionado.='<option value="x" style="background-color: #FFFFFF">Seleccionar</option>';

    foreach ($arrayTipoUnidadMedida2 as $n => $valueXX) {
        if ($valueXX[0] == $value[3]) {
            $seleccionado = 'selected';
        } else {
            $seleccionado = '';
        }
        $ComboTipoUnidadMedidaMuestraSeleccionado .= '<option value="' . trim($valueXX[0]) . ' " ' . $seleccionado . '  >' . htmlentities($valueXX[1]) . '</option>';
    }
    $ComboTipoUnidadMedidaMuestraSeleccionado .= '</select>';


    //Combo Unidad Medida
    $ComboUnidadMedidaMuestraSeleccionado = '<select id="cboUnidadMedidaMuestraSeleccionada' . trim($value[0]) . '" onchange=""  style="width:150px; font-size:12px" disabled="false" >';
    $ComboUnidadMedidaMuestraSeleccionado.='<option value="x" style="background-color: #FFFFFF">Seleccionar</option>';

    foreach ($arrayComboUnidadMedidaMuestraSeleccionado as $n => $valueXXX) {
        if ($valueXXX[0] == $value[5]) {
            $seleccionado2 = 'selected';
        } else {
            $seleccionado2 = '';
        }

        $ComboUnidadMedidaMuestraSeleccionado .= '<option value="' . $valueXXX[0] . ' " ' . $seleccionado2 . '  >' . htmlentities($valueXXX[1]) . '</option>';
    }
    $ComboUnidadMedidaMuestraSeleccionado .= '</select>';

//    print_r($arrayListaMaterialesxPuntoDeControlxExamen);
    ?>
    <div id="<?php echo 'divMuestra' . trim($value[0]); ?>" style="position: relative; width: 100%; height: 100%; overflow: auto; display: none; margin-left: 7%">
        <input id="idMuestraPuntoControlLaboratorio<?php echo trim($value[0]); ?>" type="hidden" value="<?php echo trim($value[0]) ?>">
        <input id="idMuestraLaboratorio<?php echo trim($value[0]); ?>" type="hidden" value="<?php echo trim($value[1]) ?>">

        <!--        //codigo pruebaaaa-->

        <div style="padding:15px; float:left;width: 550px;">
            <!--<div style="padding:15px;">-->
            <fieldset style="width: 800px">
                <legend>Detalle de Muestra</legend>
                <div style="padding:15px;">
                    <div class="filaMuestraDetalle" >
                        <div class="labelMuestraDetalle">
                            <b>Nombre Muestra: </b>
                        </div>
                        <div class="inputMuestraDetalle">
                            <input type="text" id="txtNombreMuestraSeleccionada<?php echo trim($value[0]) ?>" size="20"  readonly="readonly" value=" <?php echo $idMuestraLaboratorio ?> " /> </td>

                        </div>
                    </div>

                    <div class="filaMuestraDetalle" >
                        <div class="labelMuestraDetalle">
                            <b>Tipo de Unidad</b>
                        </div>
                        <div class="inputMuestraDetalle">

                            <div id="Div_ComboTipoUnidadMedidaMuestraSeleccionada<?php echo trim($value[0]) ?>"><?php echo $ComboTipoUnidadMedidaMuestraSeleccionado ?> 
                            </div> 

                        </div>
                    </div>

                    <div class="filaMuestraDetalle" >
                        <div class="labelMuestraDetalle">
                            <b>Unidad de Medida::</b>
                        </div>
                        <div class="inputMuestraDetalle">

                            <div id="Div_ComboUnidadMedidaMuestraSeleccionada<?php echo trim($value[0]) ?>"><?php echo $ComboUnidadMedidaMuestraSeleccionado ?> 

                            </div>

                        </div>
                    </div>

                    <div class="filaMuestraDetalle" >
                        <div class="labelMuestraDetalle">
                            <b>Cantidad Máxima:</b>
                        </div>
                        <div class="inputMuestraDetalle">
                            <input type="text" id="txtCantidadMaximaMuestraSeleccionada<?php echo trim($value[0]) ?>" readonly="readonly"
                                   onkeypress="return   validarTipoDatos(4,this,event,'txtCantidadMinimaMuestraSeleccionada<?php echo trim($value[0]) ?>')" size="20" value="<?php echo $nMaximoMuestra ?>"  />          


                        </div>
                    </div>
                    <div class="filaMuestraDetalle" >
                        <div class="labelMuestraDetalle">
                            <b>Cantidad Minima::</b>
                        </div>
                        <div class="inputMuestraDetalle">
                            <input type="text" id="txtCantidadMinimaMuestraSeleccionada<?php echo trim($value[0]) ?>" readonly="readonly"
                                   onkeypress="return   validarTipoDatos(4,this,event,'txtCantidadMinimaMuestraSeleccionada<?php echo trim($value[0]) ?>')"      size="20" value="<?php echo $nMinimoMuestra ?>" />       


                        </div>
                    </div>

                    <div class="filaMuestraDetalle" >
                        <div class="labelMuestraDetalle">
                            <div id="div_BotonEditar_Muestra_MDxE<?php echo trim($value[0]) ?>">
                                <a href="javascript:EditarItemMuestrasAlmacenados(document.getElementById('idMuestraPuntoControlLaboratorio<?php echo trim($value[0]) ?>').value);"><img border="0" title="Editar" alt="" src="../../../../fastmedical_front/imagen/btn/b_editar_on.gif"/></a>

                            </div>  
                        </div>


                        <div class="inputMuestraDetalle">
                            <div id="div_BotonEliminar_Muestra_MDxE <?php echo trim($value[0]) ?>">
                                <a href="javascript:EliminarItemMuestraAlmacenados(document.getElementById('idMuestraPuntoControlLaboratorio<?php echo trim($value[0]) ?>').value);"><img border="0" title="Eliminar" alt="" src="../../../../fastmedical_front/imagen/btn/b_borrar_on.gif"/></a>

                            </div>
                        </div>

                        <div class="inputMuestraDetalle2">
                            <div id="div_BotonActualizar_Muestra_MDxE<?php echo trim($value[0]) ?>">
                                <a href="javascript:ActualizarItemMuestraAlmacenados(document.getElementById('cboTipoUnidadMedidaMuestraSeleccionada<?php echo trim($value[0]) ?>').value,
                                   document.getElementById('cboUnidadMedidaMuestraSeleccionada<?php echo trim($value[0]) ?>').value,
                                   document.getElementById('txtCantidadMaximaMuestraSeleccionada<?php echo trim($value[0]) ?>').value,
                                   document.getElementById('txtCantidadMinimaMuestraSeleccionada<?php echo trim($value[0]) ?>').value,
                                   document.getElementById('idMuestraPuntoControlLaboratorio<?php echo trim($value[0]) ?>').value);">

                                    <img border="0" title="Actualizar" alt="" src="../../../../fastmedical_front/imagen/btn/b_actualizar_on.gif"/></a>

                            </div> 
                        </div>
                    </div>

                </div>
            </fieldset>

        </div>


    </div>


    <?php
}
?>
