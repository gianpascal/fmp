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
                            <div style="width: 80px; float: left;" id="divEtiquetaUsuario">
                                Usuario:
                            </div>
                            <div style="float: left;" id="DivTextUsuario">
                                <input type="text" style="width:120px;" value="Buscar..." onkeypress="limpiaBusquedaUsuarioCopia('01',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" maxlength="7" id="txtUsuario" name="txtCodigo"/>
                            </div>
                        </div>

                        <div style="width: 100%; height: 30px; ">
                            <div style="width: 80px; float: left;" id="divEtiquetaApePat">
                                Ape. Pat:
                            </div>
                            <div style="float: left;" id="DivtextApePat">
                                <input type="text" style="width:120px;" value="" onkeypress="limpiaBusquedaUsuarioCopia('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="txtapellidoPaterno" name="textfield3"/>
                            </div>
                        </div>
                        <div style="width: 100%; height: 30px; ">
                            <div style="width: 80px; float: left;" id="divEtiquetaApeMat">
                                Ape. Mat:
                            </div>
                            <div style=" float: left;" id="DivTextapeMat">
                                <input type="text" style="width:120px;" value="" onkeypress="limpiaBusquedaUsuarioCopia('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="txtapellidoMaterno" name="textfield4"/>
                            </div>
                        </div>
                        <div style="width: 100%; height: 30px; ">
                            <div style="width: 80px; float: left;" id="divEtiquetaNombre">
                                Nombre:
                            </div>
                            <div style="float: left;" id="DivtextNombre">
                                <input type="text" style="width:120px;" value="" onkeypress="limpiaBusquedaUsuarioCopia('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="txtnombres" name="textfield5"/>
                            </div>
                        </div>
                        <div style="width: 200px; height: 30px; ">


                            <div  id ="divEtiquetaBuscar" style="width:100px;  float:left;" align="center">
                                <img id="imgBuscar" border="0" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif" alt="" title="Codigo de Persona" onclick="buscarUsuariosCopia()">
                            </div>
                            <div  id ="divEtiquetaLimpiar" style="width:100px;  float:left;" align="center">                                
                                <img id="imgBuscar" border="0" src="../../../../medifacil_front/imagen/btn/btn_limpiar.gif" alt="" title="Codigo de Persona" onclick="limpiaBusquedaUsuarioCopiaTexto()">
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
            <div id="divResultados" style="width:700px;  height:290px;float: left; ">
                <div id="divTablaResultadosEmpleados" style="width:850px;height: 280px; background:#E3EFFF; float:left;   padding: 0px; " >

                </div>
            </div>
        </div>

    </body>
</html>