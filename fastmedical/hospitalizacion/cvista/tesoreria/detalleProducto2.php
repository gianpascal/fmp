
<?php 
if(!empty($arrayProducto)){
foreach ($arrayProducto as $producto) {
$v_desc_ser_pro =$producto['v_desc_ser_pro'];
$c_cod_ser_pro=trim($producto['c_cod_ser_pro']);
$unidad=$producto['unidad'];
$presen=$producto['presen'];
$tipo=$producto['tipo'];
$n_puntos=$producto['n_puntos'];
$v_desc_ccos=trim($producto['v_desc_ccos']);
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

        			<div id="div_nombreProducto" style="width:100%">
       					<fieldset id="fsnombreProd">
        				<legend>
                        	Nombre del Producto
        				</legend>
                      		<?php echo $v_desc_ser_pro;	?> 
                        </fieldset>
   			  </div>
             
              		<form>
                    <table  >
  <tr>
    <td align="right">C&oacute;digo:</td>
    <td><input  type="hidden" name="textfield" id="textfield" value="<?php echo $c_cod_ser_pro;	?> " /> <?php echo $c_cod_ser_pro;	?></td>
  </tr>
  <tr>
    <td align="right">C. Costos:</td>
    <td><?php echo $v_desc_ccos;	?></td>
  </tr>
  <tr>
    <td align="right">U. Medida:</td>
    <td> <?php echo $unidad;?>
      Presentaci&oacute;n: <?php echo $presen;	?>
      </td>
  </tr>
 
  <tr>
    <td align="right">Tipo:</td>
    <td><?php echo $tipo;	?></td>
  </tr>
  <tr>
    <td align="right">C. Puntaje</td>
    <td><?php echo $n_puntos;	?></td>
  </tr>
</table>

</form>
           	  

      