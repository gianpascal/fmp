<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="../../../javascript/actomedico/llamarPaciente.js"></script>
 <script type="text/javascript" src="../../../javascript/windowsprotoype/prototype.js"></script>
        <script type="text/javascript" src="../../../javascript/windowsprotoype/effects.js"></script>
        <script type="text/javascript" src="../../../javascript/windowsprotoype/window.js"></script>
        <script type="text/javascript" src="../../../javascript/windowsprotoype/window_effects.js"></script>
        <script type="text/javascript" src="../../../javascript/windowsprotoype/debug.js"></script>
        <script type="text/javascript" src="../../../javascript/windowsprotoype/autocomplete.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Llamada de Pantalla</title>
<style type="text/css">
            @import url("../../../estilo/simedh.css");
            @import url("../../../estilo/default.css");
            @import url("../../../estilo/alphacube.css");
            @import url("../../../estilo/dhtmlxtree.css");
            @import url("../../../estilo/dhtmlxtabbar.css");
            @import url("../../../estilo/dhtmlxcalendar.css");
            @import url("../../../estilo/dhtmlgoodies_calendar.css");
            @import url("../../../estilo/tabs.css");
            @import url("../../../estilo/autocomplete.css");
            @import url("../../../estilo/dhtmlxgrid/dhtmlxgrid.css");
            @import url("../../../estilo/dhtmlxgrid/dhtmlxgrid_dhx_skyblue1.css");
            @import url("../../../estilo/dhtmlxgrid/dhtmlxgrid_dhx_blue.css");
            @import url("../../../estilo/dhtmlxgrid/dhtmlxgrid_dhx_black.css");
</style>
<script type="text/javascript">
 
function MM_CheckFlashVersion(reqVerStr,msg){
  with(navigator){
    var isIE  = (appVersion.indexOf("MSIE") != -1 && userAgent.indexOf("Opera") == -1);
    var isWin = (appVersion.toLowerCase().indexOf("win") != -1);
    if (!isIE || !isWin){  
      var flashVer = -1;
      if (plugins && plugins.length > 0){
        var desc = plugins["Shockwave Flash"] ? plugins["Shockwave Flash"].description : "";
        desc = plugins["Shockwave Flash 2.0"] ? plugins["Shockwave Flash 2.0"].description : desc;
        if (desc == "") flashVer = -1;
        else{
          var descArr = desc.split(" ");
          var tempArrMajor = descArr[2].split(".");
          var verMajor = tempArrMajor[0];
          var tempArrMinor = (descArr[3] != "") ? descArr[3].split("r") : descArr[4].split("r");
          var verMinor = (tempArrMinor[1] > 0) ? tempArrMinor[1] : 0;
          flashVer =  parseFloat(verMajor + "." + verMinor);
        }
      }
      // WebTV has Flash Player 4 or lower -- too low for video
      else if (userAgent.toLowerCase().indexOf("webtv") != -1) flashVer = 4.0;

      var verArr = reqVerStr.split(",");
      var reqVer = parseFloat(verArr[0] + "." + verArr[2]);
  
      if (flashVer < reqVer){
        if (confirm(msg))
          window.location = "http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash";
      }
    }
  } 
}
</script>
<script src="../../../Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body onload="MM_CheckFlashVersion('8,0,0,0','El contenido de la página requiere una nueva versión del reproductor Adobe Flash.  Desea descargarlo ahora?');">
<div style="width:100%; margin:1px auto; border: #006600 solid; height:400px">
    <div style=" margin: 0 auto; width: 600px; height: 400px;">
          <script type="text/javascript">
        AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0','width','500','height','400','id','FLVPlayer','src','FLVPlayer_Progressive','flashvars','&MM_ComponentVersion=1&skinName=Clear_Skin_1&streamName=hosp&autoPlay=true&autoRewind=true','quality','high','scale','noscale','name','FLVPlayer','salign','lt','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','FLVPlayer_Progressive' ); //end AC code
      </script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="300" height="300" id="FLVPlayer">
      <param name="movie" value="FLVPlayer_Progressive.swf" />
      <param name="salign" value="lt" />
      <param name="quality" value="high" />
      <param name="scale" value="noscale" />
      <param name="FlashVars" value="&MM_ComponentVersion=1&skinName=Clear_Skin_1&streamName=hosp&autoPlay=true&autoRewind=true" />
      <embed src="FLVPlayer_Progressive.swf" flashvars="&MM_ComponentVersion=1&skinName=Clear_Skin_1&streamName=hosp&autoPlay=true&autoRewind=true" quality="high" scale="noscale" width="300" height="300" name="FLVPlayer" salign="LT" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" />      
</object></noscript>
        
        
    </div>


</div>
    <input id="hpantalla"  value="<?php echo $_SESSION["codigopantalla"];?>" type="hidden" />
    <input id="numeroEspacios"  value="4" type="hidden" />
<div style="width:100%; margin:1px auto; border: #006600 solid; height:400px; background-color:#eeeeee; ">
    <div style=" width:100%; height: 49% "  >
        <div style=" width:49%; height: 100%; border: #006600 solid; float: left; ">
            <div id="div1" style=" margin: 10px auto; width: 90%; height: 50%; font-size: 60px; color:#aa0000 ">
<!--                C21: Rojas M-->
            </div>

             <input id="hconsultorio1"  value="" type="hidden" />


        </div>
        <div style=" width:50%; height: 100%; border: #006600 solid; float: left;">
            <div id="div2" style=" margin: 10px auto; width: 90%; height: 50%; font-size: 70px; color:#aa0000 ">
<!--                C11: Arroyo E-->
            </div>
            <input id="hconsultorio2"  value="" type="hidden" />
        </div>
    </div>
    <div style=" width:100%; height: 49% "  >
        <div style=" width:49%; height: 100%; border: #006600 solid; float: left; ">
           <div id="div3"  style=" margin: 10px auto; width: 90%; height: 50%; font-size: 70px; color:#aa0000 ">
<!--                C22: Zumaeta R-->

            </div>
            <input id="hconsultorio3"  value="" type="hidden" />
        </div>
        <div style=" width:50%; height: 100%; border: #006600 solid; float: left;">
            <div id="div4"  style=" margin: 10px auto; width: 90%; height: 50%; font-size: 70px; color:#aa0000 ">
<!--                C28: Ludeña M-->
            </div>
            <input id="hconsultorio4"  value="" type="hidden" />
        </div>
    </div>


</div>

</body>
</html>
<script>
//setInterval("llamarPaciente();",2000);
llamarPaciente1();
</script>


