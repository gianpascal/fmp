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

<style>
    /*#table_wrapper{background:tomato;border:1px solid olive;float:left;}*/
    /*#tbody{height:80px;overflow-y:auto;width:800px;background:yellow;}*/
    #tablePuesto{border-collapse:collapse; width:100%;}
    #tablePuesto td{padding:1px 5px; /* pixels */
       border-right:1px ; /* to avoid the hacks for the padding */
       border-bottom:1px;} 
    #tablePuesto .td1{width:100px;}
    #tablePuesto .td2{width:140px;}
    #tablePuesto .td3{width:380px;}
    #tablePuesto .td4{width:140px;}
    #tablePuesto .td5{border-right-width:0;} /* optional */

    #header{width:1000px;background:green;border-bottom:1px;}
    #header div{padding:1px 5px;float:left;border-right:1px solid orange;}
    #header #head1{width:100px;} /* the same as td1 */
    #header #head2{width:140px;} /* the same as td2 */
    #header #head3{width:380px;}
    #header #head4{width:140px;} 
    #header #head5{float:none;border-right-width:0} 
</style>
<input name="txthidCodigoPersona" type="hidden" id="txthidCodigoPersona" />
<input name="txthnombreCompleto" type="hidden" id="txthnombreCompleto" />
<input name="hiIdModalidadContrato" type="hidden" id="hiIdModalidadContrato" value=""/>
<input name="hicInd" type="hidden" id="hicInd" value=""/>
<input name="hicodEmpleado" type="hidden" id="hicodEmpleado" value=""/>
<div style="width: 100%;border:3px;border-color: #000000;margin-top:0px;margin-bottom:0px;margin-left: 0px;margin-right: 0px;min-height:680px;padding:0px;">
    <div class="titleform" style="width:100%;">
        <h1>REGULARIZACION HORARIO</h1>
    </div>
    <div id="divConsulta" style="width:1000px; height:100%;  margin:1px auto;" align="center">
        <div id="divBusquedaPersonas" style="width:1000px; float: left" >
            <div id="divBusquedaDatos" style="width:260px;  height:300px;float: left;  ">
                <div style="height: 320px; width: 230px;" id="toolbar">

                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaCodigo">
                            Código:
                        </div>
                        <div style="float: left;" id="DivTextCodigo">
                            <input type="text" style="width:120px;" value="Buscar..." onkeypress="limpiaBusquedasHorarios('01',this,event);return validFormSalt('nro', this, event, 'imgbusqueda');" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" maxlength="7" id="txtCodigo" name="txtCodigo"/>
                        </div>
                    </div>
                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaEstado">
                            Estado:
                        </div>
                        <div style=" float: left;" id="DivSelectEstado">
                            <select  style="width: 120px; font-size: 9px;" id="comboTipoEstados" name="selectE">

                                <option  value="2" >Todos</option>
                                <option selected="selected" value="1" onclick="limpiaBusquedasHorarios('02',this,'1');">Activos</option>
                                <option value="0" onclick="limpiaBusquedasHorarios('02',this,'1');">Inactivos</option>
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
                                   onkeypress="limpiaBusquedasHorarios('03',this,event);"
                                   onblur="if (this.value=='') this.value=this.defaultValue;"
                                   onfocus="if (this.value==this.defaultValue) this.value='';" id="nroDoc" maxlength="8" name="txtDoc"/>
                        </div>
                    </div>
                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaApePat">
                            Ape. Pat:
                        </div>
                        <div style="float: left;" id="DivtextApePat">
                            <input type="text" style="width:120px;" value="" onkeypress="limpiaBusquedasHorarios('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="apellidoPaterno" name="textfield3"/>
                        </div>
                    </div>
                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaApeMat">
                            Ape. Mat:
                        </div>
                        <div style=" float: left;" id="DivTextapeMat">
                            <input type="text" style="width:120px;" value="" onkeypress="limpiaBusquedasHorarios('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="apellidoMaterno" name="textfield4"/>
                        </div>
                    </div>
                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaNombre">
                            Nombre:
                        </div>
                        <div style="float: left;" id="DivtextNombre">
                            <input type="text" style="width:120px;" value="" onkeypress="limpiaBusquedasHorarios('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="nombres" name="textfield5"/>
                        </div>
                    </div>

                    <form action="../../classReporte/reportes/reporteWebAsistencia.php" target="_blank" method="GET" id="nombreFormu">
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
                        <div>
                            <center><input type="submit" value="Reporte"  style="cursor:pointer;background-color:white"></center><br>
                        </div>
                    </form>
                    <div style="width: 100%; height: 30px;display:none">
                        <div style="width: 80px; float: left;" id="divEtiquetaNombre">
                            Estado1:
                        </div>
                        <div style="float: left;" id="DivtextNombre">
                            <select id="cboRegularizado"  name="cboRegularizado" style="width: 150px;">
                                <option  value="-1"> Seleccionar Estado</option>
                                <option value="1"> Regularizado</option>
                                <option value="0" selected> No Regularizado</option>
                                <option value="2">Faltas</option>
                            </select>
                        </div>
                    </div>
                    <div >
                        <CENTER><div  id ="divEtiquetaBuscar" style="width:65px;" align="center">
                                <!--<CENTER> <a href="javascript:buscarEmpleadosAreasNombreHorario();"><img id="imgbusqueda" border="0" title="Codigo de Persona" alt="" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif"/></a></CENTER>-->
                            </div>
                        </CENTER>
                    </div> 
                </div>
            </div>
            <div id="divBusquedaCC" style="width:350px;  height:360px;float: left;  ">
                <div style="height: 320px; width: 320px;" id="toolbar">
                    <div id="divCCostos" style="height:318px;width: 326px;overflow:scroll; ">

                    </div>
                </div>
            </div>
            <div id="divBusquedaAreas" style="width:380px; height:300px;float: left;  ">
                <div style="height: 320px; width: 360px;" id="toolbar">
                    <div id="divAreas" style="height:318px;width: 360px; ">

                    </div>
                </div>
            </div>
        </div>
        <div align="center" id="divTablaResultado" style="width:1100px;height: 200px; float:left; border-radius:0px;clear:both;"  >  
            <table>
                <tr>
                    <td >

                    </td>
                    <td>
                        <div align="center" id="divTablaResultadosEmpleados"  style=" overflow:auto; width:550px;height: 200px; border:1px solid #8EAA86; border-radius:5px;clear:both;"  >
                        </div>  
                    </td>
                    <td>

                    </td>
                </tr>
            </table>
        </div><br><br>
        <div id="div_nombreempleadoTrabajdor" style="width:1000px;height:140px;clear:both; float:left;font-size: 20px; line-height:25px; color:#0C527C; ">
        </div>
        <br><br>
        <div  style="width:1000px;height: 50px; float:left ;clear:both;" >
            <table>
                <tr>
                    <td style="width: 20px"><a href="javascript:agregarPersonalTurnoRegularizar();">
                            <img border="0" src="../../../../fastmedical_front/imagen/btn/b_agregar_off.gif" alt="" title="Ocultar">
                        </a></td>
                    <td style="width: 20px"></td>
                    <td ><b>Leyenda:</b> </td>
                    <td> <table>
                            <tr>
                                <td bgcolor="#FF7145"><b>Actualizado</b></td> 
                            </tr>
                            <tr>
                                <td bgcolor="#DBED17"><b>Ingresado</b></td>
                            </tr>
                        </table>
                    </td> 
                    <td style="width: 60px">

                    </td>
                </tr>
            </table>
        </div>
        <div id="div_tablaXEmpleadosRegulados" style="width:1000px;height: 300px;float:left;border:1px solid #8EAA86; border-radius:5px;float: left;clear:both; "></div>
        <div id="div_tablahoraExtrasTrabajadas" style="width:1000px;height: 300px;float:left;border:1px solid #8EAA86; border-radius:5px;float: left;clear:both; "></div>
    </div>

</div>

<!--<div>
    <CENTER>
        <form action="../../classReporte/reportes/reporteWebAsistencia.php" target="_blank" method="GET">
            inicio  : <input type="text" name="txtFechainicio" id="txtFechainicio" >
            fin : <input type="text" name="txtFechafin" id="txtFechafin">
            <input type="submit" value="Submit">
        </form>        

    </CENTER>
</div>-->

