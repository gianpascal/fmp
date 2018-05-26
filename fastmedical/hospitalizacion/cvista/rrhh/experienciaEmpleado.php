<form id="form_detalle" name="form_detalle" action="">
 <div style="width:99%; margin:1px auto; border: #006600" >
  <div class="titleform" id="divTitulo" >     
  </div>
</div>


<div  id ="divExperiencia" style="width:99%;height:inherit;margin-left:1%;margin-right:1%;overflow:scroll; ">
 <fieldset style="margin:1px;width:99%;height:22px;padding: 0px;">
        <table border="0">
          <tr>
            <td><b>EXPERIENCIA LABORAL</b></td>
          </tr>
        </table>    
 </fieldset>
    <div  id ="divDatosExperiencia" style="width:98%;height:190px;margin-left:1%;margin-right:1%; overflow: auto;">
    </div>
    <div  id ="divEspacioSup" style="width:99%;height:10px;margin-left:1%;margin-right:1%; ">
    </div>
    <div  id ="divBotonesExperiencia" style="width:99%;height:inherit;margin-left:1%;margin-right:1%; " align="center">
         <fieldset style="margin:1px;width:50%;height:27px;padding: 0px;">
                
                <div  id ="DivEliminar" style=" float:right;width:33%; visibility: hidden;" align="center">
                        <a href="javascript:enableAccion(3);">
                        <img border="0" title="" alt="" src="../../../../fastmedical_front/imagen/btn/b_eliminar_on.gif"/></a>
                </div>
                <div  id ="DivAgregar" style=" float:right;width:33%;" align="center">
                        <a href="javascript:enableAccion(2);">
                        <img border="0" title="" alt="" src="../../../../fastmedical_front/imagen/btn/b_agregar_on.gif"/></a>
               </div>
               <div  id ="DivEditar" style=" float:right;width:33%; visibility: hidden;" align="center">
                        <a href="javascript:enableAccion(1);">
                        <img border="0" title="" alt="" src="../../../../fastmedical_front/imagen/btn/b_editar_on.gif"/></a>
               </div>                            
                
      </fieldset>
    </div>
    
    <div  id ="divResultadoExperiencia" style="width:99%;height:260px;margin-left:1%;margin-right:1%; " align="center">
       <fieldset style="margin:1px;width:92%;height:257px;padding: 0px; font-size: larger">
           
           <div style="width: 100%; height: 7%;">
         </div>
           <table border="0">
                      <tr>
                        <td><b>DETALLE</b></td>
                      </tr>
                    </table>
            <div style="width: 100%; height: 7%;">
         </div>
           <div id="uno" style="width: 100%; height: 15%; margin-left: 9%; visibility: hidden">
                <div style="width: 10%; float: left; " id="divEtiquetaDesde">
                        Desde*:
                </div>
                <div style="width: 21%; float: left;" id="DivTextDesde">
                    <input  type="text" size="12" value="" onblur="esFechaValida(this);" onclick="calendarioHtmlx('txtDesde');" maxlength="10"  id="txtDesde" name="txtDesde" disabled="true"/>
                </div>
               <div style="width: 5%; float: left;" id="DivTextCalD">

                </div>
             
                <div style="width: 9%; float: left; " id="divEtiquetaHasta">
                        Hasta*:
                </div>
                <div style="width: 21%; float: left;" id="DivTextHasta">
                    <input type="text" size="12" value="" onblur="esFechaValida(this);" onclick="calendarioHtmlx('txtHasta');" maxlength="10"  id="txtHasta" name="txtHasta"  disabled="true"/>
                </div>
               <div style="width: 5%; float: left;" id="DivTextCalH">

                </div>
               <div style="width: 28%; float: left; visibility: hidden" id="DivBtnGrabar">
                    <a href="javascript:validaAccionCategoria();">
                     <img border="0" id="btnGrabar" alt="" src="../../../../fastmedical_front/imagen/btn/b_grabar__on.gif"/> </a>
                </div>
               
         </div>
           <div id="dos" style="width: 100%; height: 15%; margin-left: 6%; visibility: hidden ">
                <div style="width: 15%; float: left; " id="divEtiquetaInstitucion">
                        Institución*:
                </div>
                <div style="width: 47%; float: left;" id="DivTextInsitucion">
                    <input type="text" size="12" value="" onkeypress=""  id="txtInstitucion" name="txtInstitucion"  disabled="true" style="width:270px;"/>
                </div>
               <div style="width: 32%; float: left; visibility: hidden" id="DivBtnCancelar">
                    <a href="javascript:disableAccion();">
                    <img border="0" id="btnCancelar" alt="" src="../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif"/> </a>
                </div>
         </div>
           <div id="tres" style="width: 100%; height: 15%; margin-left: 6%; visibility: hidden">
                <div style="width: 15%; float: left; " id="divEtiquetaCargo">
                        Cargo*:
                </div>
                <div style="width: 30%; float: left;" id="DivSelectEstado">
                     <input type="text" size="12" value="" onkeypress=""  id="txtCargo" name="txtCargo"  disabled="true" style="width:270px;"/>
                </div>
         </div>
           <div id="cuatro" style="width: 100%; height: 9%; margin-left: 8%; visibility: hidden">
                <div style="width: 22%; float: left; " id="divEtiquetaFunciones">
                        Funciones/Logros:
                </div>
         </div>
           <div id="cinco" style="width: 100%; height: 15%; visibility: hidden">
                <div style="width: 50%; float: left; margin-left: 9%" id="DivTextFunciones">
                        <textarea name="txtFunciones" rows="2"  id="txtFunciones" disabled="true" style="width:340px; font-family: sans-serif" onfocus="if (this.value==this.defaultValue) this.value='';" onblur="if (this.value=='') this.value=this.defaultValue;" onkeypress=""></textarea>
                </div>
         </div>
       </fieldset>
    </div>
</div>




</form>