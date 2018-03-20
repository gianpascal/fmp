<!--  <input type="hidde" id="hestadoprod" name="hestadoprod" value="" >
  <input type="hidde" id="hCodPerProd" name="hCodPerProd" value="" >-->

<div id="divContenidoPuntoControl" style="width:1300px; height:auto;  margin:1px auto; border: #006600 solid" align="center">
    <table border="1">
        <tr>
            <td> 
                <div id="div_ExamenPuntoControl">
                    <table>
                        <tr>
                            <td style="width:40px;float: center; height: auto; ">
                            </td>
                            <td>
                                <div class="titleform">
                                    <h1>TABLA CPT</h1>
                                </div>
                                <div id="divCTP" class="toolbar" style="width:480px;float: left; height: 250px; ">
                                    <table border="1" align="center">
                                        <td> 
                                            <h3> <b>NOMBRE: CODIGO:</b></h3>
                                        </td>
                                        <td>
                                            <input type="text" id="txtNombreCPT" value="" name="txtNombreCPT" style="width: 300px" onkeyup="buscarTablaCPT('01',this,event); "/>
                              
                                            <input type="text" id="txtCodCPT" value="" name="txtCodCPT" style="width: 300px" onkeyup="cargarLetras(event);">
                                        </td>
                                        <tr> 
                                            <td colspan="2" style="width:460px;float: center; height: auto; ">
                                                <div id="div_TablaCPT" style="width:470px;float: left; height: 200px; ">
                                                </div>
                                            </td>

                                        </tr>   
                                    </table> 
                                </div>

                            </td>
                            <td>
                                <div class="titleform">
                                    <h1>TABLA PRODUCTOS</h1>
                                </div>
                                <div id="divMxserpro" class="toolbar" style="width:480px;float: left; height: 250px; ">
                                    <table border="1" align="center">
                                        <td> 
                                            <h3> <b>NOMBRE: CODIGO:</b></h3>
                                        </td>
                                        <td>
                                            <input type="text" id="txtNombreMxserpro" value="" name="txtNombreMxserpro" style="width: 300px" onkeyup="buscarMxserpro('01',this,event);"/>

                                            <input type="text" id="txtIdProd" value="" name="txtIdProd" style="width: 300px" onkeyup="cargarLetrasMxSerPro(event);">
                                        </td>
                                        <tr> 
                                            <td colspan="2" style="width:450px;float: center; height: 140px; ">
                                                <div id="div_TablaMxserpro" style="width:470px;float: left; height: 200px; ">
                                                </div>
                                            </td>
                                        </tr> 
                                    </table> 
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <td colspan="4" style="width:10px;float: center; height: 4px; "> 
            </td>
        </tr> 
        <tr align="center">
            <td colspan="" align="center" style="width:940px;float: center; height: 300px; "> 
                <div id="div_TablaDetalleEquivalencia" align="center">
                    <?php
                    echo "<a href=\"javascript:examenesRelacionados();\">
                          <img border=\"0\" id=\"btnRelacion\" align=\"right\" alt=\"\" src=\"../../../../medifacil_front/imagen/btn/b_verrelacion_on.GIF\"/></a>";
                    ?>
                </div>
                <div class="titleform">
                    <h1>TABLA DETALLE DE EQUIVALENCIAS</h1>
                </div>
                <div id="divDetalle" class="toolbar" style="width:980px;float: left; height: 250px; ">
                    <table border="1" align="center">   
                        <tr> 
                            <td colspan="2" style="width:900px;float: center; height: auto; ">
                                <div id="div_Equivalencias" style="width:980px;float: left; height: 240px; ">
                                </div>
                            </td>
                        </tr>   
                    </table> 
                </div>
                                            <input type="hidden" id="txtiIdCPT" value="" name="txtiIdCPT" style="width: 300px" onkeyup="buscarTablaCPT('01',this,event); "/>
                </div> 
            </td>
        </tr>

    </table>
</div>


