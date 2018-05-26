<?php

include_once("../../cdatos/DLaboratorio.php");

class LLaboratorio {

    public function __construct() {
        
    }

    function lTablaPuntosControl() {
        $o_DLaboratorio = new DLaboratorio();
        $resultado = $o_DLaboratorio->dTablaPuntosControl();
        return $resultado;
    }

    function lPersonasPorPuntoControl($idPuntoControl, $fecha) {
        $o_DLaboratorio = new DLaboratorio();
        $resultado = $o_DLaboratorio->dPersonasPorPuntoControl($idPuntoControl, $fecha);
        return $resultado;
    }

    function lObtenerDetallePuntoControl($id) {
        $o_DLaboratorio = new DLaboratorio();
        $resultado = $o_DLaboratorio->dObtenerDetallePuntoControl($id);
        return $resultado;
    }

    function lGrabarDetallePuntoControl($datos) {
        $o_DLaboratorio = new DLaboratorio();
        $resultado = $o_DLaboratorio->dGrabarDetallePuntoControl($datos);
        return $resultado;
    }

    function lAgregarDetallePuntoControl($datos) {
        $o_DLaboratorio = new DLaboratorio();
        $resultado = $o_DLaboratorio->dAgregarDetallePuntoControl($datos);
        return $resultado;
    }

    function lVerificarRecibirPuntoControl($datos) {
        $o_DLaboratorio = new DLaboratorio();
        $resultado = $o_DLaboratorio->dVerificarRecibirPuntoControl($datos);
        return $resultado;
    }

    function lVerificarProcesarPuntoControl($datos) {
        $o_DLaboratorio = new DLaboratorio();
        $resultado = $o_DLaboratorio->dVerificarProcesarPuntoControl($datos);
        return $resultado;
    }

    function lcomboPuntoControl() {
        $o_DLaboratorio = new DLaboratorio();
        $rs = $o_DLaboratorio->dcomboPuntoControl();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

// laboratorio del lobo //
    function LbuscarExamenesLaboratorio($datos) {
        $o_DLaboratorio = new DLaboratorio();
        $resultado = $o_DLaboratorio->DbuscarExamenesLaboratorio($datos);
        foreach ($resultado as $key => $value) {
            array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/b_ver_on.gif ^ Puntos Control");
        }
        return $resultado;
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Original de lobo 12Julio2012
//    function LreporteDePuntoControlXExamen($datos) {
//        $o_DLaboratorio = new DLaboratorio();
//        $resultado = $o_DLaboratorio->DreporteDePuntoControlXExamen($datos);
//        $columna = count($resultado);
////        print_r($columna);
//        foreach ($resultado as $key => $value) {
//            if ($key == 0) {
//                array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/blank.gif");
//            } else {
//                array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/Upload.png ^ Subir");
//            }
//            //////////////
//            if ($key == $columna - 1) {
//                array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/blank.gif");
//            } else {
//                array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/agt_upgrade_misc.png ^ Bajar");
//            }
//            array_push($resultado[$key], $columna);
//        }
//        
//       
//        return $resultado;
//    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Original de lobo - Modificado por JCQA 12Julio2012  12:24pm

    function LreporteDePuntoControlXExamen($datos) {
        $o_DLaboratorio = new DLaboratorio();
//        $o_DLaboratorio1 = new DLaboratorio();
        $resultado = $o_DLaboratorio->DreporteDePuntoControlXExamen($datos);
//        $resultado1 = $o_DLaboratorio1->DMuestraRecibirenPuntoControl($datos);

        $columna = count($resultado);
//        print_r($columna);
        foreach ($resultado as $key => $value) {
            if ($key == $columna - 1) {
                array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/blank.gif");
            } else {
                array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/agt_upgrade_misc.png ^ Subir");
            }
            //////////////
            if ($key == 0) {
                array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/blank.gif");
            } else {
                array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/arribaFecha.png ^ Bajar");
            }
            array_push($resultado[$key], $columna);
        }

        ///////

        foreach ($resultado as $i => $valuey) {
            array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/blank.gif ^ 1"); //muestra
            array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/Book.png ^ Detalle"); //detalle

            array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/i_icq_dnd.png ^ Eliminar"); //eliminar

            array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/blank.gif ^ 1"); //recibir
        }

//        foreach ($resultado as $j => $valuem) {
//
//            array_push($resultado[$j], $resultado1[$j][0]);
//            array_push($resultado[$j], $resultado1[$j][1]);
//            array_push($resultado[$j], $resultado1[$j][2]);
//        }


        return $resultado;
    }

    /////////////////////////////////////////////////////////////////////////////////////////



    function LreporteDePuntoControl($datos) {
        $o_DLaboratorio = new DLaboratorio();
        $resultado = $o_DLaboratorio->DreporteDePuntoControl($datos);
        return $resultado;
    }

    function LguardarNuevoPuntoControl($datos) {
        $o_DLaboratorio = new DLaboratorio();
        $resultado = $o_DLaboratorio->DguardarNuevoPuntoControl($datos);
        return $resultado;
    }

    function LmaximonivelPuntoControlExamenes($datos) {
        $o_DLaboratorio = new DLaboratorio();
        $resultado = $o_DLaboratorio->DmaximonivelPuntoControlExamenes($datos);
        return $resultado;
    }

    public function LsubirBajarSecuenciaPuntoControl($datos) {
        $oDLaboratorio = new DLaboratorio();
        $rs = $oDLaboratorio->DsubirBajarSecuenciaPuntoControl($datos);
        return $rs;
    }

    ////  fin del lobo
    public function lCargartablaPerfiles() {
        $oDLaboratorio = new DLaboratorio();
        $rs = $oDLaboratorio->dCargartablaPerfiles();
        foreach ($rs as $key => $value) {
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/smile9.gif ^ Seleccionar");
        }
        return $rs;
    }

    public function lCargarTablaPerfilesExamenes($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $rs = $oDLaboratorio->dCargarTablaPerfilesExamenes($parametros);
        foreach ($rs as $key => $value) {
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar");
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/eliminar.gif ^ Eliminar");
        }
        return $rs;
    }

    //JCDB 16/07/2012
    public function lCargarTablaUsuariosHabilitadosXPuntoControl($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $rs = $oDLaboratorio->dCargarTablaUsuariosHabilitadosXPuntoControl($parametros);
        foreach ($rs as $key => $value) {
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/eliminar.gif ^ Eliminar");
        }
        return $rs;
    }

// laboratorio de JCQA //

    public function lmostrarExamenesLaboratorio() {
        $oDLaboratorio = new DLaboratorio();
        $rs = $oDLaboratorio->dmostrarExamenesLaboratorio();


//        foreach ($rs as $i => $valuey) {
//            array_push($rs[$i], "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar Examen");
//        }
//
//        foreach ($rs as $j => $valuem) {
//            array_push($rs[$j], "../../../../fastmedical_front/imagen/icono/cancel.png ^ Eliminar Examen");
//        }

        return $rs;
    }

    //creado
    public function LlistarUnidadMedidaxMaterialLaboratorio() {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DlistarUnidadMedidaxMaterialLaboratorio();
        return $resultado;
    }

    //creado 20Julio 2012 JCQA

    public function lcargarTablaUnidadesxTipoxMaterialLaboratorio($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $rs = $oDLaboratorio->dcargarTablaUnidadesxTipoxMaterialLaboratorio($parametros);


//        foreach ($rs as $i => $valuey) {
//            array_push($rs[$i], "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar Examen");
//        }
//
//        foreach ($rs as $j => $valuem) {
//            array_push($rs[$j], "../../../../fastmedical_front/imagen/icono/cancel.png ^ Eliminar Examen");
//        }

        return $rs;
    }

    // JCQA 20 Julio 12 3pm
    public function LcargarComboUnidadMedidaPopudML($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DcargarComboUnidadMedidaPopudML($datos);
        return $resultado;
    }

    // JCQA 10 Agosto 2012 12 3pm   COMBO TIPO UNIDAD MEDIDA -- MATERIAL LABORATORIO
    public function LcargarComboTipoUnidadMedidaMaterialSeleccionado($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DcargarComboTipoUnidadMedidaMaterialSeleccionado($datos);
        return $resultado;
    }

    // JCQA 16 Agosto 2012    COMBO UNIDAD MEDIDA -- MATERIAL LABORATORIO
    public function LcargarComboUnidadMedidaMaterialSeleccionado($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DcargarComboUnidadMedidaMaterialSeleccionado($datos);
        return $resultado;
    }

    // JCQA 14 Agosto 2012 12 3pm
    public function LcargarComboUnidadMedidaMuestraSeleccionado($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DcargarComboUnidadMedidaMuestraSeleccionado($datos);
        return $resultado;
    }

    // JCQA 14 Agosto 2012 12 3pm
    public function LcargarComboTipoUnidadMedidaMuestraSeleccionado() {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DcargarComboTipoUnidadMedidaMuestraSeleccionado();
        return $resultado;
    }

    public function lbuscarMaterialesLaboratorioPopap($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dbuscarMaterialesLaboratorioPopap($datos);
        return $resultado;
    }

    //creado x JCQA 10 Agosto 2012

    public function lbuscarMaterialesLaboratorioPopap_2($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dbuscarMaterialesLaboratorioPopap_2($datos);
        return $resultado;
    }

    //creado x JCQA 14 Agosto 2012

    public function lbuscarMaterialesLaboratorioPopap_3($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dbuscarMaterialesLaboratorioPopap_3($datos);
        return $resultado;
    }

    public function lagregarNuevoUnidadalMaterialLaboratorioPoppud($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dagregarNuevoUnidadalMaterialLaboratorioPoppud($datos);
        return $resultado[0][0];
    }

    //  creado por JCQA Lunes 30 Julio, 2012     

    public function lGuardarCambiosDetalleMaterialesdeLaboratorio($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dGuardarCambiosDetalleMaterialesdeLaboratorio($datos);
        return $resultado[0][0];
    }

    //  creado JCQA 28 septiembre 2012     

    public function lActualizarItemMaterialesAlmacenados($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dActualizarItemMaterialesAlmacenados($datos);
        return $resultado[0][0];
    }

    //  creado JCQA 01 octubre 2012     

    public function lActualizarItemMuestraAlmacenados($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dActualizarItemMuestraAlmacenados($datos);
        return $resultado[0][0];
    }

    //  creado JCQA 03 octubre 2012     

    public function LEliminarItemMuestraAlmacenados($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dEliminarItemMuestraAlmacenados($datos);
        return $resultado[0][0];
    }

    //  creado JCQA 03 octubre 2012     

    public function lEliminarItemMaterialesAlmacenados($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dEliminarItemMaterialesAlmacenados($datos);
        return $resultado[0][0];
    }

//  creado por JCQA Septiembre 19 , 2012     

    public function lpresentarfotoDeMaterialLaboratorio($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dpresentarfotoDeMaterialLaboratorio($datos);
        return $resultado[0][0];
    }

    //  creado por JCQA Martes 1 Agosto, 2012       
    public function lGuardarCambiosDetalleMaterialesdeLaboratorio_Nuevo($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dGuardarCambiosDetalleMaterialesdeLaboratorio_Nuevo($datos);
        return $resultado[0][0];
    }

    //  creado por JCQA Martes 18 Agosto, 2012       
    public function lGuardarMuestraxPuntoControlxExamenLaboratorio($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dGuardarMuestraxPuntoControlxExamenLaboratorio($datos);
        return $resultado[0][0];
    }

    //  creado por JCQA Martes 19 Septiembre, 2012       
    public function lGuardarMaterialxPuntoControlxExamenLaboratorio($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dGuardarMaterialxPuntoControlxExamenLaboratorio($datos);
        return $resultado[0][0];
    }

    //  creado por JCQA Martes 7 Agosto, 2012       
    public function LseleccionandoMuestraxPuntoControl($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DseleccionandoMuestraxPuntoControl($datos);
        return $resultado[0][0];
    }

    //  creado por JCQA Martes 8 Agosto, 2012       
    public function LseleccionandoPuntoControlRecibir($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DseleccionandoPuntoControlRecibir($datos);
        return $resultado[0][0];
    }

    //  creado por JCQA Martes 4 Agosto, 2012   

    public function LpreMostrarCVjc($idMaterialLaboratorio) {
        $oDLaboratorio = new DLaboratorio();
        $rs = $oDLaboratorio->DpreMostrarCVjc($idMaterialLaboratorio);
        return $rs;
    }

    //  creado por JCQA Martes 4 Agosto, 2012    
    public function guardarAtributoDocumentoEmpledojc($idMaterialLaboratorio, $nomfileupload) {
        $oDLaboratorio = new DLaboratorio();
//        $datosDocEmp = $o_LRrhh->preMostrarCV($iddocEmpleado);
        $respuesta = $oDLaboratorio->guardarAtributoDocumentoEmpledojc($idMaterialLaboratorio, $nomfileupload);
        return $respuesta;
    }

//  creado por JCQA Lunes 30 Julio, 2012    

    public function lmostrarImagenMaterialLaboratorioTraerData($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dmostrarImagenMaterialLaboratorioTraerData($datos);
        return $resultado[0][0];
    }

    public function lmostrarMaterialesDeLaboratorio() {
        $oDLaboratorio = new DLaboratorio();
        $rs = $oDLaboratorio->dmostrarMaterialesDeLaboratorio();


//        foreach ($rs as $i => $valuey) {
//            array_push($rs[$i], "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar Examen");
//        }
//
//        foreach ($rs as $j => $valuem) {
//            array_push($rs[$j], "../../../../fastmedical_front/imagen/icono/cancel.png ^ Eliminar Examen");
//        }

        return $rs;
    }

    //29 enero 2012

    public function lgetTratamientoPaciente($datos) {
        $oDLaboratorio = new DLaboratorio();
        $rs = $oDLaboratorio->dgetTratamientoPaciente($datos);
        return $rs;
    }

    public function lgetVinculadosTratamientoPaciente($datos) {
        $oDLaboratorio = new DLaboratorio();
        $rs = $oDLaboratorio->dgetVinculadosTratamientoPaciente($datos);

        foreach ($rs as $key => $value) {
            if (trim($value[5]) == "xxxxxyyyyy") {
                array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/agt_action_success_desh.png ^ No Enlazado");
            } else {
                array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/button_ok.png ^ Enlazado");
            }
        }
        return $rs;
    }

    public function lcargarTablaVincularRecetasConTratamientos($datos) {
        $oDLaboratorio = new DLaboratorio();
        $rs = $oDLaboratorio->dcargarTablaVincularRecetasConTratamientos($datos);
        return $rs;
    }

    public function lgetTratamientoPaciente2($datos) {
        $oDLaboratorio = new DLaboratorio();
        $rs = $oDLaboratorio->dgetTratamientoPaciente2($datos);
        return $rs;
    }

    public function lActualizarDetalleExamenLabo($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dActualizarDetalleExamenLabo($parametros);
        return $resultado[0][0];
    }

    public function LlistarTiposdeExamenesLaboratorio() {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DlistarTiposdeExamenesLaboratorio();
        return $resultado;
    }

    public function LlistarTiposdeMaterialesLabo() {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DlistarTiposdeMaterialesLabo();
        return $resultado;
    }

    public function lprecioExamenesxAfiliacion($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $rs = $oDLaboratorio->dprecioExamenesxAfiliacion($parametros);
//        foreach ($rs as $key => $value) {
//            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/smile9.gif ^ Seleccionar");
//        }
        return $rs;
    }

    public function lListarTiposAfiliacionExamenLaboratorio() {
        $oDLaboratorio = new DLaboratorio();
        $rs = $oDLaboratorio->dListarTiposAfiliacionExamenLaboratorio();

        return $rs;
    }

    public function lCargarTablaExamenesLaboratorio($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $rs = $oDLaboratorio->dCargarTablaExamenesLaboratorio($parametros);
        return $rs;
    }

    public function lEliminarPerfilesExamenes($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dEliminarPerfilesExamenes($parametros);
        return $resultado;
    }

    public function lAsignarExamenAPerfil($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dAsignarExamenAPerfil($parametros);
        return $resultado;
    }

    // lobo 12-07-2012 laboratorio

    public function LgrupoDePuntoControl($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DgrupoDePuntoControl($datos);
        return $resultado;
    }

    // lobo 12-07-2012 laboratorio
    public function LEstadoVersicion() {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DEstadoVersicion();
        return $resultado;
    }

    // lobo 12-07-2012 laboratorio
    public function LagregarNuevoGrupo($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DagregarNuevoGrupo($datos);
        return $resultado;
    }

    // lobo 12-07-2012 laboratorio
    public function LguardarModificadoGrupoDatos($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DguardarModificadoGrupoDatos($datos);
        return $resultado;
    }

    // lobo 13-07-2012 laboratorio
    public function LeliminarGrupoDatos($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DeliminarGrupoDatos($datos);
        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LtipoDatos() {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DtipoDatos();
        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LcargarComboUnidadMedida($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DcargarComboUnidadMedida($datos);
        return $resultado;
    }

//    
    // lobo 16-07-2012 laboratorio
    public function LdatosPuntoControl($idGrupoDatos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DdatosPuntoControl($idGrupoDatos);
        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LtipoUnidadDeMedida() {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DtipoUnidadDeMedida();
        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LguardarDatosPuntoControl($datos, $cadena) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DguardarDatosPuntoControl($datos, $cadena);
        return $resultado;
    }

    //JCDB 16/07/2012
    public function lAsignarUsuarioXPuntoControl($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dAsignarUsuarioXPuntoControl($parametros);
        return $resultado;
    }

    //JCDB 17/07/2012
    public function lEliminarUsuariosHabilitadosXPuntoControl($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dEliminarUsuariosHabilitadosXPuntoControl($parametros);
        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LdatosRangos($idDatosPuntoControl) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DdatosRangos($idDatosPuntoControl);
        $j = 0;
        foreach ($resultado as $fila) {
            If ($resultado[$j][3] == '1') {
                $resultado[$j][9] = "M";
            } else {
                If ($resultado[$j][3] == '0') {
                    $resultado[$j][9] = "F";
                }
            }
            $j++;
        }

        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LeliminarRango($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DeliminarRango($datos);

        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LmodificarRangos($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DmodificarRangos($datos);

        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LcargarComboEditarUnidadMedida($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DcargarComboUnidadMedida($datos);

        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LmodificarDatosPuntoControl($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DmodificarDatosPuntoControl($datos);

        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LEliminarRangoPorDatosPuntoControl($idDatosPuntoControl) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DEliminarRangoPorDatosPuntoControl($idDatosPuntoControl);

        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LeditarCombo($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DeditarCombo($datos);
// 
        foreach ($resultado as $i => $valuey) {
            array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar");
            array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/i_icq_dnd.png ^ Eliminar");

            if ($i == 0) {
                array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/blank.gif");
            } else {
                array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/arribaFecha.png ^ Subir");
            }
            // ============================================================================================         
            if ($i == $datos["iTemMax"] - 1) {
                array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/blank.gif");
            } else {
                array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/agt_upgrade_misc.png ^ Bajar");
            }

//            array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/arribaFecha.png ^ Arriba");
//            array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/agt_upgrade_misc.png ^ Abajo");
        }

        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LguardarItemCombo($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DguardarItemCombo($datos);

        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LmodificarItemCombo($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DmodificarItemCombo($datos);

        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LeliminarDatosCombos($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DeliminarDatosCombos($datos);

        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LsubirOrdenItem($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DsubirOrdenItem($datos);

        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LbajarOrdenItem($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DbajarOrdenItem($datos);

        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LCargaCombo($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DcargaCombo($datos);
        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LguardarRangos($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DguardarRangos($datos);
        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LcargarItemDelCombo($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DcargarItemDelCombo($datos);
        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LmodificarDatosPuntoControlSoloNombre($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DmodificarDatosPuntoControlSoloNombre($datos);
        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LEliminarDatosPuntoControl($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DEliminarDatosPuntoControl($datos);
        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LsubirDatosPuntoControl($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DsubirDatosPuntoControl($datos);
        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LbajarDatosPuntoControl($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DbajarDatosPuntoControl($datos);
        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LeliminarPuntosControl($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DeliminarPuntosControl($datos);
        return $resultado;
    }

    // lobo 16-07-2012 laboratorio
    public function LconfirmarAproduccion($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DconfirmarAproduccion($datos);
        return $resultado;
    }

    // lobo 16-07-2012 laboratorio  PRODUCCION
    public function LgrupoDePuntoControlProduccion($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DgrupoDePuntoControlProduccion($datos);
        return $resultado;
    }

    // lobo 16-07-2012 laboratorio  PRODUCCION
    public function LdatosPuntoControlProduccion($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DdatosPuntoControlProduccion($datos);
        return $resultado;
    }

    // lobo 16-07-2012 laboratorio  PRODUCCION
    public function LdatosRangosProduccion($idDatosPuntoControl) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DdatosRangosProduccion($idDatosPuntoControl);
        $j = 0;
        foreach ($resultado as $fila) {
            If ($resultado[$j][3] == '1') {
                $resultado[$j][9] = "M";
            } else {
                If ($resultado[$j][3] == '0') {
                    $resultado[$j][9] = "F";
                }
            }
            $j++;
        }

        return $resultado;
    }

    //JCDB 19/07/2012
    public function lListaActividadesLaboratorio() {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dListaActividadesLaboratorio();
        return $resultado;
    }

    public function lcontarRegistrosgetTratamientoPaciente($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dcontarRegistrosgetTratamientoPaciente($datos);
        return $resultado[0][0];
    }

    //JCDB 19/07/2012
    public function lCargarTablaEstadoExamenes($parametros) {

//codigo
        $parametros["p11"] = "1";
        if (trim($parametros["p2"]) != '' && trim($parametros["p3"]) == '' && trim($parametros["p5"]) == '' && trim($parametros["p6"]) == '' && trim($parametros["p7"]) == '' && trim($parametros["p8"]) == '') {
            $parametros["p3"] = '-666';
            $parametros["p5"] = "-666";
            $parametros["p6"] = "-666";
            $parametros["p7"] = "-666";
            $parametros["p8"] = "-666";
            $parametros["p4"] = trim($parametros["p2"]);
            $parametros["p11"] = "4";
        }
        //codigo barra
        if (trim($parametros["p3"]) != '' && trim($parametros["p2"]) == '' && trim($parametros["p5"]) == '' && trim($parametros["p6"]) == '' && trim($parametros["p7"]) == '' && trim($parametros["p8"]) == '') {
            $parametros["p2"] = '-666';
            $parametros["p5"] = "-666";
            $parametros["p6"] = "-666";
            $parametros["p7"] = "-666";
            $parametros["p8"] = "-666";
            $parametros["p4"] = trim($parametros["p3"]);
            $parametros["p11"] = "5";
        }
        //documento
        if (trim($parametros["p5"]) != "" && trim($parametros["p2"]) == '' && trim($parametros["p3"]) == '' && trim($parametros["p6"]) == '' && trim($parametros["p7"]) == '' && trim($parametros["p8"]) == '') {
            $parametros["p2"] = '-666';
            $parametros["p3"] = "-666";
            $parametros["p6"] = "-666";
            $parametros["p7"] = "-666";
            $parametros["p8"] = "-666";
            $parametros["p11"] = "2";
        }
//        //nombres
        if ((trim($parametros["p6"]) != "" || trim($parametros["p7"]) != "" || trim($parametros["p8"]) != "") && trim($parametros["p2"]) == '' && trim($parametros["p3"]) == '' && trim($parametros["p5"]) == '') {
            $parametros["p2"] = "-666";
            $parametros["p3"] = "-666";
            $parametros["p5"] = "-666";
            $parametros["p11"] = "3";
        }

        $oDLaboratorio = new DLaboratorio();
        $rs = $oDLaboratorio->dCargarTablaEstadoExamenes($parametros);
        foreach ($rs as $key => $value) {
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/exec.gif ^ procesar");
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/imprimir.png ^ Imprimir");
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/kdmconfig1.gif ^ reprocesar");
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/anular.png ^ anular");
        }
        return $rs;
    }

    //JCDB 24/07/2012
    public function lActualizarProcedenciaExamenLaboratorio($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dActualizarProcedenciaExamenLaboratorio($parametros);
        return $resultado;
    }

    //JCDB 26/07/2012
    public function lDescripcionRecipiente($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dDescripcionRecipiente($parametros);
        return $resultado;
    }

    //JCDB 26/07/2012
    public function lImagenRecipiente($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dImagenRecipiente($parametros);
        return $resultado;
    }

    //JCDB 26/07/2012
    public function lInsertarSiguientePuntoControlExamenLaboratorio($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dInsertarSiguientePuntoControlExamenLaboratorio($parametros);
        return $resultado;
    }

    //JCDB 30/07/2012
    public function lCargarTipoMuestra($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dCargarTipoMuestra($parametros);
        return $resultado;
    }

    //JCDB 30/07/2012
    public function lCargarTelefono($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dCargarTelefono($parametros);
        return $resultado;
    }

    //JCDB 31/07/2012
    public function lRecepcionarFrasco($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $parametros["p8"] = "2";
        if (trim($parametros["p7"]) == "") {
            $parametros["p7"] = null;
        }
        $resultado1 = $oDLaboratorio->dActualizarTelefono($parametros);
        $resultado2 = $oDLaboratorio->dActualizarCodigoBarra($parametros);
        $resultado3 = $oDLaboratorio->dProcesarPuntoControl($parametros);
        if ((trim($resultado1[0][0]) == 1 || trim($resultado1[0][0]) == 0) && (trim($resultado2[0][0]) == 1) && trim($resultado3[0][0]) == 1) {
            return 1;
        } else {
            if (trim($resultado2[0][0]) == 0) {
                return -1;
            }
            else
                return 0;
        }
    }

    //JCDB 01/08/2012
    public function lCaputarObservacionPuntoControl($parametros) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dCaputarObservacionPuntoControl($parametros);
        return $resultado;
    }

    //JCDB 02/08/2012
    public function lCapturaFechaLaboratorio() {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dCapturaFechaLaboratorio();
        return $resultado;
    }

    public function lDatosPacienteLaboratorio($idPacienteLaboratorio) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dDatosPacienteLaboratorio($idPacienteLaboratorio);
        return $resultado;
    }

    public function lModificarCodigoBarras($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dModificarCodigoBarras($datos);
        return $resultado;
    }

    public function lModificarMaterialPersona($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dModificarMaterialPersona($datos);
        return $resultado;
    }

    public function lModificarTelefonos($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dModificarTelefonos($datos);
        return $resultado;
    }

    public function lMantenimientoDinamico($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dMantenimientoDinamico($datos);
        return $resultado;
    }

    public function lGrabarDatoLaboratorio($datos) {
        if ($datos["valor"] == '') {
            $datos["valor"] = 'null';
        }
        $oDLaboratorio = new DLaboratorio();
        $iTipoDato = $datos["tipoDato"];
        switch ($iTipoDato) {
            case 1:
                //entero
                $datos["iValor"] = $datos["valor"];
                $datos["nValor"] = 'null';
                $datos["vValor"] = '';
                $datos["bValor"] = 'null';
                $datos["iCombo"] = '0';

                break;
            case 2:
                //varchar
                $datos["iValor"] = 'null';
                $datos["nValor"] = 'null';
                $datos["vValor"] = $datos["valor"];
                $datos["bValor"] = 'null';
                $datos["iCombo"] = '0';

                break;
            case 3:
                //datatime

                break;
            case 4:
                //decimal
                $datos["iValor"] = 'null';
                $datos["nValor"] = $datos["valor"];
                $datos["vValor"] = 'null';
                $datos["bValor"] = 'null';
                $datos["iCombo"] = '0';
                break;
            case 5:
                //boolean
                $datos["iValor"] = 'null';
                $datos["nValor"] = 'null';
                $datos["vValor"] = 'null';
                $datos["bValor"] = $datos["valor"];
                $datos["iCombo"] = '0';
                break;
            case 6:
                //combo
                //boolean
                $datos["iValor"] = 'null';
                $datos["nValor"] = 'null';
                $datos["vValor"] = 'null';
                $datos["bValor"] = 'null';
                $datos["iCombo"] = $datos["valor"];

                break;
            case 7:
                //texto

                break;
        }

        if ($datos["idDatoExamenPacienteLaboratorio"] == 0) {
            $accion = 1;
        } else {
            $accion = 2;
        }
        $resultado = $oDLaboratorio->dGrabarDatoLaboratorio($datos, $accion);

        return $resultado[0][0];
    }

    public function lTerminarProceso($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dTerminarProceso($datos);
        return $resultado;
    }

    public function lRecibirProceso($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dRecibirProceso($datos);
        return $resultado;
    }

    public function lDatosPuntoControlPaciente($iIdPacienteLaboratorioPuntoControl) {

        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dDatosPuntoControlPaciente($iIdPacienteLaboratorioPuntoControl);
        return $resultado;
    }

    public function lDatosPuntoControlPacienteProcesado($idProcesarPuntoControlProcesar) {

        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dDatosPuntoControlPacienteProcesado($idProcesarPuntoControlProcesar);
        return $resultado;
    }

    public function lDatosRecibir($idProcesarPuntoControlRecibir) {

        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dDatosRecibir($idProcesarPuntoControlRecibir);
        return $resultado;
    }

    public function lAgregarProcesarPuntoControl($iIdPacienteLaboratorioPuntoControl, $idTipoProceso) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dAgregarProcesarPuntoControl($iIdPacienteLaboratorioPuntoControl, $idTipoProceso);
        return $resultado;
    }

    public function larrayComboLaboratorio($iiDCombo) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->darrayComboLaboratorio($iiDCombo);
        return $resultado;
    }

    public function lPuntosControlPaciente($idPacienteLaboratorio) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dPuntosControlPaciente($idPacienteLaboratorio);
        return $resultado;
    }

    public function lDatosMuestra($id) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dDatosMuestra($id);
        return $resultado;
    }

    public function ldatosFraccion($id) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->ddatosFraccion($id);
        return $resultado;
    }

    public function lInsertaPacienteLaboratoriPuntoControl($iIdExamenLaboratorioUnidadMedidaLaboratorio, $iIdPacienteLaboratorioPuntoControlExamen, $cantidad) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dInsertaPacienteLaboratoriPuntoControl($iIdExamenLaboratorioUnidadMedidaLaboratorio, $iIdPacienteLaboratorioPuntoControlExamen, $cantidad);
        return $resultado;
    }

    //creadox 24sept 2012 JCQA
    public function llistarMatxPCxE($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dllistarMatxPCxE($datos);
//        print_r($resultado);
        return $resultado;
    }

//creadox 28sept 2012 JCQA
    public function llistarMuestrasxPCxE($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->dlistarMuestrasxPCxE($datos);
//        print_r($resultado);
        return $resultado;
    }

    //Lobo
    public function LanularExamenPaciente($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DanularExamenPaciente($datos);
//        print_r($resultado);
        return $resultado;
    }

    //Lobo
    public function LreprogramarExamen($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DreprogramarExamen($datos);
//        print_r($resultado);
        return $resultado;
    }

    //Lobo
    public function LagregarPuntoControlBoton($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DagregarPuntoControlBoton($datos);
//        print_r($resultado);
        return $resultado;
    }

        //Lobo
    public function LcargarDatosResultadosLaboratorio($idPacienteLaboratorio) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DcargarDatosResultadosLaboratorio($idPacienteLaboratorio);
//        print_r($resultado);
        return $resultado;
    }
    
            //Lobo
    public function LcargarDatosResultadosmicroBiologia($txtCodigoBarras) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->DcargarDatosResultadosmicroBiologia($txtCodigoBarras);
//        print_r($resultado);
        return $resultado;
    }
 

    
     public function validarGuardarDatosEnBaseDatos($datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->validarGuardarDatosEnBaseDatos($datos);
        return $resultado;
    }
    
     public function guardarDatosExcelMicrobiologia($varchar,$datos) {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->guardarDatosExcelMicrobiologia($varchar,$datos);
        return $resultado;
    }
    public function comparaExistentesBaseDatosConDirectorio() {
        $oDLaboratorio = new DLaboratorio();
        $resultado = $oDLaboratorio->comparaExistentesBaseDatosConDirectorio();
        return $resultado;
    }


}

?>