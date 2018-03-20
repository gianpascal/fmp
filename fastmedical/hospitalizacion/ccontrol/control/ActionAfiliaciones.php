<?php

require_once("../../clogica/LAfiliaciones.php");
require_once("../../../pholivo/tablaDHTMLX.php");
require_once("../../../pholivo/Html.php");

class ActionAfiliaciones {

    public function __construct() {
        
    }

    public function mostrarVerificacionContribuyente($datos) {

        require_once("../../cvista/afiliaciones/vconsultaContribuyentePuntual.php");
    }

    public function AfiliacionInactivasPersona() {
        $o_LAfiliaciones = new LAfiliaciones();
        require_once("../../cvista/afiliaciones/AfiliacionesInactivas.php");
    }

    public function FormularioDatosEssalud() {
        $o_LAfiliaciones = new LAfiliaciones();
        require_once("../../cvista/afiliaciones/FormularioDatosEssalud.php");
    }

    public function mostrarTablaContribuyentePuntual($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LAfiliaciones = new LAfiliaciones();
        $datos == '' ? $arrayFilas = array() : $arrayFilas = $o_LAfiliaciones->obtenerListaContribuyentes($datos);
        $arrayCabecera = array("0" => "Codigo", "1" => "Nombre o Razon Social", "3" => "Estado",);
        $arrayTamano = array("0" => "100", "1" => "*", "3" => "*");
        $arrayTipo = array("0" => "ro", "1" => "ro", "3" => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "left", "3" => "left");
        $arrayHidden = array("0" => "false", "1" => "false", "3" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function BuscarPersonaDBSIMI($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LAfiliaciones = new LAfiliaciones();
        $arrayFilas = $o_LAfiliaciones->BuscarPersonaDBSIMI($datos);
        $arrayCabecera = array("0" => "Codigo", "1" => "Nombre", "2" => "Num. Doc", "3" => "Estado", "4" => "Verificar");
        $arrayTamano = array("0" => "55", "1" => "*", "2" => "55", "3" => "*", "4" => "50");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "img");
        $arrayAlineacion = array("0" => "center", "1" => "left", "2" => "left", "3" => "left", "4" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function consultarContribuyentePuntual($datos) {
        $o_LAfiliaciones = new LAfiliaciones();
        $resultado = $o_LAfiliaciones->consultarEstadoContribuyente($datos);
        return $resultado;
    }

    public function guardarRelacionEntreDBSIMIandSIMED($datos) {
        $o_LAfiliaciones = new LAfiliaciones();
        $resultado = $o_LAfiliaciones->guardarRelacionEntreDBSIMIandSIMED($datos);
        return $resultado;
    }

    public function RegistrarAutoGenerado($datos) {
        $o_LAfiliaciones = new LAfiliaciones();
        $resultado = $o_LAfiliaciones->RegistrarAutoGenerado($datos);
        return $resultado;
    }

    public function ActualizarDatosEssalud($datos) {
        $o_LAfiliaciones = new LAfiliaciones();
        $resultado = $o_LAfiliaciones->ActualizarDatosEssalud($datos);
        return $resultado;
    }

    public function InsertarDatosEssalud($datos) {
        $o_LAfiliaciones = new LAfiliaciones();
        $resultado = $o_LAfiliaciones->InsertarDatosEssalud($datos);
        return $resultado;
    }

    public function verificarCodAutogenerado($datos) {
        $o_LAfiliaciones = new LAfiliaciones();
        $resultado = $o_LAfiliaciones->verificarCodAutogenerado($datos);
        echo $resultado[0][0] . '*' . $resultado[0][1] . '*' . $resultado[0][2] . '*' . $resultado[0][3] . '*' . $resultado[0][4] . '*' . $resultado[0][5] . '*' . $resultado[0][6] . '*' . $resultado[0][7] . '*' . $resultado[0][8] . '*' . $resultado[0][9] . '*' . $resultado[0][10];
    }

    public function cargarDatosPersona($datos) {
        $o_LAfiliaciones = new LAfiliaciones();
        $resultado = $o_LAfiliaciones->cargarDatosPersona($datos);
        echo $resultado[0][0] . '*' . $resultado[0][1] . '*' . $resultado[0][2] . '*' . $resultado[0][3] . '*' . $resultado[0][4] . '*' . $resultado[0][5] . '*' . $resultado[0][6];
    }

    public function agregarAfiliacionPersona($datos) {
        $o_LAfiliaciones = new LAfiliaciones();
        $resultado = $o_LAfiliaciones->lagregarAfiliacionPersona($datos);

        return $resultado;
    }

    public function activarAfiliacion($datos) {
        $o_LAfiliaciones = new LAfiliaciones();
        $resultado = $o_LAfiliaciones->activarAfiliacion($datos);
        return $resultado;
    }

    public function activarAfiliacionEssalud($datos) {
        $o_LAfiliaciones = new LAfiliaciones();
        $resultado = $o_LAfiliaciones->lactivarAfiliacionEssalud($datos);
        return $resultado[0][0];
    }

    public function quitarAfiliacionalPaciente($datos) {
        $o_LAfiliaciones = new LAfiliaciones();
        $resultado = $o_LAfiliaciones->quitarAfiliacionesalPaciente($datos);
        return $resultado;
    }
     public function QuitarRelacion($datos) {
        $o_LAfiliaciones = new LAfiliaciones();
        $resultado = $o_LAfiliaciones->QuitarRelacion($datos);
        return $resultado;
    }
    
    

    public function cambiarAfiliacionGeneral($datos) {
        $oLAfiliaciones = new LAfiliaciones();
        //$esEssalud = $oLAfiliaciones->esEssaludAfiliacionActiva($datos);
        $esEssalud = 0;
        $o_TablaPersonaEssalud = "";
        $o_TablaDatosEssalud = "";
        $o_TablaCabeceraCartaEssalud = "";
        $o_TablaDetalleCartaEssalud = "";
        $msjAfiliacionEssalud = "";
        $idCarta = "";
        $idDetalleCarta = "";
        $accionEssalud = 0;
        $ultimaAfiliacionActiva = "";

        $ultimaAfiliacionActiva = $oLAfiliaciones->getUltimaAfiliacionActiva($datos);
        if ($ultimaAfiliacionActiva == '0027') {
            $esEssalud = 1;
        }

        if ($esEssalud == 1) {
            $c_cod_per = $datos["codigoPersona"];
            $o_TablaPersonaEssalud = $this->listaPersonaEssalud($c_cod_per);
            $o_TablaDatosEssalud = $this->listaDatosEssalud($c_cod_per);
            $o_TablaCabeceraCartaEssalud = $this->listaCabeceraCartaEssalud($c_cod_per);
            $o_TablaDetalleCartaEssalud = $this->listaDetalleCartaEssalud($c_cod_per);
            /*             * ****************************************************************************************************** */

            $arrayFilasDatosHmlo = $oLAfiliaciones->spListaPersonaEssalud($c_cod_per);
            $numPacientesActivosEnHmlo = 0;

            foreach ($arrayFilasDatosHmlo as $indice => $fila) {
                if (isset($fila["cTipoPersona"]) && !empty($fila["cTipoPersona"])) {
                    if ($fila["cTipoPersona"] == 1) {
                        $numPacientesActivosEnHmlo = $numPacientesActivosEnHmlo + 1;
                    }
                }
            }
            //Verificamos si paciente está activo en la tabla nsmPersonas, y si tiene duplicidad de historias
            if ($numPacientesActivosEnHmlo == 1) {
                $arrayFilasDatosEssalud = $oLAfiliaciones->spListaDatosEssalud($c_cod_per);
                $numPacientesActivosEnEssalud = 0;

                foreach ($arrayFilasDatosEssalud as $indice => $fila) {
                    if (isset($fila["b_activo"]) && !empty($fila["b_activo"])) {
                        if ($fila["b_activo"] == 1) {
                            $numPacientesActivosEnEssalud = $numPacientesActivosEnEssalud + 1;
                        }
                    }
                }
                //Verificamos si paciente está activo en la tabla ESSALUD
                if ($numPacientesActivosEnEssalud == 1) {
                    //Verificamos la fecha de acreditacion
                    $fechaHasta = $arrayFilasDatosEssalud[0]["f_hasta"];
                    if (isset($fechaHasta) && !empty($fechaHasta)) {
                        $fechaActual = date("d/m/Y");
                        $numDifDias = $this->compararFechas($fechaHasta, $fechaActual);
                        if ($numDifDias >= 0) {
                            //Verificamos cabecera de Carta (mxcarta)
                            $arrayFilasCabeceraCartaEssalud = $oLAfiliaciones->spListaCabeceraCartaEssalud($c_cod_per);
                            $numCabecerasCartasActivasEnEssalud = 0;

                            foreach ($arrayFilasCabeceraCartaEssalud as $indice => $fila) {
                                if (isset($fila["estado"]) && !empty($fila["estado"])) {
                                    if ($fila["estado"] == 1 && $fila["c_cod_t_afil"] == '0027') {
                                        $numCabecerasCartasActivasEnEssalud = $numCabecerasCartasActivasEnEssalud + 1;
                                        $idCarta = $fila["idcarta"];
                                    }
                                }
                            }

                            if ($numCabecerasCartasActivasEnEssalud == 1) {
                                //Verificamos detalle de Carta (dxcarta)
                                $arrayFilasDetalleCarta = $oLAfiliaciones->spListaDetalleCartaEssaludPorCabeceraCarta($idCarta);
                                $numDetallesCartasActivasEnEssalud = 0;

                                foreach ($arrayFilasDetalleCarta as $indice => $fila) {
                                    if (isset($fila["estado"]) && !empty($fila["estado"])) {
                                        if ($fila["estado"] == 1) {
                                            $numDetallesCartasActivasEnEssalud = $numDetallesCartasActivasEnEssalud + 1;
                                            $indiceDetalleCartaActivaEnEssalud = $indice;
                                        }
                                    }
                                }

                                if ($numDetallesCartasActivasEnEssalud == 1) {
                                    //Aumentamos el saldo del detalle si es menor que 100 soles
                                    if (floatval($arrayFilasDetalleCarta[$indiceDetalleCartaActivaEnEssalud]["nsaldos"]) < 100) {
                                        $msjAfiliacionEssalud = "Saldo < 100";
                                        //Aumentamos detalle de cartas en 100 soles
                                        $idCarta = $arrayFilasDetalleCarta[$indiceDetalleCartaActivaEnEssalud]["idcarta"];
                                        $idDetalleCarta = $arrayFilasDetalleCarta[$indiceDetalleCartaActivaEnEssalud]["iddcarta"];
                                        $accionEssalud = 1;
                                    } else {
                                        $msjAfiliacionEssalud = "Todo OK";
                                        $accionEssalud = 2;
                                    }
                                } else {
                                    if ($numDetallesCartasActivasEnEssalud == 0) {
                                        $msjAfiliacionEssalud = "No hay detalle de carta activo para ESSALUD";
                                    } else {
                                        if ($numDetallesCartasActivasEnEssalud > 1) {
                                            $msjAfiliacionEssalud = "Existe mas de un detalle de carta activo para ESSALUD";
                                        }
                                    }
                                }
                            } else {
                                if ($numCabecerasCartasActivasEnEssalud == 0) {
                                    $msjAfiliacionEssalud = "No hay cabecera de carta activa para ESSALUD";
                                } else {
                                    if ($numCabecerasCartasActivasEnEssalud > 1) {
                                        $msjAfiliacionEssalud = "Existe mas de una cabecera de carta activa para ESSALUD";
                                    }
                                }
                            }
                        } else {
                            $msjAfiliacionEssalud = "Fecha vencida de acreditacion";
                        }
                    }
                } else {
                    if ($numPacientesActivosEnEssalud == 0) {
                        $msjAfiliacionEssalud = "Paciente no se encuentra activo en la tabla ESSALUD";
                    } else {
                        if ($numPacientesActivosEnEssalud > 1) {
                            $msjAfiliacionEssalud = "Existe mas de un registro activo en la tabla ESSALUD";
                        }
                    }
                }
            } else {
                if ($numPacientesActivosEnHmlo == 0) {
                    $msjAfiliacionEssalud = "Paciente no se encuentra activo en la tabla HMLO";
                } else {
                    if ($numPacientesActivosEnHmlo > 1) {
                        $msjAfiliacionEssalud = "Existe mas de un registro activo en la tabla HMLO, falta unificar";
                    }
                }
            }
        }
        require_once("../../cvista/afiliaciones/vcambioAfiliacionGeneral.php");
    }

    public function mostrarAfiliaciones($datos) {
        $o_LAfiliaciones = new LAfiliaciones();
        $resultado = $o_LAfiliaciones->listarAfiliacionGeneral($datos);
        return $resultado;
    }

    public function tablaxAfiliacionesPersona($datos) {
        if (isset($_SESSION["permiso_formulario_servicio"][110]["CAMBIAR_AFILIACION_GENERAL_PAC"]) && ($_SESSION["permiso_formulario_servicio"][110]["CAMBIAR_AFILIACION_GENERAL_PAC"] == 1)) {
            $verBotonCambiarAfiliaciones = "false";
        } else {
            $verBotonCambiarAfiliaciones = "true";
        }
        $o_LAfiliaciones = new LAfiliaciones;
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $o_LAfiliaciones->ltablaxAfiliacionesPersona($datos);
        $arrayCabecera = array("0" => "Id", "1" => "Afiliacion", "2" => "NumeroAfil", "3" => "CodPersona", "4" => "CodPersonah", "5" => "CodPersonar", "6" => "Activo", "7" => "Estado", "8" => "DerechoAmbiente", "9" => "Autogenerado", "10" => "...", "11" => "Ver");
        $arrayTamano = array("0" => "45", "1" => "*", "2" => "45", "3" => "50", "4" => "50", "5" => "50", "6" => "50", "7" => "50", "8" => "50", "9" => "50", "10" => "50", "11" => "50");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro", "8" => "ro", "9" => "ro", "10" => "img", "11" => "img");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "default", "3" => "default", "4" => "default", "5" => "default", "6" => "default", "7" => "default", "8" => "default", "9" => "default", "10" => "pointer", "11" => "pointer");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "true", "3" => "true", "4" => "true", "5" => "true", "6" => "false", "7" => "true", "8" => "true", "9" => "true", "10" => $verBotonCambiarAfiliaciones, "11" => "true");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "center", "3" => "center", "4" => "center", "5" => "center", "6" => "center", "7" => "center", "8" => "center", "9" => "center", "10" => "center", "11" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function tablaxAfiliacionesInacPersona($datos) {
        $o_LAfiliaciones = new LAfiliaciones;
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $o_LAfiliaciones->ltablaxAfiliacionesInacPersona($datos);
        $arrayCabecera = array("0" => "Id", "1" => "Afiliacion", "2" => "Numero");
        $arrayTamano = array("0" => "*", "1" => "*", "2" => "*");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "default");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "true");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "lefth");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function TablaEstadoDeuda($datos) {
        $o_LAfiliaciones = new LAfiliaciones;
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $o_LAfiliaciones->TablaEstadoDeuda($datos);
        $arrayCabecera = array("0" => "Estado", "1" => "Resultado", "2" => "Deuda", "3" => "Activar");
        $arrayTamano = array("0" => "*", "1" => "100", "2" => "100", "3" => "50");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "img");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "default", "3" => "pointer");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "lefth", "3" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function mostrarNOAfiliaciones($datos) {
        $o_LAfiliaciones = new LAfiliaciones();
        $resultado = $o_LAfiliaciones->listarNOAfiliacionGeneral($datos);
        return $resultado;
    }

    public function verificarExistenciaDBContribuyentePuntual($datos) {
        $o_LAfiliaciones = new LAfiliaciones();
        $resultado = $o_LAfiliaciones->verificarExistenciaDBContribuyentePuntual($datos);
        $resul = $resultado[0][0] . "/" . $resultado[0][1];
        return $resul;
    }

    public function spListaPersonaEssalud($c_cod_per) {
        $o_LAfiliaciones = new LAfiliaciones;
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $o_LAfiliaciones->TablaListaPersonaEssalud($c_cod_per);
        $arrayCabecera = array("0" => "Id", "1" => "Nombre", "2" => "Numero Doc.", "3" => "Fecha Nacimiento", "4" => "Tipo Persona");
        $arrayTamano = array("0" => "45", "1" => "*", "2" => "120", "3" => "120", "4" => "120");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "default", "3" => "default", "4" => "default");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "center", "3" => "center", "4" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function spListaDatosEssalud($c_cod_per) {
        $o_LAfiliaciones = new LAfiliaciones;
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $o_LAfiliaciones->TablaListaDatosEssalud($c_cod_per);
        $arrayCabecera = array("0" => "Codigo", "1" => "Hasta", "2" => "num. Doc.", "3" => "Ape. Paterno", "4" => "Ape. Materno", "5" => "1er Nombre", "6" => "2do Nombre", "7" => "Codigo", "8" => "Estado");
        $arrayTamano = array("0" => "*", "1" => "*", "2" => "*", "3" => "*", "4" => "*", "5" => "*", "6" => "*", "7" => "*", "8" => "*");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro", "8" => "ro");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "default", "3" => "default", "4" => "default", "5" => "default", "6" => "default", "7" => "default", "8" => "default");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false", "6" => "false", "7" => "false", "8" => "false");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "center", "3" => "center", "4" => "center", "5" => "center", "6" => "center", "7" => "center", "8" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function spListaCabeceraCartaEssalud($c_cod_per) {
        $o_LAfiliaciones = new LAfiliaciones;
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $o_LAfiliaciones->TablaListaCabeceraCartaEssalud($c_cod_per);
        $arrayCabecera = array("0" => "Id Carta", "1" => "Cod Afil.", "2" => "Cod. Persona. Doc.", "3" => "Estado", "4" => "Fecha Fin.", "5" => "Saldos", "6" => "Carta", "7" => "Nombre");
        $arrayTamano = array("0" => "90", "1" => "*", "2" => "*", "3" => "50", "4" => "100", "5" => "100", "6" => "40", "7" => "*");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "default", "3" => "default", "4" => "default", "5" => "default", "6" => "default", "7" => "default");
        $arrayHidden = array("0" => "false", "1" => "true", "2" => "true", "3" => "false", "4" => "false", "5" => "false", "6" => "true", "7" => "false");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "center", "3" => "center", "4" => "center", "5" => "center", "6" => "center", "7" => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function spListaDetalleCartaEssaludPorCabeceraCarta($c_cod_per) {
        $o_LAfiliaciones = new LAfiliaciones;
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $o_LAfiliaciones->TablaListaDetalleCartaEssaludPorCabeceraCarta($c_cod_per);
        $arrayCabecera = array("0" => "Id Carta", "1" => "Id Carta", "2" => "Carta", "3" => "Monto", "4" => "Fecha Ini.", "5" => "Fecha. Fin.", "6" => "Estado", "7" => "Saldo");
        $arrayTamano = array("0" => "*", "1" => "100", "2" => "70", "3" => "70", "4" => "*", "5" => "*", "6" => "50", "7" => "120");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "default", "3" => "default", "4" => "default", "5" => "default", "6" => "default", "7" => "default");
        $arrayHidden = array("0" => "true", "1" => "false", "2" => "true", "3" => "false", "4" => "false", "5" => "false", "6" => "false", "7" => "false");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "center", "3" => "center", "4" => "center", "5" => "center", "6" => "center", "7" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function mostrarVerificacionEssalud($c_cod_per) {
        $oLAfiliaciones = new LAfiliaciones();
        $msjAfiliacionEssalud = "";
        $idCarta = "";
        $idDetalleCarta = "";
        $accionEssalud = 0;

        $arrayFilasDatosHmlo = $oLAfiliaciones->spListaPersonaEssalud($c_cod_per);
        $numPacientesActivosEnHmlo = 0;

        foreach ($arrayFilasDatosHmlo as $indice => $fila) {
            if (isset($fila["cTipoPersona"]) && !empty($fila["cTipoPersona"])) {
                if ($fila["cTipoPersona"] == 1) {
                    $numPacientesActivosEnHmlo = $numPacientesActivosEnHmlo + 1;
                }
            }
        }
        //Verificamos si paciente está activo en la tabla nsmPersonas, y si tiene duplicidad de historias
        if ($numPacientesActivosEnHmlo == 1) {
            $arrayFilasDatosEssalud = $oLAfiliaciones->spListaDatosEssalud($c_cod_per);
            $numPacientesActivosEnEssalud = 0;

            foreach ($arrayFilasDatosEssalud as $indice => $fila) {
                if (isset($fila["b_activo"]) && !empty($fila["b_activo"])) {
                    if ($fila["b_activo"] == 1) {
                        $numPacientesActivosEnEssalud = $numPacientesActivosEnEssalud + 1;
                    }
                }
            }
            //Verificamos si paciente está activo en la tabla ESSALUD
            if ($numPacientesActivosEnEssalud == 1) {
                //Verificamos la fecha de acreditacion
                $fechaHasta = $arrayFilasDatosEssalud[0]["f_hasta"];
                if (isset($fechaHasta) && !empty($fechaHasta)) {
                    $fechaActual = date("d/m/Y");
                    $numDifDias = $this->compararFechas($fechaHasta, $fechaActual);
                    if ($numDifDias >= 0) {
                        //Verificamos cabecera de Carta (mxcarta)
                        $arrayFilasCabeceraCartaEssalud = $oLAfiliaciones->spListaCabeceraCartaEssalud($c_cod_per);
                        $numCabecerasCartasActivasEnEssalud = 0;

                        foreach ($arrayFilasCabeceraCartaEssalud as $indice => $fila) {
                            if (isset($fila["estado"]) && !empty($fila["estado"])) {
                                if ($fila["estado"] == 1 && $fila["c_cod_t_afil"] == '0027') {
                                    $numCabecerasCartasActivasEnEssalud = $numCabecerasCartasActivasEnEssalud + 1;
                                    $idCarta = $fila["idcarta"];
                                }
                            }
                        }

                        if ($numCabecerasCartasActivasEnEssalud == 1) {
                            //Verificamos detalle de Carta (dxcarta)
                            $arrayFilasDetalleCarta = $oLAfiliaciones->spListaDetalleCartaEssaludPorCabeceraCarta($idCarta);
                            $numDetallesCartasActivasEnEssalud = 0;

                            foreach ($arrayFilasDetalleCarta as $indice => $fila) {
                                if (isset($fila["estado"]) && !empty($fila["estado"])) {
                                    if ($fila["estado"] == 1) {
                                        $numDetallesCartasActivasEnEssalud = $numDetallesCartasActivasEnEssalud + 1;
                                        $indiceDetalleCartaActivaEnEssalud = $indice;
                                    }
                                }
                            }

                            if ($numDetallesCartasActivasEnEssalud == 1) {
                                //Aumentamos el saldo del detalle si es menor que 100 soles
                                if (floatval($arrayFilasDetalleCarta[$indiceDetalleCartaActivaEnEssalud]["nsaldos"]) < 100) {
                                    $msjAfiliacionEssalud = "Saldo < 100";
                                    //Aumentamos detalle de cartas en 100 soles
                                    $idCarta = $arrayFilasDetalleCarta[$indiceDetalleCartaActivaEnEssalud]["idcarta"];
                                    $idDetalleCarta = $arrayFilasDetalleCarta[$indiceDetalleCartaActivaEnEssalud]["iddcarta"];
                                    $accionEssalud = 1;
                                } else {
                                    $msjAfiliacionEssalud = "Todo OK";
                                    $accionEssalud = 2;
                                }
                            } else {
                                if ($numDetallesCartasActivasEnEssalud == 0) {
                                    $msjAfiliacionEssalud = "No hay detalle de carta activo para ESSALUD";
                                } else {
                                    if ($numDetallesCartasActivasEnEssalud > 1) {
                                        $msjAfiliacionEssalud = "Existe mas de un detalle de carta activo para ESSALUD";
                                    }
                                }
                            }
                        } else {
                            if ($numCabecerasCartasActivasEnEssalud == 0) {
                                $msjAfiliacionEssalud = "No hay cabecera de carta activa para ESSALUD";
                            } else {
                                if ($numCabecerasCartasActivasEnEssalud > 1) {
                                    $msjAfiliacionEssalud = "Existe mas de una cabecera de carta activa para ESSALUD";
                                }
                            }
                        }
                    } else {
                        $msjAfiliacionEssalud = "Fecha vencida de acreditacion";
                    }
                }
            } else {
                if ($numPacientesActivosEnEssalud == 0) {
                    $msjAfiliacionEssalud = "Paciente no se encuentra activo en la tabla ESSALUD";
                } else {
                    if ($numPacientesActivosEnEssalud > 1) {
                        $msjAfiliacionEssalud = "Existe mas de un registro activo en la tabla ESSALUD";
                    }
                }
            }
        } else {
            if ($numPacientesActivosEnHmlo == 0) {
                $msjAfiliacionEssalud = "Paciente no se encuentra activo en la tabla HMLO";
            } else {
                if ($numPacientesActivosEnHmlo > 1) {
                    $msjAfiliacionEssalud = "Existe mas de un registro activo en la tabla HMLO, falta unificar";
                }
            }
        }

        $o_TablaPersonaEssalud = $this->listaPersonaEssalud($c_cod_per);
        $o_TablaDatosEssalud = $this->listaDatosEssalud($c_cod_per);
        $o_TablaCabeceraCartaEssalud = $this->listaCabeceraCartaEssalud($c_cod_per);
        $o_TablaDetalleCartaEssalud = $this->listaDetalleCartaEssalud($c_cod_per);

        require_once("../../cvista/afiliaciones/vconsultaEssalud.php");
    }

    function compararFechas($primera, $segunda) {//Se usa esta funcion porque la de UNIX solo funcionará hasta 2030
        $valoresPrimera = explode("/", $primera);
        $valoresSegunda = explode("/", $segunda);
        $diaPrimera = $valoresPrimera[0];
        $mesPrimera = $valoresPrimera[1];
        $anyoPrimera = $valoresPrimera[2];
        $diaSegunda = $valoresSegunda[0];
        $mesSegunda = $valoresSegunda[1];
        $anyoSegunda = $valoresSegunda[2];
        $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);
        $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);
        if (!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)) {
            // "La fecha ".$primera." no es válida";
            return 0;
        } else
        if (!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)) {
            // "La fecha ".$segunda." no es válida";
            return 0;
        } else {
            return $diasPrimeraJuliano - $diasSegundaJuliano;
        }
    }

    public function listaPersonaEssalud($c_cod_per) {
        $oLAfiliaciones = new LAfiliaciones();
        $arrayFilas = $oLAfiliaciones->spListaPersonaEssalud($c_cod_per);

        $arrayTipo = array("vNumeroDocumento" => "c",
            "c_cod_per" => "c",
            "nomCompleto" => "c",
            "dFechaNacimiento" => "c",
            "iconoActivo" => "h");

        $arrayCabecera = array("vNumeroDocumento" => "DNI",
            "c_cod_per" => "Codigo",
            "nomCompleto" => "Apellidos y Nombres",
            "dFechaNacimiento" => "Fec. Nac.",
            "iconoActivo" => "Activo");
        //($_arrayCabecera,$_numFilas,$_arrayFilas='',$_estiloTabla='',$_estiloFila='',$_estiloFilaAlterna='',$_estiloFilaSeleccionada='',$_arrayEventosJS='',$_oyenteEventosJS='',$_indClave='',$_arrayTipos='' ,$_indiceEstados='',$_arrayColorEstado='')
        $o_Tabla = new Tabla1($arrayCabecera, 3, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', '', 0, $arrayTipo, 0, '');
        $tablaHTML = $o_Tabla->getTabla();
        return $tablaHTML;
    }

    public function listaDatosEssalud($c_cod_per) {
        $oLAfiliaciones = new LAfiliaciones();
        $arrayFilas = $oLAfiliaciones->spListaDatosEssalud($c_cod_per);

        $arrayTipo = array("cod_autogenerado" => "c",
            "nro_docide" => "c",
            "c_cod_per" => "c",
            "ap_paterno" => "c",
            "ap_materno" => "c",
            "pr_nombre" => "c",
            "seg_nombre" => "c",
            "f_hasta" => "c",
            "iconoActivo" => "h");

        $arrayCabecera = array("cod_autogenerado" => "Autogenerado",
            "nro_docide" => "Nro. Doc.",
            "c_cod_per" => "Cod. Persona",
            "ap_paterno" => "Ap. Paterno",
            "ap_materno" => "Ap. Materno",
            "pr_nombre" => "Primer Nombre",
            "seg_nombre" => "Segundo Nombre",
            "f_hasta" => "Hasta",
            "iconoActivo" => "Activo");
        //($_arrayCabecera,$_numFilas,$_arrayFilas='',$_estiloTabla='',$_estiloFila='',$_estiloFilaAlterna='',$_estiloFilaSeleccionada='',$_arrayEventosJS='',$_oyenteEventosJS='',$_indClave='',$_arrayTipos='' ,$_indiceEstados='',$_arrayColorEstado='')
        $o_Tabla = new Tabla1($arrayCabecera, 3, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', '', 0, $arrayTipo, 0, '');
        $tablaHTML = $o_Tabla->getTabla();
        return $tablaHTML;
    }

    public function listaCabeceraCartaEssalud($c_cod_per) {
        $oLAfiliaciones = new LAfiliaciones();
        $arrayFilas = $oLAfiliaciones->spListaCabeceraCartaEssalud($c_cod_per);

        $arrayTipo = array("idcarta" => "c",
            "c_cod_per" => "c",
            "c_cod_t_afil" => "c",
            "nomCompleto" => "c",
            "ntcarta" => "c",
            "dfecfin" => "c",
            "nsaldos" => "c",
            "iconoEstado" => "h");

        $arrayCabecera = array("idcarta" => "Id. Carta",
            "c_cod_per" => "Cod. Persona",
            "c_cod_t_afil" => "Cod. Tipo Afil.",
            "nomCompleto" => "Persona",
            "ntcarta" => "Tipo Carta",
            "dfecfin" => "Fecha Fin",
            "nsaldos" => "Saldo",
            "iconoEstado" => "Estado");
        //($_arrayCabecera,$_numFilas,$_arrayFilas='',$_estiloTabla='',$_estiloFila='',$_estiloFilaAlterna='',$_estiloFilaSeleccionada='',$_arrayEventosJS='',$_oyenteEventosJS='',$_indClave='',$_arrayTipos='' ,$_indiceEstados='',$_arrayColorEstado='')
        $o_Tabla = new Tabla1($arrayCabecera, 3, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', '', 0, $arrayTipo, 0, '');
        $tablaHTML = $o_Tabla->getTabla();
        return $tablaHTML;
    }

    public function listaDetalleCartaEssalud($c_cod_per) {
        $oLAfiliaciones = new LAfiliaciones();
        $arrayFilas = $oLAfiliaciones->spListaDetalleCartaEssalud($c_cod_per);

        $arrayTipo = array("idcarta" => "c",
            "iddcarta" => "c",
            "carta" => "c",
            "fecini" => "c",
            "fecfin" => "c",
            "monto" => "c",
            "nsaldos" => "c",
            "iconoEstado" => "h");

        $arrayCabecera = array("idcarta" => "Id. Carta",
            "iddcarta" => "Id. Detalle Carta",
            "carta" => "Carta",
            "fecini" => "Inicio",
            "fecfin" => "Fin",
            "monto" => "Monto",
            "nsaldos" => "Saldos",
            "iconoEstado" => "Estado");
        //($_arrayCabecera,$_numFilas,$_arrayFilas='',$_estiloTabla='',$_estiloFila='',$_estiloFilaAlterna='',$_estiloFilaSeleccionada='',$_arrayEventosJS='',$_oyenteEventosJS='',$_indClave='',$_arrayTipos='' ,$_indiceEstados='',$_arrayColorEstado='')
        $o_Tabla = new Tabla1($arrayCabecera, 5, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', '', 0, $arrayTipo, 0, '');
        $tablaHTML = $o_Tabla->getTabla();
        return $tablaHTML;
    }

}

?>
