<?php
require_once("../../ccontrol/control/ActionRrhh.php");
	$o_actionRrhh = new ActionRrhh();
 $o_actionRrhh-> getArbolCentroCostos();
?>
<div style="height:30px; width:100%">
ocupaciones por centro de costos
<input name="granGrupo" id="cGranGrupo" type="text" />
<input name="grupo" id="cGrupo" type="text" />
<input name="subGrupo" id="cSubGrupo" type="text" />
<input name="apertura" id="cApertura" type="text" />
</div>


        <div style="width:400px;height:500px;background: #eeeeee; float:left">
                    <div  id ="divCentroCostos" style="width:97%;height:95%;margin-left:1%;margin-right:1%;overflow: hidden;">
                        <a href="javascript:void(0)" onclick="cargarArbolCentroCostos('seleccionCentroCostos')">Centro de Costos</a>
                    </div>

        </div>
        
        <div id="division1" style="height:500px; width:350px; float:left; background:#184597">
			<div id="divDetalleCentroCostos" style="height:50px; width:300px; background:#CCCCCC; float:left; margin-left:20px;"><strong>
    	centro costos:    </strong></div>
        
        <div id="divAgregar" style="height:280px; width:300px; background:#ddddaa; float:left; margin-left:20px;">
	        	<p><b>Agregar Cargo:</b> <br />
	        	    <b>Nombre del Cargo:</b><br />
	        	    <center><textarea name="" cols="30" wrap="physical" id="cargo"></textarea></center>
	        	  <br />
	        	    <b>Ocupaci&oacute;n: </b><br />
	        	    <center><textarea readonly="readonly" name="" cols="30" wrap="physical" id="nombreOcupacion"></textarea></center>
                    <br/>
                    <b>Cantidad: </b><br />
	        	    <center>
	        	      <input name="" type="text" id="cantidad" value="1" size="30" />
	        	    </center>
                    <br/>
                    
                    
          <center>
	<a href="javascript:agregarOcupacion();"><img src="../../../../medifacil_front/imagen/btn/b_agregar_on.gif" alt="" border="0" 					title="Agregar Ocupaciones"/></a>
    <div id="estado">
    estado
    </div>
	</center>
       	  </div>
</div>

<div id="profesionesActuales" style="height:500px; width:450px; float:left; background:#cccccc; float:left;">
	<table>
  <tr>
    
    <td>
    	<div id="divListaGranGrupoOcupaciones" style="width:450px; height:100px;" >
    	<?php
              echo $o_actionRrhh->granGrupoOcupaciones();
          ?>
    </div>
    </td>
  </tr>
  <tr>
    
    <td>&nbsp;</td>
  </tr>
  <tr>
   
    <td>
    <div id="divListaGrupoOcupaciones" style="width:450px; height:100px;" >
    	
    </div>
    </td>
  </tr>
  <tr>
    
    <td>&nbsp;</td>
  </tr>
  <tr>
    
    <td>
    <div id="divListaSubGrupoOcupaciones" style="width:450px; height:100px;" >
    
    </div>
    </td>
  </tr>
  <tr>
    
    <td>&nbsp;</td>
  </tr>
  <tr>
    
    <td>
    <div id="divListaAperturaOcupaciones" style="height:130px;">

    </div>
    </td>
  </tr>

</table>
</div>

<div id="division2" style="height:500px; width:10px; float:left; background: #33CC99">

</div>

    <div id="divOcupaciones" style="height:200px; width:900px; background:#CCCCCC; float: left;">
    	centro costos
    </div>
</div>

