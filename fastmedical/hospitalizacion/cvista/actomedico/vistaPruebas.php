<div id ="divConsultaP" style="width:950px; margin:1px auto; border: #006600 solid">
    <div class="titleform">
        <h1>&nbsp;Mantenimiento de Pruebas &nbsp;</h1>
    </div>
    <?php
    $toolbarx=new ToollBar("right");
    $toolbarz=new ToollBar("right");
    ?>
    <div  id ="divPruebas" style="width:99%;margin-left:0.5%;margin-right:0.2%;overflow: hidden;">
        <div  id ="divIzqPruebas_1" style=" float:left;width:34%; ">
            <div style=" width:98%;">
            </div>
            <fieldset style="margin:1px;width:auto;height:auto;padding: 0px; font-size:14px;">
                <legend></legend>
<!--                <div  id ="divbuscarPruebas" style=" float:left;width:100%; height: 40px; margin-right: 5%; margin-left: 5%">
                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr><td colspan="2" height="10"></td></tr>
                        <tr>
                            <td width="70%">Nombre de Prueba : </td>
                            <td width="30%"> <input name="txtNombrePrueba" type="text" id="txtNombrePrueba"  value="" /></td>
                        </tr>
                    </table>
                </div>
                <div id="divBuscar" style="display: block; margin-left: 35%; margin-right: 35%; height:60px;">
                    <?php
                    $toolbarx->SetBoton("Buscar","Buscar","btn","onclick,onkeypress","buscarPrueba()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/kappfinder.png","","",1);
                    $toolbarx->Mostrar();
                    ?>
                </div>-->
                <br>
                <div  id ="divresultadoPruebas" style=" float:left;width:250px; height:350px;">
                    <fieldset style="width:300px">
                        <table>
                            <tr>
                                <td></td>
                                <td><input type="text" name="campo2" value="Nombre Prueba ..." id="campo2" onkeyup='TablaresultadoPrueba.filterBy(2,document.getElementById("campo2").value);' onfocus="if (this.value==this.defaultValue) this.value='';" onblur="if (this.value=='') this.value=this.defaultValue;"></td>
                            </tr>
                        </table>
                    </fieldset>
                    <div id="tablaPrueba" style="width:300px; height:300px;"></div>
                </div>
                <div id="divNuevo" style="width:200px; height: auto; margin-left: 30px; margin-right: 30px" align="center">
                            <?php
                            $toolbarz->SetBoton("Nuevo","Nueva Prueba","btn","onclick,onkeypress","pruebasCampos()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/editar.png","","",1);
                            $toolbarz->Mostrar();
                            ?>
                </div>
                <br>
            </fieldset>
        </div>
        <div  id ="divMantenimiento" style=" float:right;width:65%; height:auto; ">
        </div>
        <br>
        <div  id ="divMostrarCampo" style=" float:right;width:65%; height:auto;">
        </div>
    </div>
</div>
