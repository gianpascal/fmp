<div class="titleform" >
    <h1>
        <?php echo "$nombre - Codigo: $c_cod_per"; ?>
    </h1>

</div>
<div id="divContratos" style="width:900px;  " >
    <fieldset style="width:660px ">
        <legend>
            Contratos:
        </legend>
        <div id="divTablaContrato" style="height:150px;width:660px;" >

        </div>
        <div id="toolbar">
            <?php
            $toolbar = new ToollBar("right");
            if (isset($_SESSION["permiso_formulario_servicio"][121]["VENTANA_NUEVO_CONTRATO"]) && ($_SESSION["permiso_formulario_servicio"][121]["VENTANA_NUEVO_CONTRATO"] == 1)) {
                $verBotonVentanaNuevoContrato = 1;
            } else {
                $verBotonVentanaNuevoContrato = 0;
            }
            $toolbar->SetBoton("NUEVO", "Nuevo", "btn", "onclick,onkeypress", "ventanaMantenimientoContrato(1,'','')", "../../../../medifacil_front/imagen/icono/nuevo.png", "", "", $verBotonVentanaNuevoContrato);
            $toolbar->Mostrar();
            ?>
        </div>
    </fieldset>
</div>
<div id="divAreasPorPuesto" style="width:900px; " >
    <fieldset style="width:660px ">
        <legend>
            Areas por Puestos:
        </legend>
        <div id="divTablaAreaPuestoEmpleado" style="height:150px;width:660px;" >

        </div>
        <div id="toolbar">
            <input id="hPuestoEmpleado"  type="hidden"/>

            <?php
            $toolbar1 = new ToollBar("right");
            
            if (isset($_SESSION["permiso_formulario_servicio"][121]["ASIGNAR_PUESTO_EMPLEADO_AREA"]) && ($_SESSION["permiso_formulario_servicio"][121]["ASIGNAR_PUESTO_EMPLEADO_AREA"] == 1)) {
                $funcionBoton='verBuscadorAreas()';
            } else {
                 $funcionBoton='';
            }
            $toolbar1->SetBoton("AsignarArea", "Asignar Area", "btn", "onclick,onkeypress", $funcionBoton, "../../../../medifacil_front/imagen/icono/b_tree.gif", "", "", false);
            $toolbar1->Mostrar();
            ?>
        </div>
    </fieldset>
</div>


