<form id="form_detalle" name="form_detalle" action="">
 <div style="width:99%; margin:1px auto; border: #006600" >
  <div class="titleform" id="divTitulo" >
  </div>
</div>

<div  id ="divIdiomas" style="width:99%;height:inherit;margin-left:1%;margin-right:1%;overflow:scroll; ">
 <fieldset style="margin:1px;width:98%;height:22px;padding: 0px;">
        <table border="0">
          <tr>
            <td><b>IDIOMAS</b></td>
          </tr>
        </table>
 </fieldset>
    <div  id ="divDatosIdiomas" style="width:98%;height:190px;margin-left:1%;margin-right:1%; overflow: auto;">

    </div>
    <div  id ="divEspacioSup" style="width:99%;height:10px;margin-left:1%;margin-right:1%; ">
    </div>
    <div  id ="divBotonesIdiomas" style="width:99%;height:inherit;margin-left:1%;margin-right:1%; " align="center">
         <fieldset style="margin:1px;width:50%;height:27px;padding: 0px;">

                <div  id ="DivEliminar" style=" float:right;width:33%; visibility: hidden;" align="center">
                        <a href="javascript:enableAccion(3,document.getElementById('txtCategoria').value);">
                        <img border="0" title="" alt="" src="../../../../fastmedical_front/imagen/btn/b_eliminar_on.gif"/></a>
                </div>
                <div  id ="DivAgregar" style=" float:right;width:33%;" align="center">
                        <a href="javascript:enableAccion(2,document.getElementById('txtCategoria').value);">
                        <img border="0" title="" alt="" src="../../../../fastmedical_front/imagen/btn/b_agregar_on.gif"/></a>
               </div>
               <div  id ="DivEditar" style=" float:right;width:33%; visibility: hidden;" align="center">
                        <a href="javascript:enableAccion(1,document.getElementById('txtCategoria').value);">
                         <img border="0" title="" alt="" src="../../../../fastmedical_front/imagen/btn/b_editar_on.gif"/></a>
               </div>

      </fieldset>
    </div>
    
   <div  id ="divResultadoIdiomas" style="width:90%;height:inherit;margin:1% auto; " align="center">
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
          <div id="uno" style="width: 100%; height: 15%; margin-left: 7%; visibility: hidden;" >                
                <div style="width: 11%; float: left;" id="DivTextDesde">
                    <input  type="hidden" size="12" value="" onclick=""  id="txtDesde" name="txtDesde" disabled="true"/>
                </div>
               <div style="width: 14%; float: left; " id="divEtiquetainstitucion" align="right">
                        Institucion*:
                </div>
               <div style="width: 19%; float: left; " id="DivSelectInstitucion">
                   <select name="select" id="txtInstitucion" style="width:90px; font-size:10px" onchange="">
                            <?php
                            echo $comboInstitucion;
                            ?>
                    </select>
               </div>
               <div style="width: 25%; float: left; visibility: hidden" id="DivBtnGrabar">
                     <a href="javascript:validaAccionCategoria();">
                     <img border="0" id="btnGrabar" alt="" src="../../../../fastmedical_front/imagen/btn/b_grabar__on.gif"/> </a>
                </div>

         </div>
           <div id="dos" style="width: 100%; height: 15%; margin-left: 9%; visibility: hidden ">
               <div style="width: 13%; float: left; " id="divEtiquetaEspecialidad" align="right">
                        Idioma*:
                </div>
                <div style="width: 20%; float: left;" id="DivTextEspecialidad">

                    <select name="select" id="comboEspecialidad" style="width:110px; font-size:10px" onchange="">
                            <?php
                            echo $comboEspecialidad;
                            ?>
                     </select>
                </div>
               <div style="width: 21%; float: left; " id="DivSelectTipoEstudio">
                   <input  type="hidden" size="12" value="" onclick=""  id="comboTipoEstudio" name="comboTipoEstudio" disabled="true"/>
                </div>
               
               <div style="width: 28%; float: left; visibility: hidden" id="DivBtnCancelar">
                    <a href="javascript:disableAccion();">
                    <img border="0" id="btnCancelar" alt="" src="../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif"/> </a>
                </div>
         </div>
           <div id="tres" style="width: 100%; height: 15%; margin-left: 6%; visibility: hidden">
              <input  type="hidden" size="12" value="" onclick=""  id="DivSelectProfesion" name="DivSelectProfesion" disabled="true"/>
               <div style="width: 14%; float: left; " id="divEtiquetaNivel" align="right">
                        Nivel*:
                </div>
                
                <div style="width: 14%; float: left;" id="DivSelectNivel">
                     <select name="select" id="comboTipoNivel" style="width:80px; font-family: sans-serif " onchange="">
                            <?php
                            echo $comboTipoNivel;
                            ?>
                      </select>
                </div>
              <div style="width: 7%; float: left;" id="DivTextNivel">
                    <input type="text" size="12" value="" onkeypress=""  id="txtNivel" name="txtNivel"  disabled="true" style="width:20px;"/>
                </div>
        </div>
           <div id="cuatro" style="width: 100%; height: 15%; margin-left: 6%; visibility: hidden">
               <div style="width: 15%; float: left; " id="divEtiquetaCargo" align="right">
                        Estado*:
                </div>
                <div style="width: 21%; float: left;" id="DivSelectEstado">
                    <select name="select" id="comboEstado" style="width:110px; font-size:10px" onchange="">
                            <?php
                            echo $comboEstadoEstudio;
                            ?>
                   </select>
                </div>
               <div style="width: 13%; float: left; " id="divEtiquetaHasta" align="right">
                        Fecha*:
                </div>
                <div style="width: 21%; float: left;" id="DivTextHasta">
                    <input type="text" size="12" value="" onblur="esFechaValida(this);" onclick="calendarioHtmlx('txtHasta');" onfocus="calendarioHtmlx('txtHasta');" id="txtHasta" name="txtHasta"  disabled="true"/>
                </div>
               <div style="width: 5%; float: left;" id="DivTextCalH">

                </div>
             
         </div>
           <div id="cinco" style="width: 100%; height: 15%; margin-left: 2%; visibility: hidden">
               <input  type="hidden" size="12" value="" onclick=""  id="txtCargo" name="txtCargo" disabled="true"/>
              <div style="width: 16%; float: left; " id="divEtiquetaObservacion" align="right">
                        Observación:
                </div>
                <div style="width: 59%; float: left;" id="DivSelectObservacion">
                     <textarea name="txtFunciones" rows="1"  id="txtFunciones" disabled="true" style="width:300px; font-family: sans-serif" onfocus="if (this.value==this.defaultValue) this.value='';" onblur="if (this.value=='') this.value=this.defaultValue;" onkeypress=""></textarea>
                </div>
         </div>
       </fieldset>
    </div>
</div>




</form>