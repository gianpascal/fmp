<?php
require_once("../../ccontrol/control/ActionRrhh.php");
$o_ActionRrhh	= new ActionRrhh();
?>

<div style="width:700px; margin:1px auto; border: #006600 solid">
	<div class="titleform">
        <h1>Mantenimiento de Documentos</h1>
       </div>
       <div  id ="divMantDocumentos" style="width:99%;margin-left:0.5%;margin-right:0.2%;overflow: hidden;">
           <div  id ="divDerMantDocumentos" style="width:99%;" align="center">
            <div  id ="divDerSupMantDocumentos" style=" width:99%;" align="center" >
            <fieldset style="margin:1px;width:90%;height:22px;padding: 0px; font-size:14px">
            <b>Búsqueda de Documentos</b>                    
            </fieldset>

            </div>
              <div id="menuMantDocumentos" style=" height:650px; width:99%; margin-left:2px;">
                  

                <?php
              $arrayParametros['funcionDocumento']='documentoDetalle';
              $o_ActionRrhh->buscadorDocumentos($arrayParametros);
                ?>

            <fieldset style="margin:1px; margin-top:5px; width:99%;height:30px;padding: 0px; font-size:14px">
                      <div id="divBotonesDocumento1" style=" height:9%; width:50%; float: left; margin-left:5px;">
                          <a href="javascript:agregarDocumento();">
                          <img id="btnAgregar" border="0" title="Agregar Documentos" align="right" alt="" src="../../../../medifacil_front/imagen/btn/b_agregar_on.gif"/></a>
                          <a href="javascript:editaDocumento();">
                          <img id="btnActual" border="0" style=" visibility:hidden " align="right" src="../../../../medifacil_front/imagen/btn/b_editar_on.gif" alt="" title="Editar Documentos"/></a>
                          
                      </div>
                      <div id="divBotonesDocumento2" style=" height:9%; width:40%; float: left; margin-left:5px;">
                          <a href="javascript:disableEditar(1);" onclick="">
                          <img id="btnCancelar" border="0" style=" visibility:hidden " align="right" src="../../../../medifacil_front/imagen/btn/b_cancelar_on.gif" alt=""/></a>
                          <a href="javascript:editarDocumento(document.getElementById('txtNombre').value);" onclick=" ">
                          <img id="btnActualizar" border="0" style=" visibility:hidden " align="right" src="../../../../medifacil_front/imagen/btn/b_grabar__on.gif" alt="" title="Editar Documentos"/></a>
                      </div>
               </fieldset>
               <fieldset style="margin:1px;width:90%;height:22px;padding: 0px; font-size:14px">
                <b>Detalle de Atributos</b>
                </fieldset>
               <fieldset style="margin:1px;width:99%;height:350px;padding: 0px; font-size:14px">

                   <div style="width: 100%; height: 28%; float: left; margin-left:1%" >
                      <div style="width: 14%; height: 28%; float: left;" id="DivEtiquetaCodD">
                             Código:
                      </div>
                      <div style="width: 35%; height: 28%; float: left;" id="DivTextCodD">
                              <input type="text" id="txtCDocumento" name="txtCDocumento" disabled="true" size="12" value="" style="width:200px;">
                      </div>
                      <div style="width: 14%; height: 28%; float: left;" id="DivEtiquetaEstado">
                             Estado:
                      </div>
                      <div style="width: 35%; height: 28%; float: left;" id="DivTextEstado">
                              <input type="text" id="txtEstado" name="txtEstado" disabled="true" size="12" value="" style="width:200px;">
                      </div>
                      <div style="width: 14%; height: 28%; float: left;" id="DivEtiquetaNombre">
                             Nombre:
                      </div>
                      <div style="width: 84%; height: 28%; float: left;" id="DivTextNombre">
                              <input type="text" id="txtNombre" name="txtNombre" disabled="true" size="12" value="" style="width:526px;">
                      </div>
                      
                       <div style="width: 92%; height: 28%; float: left;" id="DivEtiquetaTitulo" align="center">
                           <b>ATRIBUTOS</b>
                       </div>
                    </div>
                       <div id="divdetalleAtributo" style=" height:60%; width:99%; float: left; margin-left:5px; overflow: auto;">
                        <?Php
                        echo $tablaAtributos;
                        ?>
                        </div>
                      <div id="divdetalleAtributo" style=" height:9%; width:99%; float: left; margin-left:5px; overflow: auto;">
                          <a href="javascript:agregarAtributo(document.getElementById('hDocumento').value);">
                          <img border="0" title="Agregar Atributos" alt="" src="../../../../medifacil_front/imagen/btn/b_agregar_on.gif"/></a>
                      </div>
               </fieldset>
              </div>

          </div>
         </div>

</div>