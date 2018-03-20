
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div style="width: 100%" align="center">
            <div style="height: 100px; width: 56%" id="toolbar" align="center">

            <form>
                <div style="width: 100%; height: 25%;">
                    <div style="width: 20%; float: left;" id="divEtiquetaCodigo">
                        Código:
                    </div>
                    <div style="width: 30%; float: left;" id="DivTextCodigo">
                        <input type="text" size="12" value="Buscar..." onkeypress="limpiaBusquedasPopap('01',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" maxlength="7" id="txtCodigo" name="txtCodigo"/>
                    </div>
                    <div style="width: 20%; float: left;" id="divEtiquetaEstado">
                        Estado:
                    </div>
                    <div style="width: 30%; float: left;" id="DivSelectEstado">
                        <select  style="width: 80px; font-size: 9px;" id="comboTipoEstados" name="selectE">
                            <option value="0000">Seleccionar</option>
                            <option  value="0001" >Todos</option>
                            <option selected="selected" value="0002" onclick="limpiaBusquedasPopap('02');">Activos</option>
                            <option value="0003" onclick="limpiaBusquedasPopap('02');">Inactivos</option>
                        </select>
                    </div>
                </div>
                <div style="width: 100%; height: 25%;">

                    <div style="width: 20%; float: left; " id="divEtiquetaTipoDoc">
                        Tipo Doc:
                    </div>
                    <div style="width: 30%; float: left;" id="DivSelectTipoDoc">
                        <select name="select" id="comboTipoDocumentos" style="width:80px; font-size:9px" onchange="validaTxtNroDocBuscar();">
                            <?php
                            echo $comboTipoDocumentos;
                            ?>
                        </select>
                    </div>
                    <div style="width: 20%; float: left;" id="divEtiquetaNroDoc">
                        Nro Doc:
                    </div>
                    <div style="width: 30%; float: left;" id="DivTextDoc">
                        <input type="text" size="12" value="Buscar..."
                               onkeypress="limpiaBusquedasPopap('03',this,event);"
                               onblur="if (this.value=='') this.value=this.defaultValue;"
                               onfocus="if (this.value==this.defaultValue) this.value='';" id="nroDoc" maxlength="8" name="txtDoc"/>
                    </div>
                </div>


                <div style="width: 100%; height: 25%;">

                    <div style="width: 20%; float: left;" id="divEtiquetaApePat">
                        Ape. Pat:
                    </div>
                    <div style="width: 30%; float: left;" id="DivtextApePat">
                        <input type="text" size="12" value="" onkeypress="limpiaBusquedasPopap('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="apellidoPaterno" name="textfield3"/>
                    </div>
                    <div style="width: 20%; float: left;" id="divEtiquetaApeMat">
                        Ape. Mat:
                    </div>
                    <div style="width: 30%; float: left;" id="DivTextapeMat">
                        <input type="text" size="12" value="" onkeypress="limpiaBusquedasPopap('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="apellidoMaterno" name="textfield4"/>
                    </div>
                </div>


                <div style="width: 100%; height: 25%;">

                    <div style="width: 20%; float: left;" id="divEtiquetaNombre">
                        Nombre:
                    </div>
                    <div style="width: 30%; float: left;" id="DivtextNombre">
                        <input type="text" size="12" value="" onkeypress="limpiaBusquedasPopap('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="nombres" name="textfield5"/>
                    </div>

                    <!--<div style="width: 16%; float: left;" id="DivLimpiar" align="center">
                            <a href="javascript:limpiaBusquedasPopap('0');"><img border="0" title="Codigo de Persona" alt="" src="../../../../medifacil_front/imagen/btn/btn_limpiar.gif"/></a>
                    </div>-->
                    <div  id ="divEtiquetaBuscar" style=" float:left;width:16%;" align="center">
                        <a href="javascript:buscarEmpleadosPopap(document.getElementById('txtCodigo').value,document.getElementById('comboTipoEstados').value,document.getElementById('comboTipoDocumentos').value,document.getElementById('nroDoc').value,document.getElementById('apellidoPaterno').value,document.getElementById('apellidoMaterno').value,document.getElementById('nombres').value);"><img border="0" title="Codigo de Persona" alt="" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif"/></a>
                    </div>

                </div>

            </form>
        </div><br>
        <div id="divResultadoEmpleados" style="width: 750px; height: 250px;" align="center">

        </div>
</div>
    </body>
</html>
