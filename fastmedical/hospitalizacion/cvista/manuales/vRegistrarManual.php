<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <fieldset style="margin:1px;width:95%;height:auto;padding: 0px;">
            <legend>&nbsp; Datos del Manual &nbsp;</legend>
            <table width="600" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
        <p>&nbsp;</p>
    </fieldset>

         <?php
                        require_once("../../ccontrol/control/ActionManual.php");
                        $o_ActionManual	= new ActionManual();
                        $resultado=$o_ActionManual->formRegistroManual();
                        echo $resultado;
                 ?>
    </body>
</html>
