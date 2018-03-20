<div style="width:100%;height:100%;">
    <div style="border:0px solid;width: 100%;height: 100%;overflow-y: auto;">
        <?php

        function formato_tam($size, $precision = 0) {
            $sizes = array('Tb', 'Gb', 'Mb', 'Kb', 'bytes');
            $total = count($sizes);
            while ($total-- && $size > 1024)
                $size /= 1024;
            return round($size, $precision) . " " . $sizes[$total];
        }

        $directorio = "../../../../carpetaDocumentos/reportesEssalud/" . $datos["p2"] . "/" . $datos['p1'] . "/";
        if (file_exists(($directorio))) {
            $dircadena = $directorio;
            $directorio = opendir(($directorio));
            while ($archivo = readdir($directorio)) {
                if (is_dir($archivo)) {
                    
                } else {
                    $carpeta = explode("_", $archivo);
                    if ($carpeta[0] == $datos['p3']) {
                        $directorioFinal = $dircadena . $archivo . "/";
                        $raiz = $directorioFinal;
                        if (file_exists(($directorioFinal))) {
                            $directorioFinal = opendir(($directorioFinal));
                            while ($archivoFinal = readdir($directorioFinal)) {
                                if (is_dir($archivoFinal)) {
                                    
                                } else {
                                    $formatoArchivo = explode(".", $archivoFinal);
                                    ?>
                                    <a target="_new" href="<?php echo $raiz . $archivoFinal; ?>"><div class="divArchivo" title="<?php echo $archivoFinal; ?>">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <img src="../../../imagen/formatos/<?php echo $formatoArchivo[1]; ?>.png" width="45">
                                                    </td>
                                                    <td class="nombreArchivo">
                                                        <?php
                                                        for ($x = 0; $x <= 25; $x++) {
                                                            if ($x < 25) {
                                                                echo $archivoFinal[$x];
                                                            } else {
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
            echo '<label style="font-size:14px;font-family:verdana;">Seleccione valores...</label>';
        }
        ?>
    </div>
</div>