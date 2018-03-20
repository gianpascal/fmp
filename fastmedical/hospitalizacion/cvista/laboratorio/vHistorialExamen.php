<div style="width:100%; height:25px;background-color: #D6E9FE; color: #770088" id="divCaberaEstadoExamenes" class="titleform">
    <h1><?php echo $datos["nombrePaciente"]; ?></h1>
</div>
<input id="textAcordion" type="hidden" value="<?php echo $cadenaAcordion; ?>">

<div id="contenedorAcordion" style="width: 780px; height: 570px; background-color:#487595;margin: 0 auto; ">

</div>
<div id="divDatos" style="position: relative; width: 100%; height: 100%; display: none; ">
    <div style="padding:15px;">
        <fieldset>
            <legend> Datos del Paciente</legend>
            <div style="padding:15px;">
                <div class="filaDatosPaciente" >
                    <div class="labelDatosPaciente">
                        <b> Id Paciente Laboratorio: </b>
                    </div>
                    <div class="inputMuestra">
                        <input type="text" id="txtIdPacienteLaboratorio" type="text" value="<?php echo $datos["idPacienteLaboratorio"]; ?>" /> 
                    </div>
                </div>
                <div class="filaDatosPaciente" >
                    <div class="labelDatosPaciente">
                        <b> Examen: </b>
                    </div>
                    <div class="inputMuestra">
                        <?php echo $datos["nombreExamen"]; ?>
                    </div>
                </div>
                <div class="filaDatosPaciente" >
                    <div class="labelDatosPaciente">
                        <b>Afiliacion:</b>
                    </div>
                    <div class="inputDatosPaciente">
                        <?php echo $datos["afiliacion"]; ?>
                    </div>
                </div>
                <div class="filaDatosPaciente" >
                    <div class="labelDatosPaciente">
                        <b> Fecha de Orden:</b>
                    </div>
                    <div class="inputDatosPaciente">
                        <?php echo $datos["fechaExamen"]; ?>
                    </div>
                </div>
                <div class="filaDatosPaciente" >
                    <div class="labelDatosPaciente">
                        <b>Procedencia:</b>
                    </div>
                    <div class="inputDatosPaciente">
                        <?php echo $datos["procedencia"]; ?>
                    </div>
                </div>
                <div class="filaDatosPaciente" >
                    <div class="labelDatosPaciente">
                        <b> Codigo de Barras:</b>
                    </div>
                    <div class="inputDatosPaciente">
                        <input readonly="true" id="txtCodigoBarras" style="width:120px; " onkeypress="modificarCodigoBarras(event)" value="<?php echo $datos["codigoBarras"]; ?>" />
                        <a href="javascript:editarCodigoBarras();">
                            <img id="iconoEditarCodigoBarras" border="0" src="../../../../medifacil_front/imagen/icono/editar.png" alt="" title="editar" />
                        </a>
                        <a href="javascript:modificarCodigoBarras1();">
                            <img style="display: none;" id="iconoGrabarCodigoBarras" border="0" src="../../../../medifacil_front/imagen/icono/grabar.png" alt="" title="Guardar" />
                        </a>
                        <a href="javascript:cancelarCodigoBarras();">
                            <img style="display: none;" id="iconoCancelarCodigoBarras" border="0" src="../../../../medifacil_front/imagen/icono/cancel.png" alt="" title="cancelar" />
                        </a>
                    </div>
                </div>
                <div class="filaDatosPaciente" >
                    <div class="labelDatosPaciente">
                        <b>Telef /Cel1 /Cel2:</b>
                    </div>
                    <div class="inputDatosPaciente">
                        <?php
                        foreach ($arrayTelefonos as $key => $value) {
                            $tipo = $value[2];
                            if ($tipo == '0001') {
                                $val11 = $value[1];
                                $val12 = $value[0];
                                break;
                            }
                        }
                        $text1.='<input readonly="true" id="txtTelefono" style="width:80px; " value="';
                        $text1.=$val11 . '" />';
                        $text11.='<input id="txtCidContactoTelefono" type="hidden" style="width:80px; " value="';
                        $text11.=$val12 . '" />';
                        foreach ($arrayTelefonos as $key => $value) {
                            $tipo = $value[2];
                            if ($tipo == '0003') {
                                $val21 = $value[1];
                                $val22 = $value[0];
                                break;
                            }
                        }
                        $text2.='<input readonly="true" id="txtCell1" style="width:80px; " value="';
                        $text2.=$val21 . '" />';
                        $text22.='<input id="txtCidContactoCelular1" type="hidden" style="width:80px; " value="';
                        $text22.=$val22 . '" />';
                        foreach ($arrayTelefonos as $key => $value) {
                            $tipo = $value[2];
                            if ($tipo == '0004') {
                                $val31 = $value[1];
                                $val32 = $value[0];
                                break;
                            }
                        }
                        $text3.='<input readonly="true" id="txtCell2" style="width:80px; " value="';
                        $text3.=$val31 . '" />';
                        $text33.='<input id="txtCidContactoCelular2" type="hidden" style="width:80px; " value="';
                        $text33.=$val32 . '" />';
                        echo $text1;
                        echo $text11;
                        echo $text2;
                        echo $text22;
                        echo $text3;
                        echo $text33;
                        ?>
                        <a href="javascript:editarTelefonos();">
                            <img id="iconoEditarTelefono" border="0" src="../../../../medifacil_front/imagen/icono/editar.png" alt="" title="editar" />
                        </a>
                        <a href="javascript:modificarTelefonos();">
                            <img style="display: none;" id="iconoGrabarTelefono" border="0" src="../../../../medifacil_front/imagen/icono/grabar.png" alt="" title="Guardar" />
                        </a>
                        <a href="javascript:cancelarTelefonos();">
                            <img style="display: none;" id="iconoCancelarTelefono" border="0" src="../../../../medifacil_front/imagen/icono/cancel.png" alt="" title="cancelar" />
                        </a>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>



<div id="divMuestra" style="position: relative; width: 100%; height: 100%; overflow: auto; font-family: Tahoma; font-size: 10px; display: none;">
    <?php
    require_once('../../../hospitalizacion/cvista/laboratorio/examenPaciente/muestras.php');
    ?>
</div>
<?php
$contadorPeche = 0;
$abrir = 0;
foreach ($arrayAuxPuntoControl as $value) {
    $contadorPeche++;
    $idPuntoControl = $value[0];
    $iIdPacienteLaboratorioPuntoControl = $value[6];
    ?>
    <div id="<?php echo "div" . $value[1]; ?>" style="position: relative; width: 100%; height: 100%; overflow: auto; display: none;">
        <?php 
        if($contadorPeche==1){
        ?>
        <br>
        <div class="filaDatosPaciente" >
                    <div class="labelDatosPaciente">
                        <b> Codigo de Barras:</b>
                    </div>
                    <div class="inputDatosPaciente">
                        <input readonly="true" id="txtCodBarra2" style="width:120px; "  onkeypress="modificarCodigoBarras2(event)" value="<?php echo $datos["codigoBarras"]; ?>"/>
                        <a href="javascript:editarCodBarra2();">
                            <img id="idtxtCodBarra2" border="0" src="../../../../medifacil_front/imagen/icono/editar.png" alt="" title="editar" />
                        </a>
                        <a href="javascript:modificarCodigoBarras3();">
                            <img style="display: none;" id="iconoGrabarCodigoBarras2" border="0" src="../../../../medifacil_front/imagen/icono/grabar.png" alt="" title="Guardar" />
                        </a>
                        <a href="javascript:cancelarCodigoBarras2();">
                            <img style="display: none;" id="iconoCancelarCodigoBarras2" border="0" src="../../../../medifacil_front/imagen/icono/cancel.png" alt="" title="cancelar" />
                        </a>
                    </div>
                </div>
        <br>
        <?php
        }
        ?>
        
        <?php
        //datos de Muestra
        if ($value[3] == 1) {
            require_once('../../../hospitalizacion/cvista/laboratorio/examenPaciente/muestras.php');
        }
        // Materiales
        require('../../../hospitalizacion/cvista/laboratorio/examenPaciente/materiales.php');
        //
        if ($value[8] == 1) {//si es el ultimo proceso
            $abrir = $contadorPeche + 1;
            $iIdPacienteLaboratorioPuntoControl = $value[6];
            $idProcesarPuntoControl = $value[12];
            if ($value[12] == '') { //si el procesar es nullo
                //echo 'sin procesar al inico';
                //agregar procesar punto control
                $iIdPacienteLaboratorioPuntoControl = $value[6];
                //print_r($value);
                $idProcesarPuntoControl = $this->agregarProcesarPuntoControl($iIdPacienteLaboratorioPuntoControl, 2);
                if ($value[2] == 1) {   /// es recibir
                    require('../../../hospitalizacion/cvista/laboratorio/examenPaciente/recibir.php');
                } else {

                    //$idProcesarPuntoControl=$value[10];
                    require('../../../hospitalizacion/cvista/laboratorio/examenPaciente/procesar.php');
                }
            } else {
                //echo "*".$value[10]."*";

                if ($value[2] == 1) {
                    if (isset($value[13])) {
                        $idProcesarPuntoControl = $value[16];
                        require('../../../hospitalizacion/cvista/laboratorio/examenPaciente/procesar.php');
                    } else {
                        require('../../../hospitalizacion/cvista/laboratorio/examenPaciente/recibir.php');
                    }
                } else {

                    require('../../../hospitalizacion/cvista/laboratorio/examenPaciente/procesar.php');
                }
            }
        } else {
            require('../../../hospitalizacion/cvista/laboratorio/examenPaciente/procesado.php');
        }
        ?>
    </div>

    <?php
}
?>

<input type="hidden" id="textAbierto" type="text" value="<?php echo $abrir; ?>" />




