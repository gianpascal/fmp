<?php
$oActionRrhh = new ActionRrhh();
?>
<div align="center" style="width:100%;height: 650px">
    <div style="width:75%;height:5%;background: white">
        <div class="titleform" style="width:100%;height:100%;">
            <h1>Asignación de Servicios a Puestos de Trabajo</h1>
        </div>
    </div>
    <div id="Div_Principal1" style="width:75%;height: 95%;display: block">
        <input id="hidcentrocosto" type="hidden" name="hidcentrocosto" value="" />
        <div id="Div_arbolServiciosxPuestos" style="width:40%;height: 100%;float:left;">

        </div>
        <div style="width:60%;height: 100%;float:right;">
            <div style="height: 10%">
                <div id="Div_nombreCentroCostos" style="height: 50%;"></div>
                <div style="height: 50%;">Puestos de Trabajo</div>
            </div>
            <div id="Div_tablaPuestos" style="height: 35%; overflow: auto;"><?php echo $oActionRrhh->listadoPuestosdeTrabajo(''); ?></div>
            <div style="height: 10%">
                <div style="height: 50%"></div>
                <div style="height: 50%">Lista de Servicios Asignados</div>
            </div>
            <div id="Div_tablaServicios1" style="height: 35%; overflow: auto;"><?php echo $oActionRrhh->listadoServiciosAsignados(''); ?></div>
            <div style="height: 10%">
                <div style="height: 50%"></div>
                <div id="Div_btnAgregar" align="center"  style="width:100%;height:50%;display: none">
                    <?php 
                        if($_SESSION["permiso_formulario_servicio"][205]["AGREGAR_SERVICIO_X_PUESTO"]==1){
                            echo "<a href=\"javascript:irAsignacionServiciosxPuestos()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_agregar_on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";
                        }
                    ?>
                </div>

            </div>

        </div>
    </div>
    <div id="Div_Principal2" style="width:70%;height: 95%;display: none">
        <input id="hidpuesto" type="hidden" name="hidpuesto" value="" />
        <div style="width:100%;height: 100%;float:right;">
            <div style="height: 10%">
                <div id="Div_nombrePuesto" style="height: 50%"></div>
                <div style="height: 50%;">Lista de Servicios Asignados</div>
            </div>
            <div id="Div_tablaServicios2" style="height: 35%"><?php echo $oActionRrhh->listadoServiciosAsignados(''); ?></div>
            <div style="height: 10%">
                <div style="height: 50%"></div>
                <div style="height: 50%">Lista de Servicios No Asignados</div>
            </div>
            <div id="Div_tablaServiciosxAsignar" style="height: 35%"><?php echo $oActionRrhh->listadoServiciosparaAsignar(''); ?></div>
            <div style="height: 10%">
                <div style="height: 50%"></div>
                <div id="Div_btnAgregar" align="center"  style="width:100%;height:50%">
                    <?php 
                        if($_SESSION["permiso_formulario_servicio"][205]["REGRESAR_SERVICIO_X_PUESTO"]==1)
                            echo "<a href=\"javascript:regresarAsignacionServiciosxPuestos()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_regresar_on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";
                    ?>
                </div>

            </div>

        </div>
    </div>
</div>