<?php
if (isset($value[13])) {
    $bRecibir = 1;
    $idProcesarPuntoControlRecibir = $value[12];
    $idProcesarPuntoControlProcesar = $value[16];
     $iIdPacienteLaboratorioPuntoControl = $value[6];
    $arrayDatosRecibir = $this->aDatosRecibir($idProcesarPuntoControlRecibir);
    $arrayDatosPuntoControl = $this->aDatosPuntoControlPacienteProcesado($idProcesarPuntoControlProcesar);
    // echo 'Procesar';
    //print_r($arrayDatosRecibir);
} else {
    $bRecibir = 0;
    $idProcesarPuntoControlProcesar = $value[12];
    $arrayDatosPuntoControl = $this->aDatosPuntoControlPacienteProcesado($idProcesarPuntoControlProcesar);
}
///////////////////////////para reporte
$numeroDatos = count($arrayDatosPuntoControl);
$contador = 0;
$idGrupo = $arrayDatosPuntoControl[0][0];
$idGrupoAuxiliar = '';
$idDato = $arrayDatosPuntoControl[0][2];
$idDatoAuxiliar = '';
$cadena = '';

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
        $cadena.="<table class='tablaDiagnostico'  border='0'>";
        $cadena.="
            <tr>
                <td><strong>Nro</strong></td>
                <td style='width:150px; ' ><strong>Item</strong></td>
                <td style='width:150px; '><strong>Valor</strong></td>
                <td style='width:400px; '><strong>Rango</strong></td>
            </tr>
        
        <tbody>";
    }
    $nombreDato = $valores[3];

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
                    if($rangos[6]=='1'){
                       $edad = "$edadMinima < edad < $edadMaxima"; 
                    }else{
                        $edad = "---";
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
                            if($rangos[10]==$datoCombo[2]){
                               $rangoFinal=$datoCombo[1]; 
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

        switch ($tipoDato) {
            case 1:
                //entero
                $ivalor = $valores[17];
                $entrada = "<input readonly value='$ivalor' name='0' type='text' onkeyup='validaIntegers(event,this,\"\");' style='width:50px;' onchange='grabarDatoLaboratorio($tipoDato,$idDatoExamenPacienteLaboratorio,this,$idProcesarPuntoControl,$idDatoPuntoControl)' >";
                break;
            case 2:
                //varchar
                $vvalor = $valores[19];
                $entrada = "<input readonly value='$vvalor' name='0' type='text' style='width:100px;' onchange='grabarDatoLaboratorio($tipoDato,$idDatoExamenPacienteLaboratorio,this,$idProcesarPuntoControl,$idDatoPuntoControl)' >";
                break;
            case 3:
                //datatime
                echo "i es igual a 2";
                break;
            case 4:
                //decimal
                //varchar
                $nvalor = $valores[18];
                $entrada = "<input readonly name='0' value='$nvalor' type='text' onkeyup='validaDecimal(event,this,\"\");' style='width:100px;'  onchange='grabarDatoLaboratorio($tipoDato,$idDatoExamenPacienteLaboratorio,this,$idProcesarPuntoControl,$idDatoPuntoControl)' >";
                break;
            case 5:
                //boolean
                $bvalor = $valores[20];
                if ($bvalor == 1) {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }
                $entrada = "<input disabled name='0' $checked TYPE=CHECKBOX onclick='if(this.checked){this.value=1}else{this.value=0;}' onchange='grabarDatoLaboratorio($tipoDato,$idDatoExamenPacienteLaboratorio,this,$idProcesarPuntoControl,$idDatoPuntoControl)' >";
                break;
            case 6:
                //combo
                $iiDCombo = $valores[14];
                $iCombo = $valores[21]; //valor del combo
                $arrayCombo = $this->arrayComboLaboratorio($iiDCombo);

                $entrada = "<select disabled style='width:100px;' onchange='grabarDatoLaboratorio($tipoDato,$idDatoExamenPacienteLaboratorio,this,$idProcesarPuntoControl,$idDatoPuntoControl)'>";
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
                $entrada = "<text readonly style='width:100px;' ></text>";
                break;
        }
        $cadena.="<tr>
                <td>$contador</td>
                <td>$nombreDato</td>
        
                <td>$entrada</td>
                <td>$tablaRango</td>
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
?>

<?php
if ($bRecibir == 1) {
    ?>  

    <fieldset>
        <table border="0">

            <tr>
                <td>Fecha de Recepción:</td>
                <td><?php echo $arrayDatosRecibir[0][0]; ?></td>
            </tr>
            <tr>
                <td>Usuario:</td>
                <td><?php echo $arrayDatosRecibir[0][1]; ?></td>
            </tr>
            <tr>
                <td>Host:</td>
                <td><?php echo $arrayDatosRecibir[0][2]; ?></td>
            </tr>
            <tr>
                <td>Observaciones:</td>
                <td>
    <?php echo $arrayDatosRecibir[0][3]; ?>
                </td>
            </tr>

        </table>

    </fieldset>
    <?php
}
echo $cadena;

?>
<fieldset>
        <table border="0">

            <tr>
                <td>Fecha de Procesamiento:</td>
                <td><?php echo $arrayDatosPuntoControl[0][22]; ?></td>
            </tr>
            <tr>
                <td>Usuario:</td>
                <td><?php echo $arrayDatosPuntoControl[0][23]; ?></td>
            </tr>
            <tr>
                <td>Host:</td>
                <td><?php echo $arrayDatosPuntoControl[0][24]; ?></td>
            </tr>
            <tr>
                <td>Observaciones:</td>
                <td>
    <?php echo $arrayDatosPuntoControl[0][25]; ?>
                </td>
            </tr>

        </table>

    </fieldset>



