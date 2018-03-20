<?php

require_once("../../../pholivo/Html.php");
require_once("../../clogica/LUsuario.php");

class ActionUsuario {

    public function __construct() {
        
    }

    //Actualiza password de usuario
    public function validatePassword($parametros) {
        $accion = "validatePwd";
        $idPersona = $parametros["idPersona"];
        $idSistema = $parametros["idSistema"];
        $idPerfil = "";
        $login = ""; //No es necesario enviar esto
        $password = sha1($parametros["antPassword"]); //Encriptamos password para validar
        $habilitado = "";
        $idUserDataBase = "";

        $o_LFormulario = new LUsuario();
        $rs = $o_LFormulario->spManteUsuario($accion, $idPersona, $idSistema, $idPerfil, $login, $password, $habilitado, $idUserDataBase);
        $rpta = $rs[0][0];
        /*
          if($rpta==0){
          $msj = "Contraseña incorrrecta";
          }
          else{
          $msj = "Contraseña corrrecta";
          }
          return $msj; */
        return $rpta;
    }

    //Actualiza password de usuario
    public function updatePassword($parametros) {
        $accion = "updatePwd";
        $idPersona = $parametros["idPersona"];
        $idSistema = $parametros["idSistema"];
        $idPerfil = "";
        $login = ""; //No es necesario enviar esto
        $password = sha1($parametros["confPassword"]); //Encriptamos la confirmación de la nueva contraseña
        $habilitado = "";
        $idUserDataBase = "";

        $o_LFormulario = new LUsuario();
        $rs = $o_LFormulario->spManteUsuario($accion, $idPersona, $idSistema, $idPerfil, $login, $password, $habilitado, $idUserDataBase);
        $rpta = $rs[0][0];

        if ($rpta == 1) {
            $msj = "Se actualizó contraseña con éxito";
        }
        return $msj;
    }

    //carga la vista
    //2012-02-09 3pm
    //Jose 2012/03/08
    public function mostrarMenuUsuario($iidEmpleado, $codPersona) {
//        $o_LRrhh = new LRrhh();
//        $o_ActionRrhh = new ActionRrhh();
//        $arrayCombo = $o_LRrhh->seleccionarCategoria();
//        $o_Combo = new Combo($arrayCombo);
//        $optionsHTML = '0';
//        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
//        $iidPuestoEmpleado = '';
//        $tablaPeriodos = $o_ActionRrhh->tablaPeriodos($iidPuestoEmpleado);
//        $comboContrato = $o_LRrhh->listaModalidadContrato();
//        $comboSucursal = $o_LRrhh->listaSucursal('0110073', ''); //id de la empresa HMLO -> 0110073
//        $tipoSueldo = $o_LRrhh->listaTipoSueldo();
//        $idEmpMod = "";
//        $modlidad = "";
//        $sueldo = "";
//        $fechini = "";
//        $fechfin = "";
//        $flag1 = "block";
//        $flag2 = "none";
//        $flag3 = "none";

        $o_LUsuario = new LUsuario();

        $comboPerfil = $o_LUsuario->comboPerfiles($codPersona);

        $comboUsuario = $o_LUsuario->getUsuario($codPersona);

        $existeUsuario = trim($comboUsuario[0][0]);

        $comboActividad = $o_LUsuario->comboActividad();

        $arrayActividadPersona = $o_LUsuario->LlistaExisteActividad($codPersona);
        $actividadPersona = trim($arrayActividadPersona[0][1]);
      //  print_r($arrayActividadPersona);
        $verificaPuesto = $o_LUsuario->verificaPuesto($codPersona);

        $existePuesto = trim($verificaPuesto[0][0]);
//        echo $existePuesto;
//        echo $existeUsuario;
//        if ($existe == 0) {
//            $disabled = "disabled='disabled'";
//        } else {
//            $disabled = "";
//        }
//        $existe=0;
//        $disabled  = "disabled='disabled'";
        //echo $comboPerfil;
        require_once("../../cvista/usuario/vRegistroUsuario.php");
    }

    public function crearUsuario($usuario, $codPersona, $idPerfil) {
        $o_LUsuario = new LUsuario();
        $resultado = $o_LUsuario->crearUsuario($usuario, $codPersona, $idPerfil);
        return $resultado;
    }

    public function modificarUsuario($codPersona, $idPerfil) {
        $o_LUsuario = new LUsuario();
        $resultado = $o_LUsuario->modificarUsuario($codPersona, $idPerfil);
        return $resultado;
    }

    public function modificarActividad($codPersona, $codActividad) {
        $o_LUsuario = new LUsuario();
        $resultado = $o_LUsuario->modificarActividad($codPersona, $codActividad);
        return $resultado;
    }

    public function listaPerfilesXUsuario($codPersona) {
        $o_LUsuario = new LUsuario();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LUsuario->listaPerfilesXUsuario($codPersona);
        $arrayCabecera = array(0 => "ID PERFIL", 1 => "PERFIL", 2 => "estado", 3 => "ESTADO");
        $arrayTamano = array(0 => "100", 1 => "380", 2 => "50", 3 => "180");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer", 3 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "true", 3 => "false");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function listaFormulariosXPerfilXUsuario($codPersona, $idPerfil) {
        $o_LUsuario = new LUsuario();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LUsuario->listaFormulariosXPerfilXUsuario($codPersona, $idPerfil);
        $arrayCabecera = array(0 => "ID FORMULARIO", 1 => "FORMULARIO", 2 => "estado", 3 => "ESTADO");
        $arrayTamano = array(0 => "100", 1 => "380", 2 => "50", 3 => "180");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer", 3 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "true", 3 => "false");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function listaServiciosXFormulariosXPerfilXUsuario($codPersona, $idFormulario) {
        $o_LUsuario = new LUsuario();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LUsuario->listaServiciosXFormulariosXPerfilXUsuario($codPersona, $idFormulario);
        $arrayCabecera = array(0 => "ID SERVICIO", 1 => "SERVICIO", 2 => "estado", 3 => "ESTADO");
        $arrayTamano = array(0 => "100", 1 => "380", 2 => "50", 3 => "180");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer", 3 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "true", 3 => "false");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }
}
?>
