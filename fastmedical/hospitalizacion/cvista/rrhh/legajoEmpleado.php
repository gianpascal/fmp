
<div style="width:99%; margin:1px auto; border: #006600" >
    <div class="titleform" id="divTitulo" >
    </div>
</div>
<div  id ="divLegajo" style="width:99%;height:inherit;margin-left:1%;margin-right:1%;overflow:scroll; ">
    <fieldset style="margin:1px; width:98%;height:auto;padding: 0px;">
        <b> LEGAJO</b>
        <div style="width: 11%; float: right; background-color: #7CC434;" id="divBotonActivo">
            <a onclick="" href="javascript:mostrarTLegajo(document.getElementById('txtCodPer').value,1);">
                <img border="0" alt="" src="../../../../medifacil_front/imagen/btn/btn_LegajoEmpleado.gif"/></a>
        </div>
        <div style="width: 11%; float: right; background-color: #7CC434;" id="divBotonActivo">
            <a onclick="" href="javascript:mostrarTLegajo(document.getElementById('txtCodPer').value,2);">
                <img border="0" alt="" src="../../../../medifacil_front/imagen/btn/btn_LegajoRRHH.gif"/></a>

        </div>

    </fieldset>
    <div  id ="divDatosLegajo" style="width:99%; float:left; height:180px;margin-left:1%;margin-right:1%; overflow: auto;">

    </div>
    <div>
        <!--
        <a onclick="" href="javascript:agregarDocumentoLegajo();">
            <img id="imgAgregar"  border="0" alt="" src="../../../../medifacil_front/imagen/btn/b_agregar_on.gif"/>
        </a>
        -->
        <?php
        //121:Formulario de registro de personal - 212:Formulario de datos de usuario
        if (isset($_SESSION['permiso_formulario'][121]) && isset($_SESSION['permiso_formulario'][212])) {
            if ($_SESSION["permiso_formulario_servicio"][121]["AGREGAR_DOC_X_LEGAJO"] == 1)
                echo "<a href=\"javascript:agregarDocumentoLegajo();\"><img id=\"imgAgregar\" border=\"0\" src=\"../../../../medifacil_front/imagen/btn/b_agregar_on.gif\"/></a>";
        }
        else {
            if (!isset($_SESSION['permiso_formulario'][121]) && isset($_SESSION['permiso_formulario'][212])) {
                if ($_SESSION["permiso_formulario_servicio"][212]["AGREGAR_DOC_X_LEGAJO"] == 1)
                    echo "<a href=\"javascript:agregarDocumentoLegajo();\"><img id=\"imgAgregar\" border=\"0\" src=\"../../../../medifacil_front/imagen/btn/b_agregar_on.gif\"/></a>";
            }
        }
        ?>
        <!--
        <a onclick="" href="javascript:editarLegajo();">
            <img id="imgEditar" style=" display:none;" border="0" alt="" src="../../../../medifacil_front/imagen/btn/b_editar_on.gif"/>
        </a>
        -->
        <?php
        //121:Formulario de registro de personal - 212:Formulario de datos de usuario
        // print_r($_SESSION['permiso_formulario'][121])."*<br>"; 
        //print_r($_SESSION['permiso_formulario'][212])."*<br>";
        if (isset($_SESSION['permiso_formulario'][121]) && isset($_SESSION['permiso_formulario'][212])) {
            if ($_SESSION["permiso_formulario_servicio"][121]["EDITAR_DOC_X_LEGAJO"] == 1) {
                echo "<a href=\"javascript:editarLegajo();\"><img id=\"imgEditar\" style=display:none  border=\"0\" src=\"../../../../medifacil_front/imagen/btn/b_editar_on.gif\"/></a>";
            }
        } else {

            if (!isset($_SESSION['permiso_formulario'][121]) && isset($_SESSION['permiso_formulario'][212])) {

                if ($_SESSION["permiso_formulario_servicio"][212]["EDITAR_DOC_X_LEGAJO"] == 1) {
                    echo "<a href=\"javascript:editarLegajo();\"><img id=\"imgEditar\" border=\"0\" src=\"../../../../medifacil_front/imagen/btn/b_editar_on.gif\"/></a>";
                }
            }
        }
        ?>

        <a onclick="" href="javascript:guardarLegajo();">
            <img id="imgGuardar" style="display:none" border="0" alt="" src="../../../../medifacil_front/imagen/btn/b_grabar_on.gif"/>
        </a>
        <a onclick="" href="javascript:cancelarLegajo();">
            <img id="imgCancelar" border="0" alt="" src="../../../../medifacil_front/imagen/btn/b_cancelar_on.gif"/>
        </a>

    </div>
    <div  id ="divResultadoLegajo" style="width:99%; float:left;height:auto;margin-left:1%;margin-right:1%; ">

    </div>

    <div  id ="divAdjuntarDocumento" style="width:99%; float:left; height:40px;margin-left:1%;margin-right:1%; ">
    </div>
    <div  id ="divAdjuntarOtro" style="width:99%; float:left; height:80px;margin-left:1%;margin-right:1%; ">
    </div>
</div>
<br><br><br><br>
<iframe name="iframe" src="" style="display: none;"> </iframe>
