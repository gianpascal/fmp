<?php

$directorio = "../../../../carpetaDocumentos/reportesEssalud/" . $datos['p1'];
if (file_exists(($directorio))) {
    $directorio = opendir(($directorio));
    echo "<select onChange='verificarExistenciaCarpeta(this.value);' id='cbxMes' style='height:35px;width:100%;border:1px solid mediumaquamarine;font-family: verdana;font-size: 26px'>";
    echo "<option value='1'>Seleccionar...</option>";
    while ($archivo = readdir($directorio)) {
        if (is_dir($archivo)) {
            
        } else {
            echo "<option  value='" . $archivo . "'>" . $archivo . "</option>";
        }
    }
    echo "</select>";
    closedir($directorio);
} else {
    echo "<select onChange='verificarExistenciaCarpeta(this.value);' id='cbxMes' style='height:35px;width:100%;border:1px solid mediumaquamarine;font-family: verdana;font-size: 26px'>";
    echo "<option value='1'>Seleccionar...</option>";
    echo "</select>";
}
?>