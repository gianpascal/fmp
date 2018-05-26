<input  size="30px"  name="txtIndicador" type="hidden" id="txtIndicador" value="0" />
<input  name="txtCadena" type="hidden" id="txtCadena" value="<?php echo $cadena ?>" />

<div style="width:610px;margin:1px auto; border: #006600 solid; height:500px">
    <!--<form name="frmBusqueda"  action="">-->
        <div class="titleform">
            <h1>Adicionar Procedimientos</h1>
        </div>
        <div style=" height:40px; margin-bottom:15px;  ">
            <div id="toolbar" style="height:100%;">
                <div style="width:290px; height:40px; float:left">
                    <div style="width:100%; height:33%; " >
                        <div style="width:30%; height:100%;  float:left;">
                            Procedimiento:             
                        </div> 
                        <div style="width:70%; height:100%;  float:left;">
<!--                            <input  size="30px"  name="txtNombreProcedimiento" type="text" id="txtNombreProcedimiento" onkeypress="getTarifasProcedimientos(event,'01');" onblur="if (this.value=='') this.value=this.defaultValue;"  onfocus="if (this.value==this.defaultValue) this.value='';" value="Buscar..." />-->
                            <input  size="30px"  name="txtNombreProcedimiento" type="text" id="txtNombreProcedimiento" onkeyup="getTarifasProcedimientosProductos(event,'01');" onblur="if (this.value=='') this.value=this.defaultValue;"  onfocus="if (this.value==this.defaultValue) this.value='';" value="Buscar..." />
                        </div> 
                    </div>
<!--                    <div style="width:100%; height:33%; " >
                        <div style="width:30%; height:100%;  float:left;">
                            C&oacute;digo:
                        </div> 
                        <div style="width:35%; height:100%; float:left;">
                            <input  type="text"  class="textPatronDescripcion" id="txtCodigo"  onfocus="if (this.value==this.defaultValue) this.value='';" onblur="if (this.value=='') this.value=this.defaultValue;" onkeypress="getTarifasProcedimientos(event,'02');" value="Buscar..." size="12" />
                        </div> 

                    </div>-->
<!--                    <div style="width:70%; height:33%; float:left;" >
                        <a href="javascript:getTarifasProcedimientos('','03');">
                            <img src="../../../../fastmedical_front/imagen/btn/b_buscar_on.gif" alt="" border="0" title="Agregar Ocupaciones"/>
                        </a>
                    </div>-->

                </div>
                <!--Lo coulte para no modificar el pasado-->
<!--                <div style="width:300px; float:left" hidden="">
                    <div id= "div_centroCosto" style="width: 100%; float:left; margin-left:2%; height:80px;overflow: auto ">
                        < ? // php echo $tablaCentroCosto; ?>
                    </div>
                </div>-->
            </div>

        </div>

    <!--</form>-->               

    <div  id="resultadoTarifasProcedimientos" style=" width:620px;height:200px; margin-bottom:5px; border: 1px solid #CCCCCC;overflow: auto  ">
        <!--< ?php echo $tablaPrecioProcedimientos;-->
        <!--?>-->

    </div>
    <div id="div_div">
        <div id="div_procedimientosSeleccionados" style="height:135px;overflow: auto">
<!--            < ?php echo $tablaSeleccionados;
            ? >-->
        </div>
    </div>
    <div id="div_botones" style="height:45px;">
        <fieldset style="margin:5px;height:30px;padding:5px; border-color: #006600; " >
            <table width="100%" border="0">
                <tr>
                    <td width="25%">&nbsp;</td>
                    <td width="25%" align="center">
                        <a href="javascript:cerrarAgregaProcedimientoNuevo('01');">
                            <img src="../../../../fastmedical_front/imagen/btn/b_aceptar_on.gif" alt="" border="0" title="Codigo de Persona"/>                          </a>                        </td>
                    <td width="25%" align="center">
                        <a href="javascript:cerrarAgregaProcedimientoNuevo('02');">
                            <img src="../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif" alt="" border="0" title="Codigo de Persona"/>                        	</a>                        </td>
                    <td width="25%">&nbsp;</td>
                </tr>
            </table>

        </fieldset>
    </div>


</div>

