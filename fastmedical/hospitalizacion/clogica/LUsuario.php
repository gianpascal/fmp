<?php

//session_start();
include_once("../../cdatos/DUsuario.php");
include_once("../../cdatos/DTesoreria.php");

class LUsuario {

    private $dUsuario;

    public function __construct() {
        $this->dUsuario = new DUsuario();
    }

    //Para guardar nuevo usuario
    public function spManteUsuario($accion, $idPersona, $idSistema, $idPerfil, $login, $password, $habilitado, $idUserDataBase) {
        $o_DUsuario = new DUsuario();
        $rs = $o_DUsuario->spManteUsuario($accion, $idPersona, $idSistema, $idPerfil, $login, $password, $habilitado, $idUserDataBase);
        return $rs;
    }

    public function comboPerfiles($codPerson) {
        $o_DUsuario = new DUsuario();
        $rs = $o_DUsuario->listaPerfiles($codPerson);
        return $rs;
    }

    /*
      public function comboActividad($codPersona) {
      $o_DUsuario = new DUsuario();
      $rs = $o_DUsuario->DlistaExisteActividad($codPersona);
      return $rs;
      } */

    public function comboActividad() {
        $o_DUsuario = new DUsuario();
        $rs = $o_DUsuario->listaActividad();
        return $rs;
    }

    public function LlistaExisteActividad($codPersona) {
            $o_DUsuario = new DUsuario();
            $rs = $o_DUsuario->DlistaExisteActividad($codPersona);
            return $rs;
    }

    public function getUsuario($codPersona) {
        $o_DUsuario = new DUsuario();
        $rs = $o_DUsuario->getUsuario($codPersona);
        return $rs;
    }

    public function verificaPuesto($codPersona) {
        $o_DUsuario = new DUsuario();
        $rs = $o_DUsuario->verificaPuesto($codPersona);
        return $rs;
    }

    public function crearUsuario($usuario, $codPersona, $idPerfil) {
        $o_DUsuario1 = new DUsuario();
        $o_DUsuario2 = new DUsuario();
        $o_DUsuario3 = new DUsuario();
        $resultado1 = $o_DUsuario1->guardarUsuario($usuario, $codPersona, $idPerfil);

        switch (trim($resultado1[0][0])) {
            case "0": {
                    $rs1 = "<p style='color: red; font-weight: bold'>El usuario ya Existe</p>";
                    break;
                }
            case "1": {
                    $rs1 = "<p style='color: blue; font-weight: bold'>Usuario registrado correctamente</p>";
                    break;
                }
            case "-1": {
                    $rs1 = "<p style='color: red; font-weight: bold'>El perfil no tiene formularios</p>";
                    break;
                }
            default: {
                    $rs1 = "<p style='color: red; font-weight: bold'>" . trim($resultado1[0][0]) . "</p>";
                    break;
                }
        }


        if (trim($resultado1[0][0]) == 1) {
//            $resultado2 = $o_DUsuario2->guardarPermisosFormulario($codPersona, $idPerfil);
//            $resultado3 = $o_DUsuario3->guardarPermisosServicio($codPersona, $idPerfil);
            $resultado2 = $o_DUsuario2->modificarPermisosFormulario($codPersona, $idPerfil);
            $resultado3 = $o_DUsuario3->modificarPermisosServicio($codPersona, $idPerfil);

            switch (trim($resultado2[0][0])) {
                case "0": {
                        $rs2 = "<p style='color: red; font-weight: bold'>Los formularios ya existen</p>";
                        break;
                    }
                case "1": {
                        $rs2 = "<p style='color: blue; font-weight: bold'>Formularios habilitados</p>";
                        break;
                    }
                default: {
                        $rs2 = "<p style='color: red; font-weight: bold'>" . trim($resultado1[0][0]) . "</p>";
                        break;
                    }
            }

            switch (trim($resultado3[0][0])) {
                case "0": {
                        $rs3 = "<p style='color: red; font-weight: bold'>Los servicios ya existen</p>";
                        break;
                    }
                case "1": {
                        $rs3 = "<p style='color: blue; font-weight: bold'>Servicios habilitados</p>";
                        break;
                    }
                default: {
                        $rs3 = "<p style='color: red; font-weight: bold'>" . trim($resultado1[0][0]) . "</p>";
                        break;
                    }
            }
            return $rs1 . $rs2 . $rs3;
        } else {
            return $rs1;
        }
    }

    public function modificarUsuario($codPersona, $idPerfil) {
        $o_DUsuario1 = new DUsuario();
        $o_DUsuario2 = new DUsuario();
        $o_DUsuario3 = new DUsuario();
        $resultado1 = $o_DUsuario1->modificarUsuario($codPersona, $idPerfil);
        $resultado2 = $o_DUsuario2->modificarPermisosFormulario($codPersona, $idPerfil);
        $resultado3 = $o_DUsuario3->modificarPermisosServicio($codPersona, $idPerfil);

        switch (trim($resultado1[0][0])) {
            case "0": {
                    $rs1 = "<p style='color: blue; font-weight: bold'>Perfil actual modificado</p>";
                    break;
                }
            case "1": {
                    $rs1 = "<p style='color: blue; font-weight: bold'>Usuario modificado correctamente</p>";
                    break;
                }
            case "-1": {
                    $rs1 = "<p style='color: red; font-weight: bold'>El perfil no tiene formularios</p>";
                    break;
                }
        }

        switch (trim($resultado2[0][0])) {
            case "1": {
                    $rs2 = "<p style='color: blue; font-weight: bold'>Formularios modificados correctamente</p>";
                    break;
                }
            default: {
                    $rs2 = "<p style='color: red; font-weight: bold'>" . trim($resultado1[0][0]) . "</p>";
                    break;
                }
        }

        switch (trim($resultado3[0][0])) {
            case "1": {
                    $rs3 = "<p style='color: blue; font-weight: bold'>Servicios modificados correctamente</p>";
                    break;
                }
            default: {
                    $rs3 = "<p style='color: red; font-weight: bold'>" . trim($resultado1[0][0]) . "</p>";
                    break;
                }
        }

        return $rs1 . $rs2 . $rs3;
    }

    public function modificarActividad($codPersona, $codActividad) {
        $o_DUsuario = new DUsuario();
        $resultado = $o_DUsuario->modificarActividad($codPersona, $codActividad);
    }

    public function listaPerfilesXUsuario($codPersona) {
        $o_DUsuario = new DUsuario();
        $rs = $o_DUsuario->listaPerfilesXUsuario($codPersona);
        foreach ($rs as $j => $fila) {
            if ($rs[$j][2] == 1)
                array_push($rs[$j], "Activado");
            else if ($rs[$j][2] == 0)
                array_push($rs[$j], "Desactivado");
        }
        return $rs;
    }

    public function listaFormulariosXPerfilXUsuario($codPersona, $idPerfil) {
        $o_DUsuario = new DUsuario();
        $rs = $o_DUsuario->listaFormulariosXPerfilXUsuario($codPersona, $idPerfil);
        foreach ($rs as $j => $fila) {
            if ($rs[$j][2] == 1)
                array_push($rs[$j], "Activado");
            else if ($rs[$j][2] == 0)
                array_push($rs[$j], "Desactivado");
        }
        return $rs;
    }

    public function listaServiciosXFormulariosXPerfilXUsuario($codPersona, $idFormulario) {
        $o_DUsuario = new DUsuario();
        $rs = $o_DUsuario->listaServiciosXFormulariosXPerfilXUsuario($codPersona, $idFormulario);
        foreach ($rs as $j => $fila) {
            if ($rs[$j][2] == 1)
                array_push($rs[$j], "Activado");
            else if ($rs[$j][2] == 0)
                array_push($rs[$j], "Desactivado");
        }
        return $rs;
    }

    public function lcargarTablaPacientes() {
        $o_DTesoreria = new DTesoreria();
        $respuesta = $o_DTesoreria->dcargarTablaPacientes();
        foreach ($respuesta as $key => $value) {
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/edit2.png ^ Accion");
        }
        return $respuesta;
    }

}

?>
