<?php
//print_r($rsDetalleSolicitudPendienteSOP);
//print_r($rsDxPreOperatorioSolicitudPendienteSOP);
//////////////////////////////Recuperamos Solicitud//////////////////////////////////////
if(isset ($rsDetalleSolicitudPendienteSOP)){
    $fechaPropuesta=$rsDetalleSolicitudPendienteSOP[0]["vFechaPropuesta"];
    $horaPropuesta=$rsDetalleSolicitudPendienteSOP[0]["vHoraPropuesta"];
    $nomPaciente=htmlentities($rsDetalleSolicitudPendienteSOP[0]["nomCompletoPaciente"]);
    $edad=htmlentities($rsDetalleSolicitudPendienteSOP[0]["edad"]);
    $centroCostoCirujano=htmlentities($rsDetalleSolicitudPendienteSOP[0]["vDescripcionCcosto"]);

    $duracion=$rsDetalleSolicitudPendienteSOP[0]["vTiempoOperatorioEstimado"];

    $hematocrito=$rsDetalleSolicitudPendienteSOP[0]["nHematocrito"];
    $hemoglobina=$rsDetalleSolicitudPendienteSOP[0]["nHemoglobina"];
    $observaciones=htmlentities($rsDetalleSolicitudPendienteSOP[0]["vObservaciones"]);

}
else{
    $fechaPropuesta="";
    $horaPropuesta="";
    $nomPaciente="";
    $edad="";
    $centroCostoCirujano="";
    $duracion="";
    $hematocrito="";
}
////////////////////////////Recuperamos DxPreOperatorio//////////////////////////////////
$numDxPreOperatorio=count($rsDxPreOperatorioSolicitudPendienteSOP);

$filasDivDxPreOperatorio="";
for($i=1; $i<=$numDxPreOperatorio; $i++){
    $iniDivFila="<div id=\"divFilaDxPreOperatorio_".$i."\" style=\"clear:left;width:100%\">";
    $finDiv="</div>";

    $col1="<div style=\"float:left; width:22%;\" >";
    $col1.="<label>Dx PreOperatorio ".$i."</label>";
    $col1.="</div>";

    $col2="<div style=\"float:left; width:45%;\">";
    $col2.="<input type=\"hidden\" name=\"hdnIdDxPreOperatorio_".$i."\" id=\"hdnIdDxPreOperatorio_".$i."\" />";
    $col2.="<input type=\"text\" name=\"txtDescDxPreOperatorio_".$i."\" id=\"txtDescDxPreOperatorio_".$i."\" size=\"50\" readonly=\"true\" value=\"".$rsDxPreOperatorioSolicitudPendienteSOP[$i-1]["vDescripcion"]."\" />";
    $col2.="</div>";

    $col3="<div style=\"float:left; width:11%;\">";
    //$col3.="<a href=\"javascript:mostrarBuscadorDxPreOperatorio('hdnIdDxPreOperatorio_".$i."','txtDescDxPreOperatorio_".$i."')\">";
    //$col3.="<img border=\"0\" title=\"Buscar Diagnostico\" alt=\"Buscar\" src=\"../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif\">";
    //$col3.="</a>";
    $col3.="&nbsp;";
    $col3.="</div>";

    $col4="<div style=\"float:left; width:11%;\">";
    //$col4.="<a href=\"javascript:nuevoDxPreOperatorio()\">";
    //$col4.="<img border=\"0\" title=\"Nuevo Diagnostico\" alt=\"Nuevo\" src=\"../../../../fastmedical_front/imagen/icono/abrir.png\">";
    //$col4.="</a>";
    $col4.="&nbsp;";
    $col4.="</div>";

    $col5="<div style=\"float:left; width:11%;\">";
    $col5.="&nbsp;";
    $col5.="</div>";

    $contenido=$col1.$col2.$col3.$col4.$col5;

    $filasDivDxPreOperatorio.=$iniDivFila.$contenido.$finDiv;
}

////////////////////////////Recuperamos Cirujias//////////////////////////////////
$numCirugias=count($rsCirugiasSolicitudPendienteSOP);

$filasDivCirugias="";
for($i=1; $i<=$numCirugias; $i++){
    $iniDivFila="<div id=\"divFilaTablaCirugia_".$i."\" style=\"clear:left;width:100%\">";
    $finDiv="</div>";

    $col1="<div style=\"float:left; width:22%;\" >";
    $col1.="<label>Operacion ".$i."</label>";
    $col1.="</div>";

    $col2="<div style=\"float:left; width:45%;\">";
    $col2.="<input type=\"hidden\" name=\"hdnCodServicioCirugia_".$i."\" id=\"hdnCodServicioCirugia_".$i."\" />";
    $col2.="<input type=\"text\" name=\"txtDescServicioCirugia_".$i."\" id=\"txtDescServicioCirugia_".$i."\" size=\"50\" readonly=\"true\" value=\"".$rsCirugiasSolicitudPendienteSOP[$i-1]["v_desc_ser_pro"]."\" />";
    $col2.="</div>";

    $col3="<div style=\"float:left; width:11%;\">";
    $col3.="<input type=\"text\" name=\"txtPorcServicioCirugia_".$i."\" id=\"txtPorcServicioCirugia_".$i."\" size=\"5\" readonly=\"true\" value=\"".$rsCirugiasSolicitudPendienteSOP[$i-1]["nPorcentajeCobro"]."\" />%";
    $col3.="</div>";

    $col4="<div style=\"float:left; width:11%;\">";
    //$col4.="<a href=\"javascript:mostrarBuscadorServicioCirugia('hdnCodServicioCirugia_".$i."','txtDescServicioCirugia_".$i."')\">";
    //$col4.="<img border=\"0\" title=\"Buscar Cirugia\" alt=\"Buscar\" src=\"../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif\">";
    //$col4.="</a>";
    $col4.="&nbsp;";
    $col4.="</div>";

    $col5="<div style=\"float:left; width:11%;\">";
    //$col5.="<a href=\"javascript:nuevoServicioCirugia()\">";
    //$col5.="<img border=\"0\" title=\"Nueva Cirugia\" alt=\"Nuevo\" src=\"../../../../fastmedical_front/imagen/icono/abrir.png\">";
    //$col5.="</a>";
    $col5.="&nbsp;";
    $col5.="</div>";

    $contenido=$col1.$col2.$col3.$col4.$col5;

    $filasDivCirugias.=$iniDivFila.$contenido.$finDiv;
}

////////////////////////////Recuperamos Ayudantes//////////////////////////////////
$numAyudantes=count($rsAyudantesSolicitudPendienteSOP);

$filasDivAyudantes="";
for($i=1; $i<=$numAyudantes; $i++){
    $iniDivFila="<div id=\"divFilaTablaCirujanoAyudante_".$i."\" style=\"clear:left;width:100%\">";
    $finDiv="</div>";

    $col1="<div style=\"float:left; width:22%;\" >";
    $col1.="<label>Ayudante ".$i."</label>";
    $col1.="</div>";

    $col2="<div style=\"float:left; width:45%;\">";
    $col2.="<input type=\"hidden\" name=\"hdnCodPerCirujanoAyudante_".$i."\" id=\"hdnCodPerCirujanoAyudante_".$i."\" />";
    $col2.="<input type=\"text\" name=\"txtNomPerCirujanoAyudante_".$i."\" id=\"txtNomPerCirujanoAyudante_".$i."\" size=\"50\" readonly=\"true\" value=\"".$rsAyudantesSolicitudPendienteSOP[$i-1]["nomCompletoAyudante"]."\" />";
    $col2.="</div>";

    $col3="<div style=\"float:left; width:11%;\">";
    //$col3.="<a href=\"javascript:mostrarBuscadorCirujano('hdnCodPerCirujanoAyudante_".$i."','txtNomPerCirujanoAyudante_".$i."')\">";
    //$col3.="<img border=\"0\" title=\"Buscar Cirujano\" alt=\"Buscar\" src=\"../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif\">";
    //$col3.="</a>";
    $col3.="&nbsp;";
    $col3.="</div>";

    $col4="<div style=\"float:left; width:11%;\">";
    //$col4.="<a href=\"javascript:nuevoCirujanoAyudante()\">";
    //$col4.="<img border=\"0\" title=\"Codigo de Persona\" alt=\"\" src=\"../../../../fastmedical_front/imagen/icono/abrir.png\">";
    //$col4.="</a>";
    $col4.="&nbsp;";
    $col4.="</div>";

    $col5="<div style=\"float:left; width:11%;\">";
    $col5.="&nbsp;";
    $col5.="</div>";

    $contenido=$col1.$col2.$col3.$col4.$col5;

    $filasDivAyudantes.=$iniDivFila.$contenido.$finDiv;
}
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
                    <input type="text" name="txtFechaPropuestaSolProgSOP" id="txtFechaPropuestaSolProgSOP" size="10" readonly="true" value="<?php echo $fechaPropuesta;?>" />
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
                    <input type="text" name="txtHoraPropuestaSolProgSOP" id="txtHoraPropuestaSolProgSOP" size="10" readonly="true" value="<?php echo $horaPropuesta;?>" />
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
                    <input type="text" name="txtNomPacienteSolProgSOP" id="txtNomPacienteSolProgSOP" size="50" readonly="true" value="<?php echo $nomPaciente;?>" />
                </div>
                <div style="float:left; width:11%;">
                    <!--<a href="javascript:mostrarBuscadorPaciente('hdnCodPerPaciente','txtNomPacienteSolProgSOP')">
                        <img border="0" title="Buscar Paciente" alt="Buscar" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif">
                    </a>-->
                    &nbsp;
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
            </div>

            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Edad</label>
                </div>
                <div style="float:left; width:45%;">
                    <input type="text" name="txtEdadPacienteSolProgSOP" id="txtEdadPacienteSolProgSOP" size="25" readonly="true" value="<?php echo $edad;?>" />
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
                    <input type="text" name="txtCentroCostoSolProgSOP" id="txtCentroCostoSolProgSOP" size="50" readonly="true" value="<?php echo $centroCostoCirujano;?>" />
                </div>
                <div style="float:left; width:11%;">
                    <!--<img border="0" title="Buscar Centro de Costo" alt="Buscar" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif">-->
                    &nbsp;
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
            </div>

            <!--<div id="divTablaDxPreOperatorio">
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
            </div>-->
            <div id="divTablaDxPreOperatorio">
                <input type="hidden" name="hdnNroDxPreOperatorio" id="hdnNroDxPreOperatorio" value="1" />
                <input type="hidden" name="hdnCadenaIdDxPreOperatorio" id="hdnCadenaIdDxPreOperatorio" value="1" />
                <?php echo $filasDivDxPreOperatorio;?>
            </div>

            <!--<div id="divTablaCirugia">
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
            </div>-->
            <div id="divTablaCirugia">
                <input type="hidden" name="hdnNroServicioCirugia" id="hdnNroServicioCirugia" value="1" />
                <input type="hidden" name="hdnCadenaCodServicioCirugia" id="hdnCadenaCodServicioCirugia" value="1" />
                <?php echo $filasDivCirugias;?>
            </div>

            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Duraci&oacute;n</label>
                </div>
                <div style="float:left; width:45%;">
                    <input type="text" name="txtHorasEstimadasSolProgSOP" id="txtHorasEstimadasSolProgSOP" size="10" readonly="true" value="<?php echo $duracion;?>" />
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
                    <input type="text" name="txtNomPerCirujanoResponsable" id="txtNomPerCirujanoResponsable" size="50" readonly="true" value="<?php echo htmlentities($_SESSION['nombre']) ; ?>" />
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
            </div>

            <!--<div id="divTablaCirujanoAyudante">
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
            </div>-->
            <div id="divTablaCirujanoAyudante">
                <input type="hidden" name="hdnNroCirujanoAyudante" id="hdnNroCirujanoAyudante" value="1" />
                <input type="hidden" name="hdnCadenaCodPerCirujanoAyudante" id="hdnCadenaCodPerCirujanoAyudante" value="1" />
                <?php echo $filasDivAyudantes;?>
            </div>

            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Hematocrito</label>
                </div>
                <div style="float:left; width:45%;">
                    <input type="text" name="txtValorHematocrito" id="txtValorHematocrito" size="10" onkeyup="validaDecimal(event,this,'')" readonly="true" value="<?php echo $hematocrito;?>" />%
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
                    <input type="text" name="txtValorHemoglobina" id="txtValorHemoglobina" size="10" onkeyup="validaDecimal(event,this,'')" readonly="true" value="<?php echo $hemoglobina;?>" />gr/dl
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
                        <textarea name="txaObservaciones" id="txaObservaciones" cols="45" rows="5" readonly="true"><?php echo $observaciones;?></textarea>
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
        <?php //echo "<a href=\"javascript:validarManteProgSOP('insertar')\"><img src=\"../../../../fastmedical_front/imagen/btn/b_grabar__on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";?>
        <?php echo "<a href=\"javascript:regresarSolicitudesPendientesSOP()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif\"></a>";?>
    </div>
</div>
