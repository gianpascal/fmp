
<?php 
if(!empty($arrayProducto)){
foreach ($arrayProducto as $producto) {
$v_desc_ser_pro =$producto['v_desc_ser_pro'];
$c_cod_ser_pro=trim($producto['c_cod_ser_pro']);
$unidad=$producto['unidad']."  ";
$presen=$producto['presen'];
$tipo=$producto['tipo'];
$n_puntos=$producto['n_puntos'];
$v_desc_ccos=trim($producto['v_desc_ccos']);
}
}
else{
	$v_desc_ser_pro =" Nombre del Producto ....";
	$c_cod_ser_pro="";//$producto['c_cod_ser_pro'];
	$unidad="___";//$producto['unidad'];
	$presen="___";//$producto['presen'];
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
                    <table height="80%" bordercolor="#003300" style="border:#006600; margin:5px;">
  <tr>
    <td align="right" ><strong>C&oacute;digo</strong>:</td>
    <td colspan="3" style="padding-left:10px;" ><input  type="hidden" name="textfield" id="textfield" value="<?php echo $c_cod_ser_pro;	?> " />
      <?php echo $c_cod_ser_pro;	?></td>
    </tr>
  <tr>
    <td align="right"><strong>C. Costos:</strong></td>
    <td colspan="3" style="padding-left:10px;"><?php echo $v_desc_ccos;	?></td>
    </tr>
  <tr>
    <td align="right" style="padding-left:10px;" ><strong>U. Medida:</strong></td>
    <td style="padding-left:10px;"> <?php echo $unidad;?></td>
    <td align="right" style="padding-left:10px;" ><strong>Presentaci&oacute;n:</strong></td>
    <td style="padding-left:10px;"><?php echo $presen;	?></td>
  </tr>
 
  <tr>
    <td align="right"><strong>Tipo:</strong></td>
    <td colspan="3" style="padding-left:10px;" ><?php echo $tipo;	?></td>
    </tr>
  <tr>
    <td align="right"><strong>C. Puntaje:</strong></td>
    <td colspan="3" style="padding-left:10px;"><?php echo $n_puntos;	?></td>
    </tr>
</table>

</form>
           	  

      