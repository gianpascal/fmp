<?php
require_once("../../ccontrol/control/ActionRrhh.php");
	$o_actionRrhh = new ActionRrhh();
 $o_actionRrhh-> getArbolCentroCostos();
 require_once("../../ccontrol/control/ActionLogistica.php");
	$o_actionLogistica = new ActionLogistica();
?>

<div id="divContenido" style="width: 1550px;">
    
<div style="height:30px; width:100%; float: left;">
ocupaciones por centro de costos
<input name="idCargo" id="hiddenIdCargo" type="text" />

</div>
<div style="width:400px;height:500px;background: #eeeeee; float:left">
                    <div  id ="divCentroCostos" style="width:97%;height:95%;margin-left:1%;margin-right:1%;overflow: hidden;">
                        <a href="javascript:void(0)" onclick="cargarArbolCentroCostos('serviciosCentroCostos')">Centro de Costos</a>
                    </div>

</div>
        
<div id="division1" style="height:500px; width:420px; float:left; background:#184597">
			<div id="divDetalleCentroCostos" style="height:50px; width:400px; background:#CCCCCC; float:left; margin-left:10px;"><strong>
    	centro costos:    </strong></div>
        
        <div id="divCargos" style="height:130px; width:400px; background:#ddddaa; float:left; margin-left:10px;">
	        	<p><b>Cargos:</b> <br />    
           <div id="divListaCargos" style=" height:110px;">
           			lista de cargos
           </div>                 
       	  
       	  </div>
          
          <div id="divServiciosAutorizados" style="height:280px; width:400px; background:#eeaabb; float:left; margin-left:10px;">
	        	<p><b>Servicios Autorizados:</b> <br />    
           <div id="divListaServiciosCargos" style=" height:110px;">
           			lista de servicios
           </div>                 
       	  
       	  </div>
</div>

	
<div id="divBuscaProductos" style="width:700px; height:100px; float: left; " >
    	<?php
              echo $o_actionLogistica->buscarProductos('agregaServicioCargo','onClick','300px');
          ?>
</div>    

</div>
