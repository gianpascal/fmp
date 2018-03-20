<?php
require_once("../../ccontrol/control/ActionLogistica.php");
	$o_actionLogistica = new ActionLogistica();
    $htmlCategoriasActiva = $o_actionLogistica->listaCategoriasActiva();
	$htmlCategoriasPasiva = $o_actionLogistica->listaCategoriasPasiva();
	$htmlAfiliaciones = $o_actionLogistica->listaAfiliaciones();
?>
<input type="hidden" value="%" id="categoria"/>
<input type="hidden" value="%" id="afiliacion"/>

<div style="width:800px; margin:1px auto; border: #006600 solid">
	<div class="titleform">
        <h1>Consulta de Precios </h1>
    </div>
	<div style=" height:90px; margin-bottom:15px;  ">
    	<?php require_once("busqueda_tarifas.php");?>
	</div>
	<div>
    	<div class="titleform"  style=" height:15px;">
            			Productos 
         </div>
                
         <div  id="resultadoTarifas" style="height:200px; width:100%; margin-bottom:15px; border: 1px solid #CCCCCC;  ">
						Resultado...
         </div>
	</div>
    <div class="titleform"  style=" height:15px;">
          Precios por Afiliaci&oacute;n
    </div>
    <div style="margin:5px auto; padding:10px; height:200px">
    	<div id="div_detalleProducto" style=" width:40%; background:#cccccc;border: 1px solid #CCCCCC; float:left; padding:5px; font-size:20px ">
    	  
    	</div>
	  <div id="div_precios" style="width:50%; height:195px; margin-left:5px; border: 1px solid #CCCCCC; float:left">
    	</div>       		
    </div>
	
</div>

