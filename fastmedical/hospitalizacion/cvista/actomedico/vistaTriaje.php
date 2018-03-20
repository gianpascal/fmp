<?php
$respuesta = $this->listarDatosTriaje($datos);
$talla = (float) $respuesta["nTalla"];
$peso = (float) $respuesta["nPeso"];
if ($talla <= 0)
    $imc = "0.0";
else
    $imc = round((float) (($peso) / pow($talla, 2)), 2);
?>

<table width="100%" cellspacing="1" 
    <tr>
        <td><!--<a href="javascript:cargarVistaPopudResporteHistorialTriaje(4,'Temperatura')">-->Temp. (ºC):<!--</a>--></td>
        <td><input type="text" name="txttemperatura" id="txttemperatura" size ="6" readonly="true" value="<?php echo $respuesta["nTemperatura"]; ?>"/></td>
        <td><!--<a href="javascript:cargarVistaPopudResporteHistorialTriaje(6,'Frecuencia Cardiaca')">-->Frec. Cardiaca (min):</a></td>
        <td><input type="text" name="txtfrecuenciacardiaca" id="txtfrecuenciacardiaca" size ="6" readonly="true" value="<?php echo $respuesta["iFrecuenciaCardiaca"]; ?>"/></td>
        <td><!--<a href="javascript:cargarVistaPopudResporteHistorialTriaje(3,'Frecuencia Respiratoria')">-->Frec. Respiratoria (min):<!--</a>--></td>
        <td><input type="text" name="txtfrecuenciarespiratoria" id="txtfrecuenciarespiratoria" size ="6" readonly="true" value="<?php echo $respuesta["iFrecuenciaRespiratoria"]; ?>"/></td>
        <td><!--<a href="javascript:cargarVistaPopudResporteHistorialTriaje(2,'Presion Arterial')">-->Pres. Arterial (mmHg):<!--</a>--></td>
        <td><input type="text" name="txtpresionaarterial" id="txtpresionaarterial" size ="6" readonly="true" value="<?php echo $respuesta["vPresionArterial"]; ?>"/></td>
        <td><!--<a href="javascript:cargarVistaPopudResporteHistorialTriaje(5,'Saturacion de Oxigeno')">-->Sat. O2(%):<!--</a>--></td>
        <td><input type="text" name="txtsaturacionoxigeno" id="txtsaturacionoxigeno" size ="6" readonly="true" value="<?php echo $respuesta["nSaturacionOxigeno"]; ?>"/></td>
        <td><a title="Rangos hasta 5 años de edad."href="javascript:cargarVistaPopudResporteHistorialTriaje(7,'Peso')">Peso (Kg.):</a></td>
        <td><input type="text" name="txtpeso" id="txtpeso" size ="6" readonly="true" value="<?php echo $respuesta["nPeso"]; ?>"/></td>
        <td><a title="Rangos hasta 5 años de edad." href="javascript:cargarVistaPopudResporteHistorialTriaje(1,'Talla')">Talla (m.):</a></td>
        <td><input type="text" name="txttalla" id="txttalla" size ="6" readonly="true" value="<?php echo $respuesta["nTalla"]; ?>"/></td>
        <td><!--<a href="javascript:cargarVistaPopudResporteHistorialTriaje(8,'IMC')">-->IMC:<!--</a>--></td>
        <td><input type="text" name="txtimc" id="txtimc" size ="6" readonly="true" value="<?php echo $imc; ?>"/></td>
    </tr>
</table>
