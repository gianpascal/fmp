<?php
require_once("../../ccontrol/control/ActionLogistica.php");
	$o_actionLogistica = new ActionLogistica();
    $htmlCategorias = $o_actionLogistica->listaCategorias();
	$htmlAfiliaciones = $o_actionLogistica->listaAfiliaciones();
?>
<input type="hidden" value="%" id="categoria"/>
<input type="hidden" value="%" id="afiliacion"/>
<div style="margin-top:0px;margin-bottom:0px;min-height:600px" align="left">
    <div class="titleform">
        <h1>Busqueda de datos del paciente</h1>
    </div>
  <div id="contenido_main" style="width:100%;margin:0px; padding:2px; overflow: hidden; position:absolute;">
    <div style="height:500px; width:20%; background:#CCCCCC; float:left; " >
      		<div style="height:100px; width:100%; background:#fbedff">
            			<?php require_once("busqueda_tarifas.php");?>
                 	</div>
            <div style="height:20px; width:100%; background:#eeeeee; " >
            	
                Seg&uacute;n Categor&iacute;a 
            </div>
            <div style="height:300px; width:100%; background:#999916;">
            	
				<?php echo $htmlCategorias; ?>
            </div>
            
    </div>
     <div style="width:5px; float:left;  height:100%">
      I
     </div> 
         
         <div style="height:500px; width:75%; background:#CCCCCC; float:left; margin:auto" >
        	<div style="background:#993366; height:270px;">
            	<div style="width:70%; background:#000066; float:left">
            		
                    <div style="height:20px; width:100%; background:#abcdef">
            			Productos
                 	</div>
                
          			<div  id="resultadoTarifas" style="height:250px; width:100%;  ">
						Productos...
           			</div>
            	</div>    
            
            	<div id="div_precios" style="width:30%; background: #001122; height:270px;   float:left">
            		
            	</div>
       	   </div>
            <div id="div_detalleProducto" style="background: #FFFFFF; height:100%; float:left; width:48%; padding:3px; margin-left:3px">
              <?php require_once("detalleProducto.php");?>
            </div>
             <div id="div_infoProductos" style="background: #987654; height:100%; float:left; width:48%; padding:3px; margin-left: 5px ">
               hola mundo
            </div>
            
    </div>
         
        
  </div>
     
</div>
