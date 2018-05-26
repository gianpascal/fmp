
<?php
/*----------estos datos bienen de preMostrarCV-------------*/
//$codPersona=$resultado[0][0];
$nomDocumento=$resultado[0][2];
//$version=$resultado[0][4];
$archivo=$resultado[0][5];
 //$ruta=$resultado[0][6];

echo "<table border='0' cellpadding='0' cellspacing='0'>".
        "<tr><td>";

echo "<a href=\"".$archivo."\">".$nomDocumento."</a></li>\n";

echo '</td>
      <td width ="100"> </td>
      <td>
       <div  id ="DivDetalle" style=" float:right;width:150px;">
';
                    $toolbar=new ToollBar("right");
                    $toolbar->SetBoton("Adjuntar","Adjuntar otro archivo","btn","onclick,onkeypress","adjuntarOtroFile()","../../../../fastmedical_front/imagen/icono/adjunto.gif","","",true);
                    //$toolbar->SetBoton("VER","Ver Datos","btn","onclick,onkeypress","ventana_formulario_persona('setDatosContribuyente')","../../../../fastmedical_front/imagen/icono/add_user.png","","",true);
                    $toolbar->Mostrar();
  echo '</div>
      </td>
      </tr></table>';
?>