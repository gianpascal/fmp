<?php
$edadMeses = date_parse($datos["dFechaNacimiento"]);
$fechaNacimiento = $edadMeses['year'] . '-' . $edadMeses['day'] . '-1';
$fechaHoy = date('Y-m-d');
$fechaHoyAnio = date('Y');
$fechaNaAnio = $edadMeses['year'];
$fechaHoyMes = date('m');
$fechaNaMes = $edadMeses['day'];
$edadMesesFinal = ($fechaHoyAnio - $fechaNaAnio) * 12 + ($fechaHoyMes - $fechaNaMes);

function hayarEdadMeses($anioEdad){
    $edadMesesFinal = $anioEdad * 12;
    return $edadMesesFinal;
}
function edad($edad) {
    list($anio, $mes, $dia) = explode("-", $edad);
    $aniodif = date("Y");
    $aniodif = $aniodif - $anio;
    $mesdif = date("m");
    $mesdif = $mesdif - $mes;
    $diadif = date("d");
    $diadif = $diadif - $dia;
    return $aniodif;
}

$edadFor = edad($fechaNacimiento);
?>
<table>
    <tr>
        <td>
            <label style="font-family: verdana;font-weight: bold;font-size: 18px;">Desde: </label>
        </td>
        <td>
            <?php if ($edadMesesFinal <= 72) { ?>
                <select id="cbxDesde" style="width:50px;height:25px;font-family: verdana;font-size: 16px;" onChange="generarComboHasta(<?php echo $edadMesesFinal; ?>,<?php echo $datos['iNumeroReporte'] ?>,'<?php echo $datos['vReporte']; ?>')">
                    <?php
                    for ($x = 0; $x <= $edadMesesFinal; $x++) {
                        if ($x == 36 || $x == 72) {
                            $seledted = 'selected';
                        } else {
                            $seledted = '';
                        }
                        ?>
                        <option <?php echo $seledted; ?> value="<?php echo $x; ?>">
                            <?php echo $x; ?>
                        </option>
                    <?php } ?>
                </select><label style="font-family: verdana;font-weight: normal;font-size: 18px;">Meses </label>
            <?php } else { ?>
                <select id="cbxDesde" style="width:50px;height:25px;font-family: verdana;font-size: 16px;" onChange="generarComboHasta2(<?php echo $edadFor; ?>,<?php echo $datos['iNumeroReporte'] ?>,'<?php echo $datos['vReporte']; ?>')">
                    <?php
                    
                    for ($x = 0; $x <= $edadFor; $x++) {
                        if ($x == $edadFor - 5) {
                            $seledted = 'selected';
                        } else{
                            $seledted = '';
                        }
                        ?>
                        <option <?php echo $seledted;?> value="<?php echo hayarEdadMeses($x);?>">
                            <?php echo $x; ?>
                        </option>
                    <?php } ?>
                </select><label style="font-family: verdana;font-weight: normal;font-size: 18px;">Años </label>

            <?php }
            ?>
        </td>
        <td>

        </td>
        <td>
            <label style="font-family: verdana;font-weight: bold;font-size: 18px;">Hasta: </label>
        </td>
        <td>
            <div id="contenedorComboHasta">
                <?php if ($edadMesesFinal <= 72) { ?>
                    <select id="cbxHasta" disabled style="width:50px;height:25px;font-family: verdana;font-size: 16px;" onChange="cargarGraficoHistoriaTriajeDestrucTor(<?php echo $datos['iNumeroReporte'] ?>,'<?php echo $datos['vReporte']; ?>')">
                        <?php
                        for ($x = 0; $x <= $edadMesesFinal; $x++) {
                            if ($x == $edadMesesFinal) {
                                $seledted = 'selected';
                            } else {
                                $seledted = '';
                            }
                            ?>
                            <option <?php echo $seledted; ?> value="<?php echo $x; ?>">
                                <?php echo $x; ?>
                            </option>
                        <?php } ?>
                    </select><label style="font-family: verdana;font-weight: normal;font-size: 18px;">Meses </label>
                <?php } else { ?>
                    <select id="cbxHasta" disabled style="width:50px;height:25px;font-family: verdana;font-size: 16px;" onChange="cargarGraficoHistoriaTriajeDestrucTor(<?php echo $edadMesesFinal; ?>,<?php echo $datos['iNumeroReporte'] ?>,'<?php echo $datos['vReporte']; ?>')">
                        <?php
                        for ($x = 0; $x <= $edadFor; $x++) {
                            if ($x == $edadFor ) {
                                $seledted = 'selected';
                            } else {
                                $seledted = '';
                            }
                            ?>
                            <option <?php echo $seledted; ?> value="<?php echo hayarEdadMeses($x); ?>">
                                <?php echo $x; ?>
                            </option>
                        <?php } ?>
                    </select><label style="font-family: verdana;font-weight: normal;font-size: 18px;">Años </label>
                <?php } ?>
            </div>
        </td>
    </tr>
</table>

<div id="divContenedorGraficoTriaje"  style="float:left;width:998px;height:568px;border:1px solid #A4BED4;">

</div>
<!--
<div id="contenedorTablaLeyenda" style="margin-left:8px;float:left;width:280px;height:436px;border:1px solid #A4BED4;">

</div>
<table style="float:left;width:282px;margin-left:8px;font-weight: bold" border="0" cellspacing="0">
    <tr>
        <td width="160" bgcolor="#F98C33">
    <center>
        Con Triaje
    </center> 
</td>
<td width="160" bgcolor="#69C22C">
<center>
    Sin Triaje
</center> 
</td>
</tr>
</table>

-->