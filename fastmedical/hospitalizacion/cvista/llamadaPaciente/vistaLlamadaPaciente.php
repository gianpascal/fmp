<div style="width:850px; margin:1px auto; border: #006600 solid; height: 650px">
    <div class="titleform">
        <h1>Pantallas para llamadas a Pacientes</h1>
    </div>
    <input type="hidden"  id="hidPantalla" name="hidPantalla" value="" />
    <div id="Div_botonproyectar" style="width:100%;height: 10%;margin-top: 10px">
<!--        <a href="../../ccontrol/control/control.php?p1=proyectarPantalla" onclick="activarPantalla()"><img src="../../../../fastmedical_front/imagen/btn/proyectar.png" alt="PROYECTAR" title="PROYECTAR"/></a>-->
        <a href="javascript:activarPantalla();"><img src="../../../../fastmedical_front/imagen/btn/proyectar.png" alt="PROYECTAR" title="PROYECTAR"/></a>
        
    </div>    
    <div id="Div_MantenimientoLlamadasPacientes" class="dhx_acc_base_dhx_skyblue" style="width: 100%;height: 90%">

    </div>
    <br/>

    <!-- Esto es cuerpo de cada pantalla -->

    <div id="Div_cuerpoGeneralPantalla" align="center" style="display:none;">
        
            <?php include_once("vistaMantenimientoPantallas.php") ?>
        
    </div>

</div>

