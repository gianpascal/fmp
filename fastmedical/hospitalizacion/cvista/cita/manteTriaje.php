<?php
require_once("../../ccontrol/control/ActionCita.php");
require_once("../../../pholivo/Html.php");//Sólo si necesito el toolbar

$datosDesencriptados = base64_decode($_REQUEST['datos']);
$datosSeparados = explode("|",$datosDesencriptados);

$horaProgramacion = $datosSeparados[0];
$codCronograma = $datosSeparados[1];
$codigoProgramacion=$datosSeparados[2];
$accion = $_REQUEST['accion'];
//Recuperamos datos si los hubieran para recuperarlos
$o_ActionCita = new ActionCita();
$resultado = $o_ActionCita->spListaTriaje($codigoProgramacion);

if($resultado[0]==1){//encontro datos en la BD
    $accion='actualizar';
    $peso=$resultado['nPeso'];
    $talla=$resultado['nTalla'];
    $temp=$resultado['nTemperatura'];
    $frecCardiaca=$resultado['iFrecuenciaCardiaca'];
    $presArterial=$resultado['vPresionArterial'];
    $frecRespiratoria=$resultado['iFrecuenciaRespiratoria'];
    $satOxigeno=$resultado['nSaturacionOxigeno'];
}
else{
    $peso='0';
    $talla='0';
    $temp='0';
    $frecCardiaca='0';
    $presArterial='0';
    $frecRespiratoria='0';
    $satOxigeno='0';
}
?>
<fieldset>
    <legend>Registrar Triaje</legend>
    <div style="clear:left;width:100%">&nbsp;</div>
    <div style="clear:left;width:100%">
        <div style="float:left; width:60%;" >
            <label>Peso (Kg.):</label>
        </div>
        <div style="float:left; width:40%;">
            <input type="text" name="txtPeso" id="txtPeso" size ="6" onkeyup="validaDecimal(event,this,'')" value="<?php echo $peso?>"/>
        </div>
    </div>
    <div style="clear:left;width:100%">
        <div style="float:left; width:60%;" >
            <label>Talla (
                <select name="unidadTalla" id="unidadTalla">
                    <option value="1">m</option>
                    <option value="2">cm</option>
                </select>):
            </label>
        </div>
        <div style="float:left; width:40%;">
            <input type="text" name="txtTalla" id="txtTalla" size ="6" onkeyup="validaDecimal(event,this,'')" value="<?php echo $talla?>"/>
        </div>
    </div>
    <div style="clear:left;width:100%">
        <div style="float:left; width:60%;" >
            <label>Temp. (ºC):</label>
        </div>
        <div style="float:left; width:40%;">
            <input type="text" name="txtTemp" id="txtTemp" size ="6" onkeyup="validaDecimal(event,this,'')" value="<?php echo $temp?>"/>
        </div>
    </div>
    <div style="clear:left;width:100%">
        <div style="float:left; width:60%;" >
            <label>Frec. Cardiaca (min):</label>
        </div>
        <div style="float:left; width:40%;">
            <input type="text" name="txtFrecCardiaca" id="txtFrecCardiaca" size ="6" onkeyup="validaIntegers(event,this,'')" value="<?php echo $frecCardiaca?>"/>
        </div>
    </div>
    <div style="clear:left;width:100%">
        <div style="float:left; width:60%;" >
            <label>Pres. Arterial (mmHg):</label>
        </div>
        <div style="float:left; width:40%;">
            <input type="text" name="txtPresArterial" id="txtPresArterial" size ="6" value="<?php echo $presArterial?>"/>
        </div>
    </div>
    <div style="clear:left;width:100%">
        <div style="float:left; width:60%;" >
            <label>Frec. Respiratoria (min):</label>
        </div>
        <div style="float:left; width:40%;">
            <input type="text" name="txtFrecRespiratoria" id="txtFrecRespiratoria" size ="6" onkeyup="validaIntegers(event,this,'')" value="<?php echo $frecRespiratoria?>"/>
        </div>
    </div>
    <div style="clear:left;width:100%">
        <div style="float:left; width:60%;" >
            <label>Sat. O2(%):</label>
        </div>
        <div style="float:left; width:40%;">
            <input type="text" name="txtSatOxigeno" id="txtSatOxigeno" size ="6" onkeyup="validaDecimal(event,this,'')" value="<?php echo $satOxigeno?>"/>
        </div>
    </div>
    <div style="clear:left;width:100%">&nbsp;</div>
</fieldset>
<br/>
<fieldset>
    <div id="divBotonesTriaje" align="center" style="width:100%;height:auto;background:white">
        <?php
            echo "<a href=\"javascript:manteTriaje('$accion','$horaProgramacion','$codCronograma');\" onkeypress=\"javascript:manteTriaje('$accion','$horaProgramacion','$codCronograma');\"><img src=\"../../../../fastmedical_front/imagen/btn/b_grabar_on.gif\"></a>";
        ?>
    </div>
</fieldset>

