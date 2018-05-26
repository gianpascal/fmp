<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>

        <div id="divBusquedaPersonas" style="width:1000px; float: left" > 
            <div id="divBusquedaDatos" style="width:240px;  height:300px;float: left;  ">
                <div style="height: 280px; width: 220px;" id="toolbar">
                    <form>
                        <div style="width: 100%; height: 30px; ">
                            <div style="width: 80px; float: left;" id="divEtiquetaCodigo">
                                Código:
                            </div>
                            <div style="float: left;" id="DivTextCodigo">
                                <input type="text" style="width:120px;" value="Buscar..." onkeypress="limpiaBusquedasX('01',this,event);return validFormSalt('nro', this, event, 'imgbusqueda');" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" maxlength="7" id="txtCodigo" name="txtCodigo"/>
                            </div>
                        </div>
                        <div style="width: 100%; height: 30px; ">
                            <div style="width: 80px; float: left;" id="divEtiquetaEstado">
                                Estado:
                            </div>
                            <div style=" float: left;" id="DivSelectEstado">
                                <select  style="width: 120px; font-size: 9px;" id="comboTipoEstados" name="selectE">


                                    <option selected="selected" value="1" onclick="limpiaBusquedasX('02',this,'1');">Activos</option>
                                    <option value="0" onclick="limpiaBusquedasX('02',this,'1');">Inactivos</option>
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
                                       onkeypress="limpiaBusquedasX('03',this,event);"
                                       onblur="if (this.value=='') this.value=this.defaultValue;"
                                       onfocus="if (this.value==this.defaultValue) this.value='';" id="nroDoc" maxlength="8" name="txtDoc"/>
                            </div>
                        </div>
                        <div style="width: 100%; height: 30px; ">
                            <div style="width: 80px; float: left;" id="divEtiquetaApePat">
                                Ape. Pat:
                            </div>
                            <div style="float: left;" id="DivtextApePat">
                                <input type="text" style="width:120px;" value="" onkeypress="limpiaBusquedasX('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="apellidoPaterno" name="textfield3"/>
                            </div>
                        </div>
                        <div style="width: 100%; height: 30px; ">
                            <div style="width: 80px; float: left;" id="divEtiquetaApeMat">
                                Ape. Mat:
                            </div>
                            <div style=" float: left;" id="DivTextapeMat">
                                <input type="text" style="width:120px;" value="" onkeypress="limpiaBusquedasX('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="apellidoMaterno" name="textfield4"/>
                            </div>
                        </div>
                        <div style="width: 100%; height: 30px; ">
                            <div style="width: 80px; float: left;" id="divEtiquetaNombre">
                                Nombre:
                            </div>
                            <div style="float: left;" id="DivtextNombre">
                                <input type="text" style="width:120px;" value="" onkeypress="limpiaBusquedasX('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="nombres" name="textfield5"/>
                            </div>
                        </div>
                        <div style="width: 200px; height: 30px; ">


                            <div  id ="divEtiquetaBuscar" style="width:100px;  float:left;" align="center">
                                <?php
                                if (isset($_SESSION["permiso_formulario_servicio"][224]["BUSCAR_EMP"]) && ($_SESSION["permiso_formulario_servicio"][224]["BUSCAR_EMP"] == 1)) {
                                    echo '<a href="javascript:buscarEmpleadosX(document.getElementById(\'txtCodigo\').value,document.getElementById(\'comboTipoEstados\').value,document.getElementById(\'comboTipoDocumentos\').value,document.getElementById(\'nroDoc\').value,document.getElementById(\'apellidoPaterno\').value,document.getElementById(\'apellidoMaterno\').value,document.getElementById(\'nombres\').value);"><img id="imgbusqueda" border="0" title="Codigo de Persona" alt="" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif"/></a>';
                                }
                                ?>
                            </div>
                            <div  id ="divEtiquetaLimpiar" style="width:100px;  float:left;" align="center">
                                <?php
                                if (isset($_SESSION["permiso_formulario_servicio"][224]["LIMPIAR_EMP"]) && ($_SESSION["permiso_formulario_servicio"][224]["LIMPIAR_EMP"] == 1)) {
                                    echo '<a href="javascript:limpiaBusquedasX(\'0\',\'\',\'\');"><img border="0" title="Limpia" alt="" src="../../../../fastmedical_front/imagen/btn/btn_limpiar.gif"/></a>';
                                }
                                ?>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
            <div id="divResultados" style="width:700px;  height:290px;float: left;  overflow:scroll;">
                <div id="divTablaResultadosEmpleados" style="width:655px;height: 280px; background:#E3EFFF; float:left;   padding: 0px; " >

                </div>
            </div>
        </div>

    </body>
</html>
