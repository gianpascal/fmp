<div id="Div_Odontograma" style="width:100%; float: left">
    <div id="Div_OdontogramaEncabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('Div_OdontogramaCuerpo');">
        <table style="height: auto;width: 100%" class="accordion_title">
            <tr align="center">
                <td>
                    <h1>Odontograma</h1>
                </td>
                <td style="width:3%">
                    <img id="Div_OdontogramaCuerpoicono" src='../../../../medifacil_front/imagen/icono/desplegar.png' title='desplegar' alt=""/>
                </td>
            </tr>
        </table>
    </div>
    <div id="Div_OdontogramaCuerpo" style="width:100%;">
        <div id="canvas" style="width: 800px;height:400px;  float: left;  ">
<!--            <img src="../../../../medifacil_front/imagen/odontograma/odontograma.png" width="800" height="400" usemap="#Map"/>-->
            <canvas id="canvas1"   width="800" height="400" >

            </canvas>
        </div>
        <div id="Div_Botones" style="width: 200px;height:400px; background:#aaffaa; float: left;  ">
            <input type="hidden" name="hbcolor" id="hbcolor" value="" />
            <input type="hidden" name="hicolor" id="hicolor" value="" />
            <input type="hidden" name="hdientes" id="hdientes" value="" />
            <a href="javascript:;" onclick="javascript:nuevoAgregarNuevoantecedenteOdontograma();">
                <img src="../../../../medifacil_front/imagen/btn/b_nuevo_on.gif" />
            </a>
            <a href="javascript:;" onclick="javascript:mostrarLeyenda();">
                <img src="../../../../medifacil_front/imagen/btn/b_ver_on.gif" />
            </a>
            <div id="div_foto1">
            </div>  
            <div style="border:0px solid;width: 90%;height:500px;float:left;padding:0px;">
                <div id="Div_Leyenda" style="overflow-y:scroll;width: 200px; height:375px; background-color:#006631;  ">
                </div> 
            </div>
        </div>
        <div id="divAntecedentesOdontograma" style="width: 100%;min-height:200px; background:#ccffcc; float: left;  ">
            <?php
            $arrayPreguardados = $this->aHistorialDiente($datos["codigoProgramacion"]);
            $iIdHistoriaDiente = 0;
            $iIdHistoriaDienteAux = 0;
            $contador = 0;
            foreach ($arrayPreguardados as $key => $value) {
                $iIdHistoriaDiente = $value['iIdHistoriaDiente'];
                if (isset($arrayPreguardados[$key + 1]['iIdHistoriaDiente'])) {
                    $iIdHistoriaDienteAux = $arrayPreguardados[$key + 1]['iIdHistoriaDiente'];
                } else {
                    $iIdHistoriaDienteAux = 0;
                }
                if ($value['iIdCarasDiente'] == 1) {
                    $datosPreguardado["mesial"] = 1;
                }
                if ($value['iIdCarasDiente'] == 2) {
                    $datosPreguardado["oclusal"] = 1;
                }
                if ($value['iIdCarasDiente'] == 3) {
                    $datosPreguardado["distal"] = 1;
                }
                if ($value['iIdCarasDiente'] == 4) {
                    $datosPreguardado["vestibular"] = 1;
                }
                if ($value['iIdCarasDiente'] == 5) {
                    $datosPreguardado["lingual"] = 1;
                }
                if ($value['iIdCarasDiente'] == 6) {
                    $datosPreguardado["palatino"] = 1;
                }


                if ($iIdHistoriaDiente != $iIdHistoriaDienteAux) {
                    $datosPreguardado['iIdHistoriaDiente'] = $value['iIdHistoriaDiente'];
                    $datosPreguardado['numeroAntecedenteOdontograma'] = $contador;
                    $datosPreguardado["nombreAntecedenteOdontograma"] = $value['vDescripcion'];
                    $datosPreguardado["idAntecedenteOdontograma"] = $value['iIdDiagnosticoDiente'];
                    $datosPreguardado["bTercero"] = $value['bTercero'];
                    $datosPreguardado["observacion"] = $value['observacion'];
                    $datosPreguardado["dientesAfectados"] = $value['iDientesAfectados'];
                    $datosPreguardado["iEstado"] = $value['bColor'];
                    $datosPreguardado["iColorsimbolo"] = $value['iColor'];
                    $datosPreguardado["bEsTercero"] = $value['bEsTercero'];
                    $datosPreguardado["bCaras"] = $value['bCaras'];
                   if ($datosPreguardado["dientesAfectados"] == 1) {
                        $datosPreguardado["idDiente1"] = $value['iIdDiente'];
                        $datosPreguardado["binario1"] = $value['iCodigoBinario'];
                        $datosPreguardado["idDiente2"] = '';
                        $datosPreguardado["binario2"] = '';
                    } else {
                        $datosPreguardado["idDiente1"] = $arrayPreguardados[$key - 1]['iIdDiente'];
                        $datosPreguardado["binario1"] = $arrayPreguardados[$key - 1]['iCodigoBinario'];
                        $datosPreguardado["idDiente2"] = $value['iIdDiente'];
                        $datosPreguardado["binario2"] = $value['iCodigoBinario'];
                    }

                    if ($datosPreguardado["dientesAfectados"] == 1) {
                        $arrayPosicion = $this->aPosicionSimbolo($datosPreguardado);
                        $datosPreguardado["idSimboloGrafico"] = '';
                        $datosPreguardado["px"] = '';
                        $datosPreguardado["py"] = '';
                        $datosPreguardado["ancho"] = '';
                        $datosPreguardado["alto"] = '';
                        foreach ($arrayPosicion as $fila) {
                            $datosPreguardado["idSimboloGrafico"].= $fila['iIdSimboloGraficoDiagnostico'] . '-';
                            $datosPreguardado["px"].= $fila['nPosicionX'] . '-';
                            $datosPreguardado["py"].= $fila['nPosicionY'] . '-';
                            $datosPreguardado["ancho"].= $fila['nAncho'] . '-';
                            $datosPreguardado["alto"].= $fila['nLargo'] . '-';
                        }
                    }
                    if ($datosPreguardado["dientesAfectados"] == 2) {
                        $arrayPosicion = $this->aPosicionSimboloDoble($datosPreguardado);
                        $datosPreguardado["idSimboloGrafico"] = '';
                        $datosPreguardado["px"] = '';
                        $datosPreguardado["py"] = '';
                        $datosPreguardado["ancho"] = '';
                        $datosPreguardado["alto"] = '';
                        foreach ($arrayPosicion as $fila) {
                            $datosPreguardado["idSimboloGrafico"].= $fila['iIdSimboloGraficoDiagnostico'] . '-';
                            $datosPreguardado["px"].= $fila['nPosicionX'] . '-';
                            $datosPreguardado["py"].= $fila['nPosicionY'] . '-';
                            $datosPreguardado["ancho"].= $fila['nAncho'] . '-';
                            $datosPreguardado["alto"].= $fila['nLargo'] . '-';
                        }
                    }

                    if ($value['vNombre'] != "") {
                        $datosPreguardado['urlImagen'] = $value['vNombre'];
                        $datosPreguardado['iVersion'] = $value['iVersion'];
                    }




                    $this->aAagregarAntecedenteOdontograma($datosPreguardado);
                    $contador++;

                    $datosPreguardado["mesial"] = 0;
                    $datosPreguardado["oclusal"] = 0;
                    $datosPreguardado["distal"] = 0;
                    $datosPreguardado["vestibular"] = 0;
                    $datosPreguardado["lingual"] = 0;
                    $datosPreguardado["palatino"] = 0;
                    $datosPreguardado['urlImagen'] = 0;
                    $datosPreguardado['iVersion'] = 0;
                }
            }
            ?>
            <input id="numeroAntecedentesOdontograma" type="hidden" value="<?php echo $contador; ?>" />   
        </div>


    </div>
</div>
<script>
dibujarCanvas();
</script>