<?php
$datos = array();
$datos["funcionEjecutar"] = 'busquedaResponsabledesuCaja()';
$o_ActionCaja = new ActionCaja();
$cb_combo_cajas = $o_ActionCaja->listadoCajas($datos);
?>
<div align="center">
    <div style="width:700px; height:600px;margin:1px auto; border: #006600 solid">
        <div class="titleform">
            <h1>CIERRE&nbsp;&nbsp;&nbsp;DE&nbsp;&nbsp;&nbsp;CAJERO</h1>
        </div>
        <div style="width:90%;height:20%;">
            <br/>
            <table width="90%" border="0">
                <tr>
                    <td width="10%">Caja Nº :</td>
                    <td width="18%"><?php echo $cb_combo_cajas; ?></td>
                    <td width="8%">&nbsp;</td>
                    <td width="12%">Nombre : </td>
                    <td width="52%">&nbsp;<input type="text" id="txtresponsabledesucaja" name="txtresponsabledesucaja" value="" readonly="readonly" disabled="disabled" style="width: 250px"/></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                    <td colspan="5">
                        <div align="center">
                            Seleccione Día de Proceso
                            <input id="txtcalendario1" type="text" size="10" value="<?php echo date("d/m/Y"); ?>" readonly="true"/>
                            <a href="javascript:mostrarcalendar('dhtmlxCalendar1')"><img id="calendar1" src="../../../../fastmedical_front/imagen/icono/hos_calendar.png" alt=""></a>
                            <div id="dhtmlxCalendar1" style="position:relative;display:none"></div>
                        </div>
                    </td>
                </tr>

            </table>
        </div>
        <div id="Div_TabCierreCaja" style="width:80%; height:70%;">

        </div>  
        <div id="Div_TablaParteDiarioCierreCaja" style="width:99.5%;height: 80%" >

        </div>
        <div id="Div_ConsistenciaCierreCaja" style="width:99.5%;height: 80%;" >
            <div>
                <table>
                    <tr>
                        <td>
                            <select id="combo_tipobusqueda" name="combo_tipobusqueda" onchange="selecciontipodebusquedaCierreCaja();">
                                <option value="">Seleccionar</option>
                                <option value="1">Movimiento del día</option>
                                <option value="2">Rango de comprobantes</option>
                            </select>                            
                        </td>
                        <td>&nbsp;</td>
                        <td>  
                            <div id="div_tipoComprobante"></div>
                            <select id="cboTipoComprobante" name="cboTipoComprobante">
                                <option value="1">Seleccionar Tipo Comprobante</option>
                            </select>        
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div id="Div_rangoderecibos" style="display:none">
                                <table>
                                    <tr>
                                        <td>Desde :</td>
                                        <td><input type="text" id="txtrecibodesde" name="txtrecibodesde" value="" size="10"/></td>
                                        <td> - </td>
                                        <td>Hasta :</td>
                                        <td><input type="text" id="txtrecibohasta" name="txtrecibohasta" value="" size="10"/></td>
                                    </tr>                    
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr  align="center" > 
                        <td  style="width:540px;height: 200px"  align="center" colspan="3">
                            <div id="div_tablaComprobante"  style="width:99.5%;height: 100%"  align="center"></div>
                        </td>
                    </tr>
                </table>
            </div>



            <div>

            </div>

        </div>        

        <div style="width:90%;height:10%;">

            <?php
//if (isset($_SESSION["permiso_formulario_servicio"][177]["ACEPTAR_ACREDITACION_COMPLEMENTARIA"]) && ($_SESSION["permiso_formulario_servicio"][177]["ACEPTAR_ACREDITACION_COMPLEMENTARIA"] == 1))
//echo "<a href=\"javascript:busquedaCierreCaja();\"><img src=\"../../../../fastmedical_front/imagen/btn/b_buscar_on.gif\"></a>";

            $toolbar = new ToollBar("right");
            $toolbar->SetBoton("ANULAR CIERRE CAJA", "Anular Cierre", "btn", "onclick,onkeypress", "anularCierreCaja()", "../../../../fastmedical_front/imagen/icono/agt_action_fail.png", "", "", 1);
            $toolbar->SetBoton("CERRAR CAJA", "Cerrar Caja", "btn", "onclick,onkeypress", "cerrarCajaCierreCaja()", "../../../../fastmedical_front/imagen/icono/lock.png", "", "", 1);
            $toolbar->SetBoton("BUSCAR", "Buscar", "btn", "onclick,onkeypress", "busquedaCierreCaja()", "../../../../fastmedical_front/imagen/icono/demo.png", "", "", 1);
            $toolbar->Mostrar();
            ?>
        </div> 
    </div>

</div>