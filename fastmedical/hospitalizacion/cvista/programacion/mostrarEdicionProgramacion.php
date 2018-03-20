<input type="hidden" id="hCronogramaMedicoSeleccionado" value="<?php echo $datos["codProgramacion"];?>" />
<fieldset>
    <legend>
        Detalle de la Programación
    </legend>
    <div style="height: 220px; width: 275px; float: left;">
        <fieldset style="margin: 5px;padding: 5px;">


            <div style="height: 25px; width: 80px; float: left; text-align: left; border-bottom: 1px solid gray; ">
                Fecha:
            </div>
            <div style="height: 25px; width: 170px;  float: left;text-align: left; border-bottom: 1px solid gray; ">
                <?php echo utf8_encode($datosCronograma[0]['fechaServicio']); ?>
            </div>
            <div style="height: 25px; width: 80px;  float: left; text-align: left; border-bottom: 1px solid gray; ">
                Puesto:
            </div>
            <div style="height: 25px; width: 170px; float: left; text-align: left;border-bottom: 1px solid gray; ">
                <?php echo utf8_encode($datosCronograma[0]['vNombrePuesto']); ?>
            </div>
            <div style="height: 25px; width: 80px;  float: left; text-align: left;border-bottom: 1px solid gray; ">
                Actividad:
            </div>
            <div style="height: 25px; width: 170px; float: left; text-align: left;border-bottom: 1px solid gray; ">
                <?php echo utf8_encode($datosCronograma[0]['vDescripcionActividad']); ?>
            </div>
            <div style="height: 25px; width: 80px;  float: left; text-align: left;border-bottom: 1px solid gray; ">
                Sede:
            </div>
            <div style="height: 25px; width: 170px;  float: left; text-align: left;border-bottom: 1px solid gray; ">
                 <?php echo utf8_encode($datosCronograma[0]['sede']); ?>
            </div>
            <div style="height: 25px; width: 80px;  float: left; text-align: left;border-bottom: 1px solid gray; ">
                Ambiente:
            </div>
            <div style="min-height: 25px; width: 170px;  float: left; text-align: left;border-bottom: 1px solid gray; ">
                <?php echo utf8_encode($datosCronograma[0]['vNombreAmbienteLogico']); ?>
            </div>
            <div style="height: 25px; width: 80px;  float: left; text-align: left;border-bottom: 1px solid gray; ">
                Turno:
            </div>
            <div style="height: 25px; width: 170px; float: left;text-align: left;border-bottom: 1px solid gray; ">
                <?php echo utf8_encode($datosCronograma[0]['vDescripcionTurno']); ?>
            </div>
        </fieldset>
    </div>
    <div style="height: 220px; width: 255px; float: left;">
        <fieldset style="margin: 5px;padding: 5px;">


            <div style="height: 40px; width: 100px;  float: left; text-align: left;border-bottom: 1px solid gray; ">
                Tiempo de Atencion:
            </div>
            <div style="height: 40px; width: 130px;  float: left;text-align: 
                 left;border-bottom: 1px solid gray; ">
                <?php echo utf8_encode($datosCronograma[0]['iTiempoAtencion']); ?>
            </div>
            <div style="height: 25px; width: 100px;  float: left; text-align: left;border-bottom: 1px solid gray; ">
                Cupos:
            </div>
            <div style="height: 25px; width: 130px;  float: left;text-align: left;border-bottom: 1px solid gray; ">
                <?php echo utf8_encode($datosCronograma[0]['iCuposTotales']); ?>
            </div>
            <div style="height: 40px; width: 100px;  float: left; text-align: left;border-bottom: 1px solid gray; ">
                Cupos Adicionales:
            </div>
            <div style="height: 40px; width: 130px;  float: left;text-align: left;border-bottom: 1px solid gray; ">
                <?php echo utf8_encode($datosCronograma[0]['iCuposAdicionales']); ?>
            </div>
            <div style="height: 25px; width: 100px;  float: left; text-align: left;border-bottom: 1px solid gray; ">
                Programado:
            </div>
            <div style="height: 25px; width: 130px;  float: left;text-align: left;border-bottom: 1px solid gray; ">
                <?php echo utf8_encode($datosCronograma[0]['programado']); ?>
            </div>
            <div style="height: 40px; width: 100px;  float: left; text-align: left;border-bottom: 1px solid gray; ">
                Fecha Activación:
            </div>
            <div style="height: 40px; width: 130px;  float: left;text-align: left;border-bottom: 1px solid gray; ">
                <?php echo utf8_encode($datosCronograma[0]['fechaProgramado']); ?>
            </div>
        </fieldset>
    </div>
    <div style="height: 220px; width: 250px; float: left;">
        <fieldset style="margin: 5px;padding: 5px;"">
            <div id="divAfiliacionesCronograma" >
                
            </div>
        </fieldset>
    </div>
</fieldset>


<style type="text/css">
    td{
        text-align: center;       
    }
    #head td{
        font-weight: bold;
        background-color: lightgreen;
    }
    table{
        width: 750px;
    }
    #vantiguo{max-width: 150px;}
</style>
<div><h4><center>Log de edición y/o eliminación de programación de médico</center></h4></div><br/>
<div align="center">
    <table border="1" align="center">     
        <tr id="head">
            <td >Campo</td><td id="vantiguo">Valor Antiguo</td><td>Turno</td><td>Nombre</td><td>Usuario</td><td>PC</td><td>Fecha Modificación</td>
        </tr>
        <?php foreach ($rs as $key => $value) { ?>
            <tr>
                <td><?php echo $value[0] ?>
                <td><?php echo $value[1] ?></td><td><?php echo $value[2] ?></td>
                <td><?php echo $value[3] ?></td><td><?php echo $value[4] ?></td>
                <td><?php echo $value[5] ?></td><td><?php echo $value[6] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

