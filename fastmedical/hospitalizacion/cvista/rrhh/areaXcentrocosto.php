<?php
$comboEstado=array(0=>"Activado", 1=>"Desactivado");
$toolbar0=new ToollBar("right");
$toolbar1=new ToollBar("right");
?>

<div style="width:900px; margin:1px auto; border: #006600 solid">
    <div class="titleform">
        <h1>Mantenimiento de Areas por Centro de Costos</h1>
    </div>
    <div  id ="divMantAreaCentroCosto" style="width:99%;margin-left:0.5%;margin-right:0.2%;overflow: hidden;">
        <div  id ="divIzqMantAreaCentroCosto" style=" float:left;width:40%; ">
            <fieldset style="margin:1px;width:auto;height:auto;padding: 0px; font-size:12px">
                <div style="width: 100%; height:40px;" align="center"><br>
                    <input type="text" id="txtBusquedaArbolx" name="txtBusquedaArbolx" onkeypress="if(event.keyCode==13)busquedaArbolx();" /> <a onClick="busquedaArbolx()" style="cursor: pointer">Buscar</a>
                </div>
                <div id="divTreeCentroCosto" style="width: 350px; height: 400px;">

                </div>
            </fieldset>
        </div>
        <div  id ="divDerMantAreaCentroCosto" style="width:60%; float: right" align="center">
            <div  id ="divDerSupMantDocumentos" style=" width:99%;" align="center" >
                <input type="hidden" id="hPuesto" name="hPuesto" size="12" value="">
                <input type="hidden" id="hNombre" name="hNombre" size="12" value="">
                <div id="divTitulo" class="titleform" style="border: 0px solid rgb(0, 0, 0); width: 100%;">

                </div>
                <div align="center" style="width:100%;height:50px; font-size: 12px">
                    <fieldset style="margin:10px;width:95%;height:45px;">
                        <legend>&nbsp; Centro de Costo &nbsp;</legend>
                        <table>
                            <tr><td>Nombre Centro Costo :<input id="hidCentroCosto" name="hidCentroCosto" type="hidden" value=""/> </td>
                                <td><input id="txtNombreCentroCosto" name="txtNombreCentroCosto" type="text" size="60" disabled/></td></tr>
                        </table>
                    </fieldset>
                </div>
                <fieldset style="margin:10px;width:30%;height:auto;padding: 0px; font-size:10px;">
                    <legend>&nbsp; Lista de Areas por Sede &nbsp;</legend>
                    <div style="float: right">
                        <?php
                            if (isset($_SESSION["permiso_formulario_servicio"][218]["NUEVA_AREA_POR_SEDE"]) && ($_SESSION["permiso_formulario_servicio"][218]["NUEVA_AREA_POR_SEDE"]==1)){
                                $toolbar0->SetBoton("NuevaAreaxSucursal","Nueva Area por Sucursal","btn","onclick,onkeypress","abrirArea('nuevo')",$_SESSION['path_principal']."../medifacil_front/imagen/icono/filenew.png","","",1);
                                $toolbar0->Mostrar();
                            }
                        ?>
                    </div>
                    <fieldset style="margin:10px;width:80%;height:auto;">
                        <legend>&nbsp; Sede &nbsp;</legend>
                        <table width="50%">
                            <tr><td>seleccionar Sede : </td>
                                <td>
                                    <select id="cboSede" name="cboSede" style="width: 110px;" onchange="listaAreaPorSede()">
                                        <option value="">- Seleccionar -</option>
                                        <?php
                                        foreach ($comboSucursal as $i => $value) { ?>
                                        <option value="<?php echo $comboSucursal[$i][0] ?>"><?php echo $comboSucursal[$i][14]?></option>
                                            <?php }?>
                                    </select>
                                </td></tr>
                        </table>
                    </fieldset>
                    <div id="divEmpresas" style="width:510px;height:auto">
                        <input id="hidIdAreaSede" name="hidIdAreaSede" value="" type="hidden"/>
                        <div id="divTablaAreaSede" style="margin-left: 10px; width: 490px; height: 200px; display: none;">
                        </div>
                    </div><br>
                    <div align="center" style="width: 200px">
                        <?php
                            if (isset($_SESSION["permiso_formulario_servicio"][218]["ASIG_AREA_CCOSTO"]) && ($_SESSION["permiso_formulario_servicio"][218]["ASIG_AREA_CCOSTO"]==1)){
                                $toolbar1->SetBoton("AsignarCeCeSedeEmAr","Asignar Área a Centro Costo","btn","onclick,onkeypress","grabarCeCeSedeEmpresaArea()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/agt_action_success.png","","",1);
                                $toolbar1->Mostrar();
                            }
                        ?>
                    </div>
                </fieldset>

                <div id="divSedeAreaCentroCosto" style="width:510px;height:100px;" >

                </div><br>
            </div>
        </div>
    </div>
</div>
