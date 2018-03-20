<?php ?> 
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body >
 <input type="text" id="htxtcIdAfiliacion" name="txtcIdAfiliacion" hidden=""/>
        <fieldset  style="margin:auto;width:auto;height:auto; "> 
            <legend align="center">&nbsp;<h1> HOSPITALIZACION</h1> &nbsp;</legend>
<!--            <fieldset style="margin:auto;width:60%;height:800%; "><BR>-->
                <table>
                    <tr> 
                        <td align="center">
                            <table align="center" >
                                <tr>
                                    <td colspan="2" align="center">
                                        <table align="center">
                                            <tr>
        <!--                                        <td>< ?php
//$toolbar3 = new ToollBar("left");
//$toolbar3->SetBoton("REFRESCAR", "REFRESCAR", "btn", "onclick,onkeypress", "refrescarTablaPaciente()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/actividad3.png");
//$toolbar3->Mostrar();
//
?>
                                                </td>-->
                                            </tr>
                                        </table>  </td>
                                </tr>
                                <tr align="center">
                                    <td>
                                        <table align="center" border="1">
                                            <tr>
                                                <td>
                                                    Seleccionar Tipo de Busqueda:
                                                </td>
                                                <td>
                                                    <select name="cboTipoBusqueda" id="cboTipoBusqueda" onchange="seleccionarTipoBusqueda()">
                                                        <option value="0"></option>
                                                        <option value="1">Por Fecha</option>
                                                        <option value="2">Por Paciente</option>
                                                        <option value="3">Por Pisos</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td id="trcboPisos" style="display: none" colspan="2" align ="center" >
                                                    PISOS:
                                                    <select name="cboPisos" id="cboPisos">
                                                        <option value="0">SELECCIONAR PISO</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </td>     
                                            </tr>
                                            <tr id="trFechaFinal" style="display: none">
                                                <td>
                                                    Fechas Inicial  : <input id="txtFechaIni" type="text" onclick="calendarioHtmlx('txtFechaIni')" size="20" name="txtFechaIni" />
                                                </td>
                                                <td>
                                                    Fecha Final : <input id="txtFechaFinal" type="text" onclick="calendarioHtmlx('txtFechaFinal')" size="20" name="txtFechaFinal"/>                   
                                                </td>
                                            </tr>
                                            <tr>
                                                <td id="trBotonPisos" style="display: none" align ="center"  colspan="2">
                                                    <a href="javascript:BuscarHospitalizacion();">
                                                        <img border="0" title="Buscar" alt="" src="../../../../medifacil_front/imagen/btn/b_buscar_off.gif"/></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td id="trBotonFecha" style="display: none" colspan="2" align="center">
                                                    <a href="javascript:BuscarHospitalizacion();">
                                                        <img border="0" title="Buscar" alt="" src="../../../../medifacil_front/imagen/btn/b_buscar_off.gif"/></a>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                            <tr id="trPersonal" style="display: none">
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>  Apellido Paterno Paciente:</td>
                                                            <td>
                                                                <input id="txtApPaterno" type="text" name="txtApPaterno"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>  Apellido Materno Paciente:</td>
                                                            <td>
                                                                <input id="txtApMaterno" type="text" name="txtApMaterno"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>  Nombre Paciente:</td>
                                                            <td>
                                                                <input id="txtNombre" type="text" name="txtNombre"/>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td id="trBotonPaciente" style="display: none">
                                                    <a href="javascript:BuscarHospitalizacion();">
                                                        <img border="0" title="Buscar" alt="" src="../../../../medifacil_front/imagen/btn/b_buscar_off.gif"/></a>
                                                </td>

                                            </tr>


                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </td> 

                    </tr>
                    <tr>
                        <td>
                            <div id="div_reporteHospitalizacion" style="width: 1220px; height: 700px; ">


                            </div>
                        </td>
                    </tr>  

                </table>   
            </fieldset>

<!--        </fieldset > -->

    </body>
</html>
