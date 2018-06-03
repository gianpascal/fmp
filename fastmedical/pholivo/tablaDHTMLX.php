<?php

class tablaDHTMLX
{

    public function tablaCompleta($arrayCabecera, $arrayFilas, $idtabla, $imgpath, $width)
    {
        $columnas = count($arrayCabecera);
        $tablaCompleta = "<table id=\"" . $idtabla . "\" width=\"" . $width . "\" border=\"0\" align=\"center\" cellpadding=\"0\"  class=\"dhtmlxGrid\" gridHeight=\"auto\" imgpath=\"" . $imgpath . "\" lightnavigation=\"true\">";
        $tablaCompleta .= $this->tablaCabecera($arrayCabecera);
        $tablaCompleta .= $this->tablaFilas($arrayFilas, $columnas);
        $tablaCompleta .= "</table>";
        return $tablaCompleta;
    }

    public function tablaCabecera($arrayCabecera)
    {
        $cabeceraHTML = "<tr type=\"ro\">";
        foreach ($arrayCabecera as $i => $valor) {
            $cabeceraHTML .= "<td>" . $valor . "</td>";
        }
        $cabeceraHTML .= "</tr>";
        return $cabeceraHTML;
    }

    public function tablaFilas($arrayFilas, $columnas)
    {
        $filasHTML = "";
        foreach ($arrayFilas as $i => $valor) {
            $filasHTML .= "<tr>";
            for ($j = 0; $j < $columnas; $j++) {
                $filasHTML .= "<td>" . $arrayFilas[$i][$j] . "</td>";
            }
            $filasHTML .= "</tr>";
        }
    }

    public function stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, $posicionId, $arrayhidden = '')
    {

        $cadena = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
        $cadena .= "<rows>";
        $iniciocabecera = "<head>";
        $cuerpocabecera = "";
        $fincabecera = "</head>";
        if (empty($arrayhidden)) {
            foreach ($arrayCabecera as $ind => $valor) {
                $cuerpocabecera .= "<column width='" . $arrayTamano[$ind] . "' align='" . $arrayAlineacion[$ind] . "' type='" . $arrayTipo[$ind] . "' sort='str' color=''>" .utf8_encode($arrayCabecera[$ind]) . "</column>";
            }
        } else {
            foreach ($arrayCabecera as $ind => $valor) {
                $cuerpocabecera .= "<column width='" . $arrayTamano[$ind] . "' align='" . $arrayAlineacion[$ind] . "' hidden='" . $arrayhidden[$ind] . "' type='" . $arrayTipo[$ind] . "' sort='str' color=''>" . utf8_encode($arrayCabecera[$ind]) . "</column>";
            }
        }
        $cadena .= $iniciocabecera . $cuerpocabecera . $fincabecera;
        $columnas = count($arrayCabecera);
        $filasHTML = "";
        $indice = array_keys($arrayCabecera);
        $i = 0;
        $cadena = utf8_decode($cadena);
        foreach ($arrayFilas as $fila) {
            $filasHTML .= "<row id='" . trim($fila[$posicionId]) . "'>";
            foreach ($indice as $campo) {
                //$filasHTML.="<cell>".trim($fila[$campo])."</cell>";
                //$filasHTML.="<cell>canción del niño ñano árbol </cell>";
                $filasHTML .= "<cell>" .utf8_encode(trim($fila[$campo])) . "</cell>";
            }
//            for($j=0; $j<$columnas;$j++){
            //              $filasHTML.="<cell>".$arrayFilas[$i][$j]."</cell>";
            //            }
            $filasHTML .= "</row>";
            $i++;
        }
        $cadena .= $filasHTML;
        $cadena .= "</rows>";

        return $cadena;
    }

    public function generaTabla($arrayCabecera, $arrayFilas, $arrayTamanio, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling, $arrayColor = array())
    {
//        header("Content-type: text/xml");
        //if ($arrayColor == "") {
        if (count($arrayColor) == 0) {
            foreach ($arrayCabecera as $i => $value) {
                $arrayColor[$i] = "";
            }
        }
        $tab = "<?xml version='1.0' encoding='iso-8859-1'?>\n";
        $indice = array_keys($arrayCabecera);
        $tab .= "<rows>";
//----------inicio cabecera
        $tab .= "<head>";
        foreach ($arrayCabecera as $i => $value) {
            $tab .= "<column width='" . $arrayTamanio[$i] . "' align='" . $arrayAling[$i] . "' type='" . $arrayTipo[$i] . "' hidden='" . $arrayHidden[$i] . "' sort='str' color='" . $arrayColor[$i] . "'>";
            $tab .= $arrayCabecera[$i];
            $tab .= "</column>";
        }
        $tab .= "</head>";
        $tab = utf8_decode($tab);
//----------fin cabecera
        foreach ($arrayFilas as $i => $value) {
            $tab .= "<row id='" . $i . "'>";
            foreach ($indice as $j) {
                $tab .= "<cell style='cursor: " . $arrayCursor[$j] . "'>" . trim($value[$j]) . "</cell>";
            }
            $tab .= "</row>";
        }
        $tab .= "</rows>";
        return $tab;
    }

    /*  public function generaTablaFullCombo($arrayCabecera,$arrayFilas,$arrayTamanio,$arrayTipo,$arrayCursor,$arrayHidden,$arrayAling,$arrayCombo,$arrayColor='') {
    //        header("Content-type: text/xml");
    if($arrayColor=="") {
    foreach ($arrayCabecera as $i => $value) {
    $arrayColor[$i]="";
    }
    }
    $tab="<?xml version='1.0' encoding='iso-8859-1'?>\n";
    $indice=array_keys($arrayCabecera);
    $tab.="<rows>";
    //----------inicio cabecera
    $tab.="<head>";
    foreach ($arrayCabecera as $i => $value) {
    $tab.="<column width='".$arrayTamanio[$i]."' align='".$arrayAling[$i]."' type='".$arrayTipo[$i]."' hidden='".$arrayHidden[$i]."' sort='str' color='".$arrayColor[$i]."'>";
    $tab.=$arrayCabecera[$i];
    //            if($arrayCombo != '') {
    //                foreach ($arrayCombo as $k => $val) {
    //                    $tab.=" <option value='".$arrayCombo[$k][0]."'>".$arrayCombo[$k][1]."</option>";
    //                }
    //            }
    $tab.="</column>";

    }
    $tab.="</head>";
    $tab=utf8_decode($tab);
    //----------fin cabecera
    foreach ($arrayFilas as $i => $value) {
    $tab.="<row id='".$i."' selected='2'>";
    foreach ($indice as $j) {
    $tab.="<cell  xmlcontent='".$j."'>";
    if($arrayCombo != '') {
    $tab.="<complete>";
    foreach ($arrayCombo as $k => $val) {
    $tab.=" <option value='".$k."'>".$arrayCombo[$k][1]."</option>";
    }
    }
    $tab.="</complete></cell>";
    //                <complete>
    //                <option value="1">one</option>
    //                <option value="2">two</option>
    //                <option value="3">three</option>
    //                <option value="4">four</option>
    //                <option value="5">five</option>
    //                <option value="6">six</option>
    //                <option value="7">seven</option>
    //                <option value="8">eight</option>
    //                <option value="9">nine</option>
    //                <option value="10">ten</option>
    //            </complete>
    }
    $tab.="</row>";
    }
    $tab.="</rows>";
    return $tab;

    } */

    public function generaTablaFullCombo($arrayCabecera, $arrayFilas, $arrayTamanio, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling, $arrayCombo, $arrayColor = '')
    {
//        header("Content-type: text/xml");
        if ($arrayColor == "") {
            foreach ($arrayCabecera as $i => $value) {
                $arrayColor[$i] = "";
            }
        }

        $tab = "<?xml version='1.0' encoding='iso-8859-1'?>\n";
        $indice = array_keys($arrayCabecera);
        $tab .= "<rows>";
//----------inicio cabecera
        $tab .= "<head>";
        foreach ($arrayCabecera as $i => $value) {
            $tab .= "<column width='" . $arrayTamanio[$i] . "' align='" . $arrayAling[$i] . "' type='" . $arrayTipo[$i] . "' hidden='" . $arrayHidden[$i] . "' color='" . $arrayColor[$i] . "'>";
            $tab .= $arrayCabecera[$i];
            if ($arrayCombo != '') {
                foreach ($arrayCombo as $k => $val) {
                    $tab .= " <option value='" . $arrayCombo[$k][0] . "'>" . $arrayCombo[$k][1] . "</option>";
                }
            }
            $tab .= "</column>";
        }
        $tab .= "</head>";
        $tab = utf8_decode($tab);
//----------fin cabecera
        foreach ($arrayFilas as $i => $value) {
            $tab .= "<row id='" . $i . "'>";
            foreach ($indice as $j) {
                $tab .= "<cell style='cursor: " . $arrayCursor[$j] . "' >" . trim($value[$j]) . "</cell>";
            }
            $tab .= "</row>";
        }
        $tab .= "</rows>";
        return $tab;
    }

    public function generaTablaFullComboCartetizacion($arrayCabecera, $arrayFilas, $arrayTamanio, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling, $arrayCombo, $arrayColor = '', $columnaCombo, $columnaCombo1, $cboProcedencia)
    {

//        header("Content-type: text/xml");
        if ($arrayColor == "") {
            foreach ($arrayCabecera as $i => $value) {
                $arrayColor[$i] = "";
            }
        }

        $tab = "<?xml version='1.0' encoding='iso-8859-1'?>\n";
        $indice = array_keys($arrayCabecera);
        $tab .= "<rows>";
//----------inicio cabecera
        $tab .= "<head>";
        foreach ($arrayCabecera as $i => $value) {
            $tab .= "<column width='" . $arrayTamanio[$i] . "' align='" . $arrayAling[$i] . "' type='" . $arrayTipo[$i] . "' hidden='" . $arrayHidden[$i] . "' color='" . $arrayColor[$i] . "'>";
            $tab .= $arrayCabecera[$i];

            if ($arrayCombo != '' && $i == $columnaCombo) {
                foreach ($arrayCombo as $k => $val) {
                    $tab .= " <option value='" . $arrayCombo[$k][0] . "'>" . $arrayCombo[$k][1] . "</option>";
                }
            }
            if ($cboProcedencia != '' && $i == $columnaCombo1) {
                foreach ($cboProcedencia as $m => $val) {
                    $tab .= " <option value='" . $cboProcedencia[$m][0] . "'>" . $cboProcedencia[$m][1] . "</option>";
                }
            }

            $tab .= "</column>";
        }
        $tab .= "</head>";
        $tab = utf8_decode($tab);
//----------fin cabecera
        foreach ($arrayFilas as $i => $value) {
            $tab .= "<row id='" . $i . "'>";
            foreach ($indice as $j) {

                $tab .= "<cell style='cursor: " . $arrayCursor[$j] . "' >" . trim($value[$j]);
                $tab .= "</cell>";
            }
            $tab .= "</row>";
        }
        $tab .= "</rows>";
        return $tab;
    }

    public function generaArbol($resultado)
    {
        //header("Content-type:text/xml"); --colocar esta linea en la página que se va inprimir (echo)
        //        $tam=count($resultado);
        //        $cadena="";
        //        if($tam>0){
        $cadena = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
        $cadena .= "\n<tree id='0' radio='1' >\n";
        $codAnterior = '';
        $contador = 0;
        $nivel;
        foreach ($resultado as $rs => $valor) {
            if ($codAnterior == '') {
                $cadena .= "<item text='" . trim($resultado[$rs]["titulo"]) . "' open='1' id='" . trim($resultado[$rs]["id"]) . "'>\n";
                $codAnterior = strlen(trim($resultado[$rs]["jerarquia"])); //2
                $contador = $contador + 1; //1
                $nivelAnterior = $resultado[$rs]["nivel"];
            } else {
                //verificar si el anterior era de mas nivel
                if ($codAnterior < strlen(trim($resultado[$rs]["jerarquia"]))) {
                    $cadena .= "<item text='" . trim($resultado[$rs]["titulo"]) . "' open='1' id='" . trim($resultado[$rs]["id"]) . "'>\n";
                    $codAnterior = strlen(trim($resultado[$rs]["jerarquia"]));
                    $nivelAnterior = $resultado[$rs]["nivel"];
                    $contador = $contador + 1; //2
                } else {
                    if ($codAnterior > strlen(trim($resultado[$rs]["jerarquia"]))) {
                        $numCierre = $nivelAnterior - $resultado[$rs]["nivel"] + 1;
                        $contador = $contador - $numCierre + 1;

                        while ($numCierre > 0) {
                            $cadena .= "</item>";
                            $numCierre = $numCierre - 1;
                        }
                    } else {
                        $cadena .= "</item>";
                    }

                    $cadena .= "<item text='" . trim($resultado[$rs]["titulo"]) . "' open='1' id='" . trim($resultado[$rs]["id"]) . "'>\n";
                    $codAnterior = strlen(trim($resultado[$rs]["jerarquia"])); //guardo la longitud de su codjerarquico
                }
            }
        } //fin del foreach

        for ($i = 0; $i < $contador; $i++) {
            $cadena .= "</item>\n";
        }
        $cadena .= "\n</tree>";
//        }

        return $cadena;
    }

    public function generarCombo($arrayDatos)
    {
//        header("Content-type:text/xml");
        $combo = "";
        $combo .= "<?xml version=\"1.0\"?>";
        $combo .= "<complete>";
        $combo .= '<option value="" selected="1"> - Seleccionar - </option>';
        foreach ($arrayDatos as $i => $value) {
            $combo .= '<option value="' . $arrayDatos[$i][0] . '">' . $arrayDatos[$i][1] . '</option>';
        }
        $combo .= "</complete>";
        return $combo;
    }

}

class TableLudjcmon
{

    public function tablaTurnos($idTable, $arrayCabecera, $arrayDatos, $tamanio, $arrayDisabled)
    {
        $tabla = "<table id='" . $idTable . "' border='1'>";
        /* +----------------------------  cabecera   ------------------------------+ */
        $tabla .= "<thead><tr>";
        foreach ($arrayCabecera as $i => $value) {
            $tabla .= "<th>" . $value . "</th>";
        }
        $tabla .= "</tr></thead>";
        /* +----------------------------  cuerpo    ------------------------------+ */
        if (is_array($arrayDatos)) {
            $tabla .= "<tbody>";
            foreach ($arrayDatos as $i => $valuex) {
                $tabla .= "<tr>";
                foreach ($valuex as $j => $value) {
                    $datos = explode("|", $value);
                    $tabla .= "<td>";
                    if (count($datos) == 1) {
                        $tabla .= "<input id='" . $idTable . "_text[" . $i . "][" . $j . "]' name='" . $idTable . "_text[" . $i . "][" . $j . "]' type='text' value='" . $datos[1] . "'  " . $arrayDisabled[$j] . " size='" . $tamanio[$j] . "' class='lbl1' style='text-transform:uppercase;' onchange=\"ludjcmonOnchange('" . $idTable . "'," . $i . "," . $j . ")\">";
                    } else if (count($datos) == 2) {
                        $tabla .= "<input id='" . $idTable . "_text[" . $i . "][" . $j . "]' name='" . $idTable . "_text[" . $i . "][" . $j . "]' type='text' value='" . $datos[1] . "'  " . $arrayDisabled[$j] . " size='" . $tamanio[$j] . "' class='lbl1' style='text-transform:uppercase;' onchange=\"ludjcmonOnchange('" . $idTable . "'," . $i . "," . $j . ")\">";
                        $tabla .= "<input id='" . $idTable . "_id[" . $i . "][" . $j . "]' name='" . $idTable . "_id[" . $i . "][" . $j . "]' type='hidden' size='5' value='" . $datos[0] . "'>";
                    } else if (count($datos) == 4) {
                        $tabla .= "<input id='" . $idTable . "_text[" . $i . "][" . $j . "]' name='" . $idTable . "_text[" . $i . "][" . $j . "]' type='text' value='" . $datos[1] . "' " . $arrayDisabled[$j] . "  size='" . $tamanio[$j] . "' class='lbl1' style='text-transform:uppercase;' onchange=\"ludjcmonOnchange('" . $idTable . "'," . $i . "," . $j . ")\">";
                        $tabla .= "<input id='" . $idTable . "_id[" . $i . "][" . $j . "]' name='" . $idTable . "_id[" . $i . "][" . $j . "]' type='hidden' size='5' value='" . $datos[0] . "'>";
                        $tabla .= "<input id='" . $idTable . "_horas[" . $i . "][" . $j . "]' name='" . $idTable . "_horas[" . $i . "][" . $j . "]' type='hidden' size='5' value='" . $datos[2] . "'>";
                        $tabla .= "<input id='" . $idTable . "_IdProgramacion[" . $i . "][" . $j . "]' name='" . $idTable . "_IdProgramacion[" . $i . "][" . $j . "]' type='hidden' size='5' value='" . $datos[3] . "'>";
                    }
                    $tabla .= "</td>";
                }
                $tabla .= "</tr>";
            }
            $tabla .= "</tbody>";
        }
        $tabla .= "</table>";
        return $tabla;
    }

}
