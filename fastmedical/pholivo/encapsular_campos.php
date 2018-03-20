<?php 
function crearFuncionesSetGet($cadena){
	$cadena = str_replace("\n","",trim($cadena));
	$cadena = str_replace("\t","",trim($cadena));
	$cadena = str_replace("\r","",trim($cadena));
	
	$arrayCampos = split(";",trim($cadena));
	array_pop($arrayCampos);
	$funciones="";
	foreach($arrayCampos as $item){
		$nombreCampo = str_replace("private $","",trim($item));
		$nombreFuncion =substr_replace($nombreCampo, strtoupper(substr($nombreCampo,0,1)),0,1);
		
		$nombreFuncionGet="get".$nombreFuncion;
		$nombreFuncionSet="set".$nombreFuncion;
		
		$funcionGet = "public function ".$nombreFuncionGet."(){"."\r\t".'return $this->'.$nombreCampo.";\r}";
			
		$funcionSet = "public function ".$nombreFuncionSet."(".'$_'.$nombreCampo."){"." \r\t".'$this->'.$nombreCampo." = ".'$_'.$nombreCampo."; \r}";
		
		$funciones.="\n\r".$funcionGet."\r".$funcionSet;
	}
	return $funciones;
}
$mostrar="";
$funciones="";
if ($_POST){
	$funciones=$_POST["funciones"];
	$mostrar = crearFuncionesSetGet($funciones);
}
?>
<form action="encapsular_campos.php" method="POST">
<textarea name="funciones" style="text-align:left;" cols="100" rows="20" style="padding:0px;"> 
	<?php echo trim($funciones); ?>
</textarea><br />
<input type="submit" name="generar">
</form>
<div style="background-color:#F6F6F6;display:block;height:400px;width:725px;overflow-y:scroll;border-style:groove;border-width:1px;border-color:#999999;">
	<pre>
		<?php
			echo $mostrar;
		?>
	</pre>
</div>