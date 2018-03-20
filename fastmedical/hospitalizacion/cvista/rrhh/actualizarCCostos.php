<?php
require_once("../../ccontrol/control/ActionRrhh.php");
    $o_ActionRrhh	= new ActionRrhh();
require_once("../../ccontrol/control/ActionPersona.php");
    $o_ActionPersona	= new ActionPersona();
?>

<script  src="../../../javascript/dhtml_tree/dhtmlxcommon.js"></script>
<script  src="../../../javascript/dhtml_tree/dhtmlxtree.js"></script>
<script>
</script>

<div style="width:800px; margin:1px auto; border: #006600 solid">
	<div class="titleform">
        <h1>Actualización del Centro de Costos</h1>
       </div>
       <div  id ="divActCCostos" style="width:99%;margin-left:0.5%;margin-right:0.2%;overflow: hidden;">
         <div  id ="divIzqActCCostos" style=" float:left;width:36%; height:365px;">

           <div  id ="divOpcSupActCCostos" style=" float:left;width:99%; height:340px;">
               <form>
                   <br>
               <fieldset style="margin:1px;width:99%;height:168px;padding: 0px; font-size:14px">
                   <legend>Datos del Item</legend>
                <div style="width: 100%; height: 100%; float: left; margin-left:1%" >
                      <div style="width: 22%; height: 14%; float: left;" id="DivEtiquetaNewHijo">
                              Código:
                      </div>
                      <div style="width: 50%; height: 14%; float: left;" id="DivTextNewHijo">
                              <input type="text" id="txtCodigo" name="txtCodigo" disabled="true" size="12" value="" style="width:100px;">
                      </div>
                      <div style="width: 12%; height: 14%; float: left;" id="DivEtiquetaNivel">
                              Nivel:
                      </div>
                      <div style="width: 12%; height: 14%; float: left;" id="DivTextNivel">
                              <input type="text" id="txtNivel" name="txtNivel" disabled="true" size="12" value="" onkeypress="" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';"  style="width:32px;">
                      </div>
                       <div style="width: 22%; height: 14%; float: left;" id="DivEtiquetaNewHijo">
                              Nombre:
                      </div>
                      <div style="width: 78%; height: 14%; float: left;" id="DivTextNewHijo">
                              <input type="text" id="txtInsertar" name="txtInsertar" disabled="true" size="12" value="" onkeypress="" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';"  style="width:207px;">
                      </div>
                      <div style="width: 22%; height: 14%; float: left;" id="DivEtiquetaInfNewHijo">
                              Abreviatura:
                      </div>
                       <div style="width: 52%; height: 14%; float: left;" id="DivTextInfNewHijo">
                              <input type="text" id="txtAbrev" name="txtAbrev" disabled="true" size="12" value="" onkeypress="" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';"  style="width:128px;">
                      </div>
                      <div style="width: 15%; height: 14%; float: left;" id="DivEtiquetaEstado">
                              Activo:
                      </div>
                      <div style="width: 10%; height: 14%; float: left;" id="DivTextEstado">
                          <input type="checkbox" name="chkEstado" id="chkEstado" disabled="true" onclick="if(this.checked){this.value=1}else{this.value=0;}" value="0">
                      </div>
                      <div style="width: 95%; height: 14%; float: left;" id="DivEtiquetaObservacion">
                              Observaciones:
                      </div>
                      <div style="width: 98%; height: 25%; float: left;" id="DivTextObservacion">
                          <textarea name="txtObservacion" rows="1"  id="txtObservacion" disabled="true" style="width:270px;" onfocus="if (this.value==this.defaultValue) this.value='';" onblur="if (this.value=='') this.value=this.defaultValue;" onkeypress=""></textarea>
                          <input type="hidden" id="txtUltimo" name="txtUltimo" disabled="true" size="12" value="">
                      </div>
                      <div style="width: 40%; height: 20%; visibility:hidden; float: left;" id="divBotonGrabar">
                          <?php
                            if($_SESSION["permiso_formulario_servicio"][203]["GRABAR_CCOSTO"]==1){
                                echo "<a onclick=\"tree.insertNewItem(tree.getSelectedItemId(),generaCodCCHijo(tree.getSelectedItemId(),document.getElementById('txtInsertar').value,document.getElementById('txtAbrev').value, document.getElementById('txtObservacion').value),document.getElementById('txtInsertar').value,0,0,0,0,'SELECT',0);\" href=\"javascript:disableNuevoItem();\">
                                      <img border=\"0\" id=\"btnGrabar\" align=\"right\" alt=\"\" src=\"../../../../medifacil_front/imagen/btn/b_grabar__on.gif\"/></a>";
                            }
                          ?>
                      </div>
                      <div style="width: 20%; height: 5%; visibility:hidden; float: left;" id="divBotonActualizar">
                          <?php
                            if($_SESSION["permiso_formulario_servicio"][203]["ACT_CCOSTO"]==1){
                                echo "<a onclick=\"editaItem(tree.getSelectedItemId(),document.getElementById('txtInsertar').value,document.getElementById('txtAbrev').value,document.getElementById('txtObservacion').value,document.getElementById('txtCodigo').value);\" href=\"javascript:disableNuevoItem();\">
                                      <img border=\"0\" id=\"btnActualizar\" align=\"right\" alt=\"\" src=\"../../../../medifacil_front/imagen/btn/b_actualizar_on.gif\"/></a>";
                            }
                          ?>
                      </div>
                      <div style="width: 30%; height: 15%; visibility:hidden; float: left;"  id="divBotonCancelar">	
                          <?php
                            if($_SESSION["permiso_formulario_servicio"][203]["CANCELAR_CCOSTO"]==1){
                              echo "<a onclick=\"\" href=\"javascript:disableNuevoItem();\">
                                  <img border=\"0\" id=\"btnCancelar\" align=\"left\" alt=\"\" src=\"../../../../medifacil_front/imagen/btn/b_cancelar_on.gif\"/></a>";
                            }
                          ?>
                      </div>
                      <input type="hidden" id="txtArbol" name="txtArbol" disabled="true" size="12" value="" onkeypress=""  style="width:32px;">

                </div>
               </fieldset>
               <fieldset style="margin:1px;width:99%;height:75px;padding: 0px; font-size:14px">
                   <legend>Item de nivel superior</legend>
                   <div style="width: 100%; height: 100%; float: left; margin-left:1%" >
                    <div style="width: 22%; height: 35%; float: left;" id="DivEtiquetaCodP">
                              Código:
                      </div>
                      <div style="width: 50%; height: 35%; float: left;" id="DivTextP">
                              <input type="text" id="txtCod" name="txtCod" disabled="true" size="12" value="" style="width:100px;">
                      </div>
                      <div style="width: 12%; height: 35%; float: left;" id="DivEtiquetaNivelP">
                              Nivel:
                      </div>
                      <div style="width: 12%; height: 35%; float: left;" id="DivTextNivelP">
                              <input type="text" id="txtNiv" name="txtNiv" disabled="true" size="12" value="" style="width:32px;">
                      </div>
                       <div style="width: 22%; height: 35%; float: left;" id="DivEtiquetaNomP">
                              Nombre:
                      </div>
                      <div style="width: 78%; height: 35%; float: left;" id="DivTextDescP">
                              <input type="text" id="txtDesc" name="txtDesc" disabled="true" size="12" value="" style="width:207px;">
                      </div>
                     </div>
               </fieldset>
                   <b>Seleccione un Centro de Costo para habilitar las opciones: </b>
               <fieldset style="margin:1px;width:99%;height:50px;padding: 0px; font-size:14px">
                   <legend>.</legend>
                  <div style="width: 100%; height: 100%; float: left; margin-left:1%" >
                       <div style="width: 25%; float: left; visibility:hidden;" id="divBotonNew">
                           <?php
                                if($_SESSION["permiso_formulario_servicio"][203]["AGREGAR_CCOSTO"]==1){
                                    echo "<a onclick=\"\" href=\"javascript:enableNuevoItem(1);\"><img border=\"0\" alt=\"\" src=\"../../../../medifacil_front/imagen/btn/b_agregar_cc.gif\"/></a>";
                                }
                            ?>
                      </div>

                      <div style="width: 25%; float: left; visibility:hidden;" id="divBotonEditar">
                           <?php
                                if($_SESSION["permiso_formulario_servicio"][203]["EDITAR_CCOSTO"]==1){
                                    echo "<a onclick=\"\" href=\"javascript:enableNuevoItem(2);\"><img border=\"0\" title=\"Centro Costos\" alt=\"\" src=\"../../../../medifacil_front/imagen/btn/b_editar_on.gif\"/></a>";
                                }
                           ?>

                      </div>
                      <div style="width: 25%; float: left; visibility:hidden; " id="divBotonEliminar">
                           <?php
                                if($_SESSION["permiso_formulario_servicio"][203]["ELIMINAR_CCOSTO"]==1){
                                     echo "<a  onclick=\"eliminaItem(tree.getSelectedItemId(),tree.getItemText(tree.getSelectedItemId())); tree.deleteItem(tree.getSelectedItemId(),false);\" href=\"javascript:void(0);\">
                                     <img border=\"0\" alt=\"\" src=\"../../../../medifacil_front/imagen/btn/b_eliminar_on.gif\"/></a>";
                                }
                           ?>
                     </div>
                     <div style="width: 24%; float: left; " id="divBotonLimpiar">
                         <?php
                            if($_SESSION["permiso_formulario_servicio"][203]["LIMPIAR_CCOSTO"]==1){
                              echo "<a onclick=\"\" href=\"javascript:limpiaDatos();\">
                                 <img border=\"0\" alt=\"\" src=\"../../../../medifacil_front/imagen/btn/b_limpiar.gif\"/></a>";
                            }
                         ?>
                     </div>
                  </div>
               </fieldset>

                </form>

           </div>

           <div  id ="divOpcInfActCCostos" style=" float:left;width:99%; height:25px;">
           </div>
         </div>

          <div  id ="divDerActCCostos" style=" float:right;width:64%;">
            <div  id ="divDerSupActCCostos" style=" width:99%;" align="center" >
            <fieldset style="margin:1px;width:90%;height:22px;padding: 0px; font-size:14px">
            <b>Menú de los Centros de Costos</b>
                    <div style="width: 15%; float: right; background-color: #7CC434;" id="divBotonActivo">
                         <?php
                                if($_SESSION["permiso_formulario_servicio"][203]["MOSTRAR_ACTIVO_CCOSTO"]==1){
                                     echo "<a onclick=\"\" href=\"javascript:seleccionarArbolCCostos();\">
                                     <img border=\"0\" alt=\"\" src=\"../../../../medifacil_front/imagen/btn/btn_ArbolActivo.gif\"/></a>";
                                }
                         ?>

                     </div>
                     <div style="width: 15%; float: right; background-color: #7CC434;" id="divBotonTodo">
                         <?php
                                if($_SESSION["permiso_formulario_servicio"][203]["MOSTRAR_TODO_CCOSTO"]==1){
                                    echo "<a onclick=\"tree.enableThreeStateCheckboxes(-1);\" href=\"javascript:seleccionarArbolCCostosCompleto();\">
                                        <img border=\"0\" alt=\"\" src=\"../../../../medifacil_front/imagen/btn/btn_ArbolTodo.gif\"/></a>";
                                }
                         ?>
                     </div>
            </fieldset>

            </div>
              <div id="menuActCCostos" style=" height:650px; width:99%; margin-left:2px;">
                  <?php $resultadoArray=$o_ActionRrhh->verItemCC(tree.getSelectedItemId());?>
              </div>

          </div>
         </div>

</div>