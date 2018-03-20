
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <input id="hcod_ser_pro" name="hcod_ser_pro" type="hidden" value="">
        <input id="hNombreMaterialxAgregar" name="hcod_ser_pro" type="hidden" value="">

        <div style="width: 100%" align="center">
            <div style="height: 60px; width: 56%" id="toolbar" align="center">

                <form>

                    <div style="width: 100%; height: 20%;">
                        <table>
                            <tr>
                                <td>
                                    <div style="width: 20%; float: left;" id="divEtiquetaApePat">
                                        Nombre Material:
                                    </div>   
                                </td>
                                <td>
                                    <div style="width: 30%; float: left;" id="DivtextApePat">
                                        <input type="text" size="30" value="" onkeypress="if(event.keyCode==13)buscarMaterialesLaboratorioPopap123();"   onblur="this.style.background='#BAB6DB'" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="NombreaBuscarMateriales"  name="NombreaBuscarMateriales"/>


                                    </div>

                                </td>
                                <td>
                                    <div  id ="divEtiquetaBuscar" style=" float:left;width:16%;" align="center">
                                        <a href="javascript:buscarMaterialesLaboratorioPopap(document.getElementById('NombreaBuscarMateriales').value);"><img border="0" title="Codigo de Persona" alt="" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif"/></a>
                                    </div>

                                </td>


                            </tr>

                        </table>

                    </div>
                    
               </form>
            </div>
            
            <br>

            <div id="div_ResultadoBusquedaMaterialesLaboratorio" style="width: 500px; height: 250px;" align="center">

            </div>
        </div>
    </body>
</html>
