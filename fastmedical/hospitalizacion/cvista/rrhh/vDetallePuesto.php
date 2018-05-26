<?php
//$arrayComboHoraInicioTurno

$datos = array();
$datos["1"] = 'Medico';
$datos["2"] = 'Tecnico';
$datos["3"] = 'Licenciado';
$datos["4"] = 'Administrativo';

//print_r($datos);

$o_Combo = new Combo($datos);
//
//$horaInicioTurno="Licenciado";
$opcionesCategoriaPuesto = $o_Combo->getOptionsHTML('', '');
?>


<!--<fieldset style="margin:1px;width:99%;height: 150px;padding: 0px; font-size:1.2em;background-color: #D6E9FE">-->
<fieldset style="margin:1px;width:99%;height: 150px;padding: 0px; font-size:1.2em;">
    <legend>&nbsp; Datos del Puesto &nbsp;</legend>
    <div style="padding-left: 10px;">
        <input name="hIdPuesto" type="hidden" id="hIdPuesto"  />
        <input name="hAccion" type="hidden" id="hAccion" value="0" />
        <div id='fila1' style="height:20%; width:100%">
            <div id='cell11' style="float:left; width:20%;" >Nombre:</div>
            <div id='cell12' style="float:right; width:80%;">
                <input name="txtNombrePuesto" type="text" id="txtNombrePuesto" size="70"  readonly="readonly" />
            </div>
        </div><div style="clear: both;height: 10px"></div>


        <div id='fila2' style=" width:100%; height:20%">
            <div id='cell21' style="float:left; width:20%;">Centro de Costos: </div>
            <div id='cell22' style="float:right; width:80%;">
                <input name="txtCentroCostos" type="text" id="txtCentroCostos" size="70"  readonly />
            </div>
        </div><div style="clear: both;height: 10px"></div>


        <div id='fila3' style=" width:100%; height:20%">
            <div id='cell31' style="float:left; width:20%;">Categoria de Puesto:</div>
            <div id='cell32' style="float:right; width:80%;">


                <select name="select" id="selectCategoriaPuestos" style="width:150px; font-size:9px" disabled="true" >
                    <?php
                    echo $opcionesCategoriaPuesto;
                    ?>
                </select>


            </div>
        </div><div style="clear: both;height: 10px"></div>


        <div id='fila4' style="width:100%;height:20%">
            <div id='cell41' style="float:left; width:20%;">Puesto Activo:</div>
            <div id='cell42' style="float:right; width:80%;">
                <input type="checkbox" name="chkEstado" id="chkEstado" disabled="true" onclick="if(this.checked){this.value=1;}else{this.value=0;blanquearData();}" value="0"  >
            </div>

        </div><div style="clear: both;height: 10px"></div>
        
        

        <fieldset style="margin:1px;width:99%;height: auto;padding: 0px; background-color: #D6E9FE;">
            <div id='fila5' style="width:100%;height:20%;display:none;">
                <div id='cell51' style="float:left; width:100%;">
                    <?php
                    if (isset($_SESSION["permiso_formulario_servicio"][204]["GRABAR_PUESTO_X_CCOSTO"]) && ($_SESSION["permiso_formulario_servicio"][204]["GRABAR_PUESTO_X_CCOSTO"] == 1)) {
                        //<a href="javascript:grabarDetallePuesto();"><img  style=" display: none;" id="imgagenGuardar" src="../../../../fastmedical_front/imagen/btn/b_grabar_on.gif"/></a>
                        echo "<a href=\"javascript:grabarDetallePuestoaCentroCosto();\"><img  style=\" display: none;\" id=\"imgagenGuardar\" src=\"../../../../fastmedical_front/imagen/btn/b_grabar_on.gif\"/></a>";
                    } else {
                        echo "<img  style=\" display: none;\" id=\"imgagenGuardar\" src=\"../../../../fastmedical_front/imagen/btn/b_grabar_on.gif\"/>";
                    }

                    if (isset($_SESSION["permiso_formulario_servicio"][204]["ACTUALIZAR_PUESTO_X_CCOSTO"]) && ($_SESSION["permiso_formulario_servicio"][204]["ACTUALIZAR_PUESTO_X_CCOSTO"] == 1)) {
                        //<a href="javascript:cancelarGrabarDetallePuesto();"><img  style=" display: none;" id="imgagenCancelar" src="../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif"/></a>
                        echo "<a href=\"javascript:actualizarDatosPuestoenCentroCostos();\"><img  style=\" display: none;\" id=\"imgagenActualizar\" src=\"../../../../fastmedical_front/imagen/btn/b_actualizar_off.gif\"/></a>";
                    } else {
                        echo "<img  style=\" display: none;\" id=\"imgagenActualizar\" src=\"../../../../fastmedical_front/imagen/btn/b_actualizar_off.gif\"/>";
                    }

                    if (isset($_SESSION["permiso_formulario_servicio"][204]["CANCELAR_PUESTO_X_CCOSTO"]) && ($_SESSION["permiso_formulario_servicio"][204]["CANCELAR_PUESTO_X_CCOSTO"] == 1)) {
                        //<a href="javascript:cancelarGrabarDetallePuesto();"><img  style=" display: none;" id="imgagenCancelar" src="../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif"/></a>
                        echo "<a href=\"javascript:cancelarGrabarDetallePuesto123();\"><img  style=\" display: none;\" id=\"imgagenCancelar\" src=\"../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif\"/></a>";
                    } else {
                        echo "<img  style=\" display: none;\" id=\"imgagenCancelar\" src=\"../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif\"/>";
                    }
                    
                    
                    
                    
                    ?>
                </div>
                <div id='cell53' style="float:left; width:100%;">
                    <?php
//                    if (isset($_SESSION["permiso_formulario_servicio"][204]["CANCELAR_PUESTO_X_CCOSTO"]) && ($_SESSION["permiso_formulario_servicio"][204]["CANCELAR_PUESTO_X_CCOSTO"] == 1)) {
//                        //<a href="javascript:cancelarGrabarDetallePuesto();"><img  style=" display: none;" id="imgagenCancelar" src="../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif"/></a>
//                        echo "<a href=\"javascript:actualizarDatosPuestoenCentroCostos();\"><img  style=\" display: none;\" id=\"imgagenActualizar\" src=\"../../../../fastmedical_front/imagen/btn/b_actualizar_off.gif\"/></a>";
//                    } else {
//                        echo "<img  style=\" display: none;\" id=\"imgagenActualizar\" src=\"../../../../fastmedical_front/imagen/btn/b_actualizar_off.gif\"/>";
//                    }
                    ?>
                </div>

                <div id='cell52' style="float:right; width:100%; display:none ">Mensaje</div>
            </div>


        </fieldset>


    </div>
</fieldset>