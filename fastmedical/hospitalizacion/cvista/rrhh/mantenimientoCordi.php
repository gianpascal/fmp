
<?php
$toolbar01 = new ToollBar("right");
$toolbar02 = new ToollBar("right");
$toolbar03 = new ToollBar("right");
$toolbar04 = new ToollBar("right");
$toolbar05 = new ToollBar("right");
$toolbar06 = new ToollBar("right");

//echo 'el dib de print_r: ';
//print_r($datos);
//$accion = $_REQUEST['accion'];
//echo "El valor de accion" . $accion . "fin";
//    $resultado="probandoo";//k se almacene la consulta en una variable $prueba y que se muestre en un Div reporte Descripcion
// if(isset($_REQUEST['datos'])){
$accion = $datos["accion"];
$sede = $datos["sede"];
$area = $datos["area"];
$idSedeempresaArea = $datos["idSedeempresaArea"];

if (trim($accion) == "EditarCoordinador") {

    $NombreCoordinador = $datos["cordinador"];
    $iIdEncargadoProgramacionPersonal = $datos["iIdEncargadoProgramacionPersonal"];
    $fechaInicio = $datos["fechaInicio"];
    $fechaFin = $datos["fechaFin"];

//    echo 'Los parametros son: ' . $sede . ' ' . $area . ' ' . $NombreCoordinador . ' ' . $idSedeempresaArea . ' ' . $iIdEncargadoProgramacionPersonal . ' ' . $fechaInicio . ' ' . $fechaFin;
} else if (trim($accion) == "NuevoCoordinador") {

    $NombreCoordinador = "";
    $fechaInicio = "";
    $fechaFin = "";
}

//
//if (isset($datos)) {
//    echo 'esta lleno';
////        $datosDesencriptados = base64_decode($_REQUEST['datos']);
////        $datosSeparados = explode("|",$datosDesencriptados);
//
//    $sede = $datos["sede"];
//    $area = $datos["area"];
//    $NombreCoordinador = $datos["cordinador"];
//    $iIdEncargadoProgramacionPersonal = $datos["iIdEncargadoProgramacionPersonal"];
//    $fechaInicio = $datos["fechaInicio"];
//    $fechaFin = $datos["fechaFin"];
//    $idSedeempresaArea=$datos["idSedeempresaArea"];
//    
//
//
//    echo 'Los parametros son: ' . $sede . ' ' . $area . ' ' . $NombreCoordinador . ' ' . $idSedeempresaArea . ' '.$iIdEncargadoProgramacionPersonal. ' ' . $fechaInicio . ' ' . $fechaFin;
//
//
//} else {
//    echo 'esta vacio';
//
//    $sede = "";
//    $area = "";
//    $NombreCoordinador = "";
//    $idSedeempresaArea = "";
//    $fechaInicio = "";
//    $fechaFin = "";
//}
?>

<fieldset style="margin:1px;width:75%;height:auto;padding: 0px; font-size:14px;">
    <legend>&nbsp; Datos &nbsp;</legend>

    <table width="100%" border="0">

        <tr>
            <td align="left">Sede</td>
            <td><input type="text" name="IdSede" id="IdSede" value="<?php echo $sede ?>" class="texto_combo" size="15" readonly/></td>
        </tr>

        <tr>
            <td align="left">Area</td>
            <td><input type="text" name="IdArea" id="IdArea" value="<?php echo $area ?>" class="texto_combo" size="40" readonly tabindex="1"/></td>
        </tr>

        <tr>
            <td><input type="hidden" name="NombreCoordinadorOculto" id="NombreCoordinadorOculto" value="<?php echo $NombreCoordinador ?>" class="texto_combo" size="40"  tabindex="1" readonly/></td>
            <td><input type="hidden" name="hidSedeempresaArea" id="hidSedeempresaArea" value="<?php echo $idSedeempresaArea ?>" class="texto_combo" size="40"  tabindex="1" readonly/></td> </td>
            <td><input type="hidden" name="hiIdEncargadoProgramacionPersonal" id="hiIdEncargadoProgramacionPersonal" value="<?php echo $iIdEncargadoProgramacionPersonal ?>" class="texto_combo" size="40"  tabindex="1" readonly/></td> </td>
        </tr> 


<!--        <tr>
            <td>Fecha Inicio : </td>
            <td><input name="txtFechaIni" type="text" id="txtFechaIni" title="Fecha Inicio" value="<?php echo $fechaInicio ?>" size="20" onblur="esFechaValida(this);"  onclick="calendarioHtmlx('txtFechaIni')" /></td>


        </tr>-->

<!--        <tr>
            <td>Fecha Fin : </td>
            <td><input name="txtFechaFin" type="text" id="txtFechaFin" title="Fecha Fin" value="<?php echo $fechaFin ?>" size="20" onblur="esFechaValida(this);"   onclick="calendarioHtmlx('txtFechaFin')" /></td>

        </tr>-->

<!--        <tr>
            <td>Estado : </td>

            <td>
                <input type="checkbox" name="chkEstado" id="chkEstado" onclick="if(this.checked){this.value=1}else{this.value=0;}" value="1" CHECKED/>

            </td>

        </tr>-->

    </table>

</fieldset>

<!--<table width="100%" border="1">
    <tr>
        <td>-->
<table width="100%" border="0">
    <tr>

        <td height="30" width="24%">Coordinador :</td>
        <td width="30%">


            <input id="txtNombres" name="txtNombres" value="<?php echo $NombreCoordinador ?>" size="40" readonly/>
<!--                <input id="btnListaCoordinadores" type="button" name="btnListaCoordinadores" value="Buscar..." onclick="buscarCoordinadoresAsignar()" style="cursor: pointer">
            -->



        </td>



        <?php
//                    echo "ini"+$accion+"fin" ;

        if ($accion == "EditarCoordinador") {

            echo '
                        
                    <td width="45%" align="right">
                        <div id="idbBuscarCoordinadores" style="width: 100%; display: none">';
            
            if (isset($_SESSION["permiso_formulario_servicio"][235]["BOTON_BUSCAR_EDITAR_COORDINADOR"]) && ($_SESSION["permiso_formulario_servicio"][235]["BOTON_BUSCAR_EDITAR_COORDINADOR"] == 1)) {
                $verBotonBuscarEditarCoordinador = 1;
            } else {
                $verBotonBuscarEditarCoordinador = 0;
            }

            $toolbar01->SetBoton("btnListaCoordinadores", "Buscar", "btn", "onclick,onkeypress", "buscarCoordinadoresAsignar()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/agt_action_success.png", "", "", $verBotonBuscarEditarCoordinador);
            $toolbar01->Mostrar();

            echo '
                        </div>


                    </td>';
        }
        ?>

        <?php
        if ($accion == "NuevoCoordinador") {

            echo '
                        
                    <td width="45%" align="right">
                        <div id="idbBuscarCoordinadores" style="width: 100%;">';

            if (isset($_SESSION["permiso_formulario_servicio"][235]["BOTON_BUSCAR_NUEVO_COORDINADOR"]) && ($_SESSION["permiso_formulario_servicio"][235]["BOTON_BUSCAR_NUEVO_COORDINADOR"] == 1)) {
                $verBotonBuscarNuevoCoordinador = 1;
            } else {
                $verBotonBuscarNuevoCoordinador = 0;
            }

            //lo cambie de 01 a 02
            $toolbar02->SetBoton("btnListaCoordinadores", "Buscar", "btn", "onclick,onkeypress", "buscarCoordinadoresAsignar()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/agt_action_success.png", "", "", $verBotonBuscarNuevoCoordinador);
            $toolbar02->Mostrar();

            echo '
                        </div>


                    </td>';
        }
        ?>


    </tr>

    <tr>
        <td>Estado : </td>

        <td>
            <input type="checkbox" name="chkEstado" id="chkEstado" onclick="if(this.checked){this.value=1}else{this.value=0;}" value="1" CHECKED/>

        </td>

    </tr>


    <input id="hidIdPersona" name="hidIdPersona" type="hidden" value="">


</table>
<center>

    <!--
            </td>
    
        </tr>
    
    
        <tr>
            <td>-->


    <!--        </td>
    
    
        </tr>
        
    </table>-->


    <!--    <?php
//    if ($accion == "EditarCoordinador") {
//
//        echo '
//    <tr>
//
//
//        <td colspan="2" align="left" height="30" id="desactivardiv" >
//            <div style="width: 150px;">';
//
//
//
//        $toolbar02->SetBoton("desactivarCoordinadorAlArea", "Desactivar", "btn", "onclick,onkeypress", "desactivarCoordinadorAlArea()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/agt_action_success.png", "", "", 1);
////        $toolbar02->Mostrar();
//
//
//
//        echo '
//            </div>
//        </td>
//
//
//
//
//    </tr>';
//    }
        ?>  -->
    <!--quispe-->
    <?php
//    if ($accion == "EditarCoordinador") {
//        echo '
//                <table  width="80%" border="1">
//                    <tr>
//
//                        <td  width= "50%" align="left" height="30">
//
//                            <div style="width: 20px; display: none" id="activardiv" >';
//
//                             $toolbar03->SetBoton("deshacerCambiosCoordinadorAlArea", "Guardarr", "btn", "onclick,onkeypress", "asignandoNuevoCoordinadorAlArea()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/agt_action_success.png", "", "", 1);
//                             $toolbar03->Mostrar();
//
//
//                        echo '
//                            </div>
//                            
//                        </td>
//
//
//
//
//                   ';
//    }
    ?>    
    <!--araoz-->




<!--    <tr>


        <td colspan="2" align="center" height="10">
            <div style="width: 100%; float: left; margin-left: 0%; display: none" id="DivTextDescripcion"  >

                <fieldset style="margin:1px;width:94%;height:auto;padding: 0px; font-size:14px;">

                    <legend>&nbsp; Motivo del Cese de la encargatura: &nbsp;</legend>


                    <div style="width: 100%; float: left; margin-left: 0%;" id="DivTextMotivoCese">
                        <textarea name="txtMotivoCese" rows="4"   id="txtMotivoCese" title="Motivo del Cese"  style="width:100%; font-family: sans-serif;background-color: #dff1ff" onfocus="if (this.value==this.defaultValue) this.value='';" onblur="if (this.value=='') this.value=this.defaultValue;" onkeypress="">
                            Despido por falta a las reglas...    
                        </textarea>
                    </div>


                </fieldset>

            </div>

        </td>


    </tr>-->

    <?php
    if ($accion == "EditarCoordinador") {

        echo '
            <table  width="80%" border="0" align="center">
           
            <tr>


                    <td align="center" width= "50%" height="30" >
                        <div style="width: 20px; display: none" id="activardiv" > ';


        if (isset($_SESSION["permiso_formulario_servicio"][235]["BOTON_GUARDAR_MANTENIMIENTO_COORDINADOR"]) && ($_SESSION["permiso_formulario_servicio"][235]["BOTON_GUARDAR_MANTENIMIENTO_COORDINADOR"] == 1)) {
            $verBotonGuardarCoordinadores = 1;
        } else {
            $verBotonGuardarCoordinadores = 0;
        }


        $toolbar03->SetBoton("deshacerCambiosCoordinadorAlArea", "Guardar", "btn", "onclick,onkeypress", "asignandoNuevoCoordinadorAlArea()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/agt_action_success.png", "", "", $verBotonGuardarCoordinadores);
        $toolbar03->Mostrar();
        echo '

                        </div>

                        <div style="" id="modificardiv">';



        if (isset($_SESSION["permiso_formulario_servicio"][235]["BOTON_MODIFICAR_MANTENIMIENTO_COORDINADOR"]) && ($_SESSION["permiso_formulario_servicio"][235]["BOTON_MODIFICAR_MANTENIMIENTO_COORDINADOR"] == 1)) {
            $verBotonModificarCoordinadores = 1;
        } else {
            $verBotonModificarCoordinadores = 0;
        }

        $toolbar04->SetBoton("asignarCoordinadorAlArea", "Modificar", "btn", "onclick,onkeypress", " asignarCoordinadorAlArea()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/agt_action_success.png", "", "", $verBotonModificarCoordinadores);
        $toolbar04->Mostrar();



        echo '</div>
                    
                    </td>';
    }
    ?>




    <?php
    if ($accion == "NuevoCoordinador") {

        echo '
                <table  width="80%" border="0">
            <tr>


                    <td   align="center" width= "50%" height="30">
                        <div style="">';

        if (isset($_SESSION["permiso_formulario_servicio"][235]["BOTON_GUARDAR_MANTENIMIENTO_NUEVO_COORDINADOR"]) && ($_SESSION["permiso_formulario_servicio"][235]["BOTON_GUARDAR_MANTENIMIENTO_NUEVO_COORDINADOR"] == 1)) {
            $verBotonGuardarNuevoCoordinador = 1;
        } else {
            $verBotonGuardarNuevoCoordinador = 0;
        }
        $toolbar05->SetBoton("asignarCoordinadorAlArea", "Guardar", "btn", "onclick,onkeypress", " asignarNuevoCoordinadorAlArea()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/agt_action_success.png", "", "", $verBotonGuardarNuevoCoordinador);
        $toolbar05->Mostrar();

        echo ' 
                        </div>
                    </td>';
    }
    ?>



    <?php
//      if ($accion == "NuevoCoordinador" or $accion == "EditarCoordinador" ) {





    echo '<td align="center" width= "50%" height="30">';
    
     if (isset($_SESSION["permiso_formulario_servicio"][235]["BOTON_SALIR_MANTENIMIENTO_COORDINADOR"]) && ($_SESSION["permiso_formulario_servicio"][235]["BOTON_SALIR_MANTENIMIENTO_COORDINADOR"] == 1)) {
            $verBotonSalirNuevoCoordinador = 1;
        } else {
            $verBotonSalirNuevoCoordinador = 0;
        }
    

        $toolbar06->SetBoton("salirModCoordiTurnos", "Salir", "btn", "onclick,onkeypress", " salirModCoordiTurnos()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/agt_action_success.png", "", "", $verBotonSalirNuevoCoordinador);
        $toolbar06->Mostrar();
   


    echo '</td>




            </tr>
    
            </table>
            
            ';


//    }   
    ?>



    <tr>
        <td colspan="4" align="center">
            <div id="divResulEncargado" ></div>
            <div id="divMsmResultadoEncargado" style="width: 400px;"></div>
        </td>
    </tr>

    <?php
//    if ($accion == "EditarCoordinador") {
//        echo 'Ud. se encuentra en el form. para EditarCoordinador';
//    } else if ($accion == "NuevoCoordinador") {
//
//        echo 'Ud. se encuentra en el form. para NuevoCoordinador';
//    }
    ?>


</center>
<br/>



<p>&nbsp;</p>

<!--
<fieldset>


<?php
//if ($_SESSION["permiso_formulario_servicio"][206]["GRABAR_CORDI"] == 1) {
//    $toolbar = new ToollBar("right");
//    $toolbar->SetBoton("GRABAR", "GrabarLabel", "btn", "onclick,onkeypress", "validarMantenimientoCordi('$accion')", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/grabar.png");
//    $toolbar->Mostrar();
//}
?>

