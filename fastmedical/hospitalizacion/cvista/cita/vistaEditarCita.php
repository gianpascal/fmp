<input type="hidden" id="fechaSeleccionadaEditarCita" value="<?php echo $arrayDatos['0']['dFechaServicio'] ?>" />
<input type="hidden" id="cronogramaDestinoEditarCita" value="" />
<input type="hidden" id="fechaActualEditarCita" value="<?php echo date('d/m/Y'); ?>" />


<fieldset>
    <div style="height: 250px; width: 200px; float: left">
        <div style="height: 30px; width: 200px; float: left; color: #00C6AA">
            Fecha

        </div>
        <div id="calendarioEditarCitas" style="height: 220px; width: 200px; float: left;">

        </div>

    </div>
    <div style="height: 250px; width: 500px; float: left">

        <div style="height: 30px; width: 500px; float: left; color: #00C6AA">
           Especialidad:
           <select id="servicioEditarCita" onchange="cargarMedicosEditarcitaEspecialidad();">
               <?php foreach ($arrayServicios as $value) { 
                   $seleccionado='';
                   if($arrayDatos['0']['c_cod_ser_pro']==$value['c_cod_ser_pro']){
                       $seleccionado='selected';
                   }
                   ?>
                   <option <?php echo $seleccionado; ?> value="<?php echo $value['c_cod_ser_pro'] ?>" > <?php echo $value['v_desc_ser_pro'] ?></option>
                <?php } ?>
               
           </select>

        </div>
        <div id="divTablaMedicosEditarCita" style="height: 190px; width: 500px; float: left; ">

        </div>
        <div style="height: 30px; width: 200px; float: left;">
            <div style="margin: 0 auto;">
                <div id="divBotonGrabarEditarCita" style="float: left" id="">
                    <a href="javascript:grabarEditarCita();">
                        <img src="../../../../medifacil_front/imagen/btn/b_grabar__on.gif">
                    </a>
                </div>
                <div style="float: left" id="">
                    <a href="javascript:cancelarEditarCita();">
                        <img src="../../../../medifacil_front/imagen/btn/b_cancelar_on.gif">
                    </a>
                </div>
            </div> 
        </div>
    </div>
    <div style="height: 250px; width: 90px; float: left">
        <div style="height: 30px; width: 90px; float: left; color: #00C6AA">
            Turnos:
        </div>
        <div id="divTurnosEditar" style="height: 220px; width: 90px; float: left; ">
            <select style="height:200px;width: 80px; " name="" multiple="multiple">

            </select>
        </div> 
    </div>
</fieldset>
