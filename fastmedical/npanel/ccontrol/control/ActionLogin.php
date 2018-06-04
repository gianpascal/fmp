<?php
require_once "../../../pholivo/Html.php";
require_once "../../clogica/LLogin.php";
include_once "../../cdatos/DLogin.php";

class ActionLogin
{

    public function __construct()
    {
    }

    public function validaUsuario($parametros)
    {
        $oLLogin = new LLogin();
        $respuesta = $oLLogin->getArrayUsuarioBD($parametros);
        if ($respuesta == 1) {
            $respuesta2 = $oLLogin->getArrayUsuario($parametros);
            if ($respuesta2 == 1) {
                //$respuesta = $oLLogin->getArrayUsuario($parametros);
                //$this->getUsuarioPermiso();----------->ESto tengo que corregir
                //echo "Éxito";
                header("location: ../../cvista/inicio/inicio.php");
            } else {
                //echo "Horror";
                $msn = 1;
                header("location: ../../index.php?msn=$msn");
            }
        } else {
            $msn = 2;
            header("location: ../../index.php?msn=$msn");
        }
        exit;
    }

    public function getUsuarioOficina()
    {
        $oLLogin = new LLogin();
        $empresa = '0001'; //Es el id para el HMLO
        $respuesta = $oLLogin->getUsuarioOficina($_SESSION["c_cod_per"], $empresa);
        return $respuesta;
    }

    public function getDatosInstitucion()
    {
        $oLLogin = new LLogin();
        $empresa = '0001'; //Es el id para el HMLO
        $respuesta = $oLLogin->getDatosInstitucion($_SESSION["c_cod_per"], $empresa);
        return false;
    }

    public function getUsuarioPermiso()
    {
    //    var_dump($_SESSION);
        $oLLogin = new LLogin();
        $valor = $oLLogin->getUsuarioPermisoFormulario($_SESSION["iid_sistema"], $_SESSION["c_cod_per"]);
        if ($valor == 1) {
            $oLLogin->getUsuarioPermisoServicio($_SESSION["iid_sistema"], $_SESSION["c_cod_per"]);
        }
        return false;
    }

    public function getCargaMenu()
    {
        $oLLogin = new LLogin();
        //return $oLLogin->getCargaMenu('1','0',$_SESSION['id_persona']);
        return $oLLogin->getCargaMenu($_SESSION["iid_sistema"], '0', $_SESSION["c_cod_per"]);
    }

    public function getCargaMenuConsulta($idformulario)
    {
        $oLLogin = new LLogin();
        return $oLLogin->getCargaMenuConsulta($idformulario);
    }
}
