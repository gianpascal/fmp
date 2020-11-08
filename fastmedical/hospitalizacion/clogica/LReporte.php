<?php

require_once("../../cdatos/DReporte.php");
require_once("../../cdatos/DActoMedico.php");

class LReporte {

    public function __construct() {
        
    }

    public function cboTipoReporteDetalle() {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->cboTipoReporteDetalle();
        return $respuesta;
    }

    public function cargarTablaPersonal($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->cargarTablaPersonal($datos);
        foreach ($respuesta as $key => $value) {
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/bajarAngel.png ^ Agregar");
        }
        return $respuesta;
    }

    public function cargarTablaServicios($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->cargarTablaServicios($datos);
        foreach ($respuesta as $key => $value) {
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/bajarAngel.png ^ Agregar");
        }
        return $respuesta;
    }

    public function TablaHistoriaEstadistica() {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->TablaHistoriaEstadistica();
        foreach ($respuesta as $key => $value) {
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/editarAngel.png ^ Editar");
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/estadisticasAngel.png ^ Ver");
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/cancelarBlanco.png ^ Eliminar");
        }
        return $respuesta;
    }

//      public function cargarTablaSedes(){
//         $o_DReporte = new DReporte();



    public function cargarTablaSedes() {
        $o_DReporte = new DReporte();

        $respuesta = $o_DReporte->cargarTablaSedes();
        foreach ($respuesta as $key => $value) {
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/bajarAngel.png ^ Agregar");
        }
        return $respuesta;
    }

    //JCQA 23 octubre 2012

    public function lindicadorLaboratorioClinicoListaAfiliaciones() {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->dindicadorLaboratorioClinicoListaAfiliaciones();
        foreach ($respuesta as $key => $value) {
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/boton_agregar1.JPG ^ Agregar");
        }
        return $respuesta;
    }

    //JCQA 23 octubre 2012

    public function lindicadorLaboratorioClinicoListaProcedencia() {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->dindicadorLaboratorioClinicoListaProcedencia();
        foreach ($respuesta as $key => $value) {
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/boton_agregar1.JPG ^ Agregar");
        }
        return $respuesta;
    }

    //jcqa 16 nov 2012

    function LreporteDePuntoControlXExamen_indicador($datos) {

        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->DreporteDePuntoControlXExamen_indicador($datos);
        foreach ($respuesta as $key => $value) {
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/boton_agregar1.JPG ^ Agregar");
        }
        return $respuesta;
    }

    //JCQA 22 Noviembre  2012

    function LreporteDeUnidadesUtilizadasxMaterialLaboratorio_IndicadorLaboratorio($datos) {

        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->DreporteDeUnidadesUtilizadasxMaterialLaboratorio_IndicadorLaboratorio($datos);
        foreach ($respuesta as $key => $value) {
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/boton_agregar1.JPG ^ Agregar");
        }
        return $respuesta;
    }

    //JCQA 22 Noviembre  2012

    public function lindicadorLaboratorioClinicoListaSedes() {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->dindicadorLaboratorioClinicoListaSedes();
        foreach ($respuesta as $key => $value) {
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/boton_agregar1.JPG ^ Agregar");
        }
        return $respuesta;
    }

    public function TablaLeyendaGrafica($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->TablaLeyendaGrafica($datos);
        return $respuesta;
    }

    //JCQA
    public function TablaLeyendaGraficaLab($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->TablaLeyendaGraficaLabo($datos);
        return $respuesta;
    }

    public function indicadorLaboratorioClinicoMaterialesLaboratorio() {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->indicadorLaboratorioClinicoMaterialesLaboratorio();
        foreach ($respuesta as $key => $value) {
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/boton_agregar1.JPG ^ Agregar");
        }
        return $respuesta;
    }

    //JCQA 23 octubre 2012

    public function lindicadorLaboratorioClinicoListaExamenes() {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->dindicadorLaboratorioClinicoListaExamenes();

        foreach ($respuesta as $i => $valuey) {
            array_push($respuesta[$i], "../../../../fastmedical_front/imagen/icono/boton_agregar1.JPG ^ Agregar");
        }
//
//        foreach ($rs as $j => $valuem) {
//            array_push($rs[$j], "../../../../fastmedical_front/imagen/icono/cancel.png ^ Eliminar Examen");
//        }

        return $respuesta;
    }

    public function tablaAmbiLo() {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->tablaAmbiLo();
        foreach ($respuesta as $key => $value) {
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/bajarAngel.png ^ Agregar");
        }
        return $respuesta;
    }

    public function tablaAmbiFi() {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->tablaAmbiFi();
        foreach ($respuesta as $key => $value) {
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/bajarAngel.png ^ Agregar");
        }
        return $respuesta;
    }

    public function ListarActividades() {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->ListarActividades();
        foreach ($respuesta as $key => $value) {
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/bajarAngel.png ^ Agregar");
        }
        return $respuesta;
    }

    public function lDatosPuntoControlPaciente($codPacienteLab) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->dDatosPuntoControlPaciente($codPacienteLab);
        return $respuesta;
    }

    public function lgrupodeDatos($codPacienteLab) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->dgrupodeDatos($codPacienteLab);
        return $respuesta;
    }

    public function ldatosExamenUni($codPacienteLab) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->ddatosExamenUni($codPacienteLab);
        return $respuesta;
    }

    public function lEstadisticasMedicos($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->dEstadisticasMedicos($datos);
        return $respuesta;
    }

    //jcqa
    public function lestadisticasExamenesLaboratorioClinico($datos) {
        $o_DReporte = new DReporte();
//        print_r( "mela" +$datos['puntoControl1']);
        $respuesta = $o_DReporte->destadisticasExamenesLaboratorioClinico($datos);
        return $respuesta;
    }

    public function lEstadisticasMedicosGuardados($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->dEstadisticasMedicosGuardados($datos);
        return $respuesta;
    }

    public function guardarDatosHistoriaEstadistica($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->guardarDatosHistoriaEstadistica($datos);
        return $respuesta;
    }

    public function EditarVdescripcionHistorial($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->EditarVdescripcionHistorial($datos);
        return $respuesta;
    }

    public function datosPacientexExamen($codPacienteLab) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->datosPacientexExamen($codPacienteLab);
        return $respuesta;
    }

    public function grabarReporte($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->grabarReporte($datos);
        return $respuesta;
    }

    public function grabarEtiqueta($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->grabarEtiqueta($datos);
        return $respuesta;
    }

    public function grabarAtributoFormato($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->grabarAtributoFormato($datos);
        return $respuesta;
    }

    public function arbolReporte() {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->arbolReporte();
        return $respuesta;
    }

    public function editarReporte($idreporte) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->editarReporte($idreporte);
        $id = $respuesta[0][0];
        $nombre = $respuesta[0][1];
        $estado = $respuesta[0][2];
        return $id . "|" . $nombre . "|" . $estado . "|";
    }

    public function listaEtiqueta($idReporte) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->listaEtiqueta($idReporte);
        $datos = array();
        foreach ($respuesta as $i => $value) {
            $datos[$i][0] = $respuesta[$i][0];
            $datos[$i][1] = $respuesta[$i][1];
            $datos[$i][2] = $respuesta[$i][2];
            if ($respuesta[$i][3] == 1)
                $datos[$i][3] = "Activado";
            else if ($respuesta[$i][3] == 0)
                $datos[$i][3] = "Desactivado";
            $datos[$i][4] = $respuesta[$i][4];
            $datos[$i][5] = $respuesta[$i][5];
            $datos[$i][6] = $respuesta[$i][6];
        }
        return $datos;
    }

    public function listaAtributos() {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->listaAtributos();
        $datos = array();
        foreach ($respuesta as $i => $value) {
            $datos[$i][0] = $respuesta[$i][0];
            $datos[$i][1] = $respuesta[$i][1];
            $datos[$i][2] = $respuesta[$i][2];
            $datos[$i][3] = $respuesta[$i][3];
        }
        return $datos;
    }

    public function traerValoresCombo($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->traerValoresCombo($datos);
        return $respuesta;
    }

    public function grabarAtributoCombo($idAtributo, $datosItemCombo) {
        $o_DReporte = new DReporte();
        $arrayTexto = $datosItemCombo['q1'];
        $arrayValue = $datosItemCombo['q2'];
        $indice = array_keys($arrayTexto);
        $resultado = null;
        for ($k = 0; $k < count($arrayTexto); $k++) {
            $i = $indice[$k];
            $o_DReporte = new DReporte();
            $resultado = $o_DReporte->grabarAtributoCombo("", $idAtributo, $arrayTexto[$i], $arrayValue[$i], "grabar");
        }
        return $resultado;
    }

    public function grabarReporteDetalle($idEtiqueta, $datosTipo) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->grabarReporteDetalle($idEtiqueta, $datosTipo);
        return $respuesta;
    }

    public function modificarAtributoCombo($datos) {
        $idAtributo = $datos['p1'];
        $arrayIdCombo = $datos['hididcomboatributo'];
        $arrayTexto = $datos['txttexto'];
        $arrayValue = $datos['txtvalue'];
        $respuesta = "";
        $indiceEditados = array_keys($arrayIdCombo);
        $tamanio = count($indiceEditados);
        for ($k = 0; $k < count($arrayTexto); $k++) {
            if ($k < $tamanio)
                $p = $indiceEditados[$k];
            $i = $k + 1;
            if ($i == $p) { // aqui se modifica los valores del combo despues de haber editado
                $o_DReporte = new DReporte(); //$idAtributoCombo,$texto,$value,$hacer
                $o_DReporte->grabarAtributoCombo($arrayIdCombo[$i], $idAtributo, $arrayTexto[$i], $arrayValue[$i], 'modificar');
            } else { // aqui se insertan los nuevos valores agregados del combo despues de haber editado
                $o_DReporte = new DReporte();
                $o_DReporte->grabarAtributoCombo("", $idAtributo, $arrayTexto[$i], $arrayValue[$i], 'grabar');
            }
        }
        return $respuesta;
    }

    public function cboTipoEtiquetaAtributo() {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->cboTipoEtiquetaAtributo();
        return $respuesta;
    }

    public function cargarAtributoCombo($idAtributo) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->cargarAtributoCombo($idAtributo);
        return $respuesta;
    }

    public function grabarEtiquetaAtributo($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->grabarEtiquetaAtributo($datos);
        return $respuesta;
    }

    public function listaEtiquetaAtributo($idEtiqueta) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->listaEtiquetaAtributo($idEtiqueta);
        $datos = array();
        foreach ($respuesta as $i => $value) {
            $datos[$i][0] = $respuesta[$i][0];
            $datos[$i][1] = $respuesta[$i][1];
            $datos[$i][2] = $respuesta[$i][2];
            $datos[$i][3] = $respuesta[$i][3];
            $datos[$i][4] = $respuesta[$i][5];
            $datos[$i][5] = $respuesta[$i][6];
            $datos[$i][6] = $respuesta[$i][4];
            if ($respuesta[$i][4] == 0) {
                $datos[$i][7] = "Desactivado";
                $datos[$i][8] = "../../../../fastmedical_front/imagen/icono/good.gif ^ Activar";
            } else if ($respuesta[$i][4] == 1) {
                $datos[$i][7] = "Activado";
                $datos[$i][8] = "../../../../fastmedical_front/imagen/icono/eliminar.gif ^ Desactivar";
            }
        }
        return $datos;
    }

    public function switchEtiquetaAtributo($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->switchEtiquetaAtributo($datos);
        return $respuesta;
    }

    public function existeRecetaMedica($codigoProgramacion) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->existeRecetaMedica($codigoProgramacion);
        return $respuesta;
    }

    public function datosRecetaMedica($codProgramacion) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->datosRecetaMedica($codProgramacion);
        foreach ($respuesta as $ind => $valor) {
            if (empty($valor["c_cod_ser_pro"])) {
                $arreglo = explode("|", $valor["vModoAplicacion"]);
                $valor["v_desc_ser_pro"] = $arreglo[0];
                $respuesta[$ind][0] = $arreglo[0];
                $valor["descri"] = $arreglo[1];
                $respuesta[$ind][1] = $arreglo[1];
                $valor["vModoAplicacion"] = $arreglo[3];
                $respuesta[$ind][3] = $arreglo[3];
            }
        }
        return $respuesta;
    }

    public function fechasTratamienos($idProgramacion) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->fechasTratamienos($idProgramacion);
        return $respuesta;
    }

    public function atributosRecetaMedica($reporte) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->atributosRecetaMedica($reporte);
        return $respuesta;
    }

    public function modificarEtiquetaAtributo($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->modificarEtiquetaAtributo($datos);
        return $respuesta;
    }

    public function labelReportePdf($reporte, $idReporte, $idTipoReorteDetalle) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->labelReportePdf($reporte, $idReporte, $idTipoReorteDetalle);
        return $respuesta;
    }

    public function datosPaciente($codPaciente) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->datosPaciente($codPaciente);
        return $respuesta;
        //print_r($respuesta);
    }

    public function listaExamenesHCGeneral($codProgramacion, $codExamen) {
        //var_dump('e');exit;
        $o_DActoMedicoGeneral = new DActoMedico();
        $resultado = $o_DActoMedicoGeneral->listaExamenesHCGeneral($codProgramacion, $codExamen);
        //var_dump('<pre>',$resultado);exit();
        return $resultado;
    }

    public function datosPacienteRecetaEstandarizada($codPersona, $idProgramacion) {
        $o_DReporte = new DReporte();
        $o_LPersona = new LPersona();
        $respuesta = $o_DReporte->datosPacienteRecetaEstandarizada($codPersona, $idProgramacion);
        $respuesta[0]["dFechaNacimiento"] = $o_LPersona->formatoEdad($respuesta[0]["dFechaNacimiento"]);
        $respuesta[0][3] = $respuesta[0]["dFechaNacimiento"];
        return $respuesta;
    }

    public function datosPacienteImprimirHIstoria($idProgramacion) {
        $o_DReporte = new DReporte();
        $o_LPersona = new LPersona();
        $respuesta = $o_DReporte->datosPacienteImprimirHIstoria($idProgramacion);
        //print_r($respuesta) ;
        if ($respuesta[0]["dFechaNacimiento"] == 'sindata') {
            $respuesta[0]["dFechaNacimiento"] == '-';
            $respuesta[0][1] = '-';
        } else {
            $respuesta[0]["dFechaNacimiento"] = $o_LPersona->formatoEdad($respuesta[0]["dFechaNacimiento"]);
            $respuesta[0][1] = $respuesta[0]["dFechaNacimiento"];
        }
        //  print_r( $respuesta[0]["dFechaNacimiento"]);
        return $respuesta;
    }

    public function lDatosPacienteTicketOrden($idTratamiento) {
        $o_DReporte = new DReporte();
        $o_LPersona = new LPersona();
        $respuesta = $o_DReporte->dDatosPacienteTicketOrden($idTratamiento);
        //$respuesta[0]["dFechaNacimiento"] = $o_LPersona->formatoEdad($respuesta[0]["dFechaNacimiento"]);
        //$respuesta[0][3] = $respuesta[0]["dFechaNacimiento"];
        return $respuesta;
    }

    public function datosMedico($codMedico) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->datosMedico($codMedico);
        return $respuesta;
    }

    public function eliminaDbComboAtributo($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->eliminaDbComboAtributo($datos);
        return $respuesta;
    }

    public function verificarHistoriaClinica($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->verificarHistoriaClinica($datos);
        $resp = 'NO_DATA';
        if ($respuesta) {
            $resp = $respuesta[0][2] . "|" . $respuesta[0][0]; // historiaClinica, idPaciente
        }
        return $resp;
    }

    public function verificarHistoriaClinicaXDia($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->verificarHistoriaClinicaXDia($datos);
        $resp = 'NO_DATA';
        if ($respuesta) {
            $resp = $respuesta[0][2] . "|" . $respuesta[0][0]; // historiaClinica, idPaciente
        }
        return $resp;
    }

    public function listaAtenciones($idPaciente) {
        $o_DActoMed = new DActoMedico();
        $respuesta = $o_DActoMed->arbolHCFechas($idPaciente);
        return $respuesta;
    }

    public function listaAtencionesMamografias($datos) {
        $o_DActoMed = new DActoMedico();
        $respuesta = $o_DActoMed->listaAtencionesMamografias($datos);
        return $respuesta;
    }

    public function listaAtencionesXDia($idPrograma) {
        $o_DActoMed = new DActoMedico();
        $respuesta = $o_DActoMed->listaAtencionesXDia($idPrograma);
        return $respuesta;
    }

    public function centroCostosPorServicio($codProducto) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->centroCostosPorServicio($codProducto);
        return $respuesta;
    }

    public function rptAntecedentes($idPaciente) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->hstrAntecedentes($idPaciente);
        return $respuesta;
    }

    public function rptMotivoConsulta($idProgPaciente) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->historiaMotivoConsulta($idProgPaciente);
        return $respuesta;
    }

    public function rptTriaje($idProgPaciente) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->listaDatosTriaje($idProgPaciente);
        return $respuesta;
    }

    public function rptExamenesMedicos($idProgPaciente) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->listaExamenesHC($idProgPaciente, "xprogramacion");
        return $respuesta;
    }

    public function listaAtencionesPreventivas($dia) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->listaAtencionesPreventivas($dia);
        return $respuesta;
    }

    public function rptDiagnostico($idProgPaciente) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->historiaDiagnostico($idProgPaciente);
        return $respuesta;
    }

    public function rptTratamientos($idProgPaciente, $opt) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->historiaTratamientos($idProgPaciente, $opt);
        foreach ($respuesta as $ind => $valor) {
            if (empty($valor["c_cod_ser_pro"])) {
                $arreglo = explode("|", $valor["vModoAplicacion"]);
                $respuesta[$ind]["v_desc_ser_pro"] = $arreglo[0];
                $respuesta[$ind][2] = $arreglo[0];
                $respuesta[$ind]["descri"] = $arreglo[1];
                $respuesta[$ind][5] = $arreglo[1];
                $respuesta[$ind]["icantidad"] = $valor["icantidad"];
                $respuesta[$ind][3] = $valor["icantidad"];
                $respuesta[$ind]["vModoAplicacion"] = $arreglo[2];
                $respuesta[$ind][4] = $arreglo[2];
            }
        }
        return $respuesta;
    }

    /* CAJA SIMEDH WEB */

    public function verificarRecibodePago($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->verificarRecibodePago($datos);
        return $respuesta[0][0];
    }

    public function obtenerDatosEmpresaGeneraelRecibo($codigoEmpresa) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->getDatosEmpresaGeneraelRecibo($codigoEmpresa);
        return $respuesta;
    }

    public function obtenerDatosPacienteGeneraelRecibo($numeroRecibo) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->getDatosPacienteGeneraelRecibo($numeroRecibo);
        return $respuesta;
    }

    public function obtenerDatosDetalleReciboGenerado($numeroRecibo) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->getDatosDetalleReciboGenerado($numeroRecibo);
        return $respuesta;
    }

    public function obtenerDatosPieReciboGenerado($numeroRecibo) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->getDatosPieReciboGenerado($numeroRecibo);
        return $respuesta;
    }

    public function fechaEmiteResibo() {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->fechaEmiteResibo();
        return $respuesta;
    }

    public function ExitenciaHistoriaClinica($c_cod_per) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->ExitenciaHistoriaClinica($c_cod_per);
        return $respuesta;
    }

    public function eliminarEstadisticaGuardada($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->eliminarEstadisticaGuardada($datos);
        return $respuesta;
    }

    public function buscarMedicamento($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->buscarMedicamento($datos);
        return $respuesta;
    }

    public function buscarMEdico($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->buscarMEdico($datos);
        return $respuesta;
    }

    public function mostrarReportesFechasRecetaMedica($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->mostrarReportesFechasRecetaMedica($datos);
        return $respuesta;
    }

    public function mostrarReportesFechasMedico($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->mostrarReportesFechasMedico($datos);
        return $respuesta;
    }

    public function mostrarReportesMedicamentoRecetaMedica($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->mostrarReportesMedicamentoRecetaMedica($datos);
        return $respuesta;
    }

    public function listarBusquedaCIE($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->listarBusquedaCIE($datos);
        return $respuesta;
    }

    public function mostrarReportesFechas($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->mostrarReportesFechas($datos);
        return $respuesta;
    }

    public function mostrarReportesFechasSede($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->mostrarReportesFechasSede($datos);
        return $respuesta;
    }

    public function mostrarReportesFechasAfiliacion($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->mostrarReportesFechasAfiliacion($datos);
        return $respuesta;
    }

    public function mostrarReportesFechasCie($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->mostrarReportesFechasCie($datos);
        return $respuesta;
    }

    public function mostrarReportesFechasAfiliacionSede($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->mostrarReportesFechasAfiliacionSede($datos);
        return $respuesta;
    }

    public function mostrarReportesFechasAfiliacionCIE($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->mostrarReportesFechasAfiliacionCIE($datos);
        return $respuesta;
    }

    public function mostrarReportesFechasSedeCIE($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->mostrarReportesFechasSedeCIE($datos);
        return $respuesta;
    }

    public function mostrarReportesFechasAfiliacionSedeCIE($datos) {
        $o_DReporte = new DReporte();
        $respuesta = $o_DReporte->mostrarReportesFechasAfiliacionSedeCIE($datos);
        return $respuesta;
    }

    public function LbuscarReporteGruposEtareos() {
        $o_DReporte = new DReporte();
        $resultado = $o_DReporte->DbuscarReporteGruposEtareos();
        $tabla = array();
        $contador = 1;
        foreach ($resultado as $key => $value) {
            $tabla[$key][0] = $contador;
            $tabla[$key] = array_merge($tabla[$key], $value);
            $contador++;
        }
        return $tabla;
    }

    public function LbuscarPersonasGrupoEtareo($datos) {
        $o_DReporte = new DReporte();
        $resultado = $o_DReporte->DbuscarPersonasGrupoEtareo($datos);
        return $resultado;
    }

    public function LmostrarCPTfaltantes($datos) {
        $o_DReporte = new DReporte();
        $resultado = $o_DReporte->DmostrarCPTfaltantes($datos);
        return $resultado;
    }

    public function lCargarTablaProgramacionDHTMLX() {
        $o_DReporte = new DReporte();
        $resultado = $o_DReporte->dCargarTablaProgramacionDHTMLX();
        return $resultado;
    }

    public function lmostrarReporteOperacionalTBC() {
        $o_DReporte = new DReporte();
        $resultado = $o_DReporte->dmostrarReporteOperacionalTBC();
        return $resultado;
    }

    public function lArrayHojaNSIG() {
        $o_DReporte = new DReporte();
        $resultado = $o_DReporte->dArrayHojaNSIG();
        return $resultado;
    }

    public function lArrayGrupoNSIG() {
        $o_DReporte = new DReporte();
        $resultado = $o_DReporte->dArrayGrupoNSIG();
        return $resultado;
    }

    public function lArrayActividadNSIG() {
        $o_DReporte = new DReporte();
        $resultado = $o_DReporte->dArrayActividadNSIG();
        return $resultado;
    }

    public function lArrayServicioNSIG() {
        $o_DReporte = new DReporte();
        $resultado = $o_DReporte->dArrayServicioNSIG();
        return $resultado;
    }

    public function rptAntecedentesPRograma($idPrograma) {
        $o_DReporte = new DReporte();
        $resultado = $o_DReporte->rptAntecedentesPRograma($idPrograma);
        return $resultado;
    }

    public function lDatosExamenes($iIdUbicacionesImagenes) {
        $o_DReporte = new DReporte();
        $resultado = $o_DReporte->dDatosExamenes($iIdUbicacionesImagenes);
        return $resultado;
    }

    public function getBuscarPersonasReporte($patron, $tipoDoc, $parametro, $editar) {
        require_once("../../cdatos/DPersona.php");
        $o_DPersona = new DPersonas();
        $respuesta = $o_DPersona->getArrayListPersonas($patron, $tipoDoc, $parametro);
        foreach ($respuesta as $key => $value) {
            array_push($respuesta[$key], "../../../../fastmedical_front/imagen/icono/editar.png ^ Agregar");
        }
        return $respuesta;
    }

    public function lListaObjetos() {
        $o_DReporte = new DReporte();
        $resultado = $o_DReporte->dListaObjetos();
        return $resultado;
    }

    public function lDetalleObjetos($datos) {
        require_once("../../../pholivo/Conexion.php");
        $coneccion = Conexion::getInitDsnMSSQLSimedh();
        $o_DReporte = new DReporte();
        $resultado = $o_DReporte->dDetalleObjetos($datos);
        $host = $coneccion['dbhost'];
        $base = $coneccion['dbname'];

        $path = "/var/www/html/export/$host";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $path = "/var/www/html/export/$host/$base";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $esquema=$datos['esquema'];
        $path = "/var/www/html/export/$host/$base/$esquema";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $type=$datos['type'];
        $path = "/var/www/html/export/$host/$base/$esquema/$type";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $ruta = "/var/www/html/export/$host/" . $base . "/" . $datos['esquema'] . "/" . $datos['type'] . "/" . $datos['objeto'] . ".sql";
        echo $ruta;

        if (file_exists($ruta)) {

            unlink($ruta);
        }

        $texto = '';
        $textoTotal = '';
        if ($archivo = fopen($ruta, "a")) {
            foreach ($resultado as $key => $value) {
                if (($value['Text']) != '') {
                    $texto = ($value['Text']);
                    $texto = str_replace("CREATE PROCEDURE", "ALTER PROCEDURE", $texto);
                    $texto = str_replace("CREATE procedure", "ALTER PROCEDURE", $texto);
                    $texto = str_replace("CREATE Procedure", "ALTER PROCEDURE", $texto);
                    $texto = str_replace("create procedure", "ALTER PROCEDURE", $texto);
                    $texto = str_replace("CREATE FUNCTION", "ALTER FUNCTION", $texto);
                    $texto = str_replace("CREATE function", "ALTER FUNCTION", $texto);
                    $texto = str_replace("create function", "ALTER FUNCTION", $texto);
                    $texto = str_replace("CREATE TRIGGER", "ALTER TRIGGER", $texto);
                    $texto = str_replace("CREATE TRIGGER", "ALTER trigger", $texto);
                    // fwrite($archivo, $texto.PHP_EOL);
                    //  echo $value['Text'];
                    $textoTotal .= $texto;
                }
            }
            fwrite($archivo, $textoTotal . PHP_EOL);
            fclose($archivo);
        }


        return $resultado;
    }

}

?>
