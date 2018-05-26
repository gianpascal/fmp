<?php
$ubigeo = '150117';
$pais='9589';
$cb_combo = $this->listaDatosComboUbigeo($pais,substr($ubigeo, 0, 2), substr($ubigeo, 2, 2), substr($ubigeo, 4, 2), "disabled");
$toolbar = new ToollBar("right");
$toolbar->SetBoton("Adscripcion Departamental", "Ads.Depart.", "btn", "onclick,onkeypress", "habilitaradscripciondepartamental()", "../../../../fastmedical_front/imagen/icono/apply.png", "", "", true);
?>
<input id="hcadena" type="hidden" value="">
<div align="center" style="width:1020; margin:1px auto; border: #006600 solid; height: 750px">
    <div class="titleform">
        <h1>acreditación Con Essalud </h1>
    </div>
    <div id="cabecera" align="center" style="width: 98%;height: 120px;">
        <div id="cabeceraIzquierda" style="float: left; width:65%;height:120px;">

            <fieldset style="width:98%;height:120px; font-size:1.2em">
                <legend>Opciones de Busqueda</legend>
                <div id='fila1' style="height:25px;; width:100%">

                    <div id='cell11' style="float:left; width:20%;  " >
            	DNI:
                    </div>
                    <div id='cell12' style="float:left; width:30%;">
                        <input name="txtDni" type="text" id="txtDni"
                               onfocus="if (this.value==this.defaultValue) this.value='';"
                               onblur="if (this.value=='') this.value=this.defaultValue;"
                               <?php
                               if ($_SESSION["permiso_formulario_servicio"][177]["BUSCAR_ACRE"] == 1)
                                   echo "onkeypress=\"acreditar(event,this,'01');\"";
                               ?>
                               value="BUSCAR..."   size="15"   />
                    </div>

                </div>
                <div id='fila2' style=" width:100%; height:25px">
                    <div id='cell21' style="float:left; width:20%; ">
            	Ap.Paterno:
                    </div>
                    <div id='cell22' style="float:left; width:30%;">
                        <input name="txtApellidoPaterno" type="text" id="txtApellidoPaterno"
                               onfocus="if (this.value==this.defaultValue) this.value='';"
                               onblur="if (this.value=='') this.value=this.defaultValue;"
                               <?php
                               if ($_SESSION["permiso_formulario_servicio"][177]["BUSCAR_ACRE"] == 1)
                                   echo "onkeypress=\"acreditar(event,this,'03');\"";
                               ?>
                               value="BUSCAR..."    size="15"  style="text-transform:uppercase;" />
                    </div>
                    <div id='cell23' style="float:left; width:20%;">
            	Ap.Materno:
                    </div>
                    <div id='cell24' style="float:left; width:30%;">
                        <input name="txtApellidoMaterno" type="text" id="txtApellidoMaterno"
                               onfocus="if (this.value==this.defaultValue) this.value='';"
                               onblur="if (this.value=='') this.value=this.defaultValue;"
                               <?php
                               if ($_SESSION["permiso_formulario_servicio"][177]["BUSCAR_ACRE"] == 1)
                                   echo "onkeypress=\"acreditar(event,this,'03');\"";
                               ?>
                               value="BUSCAR..." size="15"  style="text-transform:uppercase;" />
                    </div>
                </div>
                <div id='fila3' style=" width:100%; height:25px;">
                    <div id='cell31' style="float:left; width:20%;">
            	P. Nombre:
                    </div>
                    <div id='cell32' style="float:left; width:30%;">
                        <input name="txtPrimerNombre" type="text" id="txtPrimerNombre" size="15"
                               onfocus="if (this.value==this.defaultValue) this.value='';"
                               onblur="if (this.value=='') this.value=this.defaultValue;"
                               <?php
                               if ($_SESSION["permiso_formulario_servicio"][177]["BUSCAR_ACRE"] == 1)
                                   echo "onkeypress=\"acreditar(event,this,'03');\"";
                               ?>
                               value="BUSCAR..." style="text-transform:uppercase;" />
                    </div>
                    <div id='cell33' style="float:left; width:20%;">
            	S. Nombre:
                    </div>
                    <div id='cell34' style="float:left; width:30%;">
                        <input name="txtSegundoNombre" type="text" id="txtSegundoNombre"
                               onfocus="if (this.value==this.defaultValue) this.value='';"
                               onblur="if (this.value=='') this.value=this.defaultValue;"
                               <?php
                               if ($_SESSION["permiso_formulario_servicio"][177]["BUSCAR_ACRE"] == 1)
                                   echo "onkeypress=\"acreditar(event,this,'03');\"";
                               ?>
                               value="BUSCAR..." size="15" style="text-transform:uppercase;" />
                    </div>




                </div>

                <div id='fila4' style=" width:100%; height:25px">
                    <!--<div style=" width: 40%; margin:auto;" id="DivBuscar" align="center">-->
                    <div style="width:100%;height:auto;background:white" id="DivBuscar" align="center">
                        <?php
                        if ($_SESSION["permiso_formulario_servicio"][177]["BUSCAR_ACRE"] == 1)
                            echo "<a href=\"javascript:acreditar('','','04');\"><img border=\"0\" title=\"Codigo de Persona\" alt=\"\" src=\"../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif\"/></a>"
                            ?>
                        <a href="javascript:limpiarCamposBusquedaEssalud();" onkeypress="javascript:limpiarCamposBusquedaEssalud();"><img border="0" title="Limpiar" alt="Limpiar" src="../../../../fastmedical_front/imagen/btn/btn_limpiar.gif"/></a>
                    </div>
                </div>


            </fieldset>


        </div>
        <div id="cabeceraDerecha" style="float: right; width: 33%;height: 120px;">
            <?php require_once("../../cvista/admision/vConexion.php"); ?>
        </div>


    </div>

    <div id="Div_adscripcionDepartamental" align="center" style="width:100%;height:8%;margin-top: 1%">
        <table  style="width:auto;height:100%">
            <tr align="center">
                <td style="width: auto;height: 100%">
                    <div id="ubigeo" align="center">
                        <?php echo $cb_combo; ?>
                        <table>
                            <tr>
                                <td>Adscripcion Departamental Habilitado</td>
                                <td><input type="checkbox" id="chkadscripciondepartamental" name="chkadscripciondepartamental" value="1" disabled="disabled" /></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td style="width: auto;height: 100%">
                                    <div id="btnadscripciondepartamental" align="left">
                                        <?php
                                        if (isset($_SESSION["permiso_formulario_servicio"][177]["HABILITAR_ADSCRIPCION_DEPARTAMENTAL"]) && ($_SESSION["permiso_formulario_servicio"][177]["HABILITAR_ADSCRIPCION_DEPARTAMENTAL"] == 1))
                                            $toolbar->Mostrar();
//echo"<a href=\"javascript:habilitaradscripciondepartamental();\"><img src=\"../../../../fastmedical_front/imagen/btn/b_imprimir_on.gif\"></a>";
                                        ?>
                                    </div>                     
                                </td>                                
                            </tr>
                        </table>
                    </div>                    
                </td>

            </tr>
        </table>



    </div>
    <div id="tablaResultadoBusqueda" style="height:240px; width:1000px;margin-top:5px;">

    </div>
    <div id="existePersona" style="height:150px; width: 900px; display: none">
        <fieldset style="width:900px;height:150px;font-size:1.2em">
            <legend>Coincidencias</legend>
            <div id="divCoincidencias" >
                si coincidnecias
            </div>
        </fieldset>
    </div>
    <div id="dcontenedorDetalle" style="height:210px; width: 900px; margin-top: 5px; display: none;">
        <fieldset style="width:900px;height:200px;font-size:1.2em">
            <legend>Registro de Acreditación</legend>
            <div id="detalleAcredita" style="width:890px;height:190px; font-size:1em">

            </div>
        </fieldset>
    </div>
    <div id="Div_observacion" style="height:50px; width: 900px; margin-top: 5px;">
        <table>
            <tr style="font: bold medium sans-serif;color: red">
                <td>OBS :           </td>
                <td>1. Para una acreditación más rápida y efectiva, realizar la búsqueda por DNI.</td>
            </tr>
            <tr style="font: bold medium sans-serif;color: red">
                <td>&nbsp;</td>
                <td>2. Si la búsqueda se realiza por nombres y apellidos, para una acreditación más rápida y efectiva
                    coloque la mayor cantidad de datos posibles.</td>
            </tr>
        </table>
    </div>
</div>

