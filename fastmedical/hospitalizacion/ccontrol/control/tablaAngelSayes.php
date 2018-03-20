<style>
    .contenedorTabla{
        border-top:0px inset #BABAB9 ;
    }

    .imagenhref:hover{
        transform: rotate(0deg) scale(1.559) skew(0deg) translate(0px);
        -webkit-transform: rotate(0deg) scale(1.559) skew(0deg) translate(0px);
        -moz-transform: rotate(0deg) scale(1.559) skew(0deg) translate(0px);
        -o-transform: rotate(0deg) scale(1.559) skew(0deg) translate(0px);
        -ms-transform: rotate(0deg) scale(1.559) skew(0deg) translate(0px);

    }

    .tdCabecera{
        color:black;
        font-size: 12px;
        height: 25px;
        text-align: center;
        border-top:0px inset #BABAB9;
        border-right:1px inset #BABAB9;
        border-bottom:1px inset #BABAB9;
        border-left:0px inset #BABAB9;
        font-weight: bold;
    }
    .td{
        border-top:0px inset #BABAB9;
        border-right:1px inset black;
        border-bottom:1px inset black;
        border-left:0px inset #BABAB9;
        font-size: 12px;
        font-family: verdana;
    }

    .tablaTitulo{
        background: #b4e391; /* Old browsers */
        background: -moz-linear-gradient(top,  #b4e391 0%, #61c419 100%, #b4e391 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#b4e391), color-stop(100%,#61c419), color-stop(100%,#b4e391)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  #b4e391 0%,#61c419 100%,#b4e391 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  #b4e391 0%,#61c419 100%,#b4e391 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  #b4e391 0%,#61c419 100%,#b4e391 100%); /* IE10+ */
        background: linear-gradient(to bottom,  #b4e391 0%,#61c419 100%,#b4e391 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b4e391', endColorstr='#b4e391',GradientType=0 ); /* IE6-9 */

        color:white;
        text-align: center;
        font-family: verdana;
    }

    .filaTablaMaestra1:hover , .filaTablaMaestra2:hover{
        background: #e6f0a3; /* Old browsers */
background: -moz-linear-gradient(top, #e6f0a3 0%, #d2e638 50%, #c3d825 51%, #dbf043 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#e6f0a3), color-stop(50%,#d2e638), color-stop(51%,#c3d825), color-stop(100%,#dbf043)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #e6f0a3 0%,#d2e638 50%,#c3d825 51%,#dbf043 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #e6f0a3 0%,#d2e638 50%,#c3d825 51%,#dbf043 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #e6f0a3 0%,#d2e638 50%,#c3d825 51%,#dbf043 100%); /* IE10+ */
background: linear-gradient(to bottom, #e6f0a3 0%,#d2e638 50%,#c3d825 51%,#dbf043 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e6f0a3', endColorstr='#dbf043',GradientType=0 ); /* IE6-9 */
        color:black;
        font-family: verdana;
        font-size: 8px;
    }
    
    .filaTablaMaestra1:active ,.filaTablaMaestra2:active {
  
        color:white;
    }
    
    .filaTablaMaestra1 {
         background-color: #BBE796;
    }
.filaTablaMaestra1:focus {
         background-color:red;
    }

</style>
<?php

class TablaAngelSayes {

    public function __construct() {
        
    }

    function contructorTabla($scroll,$numDatosEnviadosFuncionCadena, $arrayFunctionXCelda, $arrayTitle, $arrayFunction, $arrayImagenPorCelda, $arrayUrlImagen, $array, $arrayWidth, $arrayTitulos, $arrayAlign, $arrayType, $arrayCursor, $height) {
        if (count($array) == 0) {
            $contadorColumns = count($arrayWidth);
            $countWidth = count($arrayWidth);
            $widthTitulo = 0;
            for ($cont = 0; $cont <= $countWidth - 1; $cont++) {
                $widthTitulo = $widthTitulo + $arrayWidth[$cont];
            }
            ?>

            <table  class="tablaTitulo"cellspacing="0"  width="<?php echo $widthTitulo; ?>">
                <?php
                for ($x = 0; $x <= ($contadorColumns - 1) / $contadorColumns; $x++) {
                    $contadorRows = count($arrayWidth);
                    for ($y = 0; $y <= ($contadorRows - 1) / $contadorRows; $y++) {
                        ?>
                        <tr>
                            <?php
                            for ($z = 0; $z <= $countWidth - 1; $z++) {
                                ?>
                                <td class="tdCabecera"width="<?php echo $arrayWidth[$z] ?>"><?php echo $arrayTitulos[$z] ?></td>
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

            <table  class="tablaTitulo"cellspacing="0"  width="<?php echo $widthTitulo; ?>">
                <?php
                for ($x = 0; $x <= ($contadorColumns - 1) / $contadorColumns; $x++) {
                    $contadorRows = count($array[$x]);
                    for ($y = 0; $y <= ($contadorRows - 1) / $contadorRows; $y++) {
                        ?>
                        <tr>
                            <?php
                            for ($z = 0; $z <= $countWidth - 1; $z++) {
                                ?>
                                <td class="tdCabecera"width="<?php echo $arrayWidth[$z] ?>"><?php echo $arrayTitulos[$z] ?></td>
                            <?php } ?>
                            <td width="16"  class="tdCabecera"></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>





            <div class="contenedorTabla" style="width:<?php echo $widthTitulo; ?>px;height:<?php echo $height; ?>px; <?php  if ($scroll ==1){echo 'overflow-y:none;'; }else {echo 'overflow-y:scroll;';}?>">
                <table  class="tablaMaestra" cellspacing="0">
                    <?php
                    for ($y = 0; $y <= ($contadorColumns - 1); $y++) {
                        $contadorRows = count($array);
                        if ($y % 2 == 0) {
                            $class = "filaTablaMaestra2";
                        } else {
                            $class = "filaTablaMaestra1";
                        }
                        ?>
                        <tr class="<?php echo $class;?>" >
                            <?php
                            for ($z = 0; $z <= $countWidth - 1; $z++) {
                                if ($numDatosEnviadosFuncionCadena == 1) {
                                    $cadenaEnviar ="'".$array[$y][0]."','" . $array[$y][1] . "'";
                                } else if ($numDatosEnviadosFuncionCadena == 0) {
                                    $cadenaEnviar = $array[$y][0];
                                }
                                ?>
                                <td   onclick="<?php echo $arrayFunctionXCelda[$z]; ?>(<?php echo $cadenaEnviar; ?>)"align="<?php echo $arrayAlign[$z]; ?>" height="22" class="td" width="<?php echo $arrayWidth[$z] ?>" style="cursor:<?php echo $arrayCursor[$z]; ?>">


                                    <?php ?>
                                    <?php
                                    if ($arrayType[$z] == "text") {
                                        if ($arrayWidth[$z] > 100) {
                                            $tananioCadena = ($arrayWidth[$z] / 10)+5;
                                            if (strlen($array[$y][$z]) > $tananioCadena) {
                                                for ($anchito = 0; $anchito <= $tananioCadena; $anchito++) {
                                                    if ($anchito < $tananioCadena) {
                                                        echo utf8_encode($array[$y][$z][$anchito]);
                                                    } else {
                                                        echo utf8_encode($array[$y][$z][$anchito]) . "...";
                                                    }
                                                }
                                            }
                                            else {
                                                echo utf8_encode($array[$y][$z]);
                                            }
                                        } else {
                                            echo utf8_encode($array[$y][$z]);
                                        }
                                    } else if ($arrayType[$z] == "img") {
                                        echo '<img src="' . $array[$y][$z] . '">';
                                    } else if ($arrayType[$z] == "bit") {
                                        if ($array[$y][$z] == 1) {
                                            echo '<input type="checkbox" checked  onClick="' . $arrayFunction[$z] . '(' . $cadenaEnviar . ')"  title="' . $arrayTitle[$z] . '"/>';
                                        } else {
                                            echo '<input type="checkbox" onClick="' . $arrayFunction[$z] . '(' . $cadenaEnviar . ')"  title="' . $arrayTitle[$z] . '"/>';
                                        }
                                    }
                                    if ($arrayImagenPorCelda[$z] == 1) {
                                        echo '&numsp;&numsp;<img onclick="' . $arrayFunction[$z] . '(' . $cadenaEnviar . ')" title="' . $arrayTitle[$z] . '" style="cursor:pointer" class="imagenhref" align="center" src="' . $arrayUrlImagen[$z] . '" width="15">&numsp;';
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
    }

}
?>