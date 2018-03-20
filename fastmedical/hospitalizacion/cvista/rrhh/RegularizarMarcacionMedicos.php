<?php
require_once("../../../pholivo/Html1.php");
require_once("../../../pholivo/Html.php");
require_once("../../clogica/LRrhh.php");
require_once("../../clogica/LCronograma.php");
require_once("../../../pholivo/tablaDHTMLX.php");
require_once("ActionAdmision.php");
require_once("ActionPersona.php");
$o_LPersona = new ActionPersona();
$funcion = '';
$comboTipoDocumentos = $o_LPersona->comboTipoDocumento('1');
?>
<input name="txthidCodigoPersona" type="hidden" id="txthidCodigoPersona" />
<div style="width: 100%;border:3px;border-color: #000000;margin-top:0px;margin-bottom:0px;margin-left: 0px;margin-right: 0px;min-height:680px;padding:0px;">
    <div class="titleform" style="width:100%;">
        <h1>REGULARIZACION MEDICO</h1>
    </div>
    <div id="divConsulta" style="width:1000px; height:100%;  margin:1px auto;">
        <div id="divBusquedaPersonas" style="width:1000px; float: left" >
            <div id="divBusquedaDatos" style="width:260px;  height:300px;float:left;  ">
                <div style="height: 320px; width: 230px;" id="toolbar">

                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaCodigo">
                            Código:
                        </div>
                        <div style="float: left;" id="DivTextCodigo">
                            <input type="text" style="width:120px;" value="Buscar..." onkeypress="limpiaBusquedasMedicos('01',this,event);return validFormSalt('nro', this, event, 'imgbusqueda');" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" maxlength="7" id="txtCodigo" name="txtCodigo"/>
                        </div>
                    </div>
                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaEstado">
                            Estado:
                        </div>
                        <div style=" float: left;" id="DivSelectEstado">
                            <select  style="width: 120px; font-size: 9px;" id="comboTipoEstados" name="selectE">

                                <option  value="2" >Todos</option>
                                <option selected="selected" value="1" onclick="limpiaBusquedasMedicos('02',this,'1');">Activos</option>
                                <option value="0" onclick="limpiaBusquedasMedicos('02',this,'1');">Inactivos</option>
                            </select>
                        </div>
                    </div>
                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left; " id="divEtiquetaTipoDoc">
                            Tipo Doc:
                        </div>
                        <div style=" float: left;" id="DivSelectTipoDoc">
                            <select name="select" id="comboTipoDocumentos" style="width:120px; font-size:9px" onchange="validaTxtNroDocBuscar();">
                                <?php
                                echo $comboTipoDocumentos;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaNroDoc">
                            Nro Doc:
                        </div>
                        <div style="float: left;" id="DivTextDoc">
                            <input type="text" style="width:120px;" value="Buscar..."
                                   onkeypress="limpiaBusquedasMedicos('03',this,event);"
                                   onblur="if (this.value=='') this.value=this.defaultValue;"
                                   onfocus="if (this.value==this.defaultValue) this.value='';" id="nroDoc" maxlength="8" name="txtDoc"/>
                        </div>
                    </div>
                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaApePat">
                            Ape. Pat:
                        </div>
                        <div style="float: left;" id="DivtextApePat">
                            <input type="text" style="width:120px;" value="" onkeypress="limpiaBusquedasMedicos('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="apellidoPaterno" name="textfield3"/>
                        </div>
                    </div>
                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaApeMat">
                            Ape. Mat:
                        </div>
                        <div style=" float: left;" id="DivTextapeMat">
                            <input type="text" style="width:120px;" value="" onkeypress="limpiaBusquedasMedicos('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="apellidoMaterno" name="textfield4"/>
                        </div>
                    </div>
                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaNombre">
                            Nombre:
                        </div>
                        <div style="float: left;" id="DivtextNombre">
                            <input type="text" style="width:120px;" value="" onkeypress="limpiaBusquedasMedicos('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="nombres" name="textfield5"/>
                        </div>
                    </div>

                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaNombre">
                            F. Inicial:
                        </div>
                        <div style="float: left;" id="DivtextNombre">
                            <input name="txtFechaIni" type="text" id="txtFechaIni" size="10" onclick="calendarioHtmlx('txtFechaIni')" onkeypress="return validar(event,4)" maxlength="10" onfocus="estadoCambioFechas('0')"  />
                        </div>
                    </div>
                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaNombre">
                            F. Final:
                        </div>
                        <div style="float: left;" id="DivtextNombre">
                            <input name="txtFechaFinal" type="text" id="txtFechaFinal" size="10" onclick="calendarioHtmlx('txtFechaFinal')" onkeypress="return validar(event,4)" maxlength="10" onfocus="estadoCambioFechas('1')" />
                        </div>
                    </div>

                </div>
            </div>
            <div id="divBusquedaCC" style="width:400px;  height:360px;float: left;">
                <div style="height: 320px; width: 370px;" id="toolbar">
                    <div id="divCCostosMedicos" style="height:318px;width: 365px;overflow:scroll; ">

                    </div>
                </div>
            </div>
            <div align="center" id="divTablaResultado" style="width:1100px;height: 820px; float:left; border-radius:0px;clear:both;"  >  
                <table align="center">
                    <tr style="width:1100px;" align="center">
                        <td style="width:370px;" >

                        </td>
                        <td align="center">
                            <div align="center" id="divTablaResultadosMedicos" style="width:650px;height: 180px; border:1px solid #8EAA86; border-radius:5px;clear:both;"  >
                            </div>  
                        </td>
                        <td style="width:370px;">

                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div id="divTablaMedicosPuestos" style="width:1000px;height: 380px; float:left;border:1px solid #8EAA86; border-radius:5px;clear:both;"  >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
<!--                            <div id="div_tablaXEmpleadosRegulados" style="width:1000px;height: 300px;float:left;border:1px solid #8EAA86; border-radius:5px;float: left;clear:both;margin-bottom: 15px ">         
                            </div>-->
                        </td>
                    </tr>
                </table>

            </div>


        </div>

    </div>
</div>

