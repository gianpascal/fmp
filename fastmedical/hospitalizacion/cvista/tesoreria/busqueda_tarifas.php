
<form name="frmBusqueda"  action=""> 
<input type="hidden"   name="hOpcBusquedaProductos" id="hOpcBusquedaProductos" value="1"/>

<div id="toolbar" style="height:100%;">
	<div style="width:280px; float:left">
    	<table height="100%" >
  			<tr>
    			<td><strong>Nombre Prod: </strong></td>
    			<td><input  size="30px" class="textPatronDescripcion" name="txtPatronBusquedaProductos" type="text" id="txPatronNombre"
                            <?php
                                if($_SESSION["permiso_formulario_servicio"][171]["BUSCAR_PRODUCTO"]==1){
                                    echo " onkeypress=\"getTarifasProductos(event,0);\" onblur=\"if (this.value=='') this.value=this.defaultValue;\"  onfocus=\"if (this.value==this.defaultValue) this.value='';\" value=\"Buscar...\" />";
                                }else{
                                    echo "</td>";
                                }
                            ?>
  			</tr>
  			<tr>
    			<td><strong>C&oacute;digo:</strong></td>
    			<td><input  class="textPatronDescripcion" name="txtPatronBusquedaProductos2" type="text" id="txPatronCodigo" 
                             <?php
                                if($_SESSION["permiso_formulario_servicio"][171]["BUSCAR_PRODUCTO"]==1){
                                    echo "onkeypress=\"getTarifasProductos(event,0);\" onblur=\"if (this.value=='') this.value=this.defaultValue;\"  onfocus=\"if (this.value==this.defaultValue) this.value='';\" value=\"Buscar...\"/>";
                                }else{
                                    echo "</td>";
                                }
                             ?>
                        </tr>
  			<tr>
                            <td colspan="2" >
                                <?php
                                    if($_SESSION["permiso_formulario_servicio"][171]["BUSCAR_PRODUCTO"]==1){
                                        echo "<a href=\"javascript:getTarifasProductos('',1);\"><img src=\"../../../../fastmedical_front/imagen/btn/b_buscar_on.gif\" alt=\"\" border=\"0\" title=\"Agregar Ocupaciones\"/></a>";                                
                                    }
                                ?>
                                <div id="estado"></div>
                            </td>
   		  </tr>
		</table>

    </div>
    <div style="width:400px; float:left">
      <div id= "div_categoriaActiva" style="width: 100%; float:left; margin-left:2%; height:80px; overflow: auto;">
        	<?php echo $htmlCategoriasActiva; ?>
        </div>

    </div>
</div>

<input type="text" id="nadaasa" name="nada" style="width:2px;visibility:hidden;" />



</form>
