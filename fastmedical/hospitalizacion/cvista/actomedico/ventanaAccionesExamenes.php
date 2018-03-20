<?php
$toolbarx1=new ToollBar("left");
$toolbarx2=new ToollBar("left");
$toolbarx3=new ToollBar("left");
?>
<style type="text/css">
    <!--
    #divContenedorx {
	position:absolute;
	width:600px;
	height:404px;
	z-index:1001;
	top: 16px;
	left: 10px;
    }
    #divUsarObs {
        position:absolute;
        left:219px;
        top:67px;
        width:60%;
        height:90px;
        z-index:1002;
    }
    #divEditarObs {
        position:absolute;
        width:60%;
        height:90px;
        z-index:1002;
        left: 219px;
        top: 171px;
    }
    #divEliminarObs {
        position:absolute;
        left:219px;
        top:278px;
        width:60%;
        height:90px;
        z-index:1002;
    }
    #divUsarx {
        position:absolute;
        left:6px;
        top:70px;
        width:188px;
        height:38px;
        z-index:1003;
    }
    #divEliminarx {
        position:absolute;
        width:188px;
        height:38px;
        z-index:1003;
        left: 4px;
        top: 281px;
    }
    #divEditarx {
        position:absolute;
        width:188px;
        height:38px;
        z-index:1003;
        left: 6px;
        top: 172px;
    }
    #divUsary {
        position:absolute;
        left:6px;
        top:70px;
        width:188px;
        height:39px;
        z-index:1002;
    }
    #divEliminary {
        position:absolute;
        width:188px;
        height:39px;
        z-index:1002;
        left: 4px;
        top: 281px;
    }
    #divEditary {
        position:absolute;
        width:188px;
        height:39px;
        z-index:1002;
        left: 6px;
        top: 172px;
    }
    #divMsjUsar {
        position:absolute;
        left:7px;
        top:109px;
        width:186px;
        height:31px;
        z-index:1002;
    }
    #divMsjEditar {
        position:absolute;
        left:7px;
        top:212px;
        width:186px;
        height:31px;
        z-index:1002;
    }
    #divMsjEliminar {
        position:absolute;
        left:6px;
        top:321px;
        width:186px;
        height:31px;
        z-index:1002;
    }
#divMensaje {
	position:absolute;
	left:26px;
	top:41px;
	width:543px;
	height:19px;
	z-index:1002;
}
    -->
</style>
<div id="divContenedorx">
<div id="divTitulo" style="position:absolute; width:546px; height:21px; z-index:1002; left: 25px; top: 13px;">
        <?php echo "Version : ".$descVersion." &nbsp;&nbsp;Fecha Creación : ".$fechVersion." &nbsp;&nbsp;Estado Etapa :".$vestadoDesarrollo;?></div>
    <div id="divMensaje" style="font-size: 11px;font-weight:lighter; color: #FF6600;" align="center"></div>
  <div id="divMsjUsar" style="font-size: 11px;font-weight: lighter;color: #FF6600;"></div>
  <div id="divMsjEditar" style="font-size: 11px;font-weight: lighter;color: #FF6600;"></div>
  <div id="divMsjEliminar" style="font-size: 11px;font-weight: lighter;color: #FF6600;"></div>
<div id="divUsarx">
        <?php
        $toolbarx1->SetBoton("Utilizar","Utilizar Versión","btn","onclick,onkeypress","accionesVersion('pasarproduccion')",$_SESSION['path_principal']."../medifacil_front/imagen/icono/lassists.png","","",true);
        $toolbarx1->Mostrar();
        ?>
    </div>
    <div id="divEditarx">
        <?php
        $toolbarx2->SetBoton("GenerarEdicion","Generar Versión de Edición","btn","onclick,onkeypress","accionesVersion('pasardesarrollo')",$_SESSION['path_principal']."../medifacil_front/imagen/icono/restaurar.png","","",true);
        $toolbarx2->Mostrar();
        ?>
    </div>
    <div id="divEliminarx">
        <?php
        $toolbarx3->SetBoton("Desactivar","Desactivar Versión","btn","onclick,onkeypress","accionesVersion('desactivarversion')",$_SESSION['path_principal']."../medifacil_front/imagen/icono/anular.png","","",true);
        $toolbarx3->Mostrar();
        ?>
    </div>

    <div id="divUsary"></div>
    <div id="divEliminary"></div>
    <div id="divEditary"></div>
    <div id="divUsarObs">Mediante esta Opci&oacute;n el usuario podr&aacute; podra habilitar la versi&oacute;n actual y ser usada en el sistema.</div>
    <div id="divEditarObs">Mediante esta Opci&oacute;n el usuario podr&aacute; realizar una copia y generar una nueva versi&oacute;n.</div>
    <div id="divEliminarObs">Mediante esta Opci&oacute;n el usuario podr&aacute; desactivar la versi&oacute;n que esta en la etapa de desarrollo o de producci&oacute;n.</div>
    
</div>

