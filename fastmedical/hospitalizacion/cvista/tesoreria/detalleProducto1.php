
<?php 
if(!empty($arrayProducto)){
foreach ($arrayProducto as $producto) {
$v_desc_ser_pro =$producto['v_desc_ser_pro'];
$c_cod_ser_pro=$producto['c_cod_ser_pro'];
$unidad=$producto['unidad'];
$presen=$producto['presen'];
$tipo=$producto['tipo'];
$n_puntos=$producto['n_puntos'];
$v_desc_ccos=$producto['v_desc_ccos'];
}
}
else{
	$v_desc_ser_pro =" Nombre del Producto ....";
	$c_cod_ser_pro="";//$producto['c_cod_ser_pro'];
	$unidad="";//$producto['unidad'];
	$presen="";//$producto['presen'];
	$tipo="";//$producto['tipo'];
	$n_puntos="";//$producto['n_puntos'];
	$v_desc_ccos="";//$producto['v_desc_ccos'];
}
?>

        			<div id="div_nombreProducto">
       					<fieldset id="fsnombreProd">
        				<legend>
                        	Nombre del Producto
        				</legend>
                      		<?php echo $v_desc_ser_pro;	?> 
                        </fieldset>
   			  </div>
              <br/>
              		<form>
                    <table width="100%" border="1">
                      <tr>
                        <td>C&oacute;digo:</td>
                        <td><label>
                          <input type="text" name="textfield" id="textfield" value="<?php echo $c_cod_ser_pro;	?> " />
                        </label></td>
                        <td>U. Medida:</td>
                        <td><label>
                          <input type="text" name="textfield2" id="textfield2" value="<?php echo $unidad;?> "/>
                        </label></td>
                        <td>Presentaci&oacute;n</td>
                        <td><label>
                          <input type="text" name="textfield3" id="textfield3" value=" <?php echo $presen;	?>"/>
                        </label></td>
                      </tr>
                    </table>
                    <br/>
                    <table width="100%" border="1">
                      <tr>
                        <td>Tipo:</td>
                        <td><label>
                          <input type="text" name="textfield4" id="textfield4" value="<?php echo $tipo;	?> "/>
                        </label></td>
                        <td>C. Puntaje</td>
                        <td><label>
                          <input type="text" name="textfield5" id="textfield5" value="<?php echo $n_puntos;	?>" />
                        </label></td>
                      </tr>
                    </table>
                    <br/>
                    <table width="100%" border="1">
                      <tr>
                        <td>C. Costos:</td>
                        <td><label>
                          <input type="text" name="textfield6" id="textfield6" value="<?php echo $v_desc_ccos;	?>" />
                        </label></td>
                      </tr>
                    </table>
                    <p>&nbsp;</p>
              		</form>
           	  
 <?php
//
?>
      