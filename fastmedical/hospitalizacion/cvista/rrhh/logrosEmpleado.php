<form id="form_detalle" name="form_detalle" action="">
 <div style="width:99%; margin:1px auto; border: #006600" >
  <div class="titleform" id="divTitulo" >
  </div>
</div>

<div  id ="divLogros" style="width:99%;height:inherit;margin-left:1%;margin-right:1%;overflow:scroll; ">
 <fieldset style="margin:1px;width:98%;height:22px;padding: 0px;">
        <table border="0">
          <tr>
            <td><b>LOGROS</b></td>
          </tr>
        </table>
 </fieldset>
    <div  id ="divDatosLogros" style="width:99%;height:190px;margin-left:1%;margin-right:1%; overflow: auto;">

    </div>
    <div  id ="divEspacioSup" style="width:99%;height:10px;margin-left:1%;margin-right:1%; ">
    </div>
    <div  id ="divBotonesLogros" style="width:99%;height:inherit;margin-left:1%;margin-right:1%; " align="center">
        <fieldset style="margin:1px;width:50%;height:27px;padding: 0px;">

                <div  id ="DivEliminar" style=" float:right;width:33%; visibility: hidden;" align="center">
                        <a href="javascript:enableAccion(3,document.getElementById('txtCategoria').value);">
                        <img border="0" title="" alt="" src="../../../../medifacil_front/imagen/btn/b_eliminar_on.gif"/></a>
                </div>
                <div  id ="DivAgregar" style=" float:right;width:33%;" align="center">
                        <a href="javascript:enableAccion(2,document.getElementById('txtCategoria').value);">
                        <img border="0" title="" alt="" src="../../../../medifacil_front/imagen/btn/b_agregar_on.gif"/></a>
               </div>
               <div  id ="DivEditar" style=" float:right;width:33%; visibility: hidden;" align="center">
                        <a href="javascript:enableAccion(1,document.getElementById('txtCategoria').value);">
                         <img border="0" title="" alt="" src="../../../../medifacil_front/imagen/btn/b_editar_on.gif"/></a>
               </div>

      </fieldset>
    </div>
    <div  id ="divEspacioInf" style="width:99%;height:10px;margin-left:1%;margin-right:1%; ">
    </div>
   <div  id ="divResultadoLogros" style="width:99%;height:260px;margin-left:1%;margin-right:1%; " align="center">
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
               <div style="width: 12%; float: left; " id="divEtiquetaCargo">
                        Logro*:
                </div>
                <div style="width: 50%; float: left;" id="DivSelectEstado">
                     <input type="text" size="12" value="" onkeypress=""  id="txtCargo" name="txtCargo"  disabled="true" style="width:270px;"/>
                </div>              
               <div style="width: 26%; float: left; visibility: hidden" id="DivBtnGrabar">
                    <a href="javascript:validaAccionCategoria();">
                     <img border="0" id="btnGrabar" alt="" src="../../../../medifacil_front/imagen/btn/b_grabar__on.gif"/> </a>
                </div>
               <div style="width: 5%; float: left;" id="DivTextDesde">
                    <input  type="hidden" size="12" value="" onclick="" maxlength="10"  id="txtDesde" name="txtDesde" disabled="true"/>
                </div>

         </div>
           <div id="dos" style="width: 100%; height: 15%; margin-left: 6%; visibility: hidden ">
                <div style="width: 17%; float: left; " id="divEtiquetaInstitucion">
                        Institución*:
                </div>
                <div style="width: 40%; float: left;" id="DivTextInsitucion">
                    <input type="text" size="12" value="" onkeypress=""  id="txtInstitucion" name="txtInstitucion"  disabled="true" style="width:270px;"/>
                </div>
               <div style="width: 42%; float: left; visibility: hidden" id="DivBtnCancelar">
                    <a href="javascript:disableAccion();">
                    <img border="0" id="btnCancelar" alt="" src="../../../../medifacil_front/imagen/btn/b_cancelar_on.gif"/> </a>
                </div>
         </div>
            <div id="cinco" style="width: 100%; height: 11%; margin-left: 10%; visibility: hidden">
               <div style="width: 11%; float: left; " id="divEtiquetaHasta">
                        Fecha*:
                </div>
                <div style="width: 21%; float: left;" id="DivTextHasta">
                    <input type="text" size="12" value="" onblur="esFechaValida(this);" maxlength="10" onclick="calendarioHtmlx('txtHasta');"  id="txtHasta" name="txtHasta"  disabled="true"/>
                </div>
               <div style="width: 5%; float: left;" id="DivTextCalH">

                </div>
         </div>
           <div id="tres" style="width: 100%; height: 12%; margin-left: 6%; visibility: hidden">
                <div style="width: 17%; float: left; " id="divEtiquetaFunciones">
                        Descripción:
                </div>
         </div>
           <div id="cuatro" style="width: 100%; height: 18%; visibility: hidden">
               <div style="width: 50%; float: left; margin-left: 9%" id="DivTextFunciones">
                        <textarea name="txtFunciones" rows="1"  id="txtFunciones" disabled="true" style="width:350px; font-family: sans-serif" onfocus="if (this.value==this.defaultValue) this.value='';" onblur="if (this.value=='') this.value=this.defaultValue;" onkeypress=""></textarea>
                </div>
         </div>
           
       
 </fieldset>
    </div>
</div>




</form>