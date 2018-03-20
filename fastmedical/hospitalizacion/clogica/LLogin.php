<?php

include_once("../../cdatos/DLogin.php");

class LLogin {

    private $dLogin;
    private $array;

    public function __construct() {
        $this->dLogin = new DLogin();
    }

///////////****RECIBE EL USUARIO Y CONTRASEÑA ****////////////////
    public function getArrayUsuario1($parametros) {


        $arrayAux = $this->dLogin->getArrayUsuario('2', $parametros['p2'], $parametros['p3']);

        //$this->dLogin->getArrayUsuario1($parametros['p4'],$parametros['p2'],$parametros['p3']);
        //sistema,usuario,clave
        $ok = $arrayAux[0]['ok'];
        if ($ok == 'ok') {
        //if($this->dLogin->pTotRows>0)
            $array = $arrayAux[0];
            if (isset($_SESSION)) {
                session_unset();
                // Finalmente, destruye la sesi&oacute;n
                session_destroy();
            }
            session_start();
            //echo 'sesion iniciada';
            // session_id(time());
            $_SESSION['iid_sistema'] = '2';
            $_SESSION['login_user'] = $array['vlogin_usuario'];
            $_SESSION['id_usuario'] = $array['iid_usuario'];
            $_SESSION['host'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['id_persona'] = $array['c_cod_per'];
            $_SESSION['nombre'] = $array['v_nomcompleto'];
            $_SESSION['iCodigoEmpleado'] = $array['iCodigoEmpleado'];
            $_SESSION['base_url'] = "http://172.24.64.226/";

            if (isset($array['iIdCaja'])) {
                $_SESSION["iIdCaja"] = $array['iIdCaja'];
            } else {
                $_SESSION["iIdCaja"] = "nada";
            }
            $_SESSION['path_principal'] = '../../../';
        }
        return $ok;
    }

///////////****SOLICITUD DE COD, CARGO Y CENTRO DE COSTO DEL USUARIO****////////////////
    public function getUsuarioOficina($idpersona, $idempresa) {
        $resultado = $this->dLogin->getArrayUsuarioOficina($idpersona, $idempresa);
        //print_r($resultado);

        if (count($resultado) > 0) {
            $array = $resultado[0];

            //session_name("SIMEDH");
            //session_start();
            $_SESSION["puestosEmpleado"] = $resultado;

            $_SESSION["c_cod_ccos"] = $array['c_cod_ccos'];
            //$_SESSION["c_cod_cargo"] = $array['c_cod_cargo'];
            $_SESSION["v_desc_ccos"] = $array['v_desc_ccos'];
        } else {
            $_SESSION["c_cod_ccos"] = '';
            //$_SESSION["c_cod_cargo"] = '';
            $_SESSION["v_desc_ccos"] = '';
        }
        return false;
    }

    /* public function getDatosInstitucion($cargo,$idpersona){
      $array = $this->dLogin->getArrayDatosInstitucion($cargo,$idpersona);
      if(!empty($array)){
      //session_name("SIMEDH");
      //session_start();
      $_SESSION["nom_empresa"] = $array['nom_empresa'];
      $_SESSION["ruc_empresa"] = $array['ruc_empresa'];
      $_SESSION["dir_empresa"] = $array['dir_empresa'];
      }
      return false;
      } */

///////////****SOLICITA DATOS DE INSTITUCION****////////////////
    public function getDatosInstitucion($idpersona, $idempresa) {
        $resultado = $this->dLogin->getArrayDatosInstitucion($idpersona, $idempresa);
        if (count($resultado)) {
            //session_name("SIMEDH");
            //session_start();
            $array = $resultado[0];
            $_SESSION["v_noment"] = $array['v_noment'];
            $_SESSION["c_nro_ruc"] = $array['c_nro_ruc'];
            $_SESSION["c_dirleg"] = $array['c_dirleg'];
        }
        return false;
    }

///////////****SOLICITA PERMISOS PARA FORMULARIO****////////////////
    public function getUsuarioPermisoFormulario($id_sistema, $id_persona) {

        $rs = $this->dLogin->getArrayUsuarioPermisoFormulario($id_sistema, $id_persona);
        $total = count($rs);
        $permiso_formulario = array();
        if ($total > 0) {
            foreach ($rs as $fila) {
                $permiso_formulario[$fila['iid_formulario']] = $fila;
            }
            //session_start();
            $_SESSION['permiso_formulario'] = $permiso_formulario;
            $resultado = 1;
        } else
            $resultado = 0;
        return $resultado;
    }

///////////****SOLICITA PERMISOS PARA ACCEDER A LOS SERVICIOS***////////////////
    public function getUsuarioPermisoServicio($idpersona, $sistema) {
        //$rs = $this->dLogin->getArrayUsuarioPermisoServicio($idpersona,$sistema);
        $o_DLogin = new DLogin();
        $rs = $o_DLogin->getArrayUsuarioPermisoServicio($idpersona, $sistema);
        $total = count($rs);
        $permiso_formulario_servicio = array();
        //echo $total."<br><br><br>";
        if ($total > 0) {
            foreach ($rs as $fila) {
                $permiso_formulario_servicio[$fila['iid_formulario']][$fila['vnom_servicio']] = 1;
            }
        }

        $_SESSION['permiso_formulario_servicio'] = $permiso_formulario_servicio;
        //print_r($_SESSION['permiso_formulario_servicio']);
        return false;
    }

    public function getCargaMenu($sistema, $nivel, $idpersona) {
        print_r($this->dLogin->getArrayCargaMenu($sistema, $nivel, $idpersona));
        return $this->dLogin;
    }

    public function getCargaMenuConsulta($idformulario) {
        $this->dLogin->getArrayCargaMenuConsulta($idformulario);
        return $this->dLogin;
    }

    public function verificaSesion($accion, $sesion, $tiempo, $sistema, $contenido, $idusuario, $tcaduca, $ip, $id) {
        $o_DLogin = new DLogin();
        $rs = $o_DLogin->getAccionSesion($accion, $sesion, $tiempo, $sistema, $contenido, $idusuario, $tcaduca, $ip, $id);
        return $rs;
    }

}

?>