<input id="textAcordionMaterialesxPuntoControlxExamenLabo" type="hidden" value="<?php echo $cadenaAcordionMaterialesxPuntoControlxExamenLabo; ?>">
<div style="width:100%;height:5%;background: white">
    <div class="titleformjc">
        <h1>MATERIALES POR PUNTO DE CONTROL DE EXAMEN DE LABORATORIO</h1>
    </div>
</div>
<div id="contenedorAcordionjc" style="width: 1000px; height: 500px; background-color:#487595;margin: 0 auto;">

</div>



<div id="divDatosjc" style="position: relative; width: 100%; height: 100%; display: none ">
    <div style="padding:15px;">

        <div style="padding:15px;">
            <div class="filaDatosPaciente" >
                <div class="labelDatosPaciente">
                    <b> Observaciones Materiales </b>
                </div>

            </div>

        </div>
    </div> 

</div>

<?php
foreach ($arrayListaMaterialesxPuntoDeControlxExamen as $i => $value) {
    $idUnidadMedidaExamenLabotorio = $value[0];
    $idMaterialesLaboratorio = $value[1];
    $datos = array();
    $datos["idMaterialLaboratorio"] = $value[1];
    $datos["hIdMaterialLaboratorio"] = $value[1];
    $datos["TipoUnidadMedidaEscogida"] = $value[3];


    $nombreMaterial = $value[2];
    $idTipoUnidadMedida = $value[3];
    $nombreTipoUnidadDeMedida = $value[4];
    $idUnidadMedida = $value[5];
    $NombreUnidadMedida = $value[6];
    $nMinimo = $value[7];
    $nMaximo = $value[8];
    $foto = $value[10];

    $arrayTipoUnidadMedida = $oLLaboratorio->LcargarComboTipoUnidadMedidaMaterialSeleccionado($datos);
    $o_ActionLaboratorio1 = new ActionLaboratorio();

    $arrayComboUnidadMedidaMaterialSeleccionado = $oLLaboratorio->LcargarComboUnidadMedidaMaterialSeleccionado($datos);


//                                                                                                                                                            onchange="cambioEstado(\'' . $idEstadoCampo . '\');"
    //Combo Tipo Unidad
    $ComboTipoUnidadMedidaMaterialSeleccionado = '<select id="cboTipoUnidadMedidaDisponibles' . trim($value[0]) . '" onchange="cargarComboUnidadMedidaMaterialSeleccionadoHistorialMateriales(\'' . trim($value[0]) . '\');"  style="width:150px; font-size:12px" disabled="true" >';
    $ComboTipoUnidadMedidaMaterialSeleccionado.='<option value="x" style="background-color: #FFFFFF">Seleccionar</option>';

    foreach ($arrayTipoUnidadMedida as $n => $valueXX) {
        if ($valueXX[1] == $value[3]) {
            $seleccionado = 'selected';
        } else {
            $seleccionado = '';
        }
//        echo $valueXX[1] . '/' . $value[$i][3] . '<br>';
        $ComboTipoUnidadMedidaMaterialSeleccionado .= '<option value="' . trim($valueXX[1]) . ' " ' . $seleccionado . '  >' . htmlentities($valueXX[0]) . '</option>';
//echo '/'.$seleccionado.'<br>';
//        $a = $respuesta[$i][3];
//        $b = $respuesta[$i][4];
//        if ($valuen[1] == $respuesta[$i][3]) {
//            $seleccionado = 'selected';
//        } else {
//            $seleccionado = '';
//        }
//        $ComboUnidadMedidaMaterialSeleccionado.="<option $seleccionado value= $a > $b </option>";
    }
    $ComboTipoUnidadMedidaMaterialSeleccionado .= '</select>';

//////////////////////////////////////////////////////////////////////////////////////
    //Combo Unidad Medida
    $ComboUnidadMedidaMaterialSeleccionado = '<select id="cboUnidadMedidaDisponibles' . trim($value[0]) . '" onchange=""  style="width:150px; font-size:12px" disabled="true" >';
    $ComboUnidadMedidaMaterialSeleccionado.='<option value="x" style="background-color: #FFFFFF">Seleccionar</option>';

    foreach ($arrayComboUnidadMedidaMaterialSeleccionado as $n => $valueXXX) {
        if ($valueXXX[0] == $value[5]) {
            $seleccionado2 = 'selected';
        } else {
            $seleccionado2 = '';
        }

        $ComboUnidadMedidaMaterialSeleccionado .= '<option value="' . $valueXXX[0] . ' " ' . $seleccionado2 . '  >' . htmlentities($valueXXX[1]) . '</option>';
    }
    $ComboUnidadMedidaMaterialSeleccionado .= '</select>';

//    print_r($arrayListaMaterialesxPuntoDeControlxExamen);
    ?>
    <div id="<?php echo "div" . trim($value[0]); ?>" style="position: relative; width: 100%; height: 100%; overflow: auto; display: none; margin-left: 4%">
        <input id="idUnidadMedidaExamenLabotorio<?php echo trim($value[0]); ?>" type="hidden" value="<?php echo trim($value[0]) ?>">
        <input id="idMaterialLaboratorio<?php echo trim($value[0]); ?>" type="hidden" value="<?php echo trim($value[1]) ?>">


        <div style="padding:15px; float:left;width: 550px;">
            <!--<div style="padding:15px;">-->
            <fieldset style="width: 800px">
                <legend>Detalle Material:</legend>
                <div style="padding:15px;">
                    <div class="filaMaterialDetalle" >
                        <div class="labelMaterialDetalle">
                            <b>Nombre Material: </b>
                        </div>
                        <div class="inputMaterialDetalle">
                            <input type="text" id="txtNombreMaterialSeleccionado <?php echo trim($value[0]) ?>" size="60"  readonly="readonly" value=" <?php echo $nombreMaterial ?> " /> </td>

                        </div>
                    </div>

                    <div class="filaMaterialDetalle" >
                        <div class="labelMaterialDetalle">
                            <b>Tipo de Unidad</b>
                        </div>
                        <div class="inputMaterialDetalle">

                            <div id="Div_ComboTipoUnidadMedidaMaterialSeleccionado<?php echo trim($value[0]) ?>"><?php echo $ComboTipoUnidadMedidaMaterialSeleccionado ?> 
                            </div> 

                        </div>
                    </div>

                    <div class="filaMaterialDetalle" >
                        <div class="labelMaterialDetalle">
                            <b>Unidad de Medida::</b>
                        </div>
                        <div class="inputMaterialDetalle">

                            <div id="Div_ComboUnidadMedidaMaterialSeleccionado<?php echo trim($value[0]) ?>"><?php echo $ComboUnidadMedidaMaterialSeleccionado ?> 

                            </div>

                        </div>
                    </div>

                    <div class="filaMaterialDetalle" >
                        <div class="labelMaterialDetalle">
                            <b>Cantidad Máxima:</b>
                        </div>
                        <div class="inputMaterialDetalle">
                            <input type="text" id="txtCantidadMaximaMaterialLabo<?php echo trim($value[0]) ?>" readonly="readonly" 
                                   onkeypress="return   validarTipoDatos(4,this,event,'txtCantidadMinimaMaterialLabo<?php echo trim($value[0]) ?>')"  size="20" value="<?php echo $nMaximo ?>"  />          


                        </div>
                    </div>
                    <div class="filaMaterialDetalle" >
                        <div class="labelMaterialDetalle">
                            <b>Cantidad Minima::</b>
                        </div>
                        <div class="inputMaterialDetalle">
                            <input type="text" id="txtCantidadMinimaMaterialLabo<?php echo trim($value[0]) ?>" readonly="readonly"
                              onkeypress="return   validarTipoDatos(4,this,event,'txtCantidadMinimaMaterialLabo<?php echo trim($value[0]) ?>')"   size="20" value="<?php echo $nMinimo ?>" />       


                        </div>
                    </div>

                    <div class="filaMaterialDetalle" >
                        <div class="labelMaterialDetalle">
                            <div id="div_BotonEditar_Material_MDxE<?php echo trim($value[0]) ?>">
                                <a href="javascript:EditarItemMaterialesAlmacenados(document.getElementById('idUnidadMedidaExamenLabotorio<?php echo trim($value[0]) ?>').value);"><img border="0" title="Editar" alt="" src="../../../../fastmedical_front/imagen/btn/b_editar_on.gif"/></a>

                            </div>  
                        </div>


                        <div class="inputMaterialDetalle">
                            <div id="div_BotonEliminar_Material_MDxE <?php echo trim($value[0]) ?>">
                                <a href="javascript:EliminarItemMaterialesAlmacenados(document.getElementById('idUnidadMedidaExamenLabotorio<?php echo trim($value[0]) ?>').value);"><img border="0" title="Eliminar" alt="" src="../../../../fastmedical_front/imagen/btn/b_borrar_on.gif"/></a>

                            </div> 
                        </div>

                        <div class="inputMaterialDetalle2">
                            <div id="div_BotonActualizar_Material_MDxE<?php echo trim($value[0]) ?>">
                                <a href="javascript:ActualizarItemMaterialesAlmacenados(document.getElementById('cboTipoUnidadMedidaDisponibles<?php echo trim($value[0]) ?>').value,
                                   document.getElementById('cboUnidadMedidaDisponibles<?php echo trim($value[0]) ?>').value,
                                   document.getElementById('txtCantidadMaximaMaterialLabo<?php echo trim($value[0]) ?>').value,
                                   document.getElementById('txtCantidadMinimaMaterialLabo<?php echo trim($value[0]) ?>').value,
                                   document.getElementById('idUnidadMedidaExamenLabotorio<?php echo trim($value[0]) ?>').value);">

                                    <img border="0" title="Actualizar" alt="" src="../../../../fastmedical_front/imagen/btn/b_actualizar_on.gif"/></a>

                            </div> 
                        </div>
                    </div>

                </div>
            </fieldset>
        </div>


        <div style="padding:15px; float:left;width: 250px;">

            <div style="float:center;border:0px solid #000000;width:100%;height:200px;padding:0px;overflow:auto;margin:1px;margin-top: 20px;margin-left:30% ">
                <fieldset class="fieldset_fotoMaterial_MDxE" id="fieldset_fotoMaterial_MDxE" style="margin:0px; padding:0px;width:150 ; height: 190px">
                    <legend>Foto</legend>
                    <center>
                        <div id="fotoMaterial_MDxE<?php echo trim($value[0]) ?>" style=" height:150px;width:120px;">
                            <img border="0" title="Foto Material" alt="" src="<?php echo trim($foto) ?>" style="width: 120; height: 150px;"/>

                        </div>

                    </center>
                </fieldset>
            </div>

        </div>
        <!--
                2222222222222222222222222222222222222222222222222222222
                <fieldset style="padding-left: 20px;background-color: #FFFFFF;font-size: 16px;">
                    <table border="0" align="center" style="width: 100%;height: 20%">
                        <tr> <td>
        
                                <table width="600" border="0" align="center" cellpadding="0" cellspacing="2">
                                    <tr>
                                        <td>Nombre Material:</td> 
                                        <td><input type="text" id="txtNombreMaterialSeleccionado <?php echo trim($value[0]) ?>" size="60"  readonly="readonly" value=" <?php echo $nombreMaterial ?> " /> </td>
                                    </tr>     
                                    <tr>
                                        <td>Tipo de Unidad:</td>
                                        <td>
        
                                            <div id="Div_ComboTipoUnidadMedidaMaterialSeleccionado<?php echo trim($value[0]) ?>"><?php echo $ComboTipoUnidadMedidaMaterialSeleccionado ?> 
                                            </div>   
                                        </td>
        
                                    </tr>
        
                                    <tr>
                                        <td>Unidad de Medida:</td>
                                        <td>
                                            <div id="Div_ComboUnidadMedidaMaterialSeleccionado<?php echo trim($value[0]) ?>"><?php echo $ComboUnidadMedidaMaterialSeleccionado ?> 
        
                                            </div>
                                        </td>
                                    </tr>
        
                                    <tr>
                                        <td>Cantidad Máxima:</td>
                                        <td>
                                            <input type="text" id="txtCantidadMaximaMaterialLabo<?php echo trim($value[0]) ?>" readonly="readonly" size="20" value="<?php echo $nMaximo ?>"  />          
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cantidad Minima:</td>
                                        <td>
                                            <input type="text" id="txtCantidadMinimaMaterialLabo<?php echo trim($value[0]) ?>" readonly="readonly" size="20" value="<?php echo $nMinimo ?>" />       
                                        </td>
                                    </tr>
        
        
                                    <tr>
                                        <td>
                                            <div id="div_BotonEditar_Material_MDxE<?php echo trim($value[0]) ?>">
                                                <a href="javascript:EditarItemMaterialesAlmacenados(document.getElementById('idUnidadMedidaExamenLabotorio<?php echo trim($value[0]) ?>').value);"><img border="0" title="Editar" alt="" src="../../../../fastmedical_front/imagen/btn/b_editar_on.gif"/></a>
        
                                            </div> 
        
                                        </td>
                                        <td>
                                            <div id="div_BotonEliminar_Material_MDxE <?php echo trim($value[0]) ?>">
                                                <a href="javascript:EliminarItemMaterialesAlmacenados(document.getElementById('idUnidadMedidaExamenLabotorio<?php echo trim($value[0]) ?>').value);"><img border="0" title="Eliminar" alt="" src="../../../../fastmedical_front/imagen/btn/b_borrar_on.gif"/></a>
        
                                            </div> 
        
                                        </td>
                                        <td>
                                            <div id="div_BotonActualizar_Material_MDxE<?php echo trim($value[0]) ?>">
                                                <a href="javascript:ActualizarItemMaterialesAlmacenados(document.getElementById('cboTipoUnidadMedidaDisponibles<?php echo trim($value[0]) ?>').value,
                                                   document.getElementById('cboUnidadMedidaDisponibles<?php echo trim($value[0]) ?>').value,
                                                   document.getElementById('txtCantidadMaximaMaterialLabo<?php echo trim($value[0]) ?>').value,
                                                   document.getElementById('txtCantidadMinimaMaterialLabo<?php echo trim($value[0]) ?>').value,
                                                   document.getElementById('idUnidadMedidaExamenLabotorio<?php echo trim($value[0]) ?>').value);">
        
                                                    <img border="0" title="Actualizar" alt="" src="../../../../fastmedical_front/imagen/btn/b_actualizar_on.gif"/></a>
        
                                            </div> 
        
                                        </td>
                                    </tr>
        
                                </table>
        
                            </td>
        
                            <td>
        
                                <div style="float:center;border:0px solid #000000;width:100%;height:200px;padding:0px;overflow:auto;margin:1px;">
                                    <fieldset id="fieldset_fotoMaterial_MDxE" style="margin:0px; padding:0px;width:150 ; height: 190px">
                                        <legend>Foto</legend>
                                        <center>
                                            <div id="fotoMaterial_MDxE" style=" height:150px;width:120px;">
                                                <img border="0" title="Codigo de Persona" alt="" src="<?php echo trim($foto) ?>" style="width: 120; height: 150px;"/>
        
                                            </div>
        
                                        </center>
                                    </fieldset>
                                </div>
        
                            </td>
        
                        </tr>
                    </table>
        
        
        
        
                </fieldset> -->

    </div>

    <?php
}
?>
