<style>
    .buttonAngel{
        margin-top: 5px;
        font-size: 12px;
        font-family: verdana;
        height:35px;
        border:2px solid #D5DDE8;
        background-color: #0C2D59;
        color:#D5DDE8;
    }
    .buttonAngel:hover{
        height:35px;
        border:2px solid #0C2D59;
        background-color:#D5DDE8;
        color:#0C2D59;
        cursor:pointer;
    }
    .h1{
        font-size:16px;
        font-family: verdana;
        color:#0C527C
    }
    .h1:hover{
        color:red;
    }
    .h2{
        font-size:12px;
        font-family: verdana;
        color:#0C527C
    }
    .h2:hover{
        color:red;
    }
</style>
<?php
require_once("ActionRrhh.php");
$o_ActionRrhh = new ActionRrhh();
$datosEmpleado = $o_ActionRrhh->datosPersonalSeleccionadoXcoodinador($datos);
$datosCoordinador = $o_ActionRrhh->datosAreasDeCoordinador($datos);
$areasporEmpleado = $o_ActionRrhh->datosAreasDeEmpleado($datos);
?>
<input type="hidden" id="c_cod_per" value="<?php echo utf8_encode($datosEmpleado[0][0]); ?>">
<input type="hidden" id="iIdEmpleado" value="<?php echo utf8_encode($datosEmpleado[0][1]); ?>">
<input type="hidden" id="vPersona" value="<?php echo utf8_encode($datosEmpleado[0][2]); ?>">
<input type="hidden" id="vPuesto" value="<?php echo utf8_encode($datosEmpleado[0][3]); ?>">
<input type="hidden" id="vTipoProgramacion" value="<?php echo utf8_encode($datosEmpleado[0][4]); ?>">
<input type="hidden" id="iIdTipoProgramacion" value="<?php echo utf8_encode($datosEmpleado[0][5]); ?>">
<input type="hidden" id="c_cod_per" value="<?php echo utf8_encode($datosEmpleado[0][0]); ?>">
<input type="hidden" id="iIdCoordinador" value="<?php echo utf8_encode($datos['iIdCoordinardor']); ?>">
<input type="hidden" id="iMes" value="<?php echo utf8_encode($datos['iMes']); ?>">
<input type="hidden" id="iAnio" value="<?php echo utf8_encode($datos['iAnio']); ?>">
<input type="hidden" id="iPuestoEmpleado" value="<?php echo utf8_encode($datosEmpleado[0][6]); ?>">
<input type="hidden" id="categoriaEmpleado" value="<?php echo utf8_encode($datosEmpleado[0][7]); ?>">
<input type="hidden" id="iIdCategoriaEmpleado" value="<?php echo utf8_encode($datosEmpleado[0][8]); ?>">

<h1 class="h1" title="<?php $datosEmpleado[0][3]; ?>"><?php echo utf8_encode($datosEmpleado[0][2]); ?></h1>
<h1 class="h2">Tipo Programacion: &nbsp;&nbsp;<font color="red"><?php echo utf8_encode($datosEmpleado[0][4]); ?></font></h1>
<h1 class="h2">Categoría  : &nbsp;&nbsp;<font color="red"><?php echo utf8_encode($datosEmpleado[0][7]); ?></font></h1>
<?php
switch ($datos['iMes']) {
    case 1:
        $vMes = "Enero";
        break;
    case 2:
        $vMes = "Febrero";
        break;
    case 3:
        $vMes = "Marzo";
        break;
    case 4:
        $vMes = "Abril";
        break;
    case 5:
        $vMes = "Mayo";
        break;
    case 6:
        $vMes = "Junio";
        break;
    case 7:
        $vMes = "Julio";
        break;
    case 8:
        $vMes = "Agosto";
        break;
    case 9:
        $vMes = "Setiembre";
        break;
    case 10:
        $vMes = "Octubre";
        break;
    case 11:
        $vMes = "Noviembre";
        break;
    case 12:
        $vMes = "Diciembre";
        break;
}
?>
<h1 class="h2">Mes: &nbsp;&nbsp;<?php echo utf8_encode($vMes); ?></h1>
<br>
<p><b>Areas a cargo:</b>
    <br>
    <br>
<div style="width:90%;height: 100px;border:0px solid;padding-left: 25px;overflow-y: auto;">
    <table>
        <?php
        $iIdAreas = "";
        $contadorCoordinador = count($datosCoordinador);
        $contadorEmpleado = count($areasporEmpleado);

        for ($x = 0; $x <= $contadorCoordinador - 1; $x++) {
            for ($y = 0; $y <= $contadorEmpleado - 1; $y++) {
                if ($datosCoordinador[$x][0] == $areasporEmpleado[$y][0]) {
                    $disabled = "disabled";
                    $checked = "checked";
                    $valorAlaLuzSiEresAraozTu = $datosCoordinador[$x][0];
                    $y = $contadorEmpleado - 1;
                  //  echo $x . 'par';
                } else {
                    $disabled = "";
                    $checked = "";
                    $valorAlaLuzSiEresAraozTu = "";
                   // echo $x . 'imar';
                }
            }
            ?>
            <tr>
                <td><b>-&nbsp; <?php echo $datosCoordinador[$x][1]; ?>&nbsp;&nbsp;</b></td>
                <td><input <?php echo $disabled . " "; ?><?php echo $checked . " "; ?> title="<?php echo $datosCoordinador[$x][1]; ?> " type="checkbox" id="area_<?php echo $datosCoordinador[$x][0]; ?>" onChange="seleccionarArea(<?php echo $datosCoordinador[$x][0]; ?>,this.value)"></td>
                <td><input type="hidden" id="iIdArea_<?php echo $datosCoordinador[$x][0]; ?>" value="<?php echo $valorAlaLuzSiEresAraozTu; ?>"></td>
            </tr>
            <?php
              $iIdAreas.=$datosCoordinador[$x][0] . '//';     
            }
            ?>
        </table>
    </div>
    <center>
        <button title="Guardar" onClick="aceptarAgregarEmpleadoXCoodinador('<?php echo $iIdAreas; ?>')" class="buttonAngel">Aceptar</button>
</center>

