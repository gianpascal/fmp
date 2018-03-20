<?php
    function mensaje($tipo)
    {
        switch($tipo)
        {
                case 1:	$msn="Datos personales no registrados.";
                break;
                case 2:	$msn="Usuario no registrado.";
                break;
                case 3: $msn="Datos de Ingreso no validos.";
                break;
                case 4: $msn="Perdida de Sesion, tiempo maximo transcurrido.";
                break;
                default: $msn="Ingrese sus Datos de Usuario.";
                break;
        }
        return $msn;
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
        <link rel="stylesheet" type="text/css" href="estilo/style.css" />
        <script type="text/javascript" src="../javascript/isiAJAX.js"></script>
        <script type="text/javascript" src="../javascript/isiXML.js"></script>
        <title>Panel de Administraci&oacute;n V.3.</title>
    </head>
    <body onload="javascript: document.login.p2.focus(); myajax = new isiAJAX('intro_right_inicio', 'cargador');">
        <div id="cargador">
            Por Favor Espere &nbsp;&nbsp;&nbsp;&nbsp;
            <img src="../../medifacil_front/imagen/icono/cargando.gif"  border="0" title="CARGANDO" alt="Cargador"/><a href="#" id="hider2"></a>
        </div>
        <div id="main">
            <div id="logo">
                <h1>Panel  <span class="blue">Administraci&oacute;n</span> v <span class="blue">3.0</span></h1>
                <b class="blue">Inicio de Sesi&oacute;n</b> <b></b>
            </div>

            <div id="intro_left">
                <p>SIMEDH - Version 1.0.</p>
            </div>

            <div id="intro_right">
                <p class="white">&nbsp;</p>
            </div>

            <ul id="menu_left">
                <li><a href="#" accesskey="m"><span class="key">A</span>dministrar Sistemas</a></li>
                <li><a href="#" accesskey="s">Sistemas <span class="key">SIMEDH</span> </a></li>
                <li><a href="#" accesskey="s">Soporte <span class="key">E</span>n Linea</a></li>
                <li><a href="#" accesskey="n"><span class="key">A</span>yuda</a></li>
            </ul>

            <div id="left">
                <div class="box">
                    <h2>Actualizaciones On Line</h2>
                    <p><b><a href="#">09 Enero</a> &middot; Alberto Alvarado</b><br/>Se actualizaron los permisos de usuarios, obteniendo mayor velocidad de proceso en las asignaciones de estos.</p>
                    <p><b><a href="#">14 Febrero</a> &middot; Ike Retamozo</b><br/>A la secci&oacute;n de <span class="key">A</span>yuda se le incorporo videos de casos de uso, para el sistema Admincon y Control de Inversiones.</p>
                    <br/>
                </div>

                <div class="note">
                    <p><a href="#" title="Register Now!">Descubra nuevos Sistemas</a> SIMEDH&reg; cuenta con paquetes especiales para su Instituci&oacute;n, consulte con un asesor de ventas.</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </div>
            </div>
            <div id="right">
                <div class="leftcol">
                    <h3><span class="white">Sistema M&eacute;dico Hospitalario</span></h3><br/>
                    <h1 class="blue">SIMEDH</h1>
                    <p>El Panel de Administraci&oacute;n es una herramienta integrada a todos los Sistemas que forman parte de SIMEDH &reg;, desde aqu&iacute; tendra el control de todos los procesos dentro de SIMEDH&reg;, si tiene alguna duda consulte la secci&oacute;n de Ayuda o comuniquese con SIMEDH-Soporte.</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </div>
                <div class="rightcol">
                    <h3>Login de Administrador <span id="loginbutton"><a href="#" title="Log In">&nbsp;</a></span></h3>
                    <form name="login" id="login" action="ccontrol/control/control.php" method="post" >
                        <p style="color:#000000">
                            <img src="../../medifacil_front/imagen/icono/password.png" alt="Image" class="image" />
                            Usuario&nbsp;&nbsp;&nbsp;: &nbsp;<input name="p2" id="p2" type="text" maxlength="20" class="search" /> <br />
                            Password: &nbsp;<input name="p3" id="p3" type="password" maxlength="20" class="search" />
                            <input type="hidden" name="p1" id="p1" value="valida_usuario"/>
                            <input type="hidden" name="p4" id="p4" value="1"/>
                            <input type="submit" value="Ingresar" class="ingresar"/>
                        </p>
                        <p class="red"><?php if(isset($msn)) echo mensaje($msn); else echo "Ingrese sus Datos de Usuario.";?></p>
                    </form>
                </div>
                <div class="rightcol">
                    <h3>Gobierno Electr&oacute;nico</h3>
                    <p><img src="../../medifacil_front/imagen/icono/agt_web.png" alt="Image" class="image" /> El sistema integrado para el sector p&uacute;blico establece los principios y acciones para modernizar la gesti&oacute;n p&uacute;blica y propiciar la descentralizaci&oacute;n del Estado mediante el uso intensivo de las tecnolog&iacute;as de informaci&oacute;n, en este caso el uso de herramientas de gesti&oacute;n intgradas las cuales promueven el incremento de capacidades competitivas en la Administraci&oacute;n P&uacute;blica, empresas y ciudadanos por medio del uso intensivo de las TI, entre otros.</p>
                </div>

                <div class="special">
                    <p>&nbsp;</p>
                </div>
            </div>

            <div id="footer">
                &copy; Copyright <a href="#">Gr@njit@</a><img src="../../medifacil_front/imagen/icono/granjita.jpg" alt="Granjita" title="Gr@njit@"/> 2010 &middot;  Actualizado por <a href="#">SIMEDH</a> 2010 &middot; Resoluci&oacute;n de pantalla recomendada: 1024x768 p&iacute;xeles
            </div>
        </div>
    </body>
</html>