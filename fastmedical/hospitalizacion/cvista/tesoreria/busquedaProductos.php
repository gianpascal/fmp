<?php
require_once("../../ccontrol/control/ActionLogistica.php");
	$o_actionLogistica = new ActionLogistica();
    $htmlCategoriasActiva = $o_actionLogistica->listaCategoriasActiva();
	
echo "<input type='text' value='".$funcion."' id='funcion' />";
echo "<input type='text' value='".$evento."' id='evento' />";
?>
<input type="hidden" value="%" id="categoria"/>
<input type="hidden" value="%" id="afiliacion"/>


<div style="width:700px;margin:1px auto; border: #006600 solid">
	<div class="titleform">
        <h1>Productos</h1>
        
    </div>
    
	<div style=" height:90px; margin-bottom:15px;  ">
    
    	<?php require_once("busqueda_tarifas.php");?>
	</div>
	
                
         <div  id="resultadoTarifas" style=" <?php echo "height:".$alto.";"; ?> width:700px; margin-bottom:15px; border: 1px solid #CCCCCC;  ">
						Resultado...
                        
         </div>
	

    
	
</div>

