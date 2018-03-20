<div id="divConsulta" style="width:1000px; height:100%;  margin:1px auto; border: #006600 solid">
    <div class="titleform">
        <h1>Consulta De Datos Del Personal</h1>
    </div>
    <div id="divBusquedaPersonas" style="width:1000px; float: left" >
        <div id="divBusquedaDatos" style="width:240px;  height:300px;float: left;  ">
            <div style="height: 280px; width: 220px;" id="toolbar">
                <form>
                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaCodigo">
                            Código:
                        </div>
                        <div style="float: left;" id="DivTextCodigo">
                            <input type="text" style="width:120px;" value="Buscar..." onkeypress="limpiaBusquedas('01',this,event);return validFormSalt('nro', this, event, 'imgbusqueda');" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" maxlength="7" id="txtCodigo" name="txtCodigo"/>
                        </div>
                    </div>
                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaEstado">
                            Estado:
                        </div>
                        <div style=" float: left;" id="DivSelectEstado">
                            <select  style="width: 120px; font-size: 9px;" id="comboTipoEstados" name="selectE">

                                <option  value="2" >Todos</option>
                                <option selected="selected" value="1" onclick="limpiaBusquedas('02',this,'1');">Activos</option>
                                <option value="0" onclick="limpiaBusquedas('02',this,'1');">Inactivos</option>
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
                                   onkeypress="limpiaBusquedas('03',this,event);"
                                   onblur="if (this.value=='') this.value=this.defaultValue;"
                                   onfocus="if (this.value==this.defaultValue) this.value='';" id="nroDoc" maxlength="8" name="txtDoc"/>
                        </div>
                    </div>
                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaApePat">
                            Ape. Pat:
                        </div>
                        <div style="float: left;" id="DivtextApePat">
                            <input type="text" style="width:120px;" value="" onkeypress="limpiaBusquedas('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="apellidoPaterno" name="textfield3"/>
                        </div>
                    </div>
                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaApeMat">
                            Ape. Mat:
                        </div>
                        <div style=" float: left;" id="DivTextapeMat">
                            <input type="text" style="width:120px;" value="" onkeypress="limpiaBusquedas('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="apellidoMaterno" name="textfield4"/>
                        </div>
                    </div>
                    <div style="width: 100%; height: 30px; ">
                        <div style="width: 80px; float: left;" id="divEtiquetaNombre">
                            Nombre:
                        </div>
                        <div style="float: left;" id="DivtextNombre">
                            <input type="text" style="width:120px;" value="" onkeypress="limpiaBusquedas('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="nombres" name="textfield5"/>
                        </div>
                    </div>
                    <div style="width: 200px; height: 30px; ">


                        <div  id ="divEtiquetaBuscar" style="width:65px;  float:left;" align="center">
                            <a href="javascript:buscarEmpleados(document.getElementById('txtCodigo').value,document.getElementById('comboTipoEstados').value,document.getElementById('comboTipoDocumentos').value,document.getElementById('nroDoc').value,document.getElementById('apellidoPaterno').value,document.getElementById('apellidoMaterno').value,document.getElementById('nombres').value);"><img id="imgbusqueda" border="0" title="Codigo de Persona" alt="" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif"/></a>
                        </div>
                        <div  id ="divEtiquetaLimpiar" style="width:65px;  float:left;" align="center">
                            <a href="javascript:limpiaBusquedas('0','','');"><img border="0" title="Limpia" alt="" src="../../../../medifacil_front/imagen/btn/btn_limpiar.gif"/></a>
                        </div> 
                        <div  id ="Divnuevo" style=" float:left;width:65px; " align="center">
                            <?php
                            if (isset($_SESSION["permiso_formulario_servicio"][121]["NUEVO_EMPLEADO"]) && ($_SESSION["permiso_formulario_servicio"][121]["NUEVO_EMPLEADO"] == 1)) {
                                ?>
                                <a href="javascript:ventana_formulario_empleado();"><img border="0" title="Codigo de Persona" alt="" src="../../../../medifacil_front/imagen/btn/nbtn_nuevo.gif"/></a>
                                <?php
                            }
                            ?>

                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div id="divBusquedaCC" style="width:380px;  height:300px;float: left;  ">
            <div style="height: 280px; width: 360px;" id="toolbar">
                <div id="divCCostos" style="height:280px;width: 367px;overflow:scroll; ">

                </div>
            </div>
        </div>
        <div id="divBusquedaAreas" style="width:380px; height:300px;float: left;  ">

            <div style="height: 280px; width: 360px;" id="toolbar">
                <div id="divAreas" style="height:280px;width: 360px; ">

                </div>
            </div>
        </div>
    </div>
    <div id="divTablaResultadosEmpleados" style="width:1000px;float:left;  ">
    <!--<div id="divTablaResultadosEmpleados" style="width:1000px;height: 400px; background:#7CC434; float:left;  ">-->

    </div>

</div>

<div id ="divDetallePersona" style="width:905px; margin:1px auto; border: #006600 solid; display: none;">

    <div class="titleform">
        <h1>Consulta De Datos Del Personal</h1>
    </div>
    <div  id ="divPersonal" style="width:900px ;margin-left:0.5%;margin-right:0.2%;overflow: hidden;">
        <div  id ="divIzqRegistroP" style=" width:220px;  float:left;">
            <div  id ="divIzqSupRegistroP" style=" width:220px; height: 280px;" >
                para que
            </div>
            <div  id ="divIzqInfRegistroP" style=" width:100%;" >
                <input type="hidden" id="txtCodPer" value="" />
                <input type="hidden" id="txtNomPer" value="" />
                <input type="hidden" id="txtcodigoEmpleado" value="" />
                <input type="hidden" id="txtAccion" value="" />
                <input type="hidden" id="txtId" value="" />   
                <input type="hidden" id="txtCategoria" value="" />


                <div  id ="divIzqInf" style=" width:40%; float: left;" >
                    <a href="javascript:regresarBuscarEmpleado();"><img border="0" title="Codigo de Persona" alt="" src="../../../../medifacil_front/imagen/btn/b_regresar_on.gif"/></a>
                </div>
            </div>
        </div>

        <div  id ="divDerRegistroP" style=" float:right;width:680px;  ">

        </div>
    </div>
</div>

