<?php
require_once("../../ccontrol/control/ActionRrhh.php");
?>

<div style="width:700px; margin:1px auto; border: #006600 solid">
	<div class="titleform">
        <h1>Mantenimiento de Profesiones</h1>
       </div>
       <div  id ="divMantProfesiones" style="width:99%;margin-left:0.5%;margin-right:0.2%;overflow: hidden;">
           <div  id ="divDerMantprofesiones" style="width:99%;" align="center">
            <div  id ="divDerSupMantProfesiones" style=" width:99%;" align="center" >
            <fieldset style="margin:1px;width:90%;height:22px;padding: 0px; font-size:14px">
            <b>Búsqueda de Profesiones</b>
            </fieldset>

            </div>
              <div id="menuMantProfesiones" style=" height:650px; width:99%; margin-left:2px;">
                  <fieldset style="margin:1px;width:99%;height:250px;padding: 0px; font-size:14px">

                   <div style="width: 100%; height: 15%; float: left; margin-left:1%" >
                    <div style="width: 22%; height: 35%; float: left;" id="DivEtiquetaCodP">
                              Nombre de Profesión:
                      </div>
                      <div style="width: 49%; height: 35%; float: left;" id="DivTextP">
                          <input onkeypress="javascript:buscarProfesiones(document.getElementById('txtProfesion').value,this,event);" type="text" id="txtProfesion" name="txtProfesion" size="12" value="" style="width:350px;">
                              <input type="hidden" id="hProfesion" name="hProfesion" size="12" value="">
                      </div>

                       <div style="width: 20%; height: 35%; float: left;" id="DivEtiquetaNomP">
                             <a href="javascript:buscarProfesiones(document.getElementById('txtProfesion').value,'','');">
                             <img border="0" title="Buscador de Profesiones" alt="" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif"/></a>
                      </div>
                    </div>
                       <div id="divdetalleProfesion" style=" height:70%; width:99%; float: left; margin-left:5px; overflow: auto;">
                        <?Php
                        echo $tablaProfesiones;
                        ?>
                        </div>
                      <div id="divBotonesProfesion1" style=" height:9%; width:60%; float: left; margin-left:5px;">
                          <a href="javascript:agregarProfesion();">
                          <img id="btnAgregar" border="0" title="Agregar Profesiones" align="right" alt="" src="../../../../medifacil_front/imagen/btn/b_agregar_on.gif"/></a>
                          <a href="javascript:editaProfesion();">
                          <img id="btnActual" border="0" style=" visibility:hidden " align="right" src="../../../../medifacil_front/imagen/btn/b_editar_on.gif" alt="" title="Editar Documentos"/></a>
                      </div>
                      <div id="divBotonesProfesion2" style=" height:9%; width:36%; float: left; margin-left:5px;">
                          <a href="javascript:disableEditar(2);" onclick="">
                          <img id="btnCancelar" border="0" style=" visibility:hidden " align="right" src="../../../../medifacil_front/imagen/btn/b_cancelar_on.gif" alt=""/></a>
                          <a href="javascript:editarProfesion(document.getElementById('txtNombre').value);" onclick=" ">
                          <img id="btnActualizar" border="0" style=" visibility:hidden " align="right" src="../../../../medifacil_front/imagen/btn/b_grabar__on.gif" alt="" title="Editar Documentos"/></a>
                          <input type="hidden" id="txtNombre" name="txtNombre" style=" width: 200px;  " size="12" value="">
                          <div style="width: 5%; float: left; visibility: hidden " id="DivEtiqueta" align="center">
                          Nombre:</div>
                      </div>
               </fieldset>
               <fieldset style="margin:1px;width:90%;height:22px;padding: 0px; font-size:14px">
                <b>Lista de Especialidades</b>
                </fieldset>
               <fieldset style="margin:1px;width:99%;height:350px;padding: 0px; font-size:14px">                                  

                       <div style="width: 92%; height: 8%; float: left;" id="DivEtiquetaTitulo" align="center">
                       </div>                   
                       <div id="divdetalleEspecialidad" style=" height:82%; width:99%; float: left; margin-left:5px; overflow: auto;">
                        </div>
                      <div id="divdetalleEspecialidades" style=" height:9%; width:99%; float: left; margin-left:5px; overflow: auto;">
                          <a href="javascript:agregarEspecialidad(document.getElementById('hProfesion').value);">
                          <img border="0" title="Agregar Especialidades" alt="" src="../../../../medifacil_front/imagen/btn/b_agregar_on.gif"/></a>
                      </div>
               </fieldset>
              </div>

          </div>
         </div>

</div>