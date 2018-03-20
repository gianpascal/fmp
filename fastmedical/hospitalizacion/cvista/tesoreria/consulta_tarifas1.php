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
    <div id="contenido_main" style="width:100%;margin:0px; padding:2px; overflow: hidden; z-index:1; position:absolute;">
    	<div style="width:60%;height: 50px;background-color: #F9F9f9 ;top:auto " >
        	<input type="hidden" value="%" id="categoria"/>
            <input type="hidden" value="%" id="afiliacion"/>
            <?php require_once("busqueda_tarifas.php");?>
    	</div> 
        <div style=" padding-right:50px">
         	<div style="width:100%; height:400px; ">
            <div style="width:30%; height:400px; float:left" >
         		<h3>Lista de Categorias</h3>
       		  <div  style="height:40%;  border: 1px solid #CCCCCC; " >
                <table class="tabla" width="100%">
                 	<?php echo $htmlCategorias; ?>
                </table>    
              </div>
                <br/><h3>Lista de Afiliaciones                </h3>
                <div style="height:40%; border: 1px solid #CCCCCC;">
                <table class="tabla" width="100%">
                 	<?php echo $htmlAfiliaciones; ?>
                </table>   
                </div>
                
                 
                                
       	  </div>
          <h3>Lista de Afiliaciones                </h3>
         	<div   style="height:100px; width:60%; float:left; border: 1px solid #CCCCCC; margin: auto; ">
         		 <table id="resultadoTarifas" class="tabla" width="100%">
                 	
                </table> 
         	</div> 
        </div>   
        </div>
    </div>
</div>
