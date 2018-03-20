<div id="campoOculto">
    <input type="hidden" name="txtManual" id="txtManual" value="<?php echo $idManual;?>">
</div>
<div style="width:99%; margin:1px auto; border: #006600" >
    <div class="titleform">
        <h1><?php echo htmlentities($titulo);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; versi&oacute;n v.<?php echo $version;?></h1>
    </div>
</div>
<div id ="botones" style=" float:left;width:100%;height:30px;">
    <?php
    $toolbar2=new ToollBar("left");
    $toolbar2->SetBoton("Editar","Editar","btn","onclick,onkeypress","editaManual()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/editar.png");
    $toolbar2->Mostrar();
    ?>
</div>
<br />
<div  id ="divManual" style=" float:left; width:98%;height:90%;margin-left:1%;margin-right:1%;overflow:scroll; ">
    <?php
    // ---------------para convertir el caracter 
    $cuerpo = str_replace("clmj0","&",$cuerpo);
    $cuerpo = str_replace("ljcm1","'",$cuerpo);
    $cuerpo = str_replace("lcmj2","\"",$cuerpo);
    $cuerpo = str_replace("jclm3","%",$cuerpo);
    $cuerpo = str_replace("mlcj4","#",$cuerpo);
    $cuerpo = str_replace("cmjl5","?",$cuerpo);
    echo $cuerpo;
    ?>
</div>



