<?php

require_once("../../clogica/LSOP.php");
require_once("../../../pholivo/tablaDHTMLX.php");

class ActionSOP {

    public function __construct() {
        
    }

    /***********************Solicitudes Programacion SOP***********************/
    public function xmlTablaPacientes($datos){
        $opcion=$datos["opcion"];
        $patron=$datos["patron"];
        $datosDesencriptados = base64_decode($patron);
        
        if($opcion==1){
            $datosSeparados = explode("|",$datosDesencriptados);
            $apPat = $datosSeparados[0];
            $apMat = $datosSeparados[1];
            $nombre = $datosSeparados[2];

            if($apPat!='' && $apMat=='' && $nombre==''){
                $opcion2 = 11;
                $valor2 = $apPat;
            }
            else{
                if($apPat=='' && $apMat!='' && $nombre==''){
                    $opcion2 = 12;
                    $valor2 = $apMat;
                }
                else{
                    if($apPat=='' && $apMat=='' && $nombre!=''){
                        $opcion2 = 13;
                        $valor2 = $nombre;
                    }
                    else{
                        if($apPat!='' && $apMat!='' && $nombre==''){
                            $opcion2 = 14;
                            $valor2 = $apPat.' '.$apMat;
                        }
                        else{
                            if($apPat=='' && $apMat!='' && $nombre!=''){
                                $opcion2 = 15;
                                $valor2 = $apMat.' '.$nombre;
                            }
                            else{
                                if($apPat!='' && $apMat=='' && $nombre!=''){
                                    $opcion2 = 16;
                                    $valor2 = $apPat.' '.$nombre;
                                }
                                else{
                                    if($apPat!='' && $apMat!='' && $nombre!=''){
                                        $opcion2 = 17;
                                        $valor2 = $apPat.' '.$apMat.' '.$nombre;
                                    }
                                    else{
                                        if($apPat=='' && $apMat=='' && $nombre==''){
                                            $opcion2 = 18;
                                            $valor2 = '';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        else{
            $opcion2 = $opcion;
            $valor2 = $datosDesencriptados;
        }

        $o_TablaHtmlx = new tablaDHTMLX();
        $oLSOP = new LSOP();

        $arrayFilas = $oLSOP->spListaPaciente($opcion2,$valor2);
        $arrayCabecera = array("0"=>"Código","1"=>"DNI","2"=>"Paciente","3"=>"Fec. Nac.","edad"=>"Edad","vDescripcion"=>"Afiliación");
        $arrayTamano = array("0"=>"80","1"=>"80","2"=>"200","3"=>"150","edad"=>"150","vDescripcion"=>"150");
        $arrayTipo = array("0"=>"ro","1"=>"ro","2"=>"ro","3"=>"ro","edad"=>"ro","vDescripcion"=>"ro");
        $arrayAlineacion = array("0"=>"center","1"=>"center","2"=>"left","3"=>"center","edad"=>"center","vDescripcion"=>"center");
        $arrayHidden = array("0"=>"false","1"=>"false","2"=>"false","3"=>"false","edad"=>"false","vDescripcion"=>"false");
        return $o_TablaHtmlx->stringXml($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayAlineacion,0,$arrayHidden);
    }

    public function xmlTablaCieDxPreOperatorio($accion,$token) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLSOP = new LSOP();
        
        $arrayFilas = $oLSOP->spListaCieDxPreOperatorio($accion,$token);
        $arrayCabecera = array("0"=>"Id CIE","1"=>"Código","2"=>"Descripción");
        $arrayTamano = array("0"=>"50","1"=>"50","2"=>"*");
        $arrayTipo = array("0"=>"ro","1"=>"ro","2"=>"ro");
        $arrayAlineacion = array("0"=>"center","1"=>"center","2"=>"left");
        $arrayHidden = array("0"=>"false","1"=>"false","2"=>"false");
        //public function stringXml($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayAlineacion,$posicionId,$arrayhidden='')
        return $o_TablaHtmlx->stringXml($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayAlineacion,0,$arrayHidden);
    }

    public function xmlTablaServicioCirugia($accion,$token) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLSOP = new LSOP();

        $arrayFilas = $oLSOP->spListaServicioCirugia($accion,$token);
        $arrayCabecera = array("0"=>"Código","1"=>"Servicio/Producto");
        $arrayTamano = array("0"=>"100","1"=>"*");
        $arrayTipo = array("0"=>"ro","1"=>"ro");
        $arrayAlineacion = array("0"=>"left","1"=>"left");
        $arrayHidden = array("0"=>"false","1"=>"false");
        //public function stringXml($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayAlineacion,$posicionId,$arrayhidden='')
        return $o_TablaHtmlx->stringXml($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayAlineacion,0,$arrayHidden);
    }

    public function xmlTablaCirujanos($datos){
        $opcion=$datos["opcion"];
        $patron=$datos["patron"];
        $datosDesencriptados = base64_decode($patron);

        if($opcion==1){
            $datosSeparados = explode("|",$datosDesencriptados);
            $apPat = $datosSeparados[0];
            $apMat = $datosSeparados[1];
            $nombre = $datosSeparados[2];

            if($apPat!='' && $apMat=='' && $nombre==''){
                $opcion2 = 11;
                $valor2 = $apPat;
            }
            else{
                if($apPat=='' && $apMat!='' && $nombre==''){
                    $opcion2 = 12;
                    $valor2 = $apMat;
                }
                else{
                    if($apPat=='' && $apMat=='' && $nombre!=''){
                        $opcion2 = 13;
                        $valor2 = $nombre;
                    }
                    else{
                        if($apPat!='' && $apMat!='' && $nombre==''){
                            $opcion2 = 14;
                            $valor2 = $apPat.' '.$apMat;
                        }
                        else{
                            if($apPat=='' && $apMat!='' && $nombre!=''){
                                $opcion2 = 15;
                                $valor2 = $apMat.' '.$nombre;
                            }
                            else{
                                if($apPat!='' && $apMat=='' && $nombre!=''){
                                    $opcion2 = 16;
                                    $valor2 = $apPat.' '.$nombre;
                                }
                                else{
                                    if($apPat!='' && $apMat!='' && $nombre!=''){
                                        $opcion2 = 17;
                                        $valor2 = $apPat.' '.$apMat.' '.$nombre;
                                    }
                                    else{
                                        if($apPat=='' && $apMat=='' && $nombre==''){
                                            $opcion2 = 18;
                                            $valor2 = '';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        else{
            $opcion2 = $opcion;
            $valor2 = $datosDesencriptados;
        }

        $o_TablaHtmlx = new tablaDHTMLX();
        $oLSOP = new LSOP();

        $arrayFilas = $oLSOP->spListaCirujano($opcion2,$valor2);
        $arrayCabecera = array("0"=>"Código","1"=>"DNI","2"=>"Empleado","3"=>"Fec. Nac.","edad"=>"Edad","vDescripcionCcosto"=>"Centro de Costo");
        $arrayTamano = array("0"=>"80","1"=>"80","2"=>"200","3"=>"150","edad"=>"150","vDescripcionCcosto"=>"150");
        $arrayTipo = array("0"=>"ro","1"=>"ro","2"=>"ro","3"=>"ro","edad"=>"ro","vDescripcionCcosto"=>"ro");
        $arrayAlineacion = array("0"=>"center","1"=>"center","2"=>"left","3"=>"center","edad"=>"center","vDescripcionCcosto"=>"center");
        $arrayHidden = array("0"=>"false","1"=>"false","2"=>"false","3"=>"false","edad"=>"false","vDescripcionCcosto"=>"false");
        return $o_TablaHtmlx->stringXml($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayAlineacion,0,$arrayHidden);
    }

    public function manteSolProgSOP($parametros){
        $cadenaDatos=$parametros["p2"];
        $accion=$parametros["p3"];


        $datosDesencriptados=base64_decode($cadenaDatos);
        $arrayDatos = explode("|||", $datosDesencriptados);

        $fechaPropuesta=$arrayDatos[0];
        $horaPropuesta=$arrayDatos[1];
        $codPerPaciente=$arrayDatos[2];
        $codCentroCostoSolProgSOP=$arrayDatos[3];

        $cadenaIdDxPreOperatorio=$arrayDatos[4];

        $cadenaCodServicioCirugia=$arrayDatos[5];

        $cadenaPorcServicioCirugia=$arrayDatos[6];

        $duracionServicioCirugia=$arrayDatos[7];
        $codPerCirujanoResponsable=$arrayDatos[8];

        $cadenaCodPerCirujanoAyudante=$arrayDatos[9];

        $valorHematocrito=$arrayDatos[10];
        $valorHemoglobina=$arrayDatos[11];
        $observaciones=$arrayDatos[12];

        $oLSOP = new LSOP();
        switch($accion){
            case 'insertar':
                /*$idSistema = $parametros["idSistema"];
                $idPerfil = $parametros["idPerfil"];
                $nomPerfil = $parametros["nombre"];*/
                $rs = $oLSOP->spManteSolProgSOP($accion,$fechaPropuesta,$horaPropuesta,$codPerPaciente,$codCentroCostoSolProgSOP,
                                                 $cadenaIdDxPreOperatorio,$cadenaCodServicioCirugia,$cadenaPorcServicioCirugia,
                                                 $duracionServicioCirugia,$codPerCirujanoResponsable,$cadenaCodPerCirujanoAyudante,
                                                 $valorHematocrito,$valorHemoglobina,$observaciones);
                $rpta = $rs[0][0];
                break;
            /*case 'actualizar':
                $idSistema = $parametros["idSistema"];
                $idPerfil = $parametros["idPerfil"];
                $nomPerfil = $parametros["nombre"];
                $rs = $o_LFormulario->spMantePerfil($accion,$idSistema,$idPerfil,$nomPerfil);
                $rpta = $rs[0][0]+1;
                break;
            case 'eliminar':
                $idSistema = $parametros["idSistema"];
                $idPerfil = $parametros["idPerfil"];
                $rs = $o_LFormulario->spEliminarPerfil($idSistema,$idPerfil);
                $rpta = $rs[0][0]+2;
                break;*/
        }
        //print_r($arrayDatos);
        if($rpta==1)
            $msj = "Se registró la solicitud con éxito";
        else
            $msj = "No se concretó la acción, inténtelo nuevamente o contáctese con su administrador";
            /*if($rpta==2)
                $msj = "Se actualizó el perfil con éxito";
            else
                if($rpta==3)
                    $msj = "Se eliminó el perfil con éxito";
                else
                    $msj = "No se concretó la acción, inténtelo nuevamente o contáctese con su administrador";*/
        return $msj;
    }

    //public function mostrarTablaSolicitudesPendientesSOP($datos){
    public function mostrarTablaSolicitudesPendientesSOP($accion,$token){
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLSOP = new LSOP();

        $arrayFilas = $oLSOP->spListaSolicitudesPendientesSOP($accion,$token);
        $arrayCabecera = array("iidSolicitudProgramacion"=>"Id",
                               "vFechaPropuesta"=>"Fecha Propuesta",
                               "nomCompletoPaciente"=>"Paciente",
                               "edad"=>"Edad",
                               "nomCompletoCirujano"=>"Cirujano",
                               "vDescripcionCcosto"=>"Centro de Costo",
                               "v_desc_ser_pro"=>"Servicio",
                               "vEstadoSolicitud"=>"Estado",
                               "btnVerDetalle"=>"...",
                               "btnAceptar"=>"...",
                               "btnRechazar"=>"...");
        $arrayTamano = array("iidSolicitudProgramacion"=>"80",
                             "vFechaPropuesta"=>"80",
                             "nomCompletoPaciente"=>"200",
                             "edad"=>"50",
                             "nomCompletoCirujano"=>"150",
                             "vDescripcionCcosto"=>"200",
                             "v_desc_ser_pro"=>"200",
                             "vEstadoSolicitud"=>"100",
                             "btnVerDetalle"=>"30",
                             "btnAceptar"=>"30",
                             "btnRechazar"=>"30");
        $arrayTipo = array("iidSolicitudProgramacion"=>"ro",
                           "vFechaPropuesta"=>"ro",
                           "nomCompletoPaciente"=>"ro",
                           "edad"=>"ro",
                           "nomCompletoCirujano"=>"ro",
                           "vDescripcionCcosto"=>"ro",
                           "v_desc_ser_pro"=>"ro",
                           "vEstadoSolicitud"=>"ro",
                           "btnVerDetalle"=>"img",
                           "btnAceptar"=>"img",
                           "btnRechazar"=>"img");
        $arrayAlineacion = array("iidSolicitudProgramacion"=>"center",
                                 "vFechaPropuesta"=>"center",
                                 "nomCompletoPaciente"=>"left",
                                 "edad"=>"center",
                                 "nomCompletoCirujano"=>"center",
                                 "vDescripcionCcosto"=>"center",
                                 "v_desc_ser_pro"=>"center",
                                 "vEstadoSolicitud"=>"center",
                                 "btnVerDetalle"=>"center",
                                 "btnAceptar"=>"center",
                                 "btnRechazar"=>"center");
        $arrayHidden = array("iidSolicitudProgramacion"=>"false",
                             "vFechaPropuesta"=>"false",
                             "nomCompletoPaciente"=>"false",
                             "edad"=>"false",
                             "nomCompletoCirujano"=>"false",
                             "vDescripcionCcosto"=>"false",
                             "v_desc_ser_pro"=>"false",
                             "vEstadoSolicitud"=>"false",
                             "btnVerDetalle"=>"false",
                             "btnAceptar"=>"false",
                             "btnRechazar"=>"false");
        return $o_TablaHtmlx->stringXml($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayAlineacion,0,$arrayHidden);
    }

    public function mostrarManteSolProgSOP($iidSolicitudProgramacion){
        $oLSOP = new LSOP();
        $accion1=2;
        $token=$iidSolicitudProgramacion;
        $rsDetalleSolicitudPendienteSOP = $oLSOP->spListaDetalleSolicitudesPendientesSOP($accion1,$token);
        $accion2=3;
        $rsDxPreOperatorioSolicitudPendienteSOP = $oLSOP->spListaDxPreOperatorioSolicitudesPendientesSOP($accion2,$token);
        $accion3=4;
        $rsCirugiasSolicitudPendienteSOP = $oLSOP->spListaCirugiasSolicitudesPendientesSOP($accion3,$token);
        $accion4=5;
        $rsAyudantesSolicitudPendienteSOP = $oLSOP->spListaAyudantesSolicitudesPendientesSOP($accion4,$token);
        
        require_once("../../cvista/programacion/sop/manteSolicitudProgramacionSOP.php");
    }
    /*********************Fin Solicitudes Programacion SOP*********************/

    /***************************** Programacion SOP ***************************/
    public function mostrarProgramacionSOP(){
        $accion1=6;
        $token1="";
        $opcionesCboAmbientesLogicos=$this->listarOpcionesCboAmbientesLogicos($accion1,$token1);
        $accion2=5;
        $token2="";
        $opcionesCboCentroCostoCirujanosSOP=$this->listarOpcionesCboCentroCostoCirujanosSOP($accion2, $token2);

        require_once("../../cvista/programacion/sop/vistaProgramacionSOP.php");
    }

    public function mostrarTablaProgramacionesSOP($accion,$token){
        $o_TablaHtmlx 	= new tablaDHTMLX();
        $oLSOP = new LSOP();
        //$datos==''?$arrayFilas = array():$arrayFilas = $oLActoMedico->getListaProgramacionMedico($datos);

        $arrayFilas = $oLSOP->spListaProgramacionesSOP($accion,$token);
        $arrayCabecera 	= array("iidProgramacionSOP"=>"Id",
                                "cNroFormato"=>"Nº Prog",
                                "vNombreAmbienteLogico"=>"Ambiente",
                                "dFechaServicio"=>"Fecha",
                                "vHoraProgramada"=>"Hora",
                                "vDescripcionCcosto"=>"Centro de Costo",
                                //"vEstadoSOP"=>"Estado",
                                "nomCompletoCirujano"=>"Cirujano",
                                "nomCompletoPaciente"=>"Paciente",
                                //"vDescripcionActividad"=>"Actividad",
                                //"vTipoProgramacionSOP"=>"Tipo",
                                //"vTiempoAproximado"=>"Tiempo",
                                "btnEditar"=>"...",
                                "btnAtender"=>"...");
        $arrayTamano = array("iidProgramacionSOP"=>"30",
                             "cNroFormato"=>"80",
                             "vNombreAmbienteLogico"=>"80",
                             "dFechaServicio"=>"80",
                             "vHoraProgramada"=>"40",
                             "vDescripcionCcosto"=>"250",
                             //"vEstadoSOP"=>"150",
                             "nomCompletoCirujano"=>"250",
                             "nomCompletoPaciente"=>"250",
                             //"vDescripcionActividad"=>"100",
                             //"vTipoProgramacionSOP"=>"100",
                             //"vTiempoAproximado"=>"40",
                             "btnEditar"=>"30",
                             "btnAtender"=>"30");
        $arrayTipo=array("iidProgramacionSOP"=>"ro",
                         "cNroFormato"=>"ro",
                         "vNombreAmbienteLogico"=>"ro",
                         "dFechaServicio"=>"ro",
                         "vHoraProgramada"=>"ro",
                         "vDescripcionCcosto"=>"ro",
                         //"vEstadoSOP"=>"ro",
                         "nomCompletoCirujano"=>"ro",
                         "nomCompletoPaciente"=>"ro",
                         //"vDescripcionActividad"=>"ro",
                         //"vTipoProgramacionSOP"=>"ro",
                         //"vTiempoAproximado"=>"ro",
                         "btnEditar"=>"img",
                         "btnAtender"=>"img");
        $arrayAlineacion = array("iidProgramacionSOP"=>"center",
                                 "cNroFormato"=>"left",
                                 "vNombreAmbienteLogico"=>"left",
                                 "dFechaServicio"=>"left",
                                 "vHoraProgramada"=>"center",
                                 "vDescripcionCcosto"=>"left",
                                 //"vEstadoSOP"=>"center",
                                 "nomCompletoCirujano"=>"left",
                                 "nomCompletoPaciente"=>"left",
                                 //"vDescripcionActividad"=>"left",
                                 //"vTipoProgramacionSOP"=>"center",
                                 //"vTiempoAproximado"=>"center",
                                 "btnEditar"=>"center",
                                 "btnAtender"=>"center");
        $arrayHidden = array("iidProgramacionSOP"=>"true",
                             "cNroFormato"=>"false",
                             "vNombreAmbienteLogico"=>"false",
                             "dFechaServicio"=>"false",
                             "vHoraProgramada"=>"false",
                             "vDescripcionCcosto"=>"false",
                             //"vEstadoSOP"=>"false",
                             "nomCompletoCirujano"=>"false",
                             "nomCompletoPaciente"=>"false",
                             //"vDescripcionActividad"=>"false",
                             //"vTipoProgramacionSOP"=>"false",
                             //"vTiempoAproximado"=>"false",
                             "btnEditar"=>"false",
                             "btnAtender"=>"false");
        return $o_TablaHtmlx->stringXml($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayAlineacion,0,$arrayHidden);
    }

    public function mostrarTablaLeyendaSOP(){
        $o_TablaHtmlx 	= new tablaDHTMLX();
        $oLSOP = new LSOP();
        $arrayFilas = $oLSOP->getListaLeyenda();
        $arrayCabecera 	= array("0"=>"Id","1"=>"Color","2"=>"Estado");
        $arrayTamano = array("0"=>"50","1"=>"100","2"=>"*");
        $arrayTipo=array("0"=>"ro","1"=>"ro","2"=>"ro");
        $arrayAlineacion = array("0"=>"center","1"=>"center","2"=>"center");
        $arrayHidden = array("0"=>"true","1"=>"false","2"=>"false");
        return $o_TablaHtmlx->stringXml($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayAlineacion,0,$arrayHidden);
    }

    /*
    public function manteSolProgSOP($parametros){
        $cadenaDatos=$parametros["p2"];
        $accion=$parametros["p3"];


        $datosDesencriptados=base64_decode($cadenaDatos);
        $arrayDatos = explode("|||", $datosDesencriptados);

        $fechaPropuesta=$arrayDatos[0];
        $horaPropuesta=$arrayDatos[1];
        $codPerPaciente=$arrayDatos[2];
        $codCentroCostoSolProgSOP=$arrayDatos[3];

        $cadenaIdDxPreOperatorio=$arrayDatos[4];

        $cadenaCodServicioCirugia=$arrayDatos[5];

        $cadenaPorcServicioCirugia=$arrayDatos[6];

        $duracionServicioCirugia=$arrayDatos[7];
        $codPerCirujanoResponsable=$arrayDatos[8];

        $cadenaCodPerCirujanoAyudante=$arrayDatos[9];

        $valorHematocrito=$arrayDatos[10];
        $valorHemoglobina=$arrayDatos[11];
        $observaciones=$arrayDatos[12];

        $oLSOP = new LSOP();
    */
    public function aceptarRechazarSolProgSOP($parametros){
        $iidSolicitudProgramacion=$parametros["p2"];
        $accion=$parametros["p3"];
        $oLSOP = new LSOP();
        $rs = $oLSOP->spAceptarRechazarSolProgSOP($accion,$iidSolicitudProgramacion);
        $rpta = $rs[0][0];

        if($rpta==1)
            $msj = "Se realizó la acción con éxito";
        else
            $msj = "No se concretó la acción, inténtelo nuevamente o contáctese con su administrador";
        return $msj;
    }

    public function manteProgramacionSOP($parametros){
        $cadenaDatos=$parametros["p2"];
        $accion=$parametros["p3"];

        $datosDesencriptados=base64_decode($cadenaDatos);
        $arrayDatos=explode("|||", $datosDesencriptados);
        $oLSOP = new LSOP();

        switch($accion){
            case 'actualizar':
                $iidProgramacionSOP=$arrayDatos[0];
                $iidSolicitudProgramacion="";
                $iidEstadoSOP="";
                $iidCentroCosto="";
                $cCodigoMedicoCirujano=$arrayDatos[1];
                $iCodigoPaciente="";
                $cCodigoAmbienteLogico=$arrayDatos[2];
                $iCodigoAmbienteFisico="";
                $cCodigoActividad="";
                $iidTipoProgramacionSOP=$arrayDatos[3];
                $cCodigoFormato="";
                $cNroFormato="";
                $vHoraProgramada="";
                $dFechaServicio="";
                $dFechaHoraIngreso=$arrayDatos[4];
                $dFechaHoraSalida=$arrayDatos[5];
                $vTiempoAproximado="";
                $cadenaIdServicioUtilizado=$arrayDatos[6];
                $cadenaCodPersonaResponsable=$arrayDatos[7];
                $rs = $oLSOP->spManteProgramacionSOP($accion,$iidProgramacionSOP,$iidSolicitudProgramacion,$iidEstadoSOP,$iidCentroCosto,
                                           $cCodigoMedicoCirujano,$iCodigoPaciente,$cCodigoAmbienteLogico,$iCodigoAmbienteFisico,$cCodigoActividad,
                                           $iidTipoProgramacionSOP,$cCodigoFormato,$cNroFormato,$vHoraProgramada,$dFechaServicio,$dFechaHoraIngreso,
                                           $dFechaHoraSalida,$vTiempoAproximado,$cadenaIdServicioUtilizado,$cadenaCodPersonaResponsable);
                $rpta = $rs[0][0];
                break;
        }
        if($rpta==1)
            $msj = "Se realizÃ³ la acciÃ³n con Ã©xito";
        else
            $msj = "No se concretÃ³ la acciÃ³n, intÃ©ntelo nuevamente o contÃ¡ctese con su administrador";
        return $msj;
    }

    public function mostrarManteProgSOP($iidProgramacionSOP){
        $oLSOP = new LSOP();
        $accion=2;
        $token=$iidProgramacionSOP;
        $rsDetalleProgramacionSOP = $oLSOP->spListaDetalleProgramacionSOP($accion,$token);

        $accion=8;
        $token1="";
        $iidTipoProgramacionSOP=$rsDetalleProgramacionSOP[0]["iidTipoProgramacionSOP"];
        $opcionesCboTiposProgramacionSOP=$this->listarOpcionesCboTiposProgramacionSOP($accion,$token1,$iidTipoProgramacionSOP);
        
        require_once("../../cvista/programacion/sop/manteProgramacionSOP.php");
    }

    public function listarOpcionesCboTiposProgramacionSOP($accion,$token,$indSeleccionado){
        $oLSOP = new LSOP();
        $arrayCombo = $oLSOP->spListaTiposProgramacionSOP($accion,$token);
        $oCombo = new Combo($arrayCombo);
        $indSel=$indSeleccionado;
        $valorDefault="";
        $comboHTML = $oCombo->getOptionsHTML($indSel,$valorDefault);
        return $comboHTML;
    }

    public function listarOpcionesCboAmbientesLogicos($accion,$token){
        $oLSOP = new LSOP();
        $arrayCombo = $oLSOP->spListaAmbientesLogicos($accion,$token);
        $oCombo = new Combo($arrayCombo);
        $indSel="";
        $valorDefault="Todos";
        $comboHTML = $oCombo->getOptionsHTML($indSel,$valorDefault);
        return $comboHTML;
    }

    public function listarOpcionesCboCentroCostoCirujanosSOP($accion,$token){
        $oLSOP = new LSOP();
        $arrayCombo = $oLSOP->spListaCentroCostoCirujanosSOP($accion,$token);
        $oCombo = new Combo($arrayCombo);
        $indSel="";
        $valorDefault="Todos";
        $comboHTML = $oCombo->getOptionsHTML($indSel,$valorDefault);
        return $comboHTML;
    }

    public function xmlTablaAmbientesLogicosSOP($accion,$token) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLSOP = new LSOP();

        $arrayFilas = $oLSOP->spListaAmbientesLogicosSOP($accion,$token);
        $arrayCabecera = array("cCodigoAmbienteLogico"=>"Código","vNombreAmbienteLogico"=>"Ambiente");
        $arrayTamano = array("cCodigoAmbienteLogico"=>"100","vNombreAmbienteLogico"=>"*");
        $arrayTipo = array("cCodigoAmbienteLogico"=>"ro","vNombreAmbienteLogico"=>"ro");
        $arrayAlineacion = array("cCodigoAmbienteLogico"=>"left","vNombreAmbienteLogico"=>"left");
        $arrayHidden = array("cCodigoAmbienteLogico"=>"false","vNombreAmbienteLogico"=>"false");
        //public function stringXml($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayAlineacion,$posicionId,$arrayhidden='')
        return $o_TablaHtmlx->stringXml($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayAlineacion,0,$arrayHidden);
    }

    public function mostrarBuscadorAmbienteLogico($hidden,$text){
        
        require_once("../../cvista/busqueda/buscadorAmbienteLogico.php");
    }

    public function xmlTablaCirugiasRealizadasSOP($accion,$token){
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLSOP = new LSOP();

        $arrayFilas = $oLSOP->spListaCirugiasRealizadasSOP($accion,$token);
        $arrayCabecera = array("iidCirugiaRealizada"=>"iidCirugiaRealizada",
                               "iidProgramacionSOP"=>"iidProgramacionSOP",
                               "c_cod_ser_pro"=>"Codigo Servicio",
                               "v_desc_ser_pro"=>"Servicio",
                               "cCodigoMedicoCirujano"=>"cCodigoMedicoCirujano",
                               "nomCompletoCirujano"=>"Cirujano",
                               "btnBuscarCirujano"=>"...",
                               "btnEliminarCirujano"=>"..."/*,
                               "btnRechazar"=>"..."*/);
        $arrayTamano = array("iidCirugiaRealizada"=>"80",
                             "iidProgramacionSOP"=>"80",
                             "c_cod_ser_pro"=>"100",
                             "v_desc_ser_pro"=>"200",
                             "cCodigoMedicoCirujano"=>"80",
                             "nomCompletoCirujano"=>"200",
                             "btnBuscarCirujano"=>"30",
                             "btnEliminarCirujano"=>"30"/*,
                             "btnRechazar"=>"30"*/);
        $arrayTipo = array("iidCirugiaRealizada"=>"ro",
                           "iidProgramacionSOP"=>"ro",
                           "c_cod_ser_pro"=>"ro",
                           "v_desc_ser_pro"=>"ro",
                           "cCodigoMedicoCirujano"=>"ro",
                           "nomCompletoCirujano"=>"ro",
                           "btnBuscarCirujano"=>"img",
                           "btnEliminarCirujano"=>"img"/*,
                           "btnRechazar"=>"img"*/);
        $arrayAlineacion = array("iidCirugiaRealizada"=>"center",
                                 "iidProgramacionSOP"=>"center",
                                 "c_cod_ser_pro"=>"center",
                                 "v_desc_ser_pro"=>"left",
                                 "cCodigoMedicoCirujano"=>"right",
                                 "nomCompletoCirujano"=>"center",
                                 "btnBuscarCirujano"=>"center",
                                 "btnEliminarCirujano"=>"center"/*,
                                 "btnRechazar"=>"center"*/);
        $arrayHidden = array("iidCirugiaRealizada"=>"false",
                             "iidProgramacionSOP"=>"false",
                             "c_cod_ser_pro"=>"false",
                             "v_desc_ser_pro"=>"false",
                             "cCodigoMedicoCirujano"=>"false",
                             "nomCompletoCirujano"=>"false",
                             "btnBuscarCirujano"=>"false",
                             "btnEliminarCirujano"=>"false"/*,
                             "btnRechazar"=>"false"*/);
        return $o_TablaHtmlx->stringXml($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayAlineacion,0,$arrayHidden);
    }
    
    public function xmlTablaServiciosUtilizadosSOP($accion,$token){
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLSOP = new LSOP();

        $arrayFilas = $oLSOP->spListaServiciosUtilizadosSOP($accion,$token);
        $arrayCabecera = array("iidServicioUtilizado"=>"iidServicioUtilizado",
                               "iidProgramacionSOP"=>"iidProgramacionSOP",
                               "c_cod_ser_pro"=>"Codigo Servicio",
                               "v_desc_ser_pro"=>"Servicio",
                               "cCodigoPersonaResponsable"=>"cCodigoPersonaResponsable",
                               "nomCompletoPerResp"=>"Responsable",
                               "btnBuscarResponsable"=>"...",
                               "btnEliminarResponsable"=>"..."/*,
                               "btnRechazar"=>"..."*/);
        $arrayTamano = array("iidServicioUtilizado"=>"80",
                             "iidProgramacionSOP"=>"80",
                             "c_cod_ser_pro"=>"100",
                             "v_desc_ser_pro"=>"200",
                             "cCodigoPersonaResponsable"=>"80",
                             "nomCompletoPerResp"=>"200",
                             "btnBuscarResponsable"=>"30",
                             "btnEliminarResponsable"=>"30"/*,
                             "btnRechazar"=>"30"*/);
        $arrayTipo = array("iidServicioUtilizado"=>"ro",
                           "iidProgramacionSOP"=>"ro",
                           "c_cod_ser_pro"=>"ro",
                           "v_desc_ser_pro"=>"ro",
                           "cCodigoPersonaResponsable"=>"ro",
                           "nomCompletoPerResp"=>"ro",
                           "btnBuscarResponsable"=>"img",
                           "btnEliminarResponsable"=>"img"/*,
                           "btnRechazar"=>"img"*/);
        $arrayAlineacion = array("iidServicioUtilizado"=>"center",
                                 "iidProgramacionSOP"=>"center",
                                 "c_cod_ser_pro"=>"center",
                                 "v_desc_ser_pro"=>"left",
                                 "cCodigoPersonaResponsable"=>"right",
                                 "nomCompletoPerResp"=>"center",
                                 "btnBuscarResponsable"=>"center",
                                 "btnEliminarResponsable"=>"center"/*,
                                 "btnRechazar"=>"center"*/);
        $arrayHidden = array("iidServicioUtilizado"=>"false",
                             "iidProgramacionSOP"=>"false",
                             "c_cod_ser_pro"=>"false",
                             "v_desc_ser_pro"=>"false",
                             "cCodigoPersonaResponsable"=>"false",
                             "nomCompletoPerResp"=>"false",
                             "btnBuscarResponsable"=>"false",
                             "btnEliminarResponsable"=>"false"/*,
                             "btnRechazar"=>"false"*/);
        return $o_TablaHtmlx->stringXml($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayAlineacion,0,$arrayHidden);
    }

    public function mostrarBuscadorCirujanoSOP($tipoBuscador,$rowId,$cellInd){
        require_once("../../cvista/busqueda/buscadorPersonaSOP.php");
    }
    /*************************** Fin Programacion SOP *************************/
}

?>
