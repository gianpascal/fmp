<?php
//require_once("../../../../pholivo/Html.php");//Para usar el combito, ya esta incluido en otro archivo

/********************************* Combo puestos ******************************/
$rs=$_SESSION["puestosEmpleado"];
$arrayCombo = array();
foreach($rs as $fila) {
    $fila["v_desc_ccos"]=htmlentities(trim($fila[2]));
    $arrayCombo[$fila["c_cod_ccos"]]=$fila["v_desc_ccos"];
}
$o_Combo = new Combo($arrayCombo);
$opcionesHTML = $o_Combo->getOptionsHTML();

/****************************** Combo hora propuesta **************************/
for($i=8; $i<24; $i++){
    for($j=0; $j<60; $j=$j+30){
        if($i<10){
            if($j<10){
                $arrayComboHoraPropuesta[$i.".".$j]="0".$i.":"."0".$j;
            }
            else{
                $arrayComboHoraPropuesta[$i.".".$j]="0".$i.":".$j;
            }
        }
        else{
            if($j<10){
                $arrayComboHoraPropuesta[$i.".".$j]=$i.":"."0".$j;
            }
            else{
                $arrayComboHoraPropuesta[$i.".".$j]=$i.":".$j;
            }
        }
    }
    if($i==23){
        $arrayComboHoraPropuesta["24.0"]="24:00";
    }
}
$o_Combo = new Combo($arrayComboHoraPropuesta);
$opcionesHTMLHoraPropuesta = $o_Combo->getOptionsHTML();

/***************************** Combo tiempo uso sala **************************/
//Combo Horas Estimadas
for($i=1; $i<24; $i++){
    for($j=0; $j<60; $j=$j+30){
        if($i<10){
            if($j<10){
                $arrayComboHorasEstimadas[$i.".".$j]="0".$i.":"."0".$j;
            }
            else{
                $arrayComboHorasEstimadas[$i.".".$j]="0".$i.":".$j;
            }
        }
        else{
            if($j<10){
                $arrayComboHorasEstimadas[$i.".".$j]=$i.":"."0".$j;
            }
            else{
                $arrayComboHorasEstimadas[$i.".".$j]=$i.":".$j;
            }
        }
    }
    if($i==23){
        $arrayComboHorasEstimadas["24.0"]="24:00";
    }
}
$o_Combo = new Combo($arrayComboHorasEstimadas);
$opcionesHTMLHorasEstimadas = $o_Combo->getOptionsHTML();
?>
<div>
    <div style="width:100%;height:5%;background: white">
        <div class="titleform">
            <h1>SOLICITUD PROGRAMACION - SALA DE OPERACIONES</h1>
        </div>
    </div> 
    <div>
        <fieldset>
            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Fecha Propuesta</label>
                </div>
                <div style="float:left; width:45%;">
                    <!--<input type="text" name="txtFechaPropuestaSolProgSOP" id="txtFechaPropuestaSolProgSOP" onBlur="validarFechaPropuestaSolProgSOP(this.value);" />-->
                    <input type="text" name="txtFechaPropuestaSolProgSOP" id="txtFechaPropuestaSolProgSOP" />
                    (dd/mm/aaaa)
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
            </div>

            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Hora Propuesta</label>
                </div>
                <div style="float:left; width:45%;">
                    <select name="cboHoraPropuestaSolProgSOP" id="cboHoraPropuestaSolProgSOP">
                        <?php echo $opcionesHTMLHoraPropuesta;?>
                    </select>
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
            </div>

            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Paciente</label>
                </div>
                <div style="float:left; width:45%;">
                    <input type="hidden" name="hdnCodPerPaciente" id="hdnCodPerPaciente" />
                    <input type="text" name="txtNomPacienteSolProgSOP" id="txtNomPacienteSolProgSOP" size="50" readonly="true" />
                </div>
                <div style="float:left; width:11%;">
                    <a href="javascript:mostrarBuscadorPaciente('hdnCodPerPaciente','txtNomPacienteSolProgSOP')">
                        <img border="0" title="Buscar Paciente" alt="Buscar" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif">
                    </a>
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
            </div>

            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Edad</label>
                </div>
                <div style="float:left; width:45%;">
                    <input type="text" name="txtEdadPacienteSolProgSOP" id="txtEdadPacienteSolProgSOP" size="25" readonly="true" />
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
            </div>

            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Centro de Costo</label>
                </div>
                <div style="float:left; width:45%;">
                    <select name="cboCentroCostoSolProgSOP" id="cboCentroCostoSolProgSOP">
                        <?php echo $opcionesHTML;?>
                    </select>
                </div>
                <div style="float:left; width:11%;">
                    <img border="0" title="Buscar Centro de Costo" alt="Buscar" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif">
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
            </div>

            <div id="divTablaDxPreOperatorio">
                <input type="hidden" name="hdnNroDxPreOperatorio" id="hdnNroDxPreOperatorio" value="1" />
                <input type="hidden" name="hdnCadenaIdDxPreOperatorio" id="hdnCadenaIdDxPreOperatorio" value="1" />
                <div id="divFilaDxPreOperatorio_1" style="clear:left;width:100%">
                    <div style="float:left; width:22%;" >
                        <label>Dx PreOperatorio 1</label>
                    </div>
                    <div style="float:left; width:45%;">
                        <input type="hidden" name="hdnIdDxPreOperatorio_1" id="hdnIdDxPreOperatorio_1" />
                        <input type="text" name="txtDescDxPreOperatorio_1" id="txtDescDxPreOperatorio_1" size="50" readonly="true" />
                    </div>
                    <div style="float:left; width:11%;">
                        <a href="javascript:mostrarBuscadorDxPreOperatorio('hdnIdDxPreOperatorio_1','txtDescDxPreOperatorio_1')">
                            <img border="0" title="Buscar Diagnostico" alt="Buscar" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif">
                        </a>
                    </div>
                    <div style="float:left; width:11%;">
                        <a href="javascript:nuevoDxPreOperatorio()">
                            <img border="0" title="Nuevo Diagnostico" alt="Nuevo" src="../../../../fastmedical_front/imagen/icono/abrir.png">
                        </a>
                    </div>
                    <div style="float:left; width:11%;">&nbsp;</div>
                </div>
            </div>

            <div id="divTablaCirugia">
                <input type="hidden" name="hdnNroServicioCirugia" id="hdnNroServicioCirugia" value="1" />
                <input type="hidden" name="hdnCadenaCodServicioCirugia" id="hdnCadenaCodServicioCirugia" value="1" />
                <div id="divFilaTablaCirugia_1" style="clear:left;width:100%">
                    <div style="float:left; width:22%;" >
                        <label>Operacion 1</label>
                    </div>
                    <div style="float:left; width:45%;">
                        <input type="hidden" name="hdnCodServicioCirugia_1" id="hdnCodServicioCirugia_1" />
                        <input type="text" name="txtDescServicioCirugia_1" id="txtDescServicioCirugia_1" size="50" readonly="true" />
                    </div>
                    <div style="float:left; width:11%;">
                        <input type="text" name="txtPorcServicioCirugia_1" id="txtPorcServicioCirugia_1" size="5" value="100" />%
                    </div>
                    <div style="float:left; width:11%;">
                        <a href="javascript:mostrarBuscadorServicioCirugia('hdnCodServicioCirugia_1','txtDescServicioCirugia_1')">
                            <img border="0" title="Buscar Cirugia" alt="Buscar" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif">
                        </a>
                    </div>
                    <div style="float:left; width:11%;">
                        <a href="javascript:nuevoServicioCirugia()">
                            <img border="0" title="Nueva Cirugia" alt="Nuevo" src="../../../../fastmedical_front/imagen/icono/abrir.png">
                        </a>
                    </div>
                </div>
            </div>
            
            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Duraci&oacute;n</label>
                </div>
                <div style="float:left; width:45%;">
                    <select name="cboHorasEstimadasSolProgSOP" id="cboHorasEstimadasSolProgSOP">
                        <?php echo $opcionesHTMLHorasEstimadas;?>
                    </select>&nbsp; hs
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
            </div>

            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Cirujano</label>
                </div>
                <div style="float:left; width:45%;">
                    <input type="hidden" name="hdnCodPerCirujanoResponsable" id="hdnCodPerCirujanoResponsable" value="<?php echo $_SESSION['id_persona']; ?>" />
                    <input type="text" name="txtNomPerCirujanoResponsable" id="txtNomPerCirujanoResponsable" size="50" readonly="true" value="<?php echo htmlentities($_SESSION['nombre']); ?>" />
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
            </div>

            <div id="divTablaCirujanoAyudante">
                <input type="hidden" name="hdnNroCirujanoAyudante" id="hdnNroCirujanoAyudante" value="1" />
                <input type="hidden" name="hdnCadenaCodPerCirujanoAyudante" id="hdnCadenaCodPerCirujanoAyudante" value="1" />
                <div id="divFilaTablaCirujanoAyudante_1" style="clear:left;width:100%">
                    <div style="float:left; width:22%;" >
                        <label>Ayudante 1</label>
                    </div>
                    <div style="float:left; width:45%;">
                        <input type="hidden" name="hdnCodPerCirujanoAyudante_1" id="hdnCodPerCirujanoAyudante_1" />
                        <input type="text" name="txtNomPerCirujanoAyudante_1" id="txtNomPerCirujanoAyudante_1" size="50" readonly="true" />
                    </div>
                    <div style="float:left; width:11%;">
                        <a href="javascript:mostrarBuscadorCirujano('hdnCodPerCirujanoAyudante_1','txtNomPerCirujanoAyudante_1')">
                            <img border="0" title="Buscar Cirujano" alt="Buscar" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif">
                        </a>
                    </div>
                    <div style="float:left; width:11%;">
                        <a href="javascript:nuevoCirujanoAyudante()">
                            <img border="0" title="Codigo de Persona" alt="" src="../../../../fastmedical_front/imagen/icono/abrir.png">
                        </a>
                    </div>
                    <div style="float:left; width:11%;">&nbsp;</div>
                </div>
            </div>

            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Hematocrito</label>
                </div>
                <div style="float:left; width:45%;">
                    <input type="text" name="txtValorHematocrito" id="txtValorHematocrito" size="10" onkeyup="validaDecimal(event,this,'')" />%
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
            </div>

            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Hemoglobina</label>
                </div>
                <div style="float:left; width:45%;">
                    <input type="text" name="txtValorHemoglobina" id="txtValorHemoglobina" size="10" onkeyup="validaDecimal(event,this,'')" />gr/dl
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
            </div>

            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Observaciones</label>
                </div>
                <div style="float:left; width:45%;">
                    <label>
                        <textarea name="txaObservaciones" id="txaObservaciones" cols="45" rows="5"></textarea>
                    </label>
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
            </div>
        </fieldset>
    </div>
    <br/>
    <div id="Div_btnSolProgSOP" align="center" style="width: 100%;background: bottom;display: block">
        <?php //if($_SESSION["permiso_formulario_servicio"][119]["GRABAR_PROG_MED"]==1) echo "<a href=\"javascript:validarCronogramaProgramacionMedicos()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_grabar__on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";?>
        <?php //if($_SESSION["permiso_formulario_servicio"][119]["CANCELAR_GRABAR_PROG_MED"]==1) echo "<a href=\"javascript:regresarCronogramaProgramacionMedicos()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";?>
        <?php echo "<a href=\"javascript:validarManteSolProgSOP('insertar')\"><img src=\"../../../../fastmedical_front/imagen/btn/b_grabar__on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";?>
        <?php echo "<a href=\"javascript:regresarCronogramaProgramacionSOP()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif\"></a>";?>
    </div>
</div>
