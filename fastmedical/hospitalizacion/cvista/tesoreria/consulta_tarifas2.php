<?php
require_once("../../ccontrol/control/ActionLogistica.php");
	$o_actionLogistica = new ActionLogistica();
    $htmlCategorias = $o_actionLogistica->listaCategorias();
	$htmlAfiliaciones = $o_actionLogistica->listaAfiliaciones();
?>

<div style="margin-top:0px;margin-bottom:0px;min-height:600px" align="left">
    <div class="titleform">
        <h1>Busqueda de datos del paciente</h1>
    </div>
  <div id="contenido_main" style="width:100%;margin:0px; padding:2px; overflow: hidden; position:absolute;">
    	<div style="width:90%;height: 50px;background-color: #F9F9f9 ;top:auto " >
   	    	<input type="hidden" value="%" id="categoria"/>
            <input type="hidden" value="%" id="afiliacion"/>
    	    <?php require_once("busqueda_tarifas.php");?>
    	</div> 
    <div style="height:500px; width:35%; background:#CCCCCC; float:left; " >
        	<div style="height:50px; width:100%; background:#999966">
            	Seg&uacute;n Afiliaci&oacute;n
            </div>
            <div style="height:200px; width:100%; background: #993399;  ">
            	<?php echo $htmlAfiliaciones; ?>
            </div>
          	<div style="height:50px; width:100%; background:#909966; " >
            	Seg&uacute;n Categor&iacute;a
            </div>
            <div style="height:200px; width:100%; background:#999916;">
            	<?php echo $htmlCategorias; ?>
            </div>
            
    </div>
     <div style="width:5px; float:left;  height:100%">
      I
     </div> 
         
         <div style="height:500px; width:55%; background:#CCCCCC; float:left; margin:auto" >
        	<div style="height:20px; width:100%; background:#999966">
            	Seg&uacute;n Afiliaci&oacute;n
            </div>
          <div  id="resultadoTarifas" style="height:300px; width:100%; background: #993399">
	<?php echo $htmlAfiliaciones; ?>
           </div>
          	<div style="background:#CCCCFF; height:180px;">
          	  
                <fieldset style="margin:0px; padding:0px;">
                <legend>Descripción del Producto</legend>
                  hola
                </fieldset>
       	      
            </div>
            
            
         </div>
         
        
  </div>
     
</div>
