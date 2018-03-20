<!doctype html>
<html>
    <head>
        <style>
            .btnGenerarReporteEssalud{
                height: 60px;
                border:1px solid #087F37;
                cursor: pointer;
                background-color: #087F37;
                color:white;
                font-weight: bold;
                font-family: verdana;
                font-size: 14px;
                padding:34px 6px 0px 6px;
            }
            .btnGenerarReporteEssalud:hover{
                background-color: #8AB8CA;  

            }
            .labelReporteEs{
                font-weight: bold;
                font-family: verdana;
                font-size: 14px;
            }
            .txtInputFecha{
                border:1px solid mediumaquamarine;
                height: 35px;
                font-family: verdana;
                font-size: 26px;
            }
            .divArchivo{
                float:left;
                border:1px solid white;
                width:183px;
                height: 55px;
                margin:5px 5px 5px 5px;
                padding-right: 5px;
                padding-top: 5px;
            }
            .divArchivo:hover ,nombreArchivo:hover{
                background-color: #F5F5F5;
                border:1px dashed silver;
                cursor:pointer;
            }
            .divArchivo:active ,nombreArchivo:active{
                background-color: #E0D9D9;
                border:1px dashed silver;
                cursor:pointer;
            }
        </style>
        <?php

        function formato_tam($size, $precision = 0) {
            $sizes = array('Tb', 'Gb', 'Mb', 'Kb', 'bytes');
            $total = count($sizes);
            while ($total-- && $size > 1024)
                $size /= 1024;
            return round($size, $precision) . " " . $sizes[$total];
        }
        ?>
    <br>
    <table border="0"style="margin-left: 50px;">
        <tr>
            <td rowspan="2" width="100">

            </td>
            <td rowspan="2" width="300">
                <table>
                    <tr>
                        <td>
                            <label class="labelReporteEs">Año:</label> 
                        </td>
                        <td>
                            <?php
                            $mes = intVal(date("m")) - 1;
                            $anio = intVal(date("Y"));
                            $bExiste = 0;
                            $bExisteMes = 0;
                            switch ($mes) {
                                case 1:
                                    $mesCadeba = "Enero";
                                    break;
                                case 2:
                                    $mesCadeba = "Febrero";
                                    break;
                                case 3:
                                    $mesCadeba = "Marzo";
                                    break;
                                case 4:
                                    $mesCadeba = "Abril";
                                    break;
                                case 5:
                                    $mesCadeba = "Mayo";
                                    break;
                                case 6:
                                    $mesCadeba = "Junio";
                                    break;
                                case 7:
                                    $mesCadeba = "Julio";
                                    break;
                                case 8:
                                    $mesCadeba = "Agosto";
                                    break;
                                case 9:
                                    $mesCadeba = "Setiembre";
                                    break;
                                case 10:
                                    $mesCadeba = "Octubre";
                                    break;
                                case 11;
                                    $mesCadeba = "Noviembre";
                                    break;
                                case 12:
                                    $mesCadeba = "Diciembre";
                                    break;
                            }
                            $directorio = "../../../../carpetaDocumentos/reportesEssalud/";
                            if (file_exists(($directorio))) {
                                $bExiste = 1;
                                $directorio = opendir(($directorio));
                                echo "<select onChange='verificarSubCarpetas(this.value);' id='cbxAnio' style='height:35px;width:100%;border:1px solid mediumaquamarine;font-family: verdana;font-size: 26px'>";
                                echo "<option value='1'>Seleccionar...</option>";
                                while ($archivo = readdir($directorio)) {
                                    if (is_dir($archivo)) {
                                        
                                    } else {
                                        if ($archivo == $anio) {
                                            $selectedAni = "selected";
                                        } else {
                                            $selectedAni = "";
                                        }
                                        echo "<option " . $selectedAni . " value='" . $archivo . "'>" . $archivo . "</option>";
                                    }
                                }
                                echo "</select>";
                                closedir($directorio);
                            } else {
                                $bExiste = 0;
                                echo "<select onChange='verificarSubCarpetas(this.value);' id='cbxAnio' style='height:35px;width:100%;border:1px solid mediumaquamarine;font-family: verdana;font-size: 26px'>";
                                echo "<option value='1'>Seleccionar...</option>";
                                echo "</select>";
                            }
                            ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="labelReporteEs">Mes:</label> 
                        </td>
                        <td id="contenedorComboMes">
                            <?php
                            if ($bExiste == 1) {
                                $directorio = "../../../../carpetaDocumentos/reportesEssalud/" . $anio;
                                if (file_exists(($directorio))) {
                                    $bExisteMes = 1;
                                    $directorio = opendir(($directorio));
                                    echo "<select onChange='verificarExistenciaCarpeta(this.value);' id='cbxMes' style='height:35px;width:100%;border:1px solid mediumaquamarine;font-family: verdana;font-size: 26px'>";
                                    echo "<option value='1'>Seleccionar...</option>";
                                    while ($archivo = readdir($directorio)) {
                                        if (is_dir($archivo)) {
                                            
                                        } else {
                                            if ($archivo == $mesCadeba) {
                                                $selectedAni = "selected";
                                            } else {
                                                $selectedAni = "";
                                            }
                                            echo "<option " . $selectedAni . " value='" . $archivo . "'>" . $archivo . "</option>";
                                        }
                                    }
                                    echo "</select>";
                                    closedir($directorio);
                                } else {
                                    $bExisteMes = 0;
                                    echo "<select onChange='verificarExistenciaCarpeta(this.value);' id='cbxMes' style='height:35px;width:100%;border:1px solid mediumaquamarine;font-family: verdana;font-size: 26px'>";
                                    echo "<option value='1'>Seleccionar...</option>";
                                    echo "</select>";
                                }
                            } else {
                                $bExisteMes = 0;
                                echo "<select onChange='verificarExistenciaCarpeta(this.value);'  id='cbxMes' style='height:35px;width:100%;border:1px solid mediumaquamarine;font-family: verdana;font-size: 26px'>";
                                echo "<option value='1'>Seleccionar...</option>";
                                echo "</select>";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <div id="contenedorDirectorioMamografia" style="margin-left:10px;border:1px solid green;width: 98%;height: 400px;">
        <div style="overflow-y:auto;width:100%;height:100%;">
            <div style="border:0px solid;width: 1000px;height: 80%;overflow-y: auto;">
                <?php
                $bExisteCarpetaMamografia = 0;
                if ($bExiste == 1 && $bExisteMes == 1) {
                    $directorio = "../../../../carpetaDocumentos/reportesEssalud/" . $anio . "/" . $mesCadeba . "/";
                    if (file_exists(($directorio))) {
                        $bExisteCarpetaMamografia = 1;
                        $dircadena = $directorio;
                        $directorio = opendir(($directorio));
                        while ($archivo = readdir($directorio)) {
                            if (is_dir($archivo)) {
                                
                            } else {
                                $carpeta = explode("_", $archivo);
                                if ($carpeta[0] == $datos['p1']) {
                                    $directorioFinal = $dircadena . $archivo . "/";
                                    $raiz = $directorioFinal;
                                    if (file_exists(($directorioFinal))) {
                                        $directorioFinal = opendir(($directorioFinal));
                                        while ($archivoFinal = readdir($directorioFinal)) {
                                            if (is_dir($archivoFinal)) {
                                                
                                            } else {
                                                $formatoArchivo = explode(".", $archivoFinal);
                                                ?>
                                                <a target="_new" href="<?php echo $raiz . $archivoFinal; ?>"><div class="divArchivo" title="<?php echo $archivoFinal;?>">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <img src="../../../imagen/formatos/<?php echo $formatoArchivo[1]; ?>.png" width="45">
                                                                </td>
                                                                <td class="nombreArchivo">
                                                                    <?php  
                                                                    for($x=0;$x<=25;$x++){
                                                                        if ($x<25){
                                                                           echo $archivoFinal[$x]; 
                                                                        }else{
                                                                            echo $archivoFinal[$x]; 
                                                                        }
                                                                    }
                                                                     
                                                                    
                                                                    ?>
                                                                    <br>
                                                                    <?php echo date("Y/m/d  H:i:s", fileatime($raiz . $archivoFinal)) ?>
                                                                    <br>
                                                                    <?php echo formato_tam(filesize($raiz . $archivoFinal)) ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </a>
                                                <?
                                            }
                                        }
                                    } else {
                                                                               echo '<label style="font-size:14px;font-family:verdana;">El nombre de los Directorios Finales no Respetan El Estandar Establecido</label>';
                                    }
                                }
                            }
                        }
                        closedir($directorio);
                    } else {
                        $bExisteCarpetaMamografia = 0;
                        echo '<label style="font-size:14px;font-family:verdana;">Seleccione valores...</label>';
                    }
                } else {
                     echo '<label style="font-size:14px;font-family:verdana;color:red;">ERROR!! inesperado.</label>';
                }
                ?>

            </div>
        </div>
    </div>
     <input type="hidden" value="<?php echo $datos['p1']; ?>" id="txtITem">
</body>
</html>

