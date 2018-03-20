<?php
require_once("../../ccontrol/control/ActionMantenimientoGeneral.php");
require_once("../../ccontrol/control/ActionCita.php");

$o_rrhh = new ActionRrhh();

//$cb_combo_sede_areas = $o_rrhh->listaDatosSedeAreas($datos);

 $iCodEmpCoordinador=$_SESSION['iCodigoEmpleado'];
 echo 'recibiendo idCordi'.$iCodEmpCoordinador;
 $datos['iCodigoEmpleado']=$iCodEmpCoordinador;
$cb_combo_sede_areas = $o_rrhh->listaDatosSedeAreas1( $datos);


$toolbar = new ToollBar("right");
$toolbarx = new ToollBar("left");

$o_rrhh1 = new ActionRrhh();
$variable=$o_rrhh1->funcionprueba();      ;
?>
<div style="width:100%;height:5%;background: white">
    <div class="titleform">
        <h1>ASIGNACION Martes&nbsp;&nbsp;&nbsp;DE&nbsp;&nbsp;&nbsp;EMPLEADOS&nbsp;&nbsp;&nbsp;A&nbsp;&nbsp;&nbsp;SUB-AREAS</h1>
    </div>
</div>
<div align="center">
    <div style="width:90%;height:80%;" >
        <div style="width:100%;height: 8%;">
            <table style="width:70%;height: 8%;">
                <tr style="width:60%;height: 8%;">
                    <td>
                        <div id="Div_ComboSedesAreas" align="center">
                            <?php echo $cb_combo_sede_areas; ?>
                            
                        </div>
                         

                              
                        
                    </td>
                </tr>
            </table>
        </div>
        <input id="hCodigoSubArea" type="hidden">
<!--        <input id="hCodigoEmpleado">-->
     <input id="hCodigoEmpleado" type="hidden">
        <div id="Div_ContenidoEmpleadoSubAreas" style="width:100%;height: 92%;">
            <div style="width:100%;height: 42%;">
                <table width="100%">
                    <tr>
                        <td>
                            <div style="width:100%;">
                                <div id="Div_titleTablaSubAreas" align="center" style="width:100%;">
                                    <div style="float: left; width: 30%">
                                        <?php
                                            if (isset($_SESSION["permiso_formulario_servicio"][226]["AGREGAR_SUBAREA"]) && ($_SESSION["permiso_formulario_servicio"][226]["AGREGAR_SUBAREA"]==1)){
                                                $toolbarx->SetBoton("btnAgregarSubAreas", "Agregar Sub Areas", "btn", "onclick,onkeypress", "agregarSubAreas()", "../../../../medifacil_front/imagen/icono/apply.png", "", "", true);
                                                $toolbarx->Mostrar();
                                            }
                                        ?>
                                    </div>
                                    <div style="float: right; width: 50%"><h1 align="left">Sub-&aacute;reas</h1></div>
                                </div>
                                <div style="clear: both"></div>
                                <div id="Div_TablaSubAreas" style="width:530px;height:220px;"></div>
                            </div>
                        </td>
                        <td width="5"></td>
                        <td>
                            <div style="width:100%;">
                                <div id="Div_titleTablaEmpleadosAreas" align="center" style="width:100%;">
                                    <h1>Empleados del área</h1>
                                </div>                                
                                <div id="Div_TablaEmpleadosArea" style="width:530px;height:220px;"></div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div><br>
            <div align="center" style="width:100%;height: 6%;">
                <table>
                    <tr>&nbsp;</tr>
                    <tr>
                        <td>
                            <?php
                                if (isset($_SESSION["permiso_formulario_servicio"][226]["ASIG_EMP_SUBAREA"]) && ($_SESSION["permiso_formulario_servicio"][226]["ASIG_EMP_SUBAREA"]==1)){
                                    $toolbar->SetBoton("Asignacion Empleado a SubArea", "Asignar", "btn", "onclick,onkeypress", "asignarEmpleadoaSubArea()", "../../../../medifacil_front/imagen/icono/apply.png", "", "", true);
                                    $toolbar->Mostrar();
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            <input id="hCodigoEmpleadoSubArea" type="hidden"/>
            <div style="width:100%;height: 44%;"><br>
                <div id="Div_titleTablaEmpleadosSubArea" align="center" style="width:100%;">
                    <h1>Empleados asignados a sub-áreas</h1>
                </div><div style="clear: both"></div>
                <div id="Div_TablaEmpleadosSubArea" style="width:1000px;height:92%"></div>
            </div>
        </div>
    </div>
</div>    
