<?php

include_once("../../cdatos/DAfiliaciones.php");
include_once("../../cdatos/DPersona.php");

class LAfiliaciones {

    //put your code here
    private $dAfiliaciones;

    public function __construct() {
        $this->dAfiliaciones = new DAfiliaciones();
    }

    public function spListaPersonaEssalud($c_cod_per) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->spListaPersonaEssalud($c_cod_per);
        $resultadoArray = array();

        foreach ($resultado as $indice => $fila) {
            if (isset($fila["dFechaNacimiento"]) && !empty($fila["dFechaNacimiento"])) {
                $fechaNac = strtotime($fila["dFechaNacimiento"]);
                //$resultado[$indice]["dFechaNacimiento"]=date("d/m/Y",$fechaNac);
                $fila["dFechaNacimiento"] = date("d/m/Y", $fechaNac);
            }
            if ($fila["cTipoPersona"] == 1) {
                $imagenHab = $fila["cTipoPersona"] . "<img src='../../../../medifacil_front/imagen/icono/agt_action_success.png' alt='Activa' title='Activa'/>";
            } else {
                $imagenHab = $fila["cTipoPersona"] . "<img src='../../../../medifacil_front/imagen/icono/agt_action_fail.png' alt='Inactiva' title='Inactiva'/>";
            }
            $fila["iconoActivo"] = $imagenHab;
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    public function spListaDatosEssalud($c_cod_per) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->spListaDatosEssalud($c_cod_per);
        $resultadoArray = array();

        foreach ($resultado as $indice => $fila) {
            if ($fila["b_activo"] == 1) {
                $imagenHab = $fila["b_activo"] . "<img src='../../../../medifacil_front/imagen/icono/agt_action_success.png' alt='Activo' title='Activo'/>";
            } else {
                $imagenHab = $fila["b_activo"] . "<img src='../../../../medifacil_front/imagen/icono/agt_action_fail.png' alt='Inactivo' title='Inactivo'/>";
            }
            $fila["iconoActivo"] = $imagenHab;
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    public function spListaCabeceraCartaEssalud($c_cod_per) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->spListaCabeceraCartaEssalud($c_cod_per);
        $resultadoArray = array();

        foreach ($resultado as $indice => $fila) {
            if (isset($fila["dfecfin"]) && !empty($fila["dfecfin"])) {
                $fechaFin = strtotime($fila["dfecfin"]);
                //$resultado[$indice]["dfecfin"]=date("d/m/Y",$fechaFin);
                $fila["dfecfin"] = date("d/m/Y", $fechaFin);
            }
            if ($fila["estado"] == 1) {
                $imagenHab = $fila["estado"] . "<img src='../../../../medifacil_front/imagen/icono/agt_action_success.png' alt='Activa' title='Activa'/>";
            } else {
                if ($fila["estado"] == 0) {
                    $imagenHab = $fila["estado"] . "<img src='../../../../medifacil_front/imagen/icono/agt_action_fail.png' alt='Eliminada' title='Eliminada'/>";
                } else {
                    if ($fila["estado"] == 2) {
                        $imagenHab = $fila["estado"] . "<img src='../../../../medifacil_front/imagen/icono/agt_action_fail.png' alt='Cerrada' title='Cerrada'/>";
                    }
                }
            }
            $fila["iconoEstado"] = $imagenHab;
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    public function spListaDetalleCartaEssalud($c_cod_per) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->spListaDetalleCartaEssalud($c_cod_per);
        $resultadoArray = array();

        foreach ($resultado as $indice => $fila) {
            if (isset($fila["fecini"]) && !empty($fila["fecini"])) {
                $fechaInicio = strtotime($fila["fecini"]);
                //$resultado[$indice]["fecini"]=date("d/m/Y",$fechaInicio);
                $fila["fecini"] = date("d/m/Y", $fechaInicio);
            }
            if (isset($fila["fecfin"]) && !empty($fila["fecfin"])) {
                $fechaFin = strtotime($fila["fecfin"]);
                //$resultado[$indice]["fecfin"]=date("d/m/Y",$fechaFin);
                $fila["fecfin"] = date("d/m/Y", $fechaFin);
            }

            if ($fila["estado"] == 1) {
                $imagenHab = $fila["estado"] . "<img src='../../../../medifacil_front/imagen/icono/agt_action_success.png' alt='Activo' title='Activo'/>";
            } else {
                if ($fila["estado"] == 0) {
                    $imagenHab = $fila["estado"] . "<img src='../../../../medifacil_front/imagen/icono/agt_action_fail.png' alt='Eliminado' title='Eliminado'/>";
                } else {
                    if ($fila["estado"] == 2) {
                        $imagenHab = $fila["estado"] . "<img src='../../../../medifacil_front/imagen/icono/agt_action_fail.png' alt='Cerrado' title='Cerrado'/>";
                    }
                }
            }
            $fila["iconoEstado"] = $imagenHab;
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    public function spListaDetalleCartaEssaludPorCabeceraCarta($idCarta) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->spListaDetalleCartaEssaludPorCabeceraCarta($idCarta);
        $resultadoArray = array();

        foreach ($resultado as $indice => $fila) {
            if (isset($fila["fecini"]) && !empty($fila["fecini"])) {
                $fechaInicio = strtotime($fila["fecini"]);
                //$resultado[$indice]["fecini"]=date("d/m/Y",$fechaInicio);
                $fila["fecini"] = date("d/m/Y", $fechaInicio);
            }
            if (isset($fila["fecfin"]) && !empty($fila["fecfin"])) {
                $fechaFin = strtotime($fila["fecfin"]);
                //$resultado[$indice]["fecfin"]=date("d/m/Y",$fechaFin);
                $fila["fecfin"] = date("d/m/Y", $fechaFin);
            }
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    /*
      public function esEssaludAfiliacionActiva($datos){
      $o_DAfiliaciones = new DAfiliaciones();
      $resultado=$o_DAfiliaciones->getArrayAfiliacionGeneral($datos);
      $esEssalud=0;
      foreach($resultado as $ind => $valor){
      if($resultado[$ind]["cAfiliacion"]=='0027' && $resultado[$ind]["bUltimaAfiliacion"]==1 && $resultado[$ind]["bEstado"]==1){
      $esEssalud=1;
      }
      }
      return $esEssalud;
      } */

    public function getUltimaAfiliacionActiva($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->getArrayAfiliacionGeneral($datos);
        $codUltimaAfiliacionActiva = "";
        foreach ($resultado as $ind => $valor) {
            if ($resultado[$ind]["bUltimaAfiliacion"] == 1 && $resultado[$ind]["bEstado"] == 1) {
                $codUltimaAfiliacionActiva = $resultado[$ind]["cAfiliacion"];
            }
        }
        return $codUltimaAfiliacionActiva;
    }

    /*
      public function spMantenimientoDetalleCartaEssalud($idCarta,$idDetalleCarta){
      $o_DAfiliaciones = new DAfiliaciones();
      $resultado = $o_DAfiliaciones->spMantenimientoDetalleCartaEssalud($idCarta,$idDetalleCarta);
      return $resultado;
      } */

    public function obtenerListaContribuyentes($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->getArrayContribuyentes($datos);
        return $resultado;
    }

    public function verificarCodAutogenerado($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->verificarCodAutogenerado($datos);
        return $resultado;
    }

    public function cargarDatosPersona($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->cargarDatosPersona($datos);
        return $resultado;
    }

    public function ActualizarDatosEssalud($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->ActualizarDatosEssalud($datos);
        return $resultado;
    }

    public function InsertarDatosEssalud($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->InsertarDatosEssalud($datos);
        return $resultado;
    }
    
      public function RegistrarAutoGenerado($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->RegistrarAutoGenerado($datos);
        return $resultado;
    }
    
    
    

    public function BuscarPersonaDBSIMI($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->BuscarPersonaDBSIMI($datos);
        foreach ($resultado as $key => $value) {
            array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/good.gif ^ ...");
        }
        return $resultado;
    }

    public function consultarEstadoContribuyente($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->getEstadoContribuyente($datos);
        $contribuyentepuntual = "";
        if (eregi("CONTRIBUYENTE PUNTUAL", $resultado[0][0]) && eregi("0.00", $resultado[0][0])) {
            $contribuyentepuntual = "1";
        } else {
            $contribuyentepuntual = "0";
        }
        return $contribuyentepuntual . "|" . $resultado[0][0];
    }

    public function agregarAfiliacionesalPaciente($datos) {
        $o_DAfiliciones = new DAfiliaciones();
        $afiliaciones = explode("|", $datos["afiliaciones"]);
        foreach ($afiliaciones as $ind => $valor) {
            $o_DAfiliciones->agregaAfiliacionalPaciente($datos, $valor);
        }
    }

    public function quitarAfiliacionesalPaciente($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->deleteAfiliacionalPaciente($datos);
        return $resultado;
    }
    public function QuitarRelacion($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->QuitarRelacion($datos);
        return $resultado;
    }
    
    

    public function listarAfiliacionGeneral($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->getArrayAfiliacionGeneral($datos);
        $cadena = "<fieldset style=\"width:95%;height:95%\"><div style=\"width:100%;height:100%;overflow:auto\"><legend>Afiliaciones Activas</legend><table align=\"left\">";
        foreach ($resultado as $ind => $valor) {
            $cadena.="<tr><td><input onchange=\"javascript:cambiarAfiliacionGeneral('" . $resultado[$ind]["cAfiliacion"] . "','" . $datos['codigoPersona'] . "')\" type=\"radio\" name=\"rbtnafiliacionesactivas\" id=\"rbtnafiliacionesactivas." . $resultado[$ind]["cAfiliacion"] . "\" value=\"" . $resultado[$ind]["cAfiliacion"] . "\"";
            if ($resultado[$ind]["bUltimaAfiliacion"] == 1)
                $cadena.= " checked/>";
            else
                $cadena.= "/>";
            $cadena.=$resultado[$ind]["vDescripcion"] . "</td></tr>";
        }
        $cadena.="</table></div></fieldset>";
        return $cadena;
    }

    public function ltablaxAfiliacionesPersona($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->tablaAfiliacionesActiPersona($datos);
        foreach ($resultado as $key => $value) {
            if ($value[6] == 1) {
                array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/good.gif ^ ...");
            } else {
                array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/nosecurity.png ^ ...");
            }
            if ($value[0] == '0027' || $value[0] == '0002') {
                array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/Verreload.png ^ Ver");
            } else {
                array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/whiteee.PNG ^ Ver");
            }
        }
        return $resultado;
    }

    public function lagregarAfiliacionPersona($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->dagregarAfiliacionPersona($datos);
        return $resultado;
    }

    public function activarAfiliacion($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->activarAfiliacion($datos);
        return $resultado;
    }

    public function lactivarAfiliacionEssalud($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->dactivarAfiliacionEssalud($datos);
        return $resultado;
    }

    public function ltablaxAfiliacionesInacPersona($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->dtablaxAfiliacionesInacPersona($datos);
        return $resultado;
    }

    public function TablaEstadoDeuda($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->TablaEstadoDeuda($datos);
  
            if ($resultado[0][1] == 1) {
                
            } else {
                 if ($resultado[0][2] == 0 && $resultado[0][0]!="SIN PREDIO, NO APLICA CONT. PUNTUAL ") {
                    $fecha = explode(">>>", $resultado[0][0]);
                    $cadena = $fecha[1];
                    $resultado[0][0] = "CONTRIBUYENTE PUNTUAL" . $cadena;
                }
            }

        foreach ($resultado as $key => $value) {
            array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/button_ok.png ^ Ver");
        }
        return $resultado;
    }

    public function TablaListaPersonaEssalud($c_cod_per) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->TablaListaPersonaEssalud($c_cod_per);
        return $resultado;
    }

    public function TablaListaDatosEssalud($c_cod_per) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->ListaDatosEssalud($c_cod_per);
        return $resultado;
    }

    public function TablaListaCabeceraCartaEssalud($c_cod_per) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->TablaListaCabeceraCartaEssalud($c_cod_per);
        return $resultado;
    }

    public function TablaListaDetalleCartaEssaludPorCabeceraCarta($c_cod_per) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->TablaListaDetalleCartaEssaludPorCabeceraCarta($c_cod_per);
        return $resultado;
    }

    public function verificarExistenciaDBContribuyentePuntual($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->verificarExistenciaDBContribuyentePuntual($datos);
        return $resultado;
    }
 public function guardarRelacionEntreDBSIMIandSIMED($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->guardarRelacionEntreDBSIMIandSIMED($datos);
        return $resultado;
    }

    
    
    
    
    public function listarNOAfiliacionGeneral($datos) {
        $o_DAfiliaciones = new DAfiliaciones();
        $resultado = $o_DAfiliaciones->getArrayNOAfiliacionGeneral($datos);
        $cadena = "<fieldset style=\"width:95%;height:95%;\"><div style=\"width:100%;height:100%;overflow:auto\"><legend>Afiliaciones NO Activas</legend><table style=\"overflow:auto\" align=\"left\">";
        foreach ($resultado as $ind => $valor) {
            $cadena.="<tr><td><input type=\"checkbox\" name=\"chkafiliacionesNOactivas\" id=\"chkafiliacionesNOactivas." . $resultado[$ind]["cIdAfiliacion"] . "\" value=\"" . $resultado[$ind]["cIdAfiliacion"] . "\"/> " . $resultado[$ind]["vDescripcion"] . "</td></tr>";
        }
        $cadena.="</table></div></fieldset>";
        return $cadena;
    }

}

?>
