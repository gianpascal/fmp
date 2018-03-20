<div align="center">
    <table>
        <tr align="center" >
            <td>
                <div class="titleform" id="divCabeceraConsultaEstadoExamenes"style="width:100%; height:100%;background-color: #D6E9FE; color: #770088">
                    <h1>CONSULTA DE ESTADO DE EXAMENES</h1>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 1210px;background: #D6E9FE">
                    <tr>
                        <td align="right">Código:&nbsp;</td>
                        <td><input type="text" name="txtCodigo" id="txtCodigo" value="" onkeypress="enfocarCampos(id,event);" onfocus="limpiarCamposConsultaEstado('01',this,event)" onkeydown="limpiarCamposConsultaEstado('01',this,event);"/></td>
                         <td align="right">Cod Bar:&nbsp;</td>
                        <td><input type="text" name="txtCodBar" id="txtCodBar" value="" onkeypress="enfocarCampos(id,event);" onfocus="limpiarCamposConsultaEstado('02',this,event)"  onkeydown="limpiarCamposConsultaEstado('02',this,event)" /></td>
                        <td align="right">Tipo Doc:&nbsp;</td>
                        <td>
                            <select name="select" id="comboTipoDocumentos" style="width:100%; font-size:9px" onkeypress="enfocarCampos(id,event);">
                                <?php
                                echo $comboTipoDocumentos;
                                ?>
                            </select>
                        </td>
                       <td align="right">Nro Doc:&nbsp;</td>
                        <td><input type="text" name="txtNroDoc" id="txtNroDoc" value="" onkeypress="enfocarCampos(id,event);" onfocus="limpiarCamposConsultaEstado('03',this,event); " onkeydown="limpiarCamposConsultaEstado('03',this,event)" /></td>
                        
                        <td align="right">Fecha:&nbsp;</td>
                        <td><input type="text" onkeypress="enfocarCampos(id,event)" onfocus="estadoCambioFechasConsultaLaboratorio('0')" maxlength="10"  onclick="calendarioHtmlx('txtFechaIni')" size="20" id="txtFechaIni" name="txtFechaIni"></td>
                        <td><img id="imgBuscar" border="0" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif" alt="" title="Codigo de Persona" onclick="buscarConsultaEstadoExamen()"></td>                    
                    </tr>
                    <tr>
                        <td align="right">Ape Pat:&nbsp;</td>
                        <td><input type="text" name="txtApePat" id="txtApePat" value="" onkeypress="enfocarCampos(id,event);" onfocus="limpiarCamposConsultaEstado('04',this,event)" onkeydown="limpiarCamposConsultaEstado('04',this,event)" /></td>
                       <td align="right">Ape Mat:&nbsp;</td>
                        <td><input type="text" name="txtApeMat" id="txtApeMat" value="" onkeypress="enfocarCampos(id,event);" onfocus="limpiarCamposConsultaEstado('04',this,event)" onkeydown="limpiarCamposConsultaEstado('04',this,event)" /></td>
                          <td align="right">Nombre:&nbsp;</td>
                        <td><input type="text" name="txtNombre" id="txtNombre" value="" onkeypress="enfocarCampos(id,event);" onfocus="limpiarCamposConsultaEstado('04',this,event)"  onkeydown="limpiarCamposConsultaEstado('04',this,event)" /></td>  
                        <td align="right"></td>
                        <td></td>  
                        <td align="right"></td>
                        <td>
<!--                            <input type="text" onfocus="estadoCambioFechasConsultaLaboratorio('1')" maxlength="10" onkeypress="return validar(event,4)" onclick="calendarioHtmlx('txtFechaFinal')" size="20" id="txtFechaFinal" name="txtFechaFinal">-->
                        </td>
                        <td><img border="0" src="../../../../medifacil_front/imagen/btn/btn_limpiar.gif" alt="" title="Limpiar" onclick="limpiarCamposConsultaEstado(0,'','')"></td>                       
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 1210px">
                    <tr align="center" >
                        <td>
                            <div class="titleform" id="divCaberaEstadoExamenes"style="width:100%; height:100%;background-color: #D6E9FE; color: #770088">
                                <h1>ESTADO DE EXAMENES</h1>
                            </div>
                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                            <div id="divTablaEstadoExamenes" align="center" style="width:1210px; height:450px;"></div>
                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                            <div id="divBotonesEstadoExamen" align="center" style="width:520px; height:30px;margin-left: 45%">
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>