<?php

class TablaAngelSayes {

    public function __construct() {
        
    }

    function contructorTabla($idNameContenedorSecundario, $BusquedaBit, $arrayEtiquedaId, $arrayFuncionesObjetosBusqueda, $ResultadoBusqueda, $arrayFuncionesDatosCombo, $arrayBitBusqueda, $arrayTypeBusqueda, $numDatosEnviadosFuncionCadena, $arrayFunctionXCelda, $arrayTitle, $arrayFunction, $arrayImagenPorCelda, $arrayUrlImagen, $array, $arrayWidth, $arrayTitulos, $arrayAlign, $arrayType, $arrayCursor, $height) {



        if ($ResultadoBusqueda == 0) {
            $contadorColumns = count($arrayWidth);
            $countWidth = count($arrayWidth);
            $widthTitulo = 0;
            if (count($array) == 0) {
                for ($cont = 0; $cont <= $countWidth - 1; $cont++) {
                    $widthTitulo = $widthTitulo + $arrayWidth[$cont];
                }
                ?>


                <table  class="tablaTitulo"cellspacing="0"  width="<?php echo $widthTitulo;
                ?>">
                            <?php
                            for ($x = 0; $x <= ($contadorColumns - 1) / $contadorColumns; $x++) {
                                $contadorRows = count($arrayWidth);
                                for ($y = 0; $y <= ($contadorRows - 1) / $contadorRows; $y++) {
                                    ?>
                            <tr>
                                <?php
                                for ($z = 0; $z <= $countWidth - 1; $z++) {
                                    ?>
                                    <td class="tdCabecera"width="<?php echo $arrayWidth[$z] ?>"><?php
                                        echo
                                        $arrayTitulos[$z]
                                        ?></td>
                                <?php } ?>
                                <td width="16"   class="tdCabecera"></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>

                <?php
            } else {
                $contadorColumns = count($array);

                $countWidth = count($arrayWidth);
                $widthTitulo = 0;
                for ($cont = 0; $cont <= $countWidth - 1; $cont++) {
                    $widthTitulo = $widthTitulo + $arrayWidth[$cont];
                }
                ?>

                <table  class="tablaTitulo"cellspacing="0"  width="<?php echo $widthTitulo;
                ?>">
                            <?php
                            for ($x = 0; $x <= ($contadorColumns - 1) / $contadorColumns; $x++) {
                                $contadorRows = count($array[$x]);
                                for ($y = 0; $y <= ($contadorRows - 1) / $contadorRows; $y++) {
                                    ?>
                            <tr>
                                <?php
                                for ($z = 0; $z <= $countWidth - 1; $z++) {
                                    ?>
                                    <td class="tdCabecera"width="<?php echo $arrayWidth[$z] ?>"><?php
                                        echo
                                        $arrayTitulos[$z]
                                        ?></td>
                                <?php } ?>
                                <td width="16"   class="tdCabecera"></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
                <?php if ($BusquedaBit == 1) { ?>
                    <table   cellspacing="0"  width="<?php echo $widthTitulo;
                    ?>">
                                 <?php
                                 for ($x = 0; $x <= ($contadorColumns - 1) / $contadorColumns; $x++) {
                                     $contadorRows = count($arrayWidth);
                                     for ($y = 0; $y <= ($contadorRows - 1) / $contadorRows; $y++) {
                                         ?>
                                <tr>
                                    <?php
                                    for ($z = 0; $z <= $countWidth - 1; $z++) {
                                        ?>
                                        <td  valign="middle" align="center" class="tdCabeceraBusqueda" width="<?php echo $arrayWidth[$z] ?>">
                                            <?php
                                            if ($arrayBitBusqueda[$z] == 1) {
                                                // $cadena='';
                                                switch ($arrayTypeBusqueda[$z]) {
                                                    case 'text':
                                                        echo '<input id="' . $arrayEtiquedaId[$z] . '"  onkeyPress="' . $arrayFuncionesObjetosBusqueda[$z] . '(event);" class="inputBusquedaTabla" type="text" style="width:' . ($arrayWidth[$z] - 35) . 'px;">';
                                                        break;
                                                    case 'combo':
                                                        require_once('Action/Action.php');
                                                        $Action = new CapaAction();
                                                        eval('echo  $resultado = $Action->$arrayFuncionesDatosCombo[$z]($arrayFuncionesObjetosBusqueda[$z],"$arrayEtiquedaId[$z]");');
                                                        break;
                                                    case 'bit':
                                                        echo '<input id="' . $arrayEtiquedaId[$z] . '" type="checkbox" onChange="' . $arrayFuncionesObjetosBusqueda[$z] . '();">';
                                                        break;
                                                }
                                            } else {
                                                
                                            }
                                            ?>
                                        </td>
                                    <?php } ?>
                                    <td width="16"   style="background-color:#F0F0F0;" class="tdCabeceraBusqueda"></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                <?php } ?>



                <div id="<?php echo $idNameContenedorSecundario; ?>" class="contenedorTabla" style="width:<?php echo $widthTitulo;
                ?>px;height:<?php echo $height; ?>px;">
                    <table  class="tablaMaestra" cellspacing="0">
                        <?php
                        $contadorRows = count($array);
                        for ($y = 0; $y <= ($contadorColumns - 1); $y++) {
                                $class = "filaTablaMaestra";
                            ?>
                            <tr valign="middle" class="<?php echo $class; ?>" >
                                <?php
                                for ($z = 0; $z <= $countWidth - 1; $z++) {
                                    if ($numDatosEnviadosFuncionCadena == 1) {
                                        $cadenaEnviar = "'" . $array[$y][0] . "','" . $array[$y][1] . "'";
                                    } else if ($numDatosEnviadosFuncionCadena == 0) {
                                        $cadenaEnviar = $array[$y][0];
                                    }
                                    else if ($numDatosEnviadosFuncionCadena == 2){
                                             $cadenaEnviar = "'" . $array[$y][0] . "','" . $array[$y][1] . "','" . $array[$y][2] . "'";
                                    }
                                    ?>
                                    <td   onclick="<?php echo $arrayFunctionXCelda[$z]; ?>(<?php
                                    echo
                                    $cadenaEnviar;
                                    ?>)"align="<?php echo $arrayAlign[$z]; ?>" height="22" 
                                          class="td" width="<?php echo $arrayWidth[$z] ?>" style="cursor:<?php
                                          echo
                                          $arrayCursor[$z];
                                          ?>">


                                        <?php ?>
                                        <?php
                                        if ($arrayType[$z] == "text") {
                                            if ($arrayWidth[$z] > 100) {
                                                $tananioCadena = ($arrayWidth[$z] / 10) + 5;
                                                if (strlen($array[$y][$z]) > $tananioCadena) {
                                                    for ($anchito = 0; $anchito <= $tananioCadena; $anchito++) {
                                                        if ($anchito < $tananioCadena) {
                                                            echo utf8_encode($array[$y][$z][$anchito]);
                                                        } else {
                                                            echo utf8_encode($array[$y][$z][$anchito]) . "...";
                                                        }
                                                    }
                                                } else {
                                                    echo utf8_encode($array[$y][$z]);
                                                }
                                            } else {
                                                echo utf8_encode($array[$y][$z]);
                                            }
                                        } else if ($arrayType[$z] == "img") {
                                            echo '<img width="25" class="imagenhref" src="' . $array[$y][$z] . '">';
                                        } else if ($arrayType[$z] == "bit") {
                                            if ($array[$y][$z] == 1) {
                                                echo '<input type="checkbox" checked  onClick="' . $arrayFunction[$z] . '('
                                                . $cadenaEnviar . ')"  title="' . $arrayTitle[$z] . '"/>';
                                            } else {
                                                echo '<input type="checkbox" onClick="' . $arrayFunction[$z] . '(' .
                                                $cadenaEnviar . ')"  title="' . $arrayTitle[$z] . '"/>';
                                            }
                                        }
                                        if ($arrayImagenPorCelda[$z] == 1) {
                                            echo '  <img onclick="' . $arrayFunction[$z] . '(' .
                                            $cadenaEnviar . ')" title="' . $arrayTitle[$z] . '" style="cursor:pointer"
class="imagenhref" align="right" src="' . $arrayUrlImagen[$z] . '"
width="25"> ';
                                        }
                                        ?>

                                        <?php ?>
                                    </td>
                                <?php } ?>
                            </tr>
                            <?php
                        }
                        ?>

                    </table>
                </div>       
                <?php
            }
        } else {

            $contadorColumns = count($array);
            $countWidth = count($arrayWidth);
            $widthTitulo = 0;
            if ($contadorColumns > 0) {
                ?>
                <table  class="tablaMaestra" cellspacing="0">
                    <?php
                    //print_r($contadorColumns);

                    for ($y = 0; $y <= ($contadorColumns - 1); $y++) {
                        $contadorRows = count($array);
                        $class = "filaTablaMaestra";
                        ?>
                        <tr class="<?php echo $class; ?>" >
                            <?php
                            for ($z = 0; $z <= $countWidth - 1; $z++) {
                                // print_r($countWidth);
                                //print_r($array);
                                if ($numDatosEnviadosFuncionCadena == 1) {
                                    $cadenaEnviar = "'" . $array[$y][0] . "','" . $array[$y][1] . "'";
                                } else if ($numDatosEnviadosFuncionCadena == 0) {
                                    $cadenaEnviar = $array[$y][0];
                                }
                                
                                    else if ($numDatosEnviadosFuncionCadena == 2){
                                             $cadenaEnviar = "'" . $array[$y][0] . "','" . $array[$y][1] . "','" . $array[$y][2] . "'";
                                    }
                                ?>
                                <td   onclick="<?php echo $arrayFunctionXCelda[$z]; ?>(<?php
                                echo
                                $cadenaEnviar;
                                ?>)"align="<?php echo $arrayAlign[$z]; ?>" height="22" valign="middle"
                                      class="td" width="<?php echo $arrayWidth[$z] ?>" style="cursor:<?php
                                      echo
                                      $arrayCursor[$z];
                                      ?>">


                        <?php ?>
                                    <?php
                                    if ($arrayType[$z] == "text") {
                                        if ($arrayWidth[$z] > 100) {
                                            $tananioCadena = ($arrayWidth[$z] / 10) + 5;
                                            if (strlen($array[$y][$z]) > $tananioCadena) {
                                                for ($anchito = 0; $anchito <= $tananioCadena; $anchito++) {
                                                    if ($anchito < $tananioCadena) {
                                                        echo utf8_encode($array[$y][$z][$anchito]);
                                                    } else {
                                                        echo utf8_encode($array[$y][$z][$anchito]) . "...";
                                                    }
                                                }
                                            } else {
                                                echo utf8_encode($array[$y][$z]);
                                            }
                                        } else {
                                            echo utf8_encode($array[$y][$z]);
                                        }
                                    } else if ($arrayType[$z] == "img") {
                                        echo '<img width="25" class="imagenhref" src="' . $array[$y][$z] . '">';
                                    } else if ($arrayType[$z] == "bit") {
                                        if ($array[$y][$z] == 1) {
                                            echo '<input type="checkbox" checked  onClick="' . $arrayFunction[$z] . '('
                                            . $cadenaEnviar . ')"  title="' . $arrayTitle[$z] . '"/>';
                                        } else {
                                            echo '<input type="checkbox" onClick="' . $arrayFunction[$z] . '(' .
                                            $cadenaEnviar . ')"  title="' . $arrayTitle[$z] . '"/>';
                                        }
                                    }
                                    if ($arrayImagenPorCelda[$z] == 1) {
                                        echo '  <img onclick="' . $arrayFunction[$z] . '(' .
                                        $cadenaEnviar . ')" title="' . $arrayTitle[$z] . '" style="cursor:pointer"
class="imagenhref" align="right" src="' . $arrayUrlImagen[$z] . '"
width="25"> ';
                                    }
                                    ?>

                                    <?php ?>
                                </td>
                                <?php } ?>
                        </tr>
                            <?php
                        }
                        ?>

                </table>
                <?php
            }
        }
    }

}
?>