<input type="hidden" id="idProcesar_<?php echo $idPuntoControl; ?>" value="<?php echo $idProcesarPuntoControl; ?>" />
<?php
$arrayDatosPuntoControl = $this->aDatosPuntoControlPaciente($iIdPacienteLaboratorioPuntoControl);
$numeroDatos = count($arrayDatosPuntoControl);
$contador = 0;
$idGrupo = $arrayDatosPuntoControl[0][0];
$idGrupoAuxiliar = '';
$idDato = $arrayDatosPuntoControl[0][2];
$idDatoAuxiliar = '';
$cadena = '';
$funcionCerrar = $datos["funcionCerrar"];
$contadorItems = 0;
foreach ($arrayDatosPuntoControl as $valores) {
    $contador++;
    $idGrupo = $valores[0];
    $idDato = $valores[2];
    if ($idGrupo != $idGrupoAuxiliar) {

        if ($idGrupoAuxiliar != '') {
            $cadena.="</tbody>
                  </table>";
            $cadena.="</fieldset>";
        }
        $cadena.="<fieldset>";
        $nombreGrupo = $valores[1];
        $cadena.="<legend>$nombreGrupo</legend>";
        $cadena.= "<input type='hidden' id='estado_$contador' value='$valores[24]' />";
        if ($valores[24] == 1) {
            $cadena.= '<img id="imgBuscar" border="0" onclick="CargarDatosResultadosLaboratorio()" title="Codigo de Persona" alt="" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif">';
        }
        $cadena.="<table class='tablaDiagnostico'  border='0'>";
        $cadena.="
            <tr>
                <td><strong>Nro</strong></td>
                <td style='width:150px; ' ><strong>Item</strong></td>
                <td style='width:150px; '><strong>Valor</strong></td>
                <td style='width:100px; '><strong>U.Med</strong></td>
                <td style='width:400px; '><strong>Rango</strong></td>
            </tr>

            <tbody>";
    }
    $nombreDato = $valores[3];
    $unidadMedida = $valores[22];
    ;
    if ($valores[23] == 1) {
        $obligatorio = ' (*)';
    } else {
        $obligatorio = '';
    }

    if ($idDato != $idDatoAuxiliar) {
        $tablaRango = "<table class='tablaDiagnostico'  border='0'>";
        $tablaRango.="
                <tr>
                    <td style='width:100px; ' ><strong>Edad</strong></td>
                    <td style='width:50px; ' ><strong>Sexo</strong></td>
                    <td style='width:100px; '><strong>Rango</strong></td>
                    <td style='width:150px; '><strong>significado</strong></td>
                </tr>

                <tbody>";
        $isRango = 1;
        $tipoDato = $valores[13];
        if ($tipoDato == 6) {
            $iiDCombo = $valores[14];
            $iCombo = $valores[21]; //valor del combo
            $arrayCombo = $this->arrayComboLaboratorio($iiDCombo);
        }
        foreach ($arrayDatosPuntoControl as $rangos) {
            if ($idDato == $rangos[2]) {
                if ($rangos[4] != '') {
                    $edadMinima = $rangos[7];
                    $edadMaxima = $rangos[8];
                    if ($rangos[6] == '1') {//bedad
                        $edad = "$edadMinima < edad < $edadMaxima";
                    } else {
                        $edad = "-";
                    }
                    if ($rangos[5] == '1') {
                        $sexo = $rangos[9];
                        if ($sexo == 1) {
                            $sexo = 'hombre';
                        } else {
                            $sexo = 'mujer';
                        }
                    } else {
                        $sexo = '-';
                    }
                    if ($tipoDato == 6) {
                        foreach ($arrayCombo as $datoCombo) {
                            if ($rangos[10] == $datoCombo[2]) {
                                $rangoFinal = $datoCombo[1];
                            }
                        }
                    } else {
                        $rangoMinimo = $rangos[10];
                        $rangoMaximo = $rangos[11];
                        $rangoFinal = "$rangoMinimo < R < $rangoMaximo";
                    }


                    $significado = $rangos[12];
                    $tablaRango.="<tr>
                        <td>$edad</td>
                        <td>$sexo</td>
                        <td>$rangoFinal</td>
                        <td>$significado</td>
                    </tr>";
                } else {
                    $isRango = 0;
                }
            }
        }
        $tablaRango.="</tbody>
            </table>";
        if ($isRango == 0) {
            $tablaRango = '';
        }
        $tipoDato = $valores[13];
        $entrada = '';

        $idDatoExamenPacienteLaboratorio = $valores[16];
        if ($idDatoExamenPacienteLaboratorio == '') {
            $idDatoExamenPacienteLaboratorio = 0;
        }
        $idDatoPuntoControl = $valores[2];
        $contadorItems++;
        $entrada2 = "<input type='hidden' id='tipoDatos_$contadorItems' value='$tipoDato' />";
        $entrada2 .= "<input type='hidden' id='idDatoExamenPacienteLaboratorio_$contadorItems' value='$idDatoExamenPacienteLaboratorio' />";
        $entrada2 .= "<input type='hidden' id='idProcesarPuntoControl_$contadorItems' value='$idProcesarPuntoControl' />";
        $entrada2 .= "<input type='hidden' id='idDatoPuntoControl_$contadorItems' value='$idDatoPuntoControl' />";
//          grabarDatoLaboratorio($tipoDato,$idDatoExamenPacienteLaboratorio,this,$idProcesarPuntoControl,$idDatoPuntoControl)
        switch ($tipoDato) {
            case 1:
                //entero
                $ivalor = $valores[17];
                $entrada = "<input id='valor_$contadorItems' value='$ivalor' name='0' type='text' onkeyup='validaIntegersLaboratorio(event,this,\"\");' style='width:50px;' onchange='grabarDatoLaboratorio($tipoDato,$idDatoExamenPacienteLaboratorio,this,$idProcesarPuntoControl,$idDatoPuntoControl)' >";
                break;
            case 2:
                //varchar
                $vvalor = $valores[19];
                $entrada = "<input id='valor_$contadorItems' value='$vvalor' name='0' onkeyup='saltoVarchar(event,this,\"\");' type='text' style='width:100px;' onchange='grabarDatoLaboratorio($tipoDato,$idDatoExamenPacienteLaboratorio,this,$idProcesarPuntoControl,$idDatoPuntoControl)' >";
                break;
            case 3:
                //datatime
                echo "i es igual a 2";
                break;
            case 4:
                //decimal
                //varchar
                $nvalor = $valores[18];
                $entrada = "<input id='valor_$contadorItems' name='0' value='$nvalor' type='text' onkeyup='validaDecimalLaboratorio(event,this,\"\");' style='width:100px;'  onchange='grabarDatoLaboratorio($tipoDato,$idDatoExamenPacienteLaboratorio,this,$idProcesarPuntoControl,$idDatoPuntoControl)' >";
                break;
            case 5:
                //boolean
                $bvalor = $valores[20];
                if ($bvalor == 1) {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }
                $entrada = "<input id='valor_$contadorItems' name='0' $checked TYPE=CHECKBOX onclick='if(this.checked){this.value=1}else{this.value=0;}' onchange='grabarDatoLaboratorio($tipoDato,$idDatoExamenPacienteLaboratorio,this,$idProcesarPuntoControl,$idDatoPuntoControl)' >";
                break;
            case 6:
                //combo
                $iiDCombo = $valores[14];
                $iCombo = $valores[21]; //valor del combo
                //$arrayCombo = $this->arrayComboLaboratorio($iiDCombo);

                $entrada = "<select id='valor_$contadorItems' style='width:100px;' onchange='grabarDatoLaboratorio($tipoDato,$idDatoExamenPacienteLaboratorio,this,$idProcesarPuntoControl,$idDatoPuntoControl)'>";
                $entrada.="<option value=''>Seleccionar</option>";

                foreach ($arrayCombo as $items) {

                    $itemCombo = $items[1];
                    $valueCombo = $items[0];
                    if ($iCombo == $valueCombo) {
                        $seleccionado = 'selected';
                    } else {
                        $seleccionado = '';
                    }
                    $entrada.="<option $seleccionado value='$valueCombo'>$itemCombo</option>";
                }
                $entrada.= "</select>";

                break;
            case 7:
                //texto
                $entrada = "<text id='valor_$contadorItems' style='width:100px;' ></text>";
                break;
        }

        $cadena.="<tr>
                <td>
                    $contadorItems
                    <input type='hidden' id='contador_$contadorItems' value='$contadorItems' />
                    <input type='hidden' id='obligatorio_$contadorItems' value='$obligatorio' />
                    <input type='hidden' id='funcioNulos_$contadorItems' value='grabarDatoLaboratorioNulos($tipoDato,$idDatoExamenPacienteLaboratorio,$contadorItems,$idProcesarPuntoControl,$idDatoPuntoControl)' />
                </td>
                <td>$nombreDato $obligatorio</td>

                <td>$entrada</td>
                <td>$unidadMedida</td>
                <td>$tablaRango</td>
                <td>$entrada2</td>
            </tr>";
    }

    if ($numeroDatos == $contador) {
        $cadena.="</tbody>
        </table>";
        $cadena.="</fieldset>";
    }


    $idGrupoAuxiliar = $idGrupo;
    $idDatoAuxiliar = $idDato;
}
echo $cadena;
?>

<fieldset>
    <legend>Procesar</legend>

    Observaciones:
    <br/>
    <textarea id="textObservacion<?php echo $idProcesarPuntoControl; ?>" style="width: 300px; height: 100px;"></textarea>
    <input type="hidden" id="numeroCampos" value='<?php echo $contadorItems; ?>' />
    <?php
    $toolbar1 = new ToollBar();
    $toolbar1->SetBoton("terminarProceso", "Terminar Proceso", "btn", "onclick,onkeypress", "terminarProceso($idProcesarPuntoControl,'$funcionCerrar')", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/kopeteavailable.png", "", "", 1);
    $toolbar1->Mostrar();
    ?>
</fieldset>

