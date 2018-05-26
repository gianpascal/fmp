<?php
require_once("../../ccontrol/control/ActionRrhh.php");
    $o_ActionRrhh	= new ActionRrhh();
require_once("../../ccontrol/control/ActionPersona.php");
    $o_ActionPersona	= new ActionPersona();
$codTipo="01";
$codInst="";
$disabled="disabled";
$comboEstudio=$o_ActionRrhh->listaEstudios($codTipo,$codInst,$disabled);
$codProf="01";
$codEsp="";
$comboProfesion=$o_ActionRrhh->listaProfesiones($codProf,$codEsp,$disabled);
?>

<form id="form_detalle" name="form_detalle" action="">
 <div style="width:99%; margin:1px auto; border: #006600" >
  <div class="titleform" id="divTitulo" >
  </div>
</div>

<div  id ="divEstudios" style="width:99%;height:inherit;margin-left:1%;margin-right:1%;overflow:scroll; ">
 <fieldset style="margin:1px;width:98%;height:22px;padding: 0px;">
        <table border="0">
          <tr>
            <td><b>ESTUDIOS SUPERIORES</b></td>
          </tr>
        </table>
 </fieldset>
    <div  id ="divDatosEstudios" style="width:98%;height:150px;margin-left:1%;margin-right:1%; overflow: auto;">

    </div>
    <div  id ="divEspacioSup" style="width:99%;height:10px;margin-left:1%;margin-right:1%; ">
    </div>
    <div  id ="divBotonesEstudios" style="width:99%;height:inherit;margin-left:1%;margin-right:1%; " align="center">
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
   
   <div  id ="divResultadoEstudios" style="width:95%;height:260px;margin-left:1%;margin-right:1%; " align="center">
         <fieldset style="margin:1px;width:92%;height:257px;padding: 0px; font-size: larger">

           <div style="width: 100%; height: 2%;">
         </div>
           <table border="0">
                      <tr>
                        <td><b>DETALLE</b></td>
                      </tr>
                    </table>
            <div style="width: 100%; height: 2%;">
         </div>
             <div id="uno" style="width: 100%; height: 13%; margin-left: 7%; visibility: hidden;" >
                <div style="width: 12%; float: left; " id="divEtiquetaDesde" align="right">
                        Inicio*:
                </div>
                <div style="width: 21%; float: left;" id="DivTextDesde">
                    <input  type="text" size="12" value=""  onclick="calendarioHtmlx('txtDesde');" id="txtDesde" name="txtDesde" disabled="true"/>
                </div>
               <div style="width: 5%; float: left;" id="DivTextCalD">

                </div>

                <div style="width: 13%; float: left; " id="divEtiquetaHasta" align="right">
                        Fin*:
                </div>
                <div style="width: 21%; float: left;" id="DivTextHasta">
                    <input type="text" size="12" value="" onclick="calendarioHtmlx('txtHasta');" id="txtHasta" name="txtHasta"  disabled="true"/>
                </div>
               <div style="width: 5%; float: left;" id="DivTextCalH">

                </div>
               <div style="width: 25%; float: left; visibility: hidden" id="DivBtnGrabar">
                     <a href="javascript:validaAccionCategoria();">
                     <img border="0" id="btnGrabar" alt="" src="../../../../fastmedical_front/imagen/btn/b_grabar__on.gif"/> </a>
                </div>
         </div>
           <div id="dos" style="width: 100%; height: 13%; margin-left: 7%; visibility: hidden;">
            
               <div style="width: 70%; float: left; " id="divEtiquetaTipoEstudio" align="right">
             <?php echo $comboEstudio; ?></div>              
              
               <div style="width: 20%; float: left; visibility: hidden" id="DivBtnCancelar">
                    <a href="javascript:disableAccion();">
                    <img border="0" id="btnCancelar" alt="" src="../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif"/> </a>
                </div>
         </div>
             
           <div id="tres" style="width: 100%; height: 25%; margin-left: 6%; visibility: hidden">
             <div style="width: 90%; float: left; " id="divEtiquetaProfesion" align="right">
             <?php echo $comboProfesion; ?></div>
                            
         </div>
           <div id="cuatro" style="width: 100%; height: 13%; margin-left: 6%; visibility: hidden">
               <div style="width: 12%; float: left; " id="divEtiquetaCargo" align="right">
                        Estado*:
                </div>
                <div style="width: 21%; float: left;" id="DivSelectEstado">
                    <select name="select" id="comboEstado" style="width:90px; font-size:10px" onchange="">
                            <?php
                            echo $comboEstadoEstudio;
                            ?>
                   </select>
                </div>
             <div style="width: 15%; float: left; " id="divEtiquetaNivel" align="right">
                        Nivel*:
                </div>
                <div style="width: 7%; float: left;" id="DivTextNivel">
                    <input type="text" size="12" value="" onkeypress=""  id="txtNivel" name="txtNivel"  disabled="true" style="width:20px;"/>
                </div>
                <div style="width: 14%; float: left;" id="DivSelectNivel">
                     <select name="select" id="comboTipoNivel" style="width:80px; font-family: sans-serif " onchange="">
                            <?php
                            echo $comboTipoNivel;
                            ?>
                      </select>
                </div>
         </div>
           <div id="cinco" style="width: 100%; height: 13%; margin-left: 2%; visibility: hidden">
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