<?php

$filename = str_replace(" ", "-", "ReporteCaja");
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=" . $filename . $parametros["p4"]);
header("Pragma: no-cache");
header("Expires: 0");

$table = "<table>";
$inicio = "si";
foreach ($arrayFilas as $key => $fila) {

    if ($inicio == "si") {
        $table.="<tr>";
        foreach ($fila as $id => $value) {
            if (!is_numeric($id)) {
                $table.="<td style='background:#cccccc;'>";
                $table.=$id;
                $table.="</td>";
            }
        }
        $table.="</tr>";
        $inicio = "no";
    }
    $table.="<tr>";
    foreach ($fila as $id => $value) {
        if (!is_numeric($id)) {
            $table.="<td>";
            $table.=$value;
            $table.="</td>";
        }
    }
    $table.="</tr>";
}
$table.="</table>";
echo $table;
?>