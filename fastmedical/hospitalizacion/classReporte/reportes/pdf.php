<?php
if($_GET) {
    $parametros=$_GET;
}else if($_POST) {
    $parametros = $_POST;
}
$indice=array_keys($parametros);
$c=0;
$datos="";
foreach ($indice as $i => $value) {
    if($c==0)
        $datos.=$value."=".$parametros[$value];
    else
        $datos.="&".$value."=".$parametros[$value];

    $c++;
}
$path="../../classReporte/reportes/setDatosReporte.php?".$datos;
?>
<style type="text/css">
    <!--
    #div_loadig {
        position:absolute;
        width:160px;
        height:40px;
        z-index:1;
        left: 475px;
        top: 305px;
        border : 1px solid #3F7D39;
        -moz-border-radius : 10px;
        margin-left:-80px;
        margin-top:-20px;
        padding : 4px;
    }
    -->
</style>
<div  style="width: 98%; height: 98%;" align="center">
    <div style="width: 100%; height: 100%;" align="center">
        <div id="div_loadig">   <table width="100%" border="0">
                <tr valign="middle">
                    <td>
                        Por Favor Espere
                    </td>
                    <td>
                        <img src="../../../imagen/inicio/cargando.gif"  border="0" title="CARGANDO" alt="Cargador"/><a href="#" id="hider2"></a>
                    </td>
                </tr>
            </table>
        </div>
        <iframe id='vidfrm' width="100%" height="100%" src="<?php echo $path;?>" align="middle">

        </iframe>
    </div>
</div>