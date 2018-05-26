<?php
require_once("../../ccontrol/control/ActionRrhh.php");
?>

<div style="width:900px; margin:1px auto; border: #006600 solid">
	<div class="titleform">
        <h1>Mantenimiento de Documentos por Puesto</h1>
       </div>
       <div  id ="divMantDocumentos" style="width:99%;margin-left:0.5%;margin-right:0.2%;overflow: hidden;">
           <div  id ="divIzqMantDocumentos" style=" float:left;width:40%; ">
                <div  id ="divIzqSupMantDocumentos" style=" width:100%;" align="center" >
                    <div style="height: 70px; width: 93%" id="toolbar">
                        <input type="hidden"   id="hCcosto" name="hCcosto" value="1"/>
                        <div style="width: 100%; height: 35%;">
                                <div style="width: 20%; float: left;" id="divEtiquetaPuesto">
                                        Puesto:
                                </div>
                                <div style="width: 80%; float: left;" id="DivTextPuesto">
                                        <input type="text" size="30" value="Buscar..." onkeypress="verPuestosDocumento('x',event,'detallePuestoCentro');"  onfocus="if (this.value==this.defaultValue) this.value='';"  id="txtPuesto" name="txtPuesto"/>
                                </div>
                        </div>
                         <div style="width: 100%; height: 35%;">
                                <div style="width: 20%; float: left;" id="divEtiquetaNroOrden">
                                        Categoria:
                                </div>
                                <div style="width: 60%; float: left;" id="DivSelectTipoDoc">
                                    <select name="select" id="comboCategoriaPuestos" style="width:150px; font-size:9px" >
                                    <?php
                                    echo $comboHTML;
                                    ?>
                                   </select>
                                </div>
                         </div>
                        <div style="width: 100%; height: 30%;">
                                <div style="width: 20%; float: left;" id="divEtiquetaNroOrden">
                                        Estado:
                                </div>
                                <div style="width: 30%; float: left;" id="DivSelectTipoDoc">
                                     <select name="select" id="comboEstados" style="width:60px; font-size:9px" >
                                         <option value="1">Todos</option>
                                         <option value="2">Activos</option>
                                         <option value="3">Inactivos</option>
                                    </select>
                                </div>
                                <div style=" width: 30%; float: left; margin-left: 20px;" id="DivBuscar" >
                                        <a href="javascript:verPuestosDocumento('x','','detallePuestoCentro');"><img border="0" title="Codigo de Persona" alt="" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif"/></a>
                                </div>
                         </div>
                </div>
              </div>
              <div  id ="divIzqInfMantDocumentos" style=" width:100%;" >
                 <div style=" width:98%;">
                 </div>
                      <form>
                           <div  id ="divIzqInfPuestosCCostos" style=" width:100%;" >
                                <div  id ="divOpcPtoDocumento" style=" float:left;width:99%; height:250px;">

                                </div>
                           </div>
                       </form>
                    <div  id ="divPuestos" style=" float:left;width:100%; height:200px; overflow: auto;">
                        <?Php
                        echo $tablaPuestosB;
                        ?>                            
                    </div>
              </div>
            </div>
           <div  id ="divDerMantDocumentos" style="width:60%; float: right" align="center">
                <div  id ="divDerSupMantDocumentos" style=" width:99%;" align="center" >
                    <input type="hidden" id="hPuesto" name="hPuesto" size="12" value="">
                    <input type="hidden" id="hNombre" name="hNombre" size="12" value="">
                    <div id="divTitulo" class="titleform" style="border: 0px solid rgb(0, 0, 0); width: 100%;">

                    </div>
                  <fieldset style="margin:1px;width:95%;height:230px; font-size:14px">
                       <div id="divdetallePuestoDocumento" style=" height:95%; width:99%; float: left; margin-left:5px; overflow: auto;">
                        <?Php
                        echo $tablaPuestoDocumentos;
                        ?>                           
                        </div>                      
                  </fieldset>
                   <fieldset style="margin:1px;width:30%;height:30px;padding: 0px; font-size:14px">
                        <a href="javascript:agregarDocumentoPuesto();">
                        <img border="0" title="Agregar Documentos" alt="" src="../../../../fastmedical_front/imagen/btn/b_agregar_on.gif"/></a>
                    </fieldset>
                   <fieldset style="margin:1px;width:95%;height:230px;padding: 0px; font-size:14px">

                           <div style="width: 99%; height: 6%; float: left;" id="DivEtiquetaTitulo" align="center">
                               <b>LISTADO DE DOCUMENTOS</b>
                           </div>

                           <div id="divdetalleDocumentos" style=" height:90%; width:99%; float: left; margin-left:5px; overflow: auto;">
                            <?Php
                            echo $tablaDocumentos;
                            ?>
                            </div>

                   </fieldset>
              </div>

          </div>
         </div>

</div>