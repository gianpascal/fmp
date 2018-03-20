<?php
$last_id = '';
echo "<rows>";
foreach ($arrayFilas as $row) {
    if (strlen($last_id) == strlen($row['vJerarquico'])) {
        echo "</row>";
    } else if (strlen($last_id) < strlen($row['vJerarquico'])) {
        
    } else if (strlen($last_id) > strlen($row['vJerarquico'])) {
        for ($i = strlen($row['vJerarquico']); $i < strlen($last_id) + 1; $i = $i + 2) {
            echo "</row>";
        }
    }
    echo "<row id='" . $row['iIdIndicadorTBC'] . "' open='1'>";
    echo "<cell image='../../../medifacil_front/imagen/csh_bluebooks_simedh/book.gif'>" . htmlspecialchars(utf8_encode($row['vIndicador'])) . "</cell>";
    echo "<cell>" . $row['iGrupo0_9'] . "</cell>";
    echo "<cell>" . $row['iGrupo10_14'] . "</cell>";
    echo "<cell>" . $row['iGrupo15_19'] . "</cell>";
    echo "<cell>" . $row['iGrupo20_44'] . "</cell>";
    echo "<cell>" . $row['iGrupo45_59'] . "</cell>";
    echo "<cell>" . $row['iGrupo60_mas'] . "</cell>";
    echo "<cell>" . $row['iTotal'] . "</cell>";
    $last_id = $row['vJerarquico'];
}
for ($i = 0; $i < strlen($last_id); $i = $i + 2) {
    echo "</row>";
}
echo "</rows>";
?>

