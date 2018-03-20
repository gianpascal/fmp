<?php
    require_once("TreeMenuFacilito.php");
     //$array=array("100","Hospital",0,"#",array(array("110","Apoyo al Diagnostico",1,"#",array(array("111","Emergencia",2,"#",""))),array("120","Servicio de Consulta Externa",1,"#",array(array("121","Odontología",2,"#",""),array("122","Pediatría",2,"#",array(array("1221","Pediatria 1",3,"#",""))),array("123","Urologìa",2,"#","")))));
    $array1211 = array("5","n","1211","0","Urologia","#","");
    $array1212 = array("5","n","1212","0","Pediatria","#","");
    $array1213 = array("5","n","1214","0","Odontologia","#","");
    $array1214 = array("5","n","1214","0","Geriatria","#","");
    $array1215 = array("5","n","1215","0","Gastrologia","#","");
    $array1216 = array("5","n","1216","0","Cardiologia","#","");
    $array1217 = array("5","n","1217","0","Traumatologia","#","");
    $array1218 = array("5","n","1218","0","Orinotologia","#","");
    $array1219 = array("5","n","1219","0","Oftalmologia","#","");
    
    $array121 = array("4","n","121","0","Consulta Externa","#",array($array1211,$array1212,$array1213,$array1214,$array1215,$array1216,$array1217,$array1218,$array1219));
    
    $array122 = array("3","n","122","0","Topico","#","");
    $array123 = array("3","123","123","0","Emergencia","#","");
    $array124 = array("3","123","124","0","Hospitalizacion","#","");
    $array111 = array("3","123","111","0","Laboratorio","#","");
    $array112 = array("3","n","112","0","Imagenes","#","");
    $array113 = array("3","n","113","0","Farmacia","#","");
    
    $array12  = array("2","n","120","0","Serivicio de Asistenciamiento","#",array($array121,$array122,$array123,$array124));
    $array11  = array("2","n","110","0","Apoyo al Diagnostico","#",array($array111,$array112,$array113));
    
    $arrayX   = array("1","n","100","0","Hospital","#",array($array11,$array12));
    
	$objMenu = new HTML_TreeMenuFacilito($arrayX,"");
	
    $scriptJSArbolDeMierda = $objMenu->getTreeMenuJSAjax();
?>
<html>
<head>
<style type="text/css">
        body{
            font-family: Georgia;
            font-size: 11pt;
        }
        .treeMenuDefault{
            font-style: italic;
        }
        .treeMenuBold {
            font-style: italic;
            font-weight: bold;
        }
</style>
    <script src="simedh/javascript/HTML_TreeMenu/TreeMenu.js" language="JavaScript" type="text/javascript"></script>
</head>
<body>
<?php  
	$objMenu = new HTML_TreeMenuFacilito($arrayX,"");
	
    $scriptJSArbolDeMierda = $objMenu->getTreeMenuJSAjax();
echo "<br>";
    echo "<script>eval(\"$scriptJSArbolDeMierda\");</script>";
/*
$scriptJSArbolDeMierda = $treeMenu->printMenu();
$scriptJSArbolDeMierda = str_replace("<script type=\"text/javascript\">","",$scriptJSArbolDeMierda);
$scriptJSArbolDeMierda = str_replace("//<![CDATA[","",$scriptJSArbolDeMierda);
$scriptJSArbolDeMierda = str_replace("// ]]>","",$scriptJSArbolDeMierda);
$scriptJSArbolDeMierda = str_replace("</script>","",$scriptJSArbolDeMierda);
$scriptJSArbolDeMierda = str_replace("\n","",$scriptJSArbolDeMierda);
$scriptJSArbolDeMierda = str_replace("\t","",$scriptJSArbolDeMierda);
$scriptJSArbolDeMierda = str_replace("\r","",$scriptJSArbolDeMierda);
$scriptJSArbolDeMierda = str_replace("\"","'",$scriptJSArbolDeMierda);
$scriptJSArbolDeMierda = str_replace("\\","\\\\",$scriptJSArbolDeMierda);
echo "<script>eval(\"$scriptJSArbolDeMierda\");</script>";
*/
	echo "<script>eval(\"$scriptJSArbolDeMierda\");</script>";
?>

</body>
</html>