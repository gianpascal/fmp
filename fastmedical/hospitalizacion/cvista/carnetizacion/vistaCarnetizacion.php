<?php
$toolbar1 = new ToollBar("center");
$toolbar2 = new ToollBar("center");
?>
<link rel="stylesheet" type="text/css" href="../../../estilo/dhtmlxcalendar.css"></link>
<!--   <link rel="stylesheet" type="text/css" href="../dhtmlxCalendar/codebase/skins/dhtmlxcalendar_dhx_skyblue.css"></link>-->


<input type="hidden"  id="txtCodigo" name="txtCodigo" />
<input type="hidden"  id="txtFinaCarnetizacionPersona" name="txtFinaCarnetizacionPersona" />

<input type="hidden"  id="hfechaObtenidoEventoCalendar" name="hfechaObtenidoEventoCalendar" />
<input type="hidden"  id="hEstado" name="hEstado" value="0" />
<div align="center">
    <table border ="1">
        <tr>
            <td>

            </td>
            <td>
                <table  align="center" border="1">

                    <tr bgColor="#D6E9FE" align="center" >

                        <td style="width: 150px;height: 90px">
                            <div id="div_calendarHere" style="position:relative;height:180px;width: 190px;"></div>
                        </td>
                        <td align="center" style="width: 120px; height: 20px">
                            <div id="div_Busqueda" style="width: 880px; height: 110px">
                                <table>
                                    <tr>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <b> Cod Persona </b> </b>
                                                    </td>
                                                    <td>
                                                        <input type="txt"  id="txtCodigoPersona" onkeypress="limpiaBusquedasotros('01',this,event);" name="txtCodigoPersona" >   
                                                    </td>
                                                    <td>
                                                        <b> Tipo Documento</b>
                                                    </td>
                                                    <td>
                                                        <select name="cboTipoDocumento" id="cboTipoDocumento" onchange="limpiaBusquedasotros('02',this,event);">
                                                            <option value=""> seleccionar</option>
                                                            <?php foreach ($comboTipoDocumentos as $n => $valuen) { ?>   
                                                                <option value="<?php echo $valuen[0] ?>" <?php if ($valuey[8] == $valuen[0]) echo "selected" ?>> <?php echo $valuen[1] ?> </option>
                                                            <?php } ?>

                                                        </select>  
                                                    </td>
                                                    <td>
                                                        <b> N° documento</b>
                                                    </td>
                                                    <td>
                                                        <input type="txt" id="txtNdocumento" name="txtNdocumento" >
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td>
                                                        <b> Ap. Paterno</b>
                                                    </td>
                                                    <td>
                                                        <input type="txt" onkeypress="limpiaBusquedasotros('04',this,event);" id="txtApellidoPaterno" name="txtApellidoPaterno" >   
                                                    </td>

                                                    <td>
                                                        <b> Ap. Materno </b>
                                                    </td>
                                                    <td>
                                                        <input type="txt" id="txtApellidoMaterno" name="txtApellidoMaterno" onkeypress="limpiaBusquedasotros('04',this,event);" >   
                                                    </td>
                                                    <td>
                                                        <b>  Nombre: </b> 
                                                    </td>
                                                    <td>
                                                        <input type="txt" id="txtNombre"  name="txtNombre" onkeypress="limpiaBusquedasotros('04',this,event);" >   
                                                    </td>

                                                </tr>
                                                <tr>                                     
                                                    <td >  <b> Tipo Certificado:</b></td>
                                                    <td colspan="2">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <select name="cboTipoCertificado" id="cboTipoCertificado"  onchange="limpiaBusquedasotros('05',this,event);">
                                                                        <option value="0"> seleccionar</option>
                                                                        <?php foreach ($comboTipoCertifica as $y => $valuey) { ?>    
                                                                            <option value="<?php echo $valuey[0] ?>"> <?php echo $valuey[1] ?> </option>
                                                                        <?php } ?>

                                                                    </select>  
                                                                </td>
                                                                <td>
                                                                    <div id="1">
                                                                        Manupulador
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div id="2">
                                                                        <input type="checkbox" id="checkManipulador" name="checkManipulador" value="ON" onclick="checkManipulador()"/>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div id="3">
                                                                        No Manupulador
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div id="4">
                                                                        <input type="checkbox" id="checkNoManipulador" name="checkNoManipulador" value="ON" onclick="NocheckManipulador()"/>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $toolbar1->SetBoton("Buscar", "Buscar", "btn", "onclick,onkeypress", "buscarPorBotonPersonaCarnetizacion()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/filenew.png", "", "", 1);
                                                        $toolbar1->Mostrar();
                                                        ?>
                                                    </td>
                                                    <td style="width: 12px"> </td>
                                                    <td>
                                                        <?php
                                                        $toolbar2->SetBoton("Limpiar", "Limpiar", "btn", "onclick,onkeypress", "LimpiarPersonaCarnetizacion()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/filenew.png", "", "", 1);
                                                        $toolbar2->Mostrar();
                                                        ?> 
                                                    </td>

                                                </tr>
                                                <tr align="center">
                                                    <td colspan="6" bgcolor="#76CF2D">
                                                        <table>
                                                            <tr >
                                                                <td> <b> Sin Resultado</b></td>
                                                                <td style="width: 60px" bgcolor="#F2F9F6"></td>
                                                                <td> <b> Con Resultado</b></td>
                                                                <td style="width: 60px" bgcolor="#D6E9FE"></td>
                                                                <td> <b>Impreso</b></td>
                                                                <td style="width: 60px" bgcolor="#F6CEEC"></td>
                                                                <td> <b>Entregado</b></td>
                                                                <td style="width: 60px" bgcolor="#36B1DF"></td>
                                                                <td> <b>Duplicado</b></td>
                                                                <td style="width: 60px" bgcolor="#C9CE2D"></td>           
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <div id="div_foto">

                                            </div>
                                            <div id="div_fotoInicio">
                                                <img width="80px" height="106px" align="left" src="../../../../carpetaDocumentos/materialesLaboratorio/fotosCarnet/tufoto.JPG"/>
                                            </div>    
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>

                    <tr align="center">
                        <td style="height: 7px" bgColor="#D6E9FE" colspan="2"> 
                            <div id="div_fechaArriba">
                                <a href="javascript:ocultarBusqueda();">
                                    <img border="0" title="Buscar" alt="" src="../../../../medifacil_front/imagen/icono/arribaFecha.png"/></a>
                            </div>
                            <div id="div_fechaAbajo">
                                <a href="javascript:ocultarBusqueda();">
                                    <img border="0" title="Buscar" alt="" src="../../../../medifacil_front/imagen/icono/agt_upgrade_misc.png"/></a>
                            </div>    
                        </td>
                    </tr>
                    <tr align="center">
                        <td align="center" colspan="2">
                            <div id="divReportePersonaCarnetizacion" style="height: 520px; width: 1100px" align="center"></div>
                        </td>
                    </tr>
                    <tr align="center">
                        <td align="center" colspan="2">
                            <div id="divTotalManipuladores" style="height: 20px; width: 1100px" align="center"></div>
                        </td>
                    </tr>
                </table> 
            </td>
        </tr>
    </table>

</div>
