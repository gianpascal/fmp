<?php

require_once("../../../pholivo/Html.php");
require_once("../../../pholivo/Html1.php");
//require_once("../../../pholivo/HTML_TreeMenu/TreeMenuFacilito.php");
require_once("../../clogica/LCronograma.php");
require_once("../../clogica/LCita.php");
require_once("../../centidad/ECita.php");
require_once("../../centidad/EPaciente.php");
require_once("../../clogica/LPersona.php");
require_once("../../../pholivo/tablaDHTMLX.php");

class ActionCita {

    //Junnior
    public function listaDatosComboFiltro($opcionBusqueda, $filtro, $dato, $disabled, $fecha, $sede) {
        $o_Lcita = new LCita();

        switch ($opcionBusqueda) {
            case '1':
                $datosdelCombo = array("3" => "Ambiente", "9" => "Actividad", "14" => "Médico", "19" => "Especialidad");
                break;
            case '2':
                $datosdelCombo = array("3" => "Ambiente", "5" => "Turnos", "9" => "Actividad", "11" => "Prod/Serv", "12" => "Cupos", "14" => "Médico", "19" => "Especialidad");
                break;
            case '3':
                $datosdelCombo = array("3" => "Ambiente", "5" => "Turnos", "9" => "Actividad", "11" => "Prod/Serv", "12" => "Cupos", "14" => "Médico", "19" => "Especialidad");
                break;
        }

        //$arrayCombo = $o_Lcita->getArraylistaDatosFiltro($opcionBusqueda);
        $o_Combo = new Combo($datosdelCombo);
        $comboHTML_01 = $o_Combo->getOptionsHTML($filtro);

        //$arrayCombo = $o_Lcita->getArraylistaDatosFiltroDato($opcionBusqueda,$filtro);
        $arrayCombo = $o_Lcita->getArraylistaDatosBusqueda($filtro, $dato, $fecha, $sede);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML_02 = $o_Combo->getOptionsHTML($dato);

        //$row_ochg = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=combo_filtro&p2='+document.getElementById(\"hOpcionBusqueda\").value+'&p3='+document.form_detalle.cb_departamento.value+'&p4='+document.form_detalle.cb_provincia.value,'divFiltro');\"";
        $row_ochg = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=combo_filtro&p2='+document.getElementById('hOpcionBusqueda').value+'&p3='+document.form_filtro.cb_filtro.value+'&p4='+document.getElementById('cal01').getElementsByTagName('input')[6].value+'-'+document.getElementById('cal01').getElementsByTagName('input')[5].value+'-'+document.getElementById('cal01').getElementsByTagName('input')[4].value+'&sede='+document.getElementById('hIdFiltroSede').value,'divFiltro');\"";
        //$row_ochg2 = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=cronograma_medico_filtro_ambiente&fecha='+document.getElementById(cal).getElementsByTagName('input')[6]+'-'+document.getElementById(cal).getElementsByTagName('input')[5]+'-'+document.getElementById(cal).getElementsByTagName('input')[4]+'&filtro='+getElementById('cbo_filtro').value+'&dato='+getElementById('cbo_dato').value,'divFiltro');\"";
        $row_ochg2 = "onchange=\"javascript:seleccionarComboFiltroDato('cal01');\"";
        $row_ini = "<table><tr><td>Filtrar por</td><td>";
        $row_med = "</td><td>";
        $row_fin = "</td></tr></table>";
        $row_filtro = "<select name=\"cb_filtro\"  id=\"cb_filtro\" " . $row_ochg . ">";
        $row_dato = "Dato</td><td><select name=\"cb_dato\"  id=\"cb_dato\" " . $row_ochg2 . ">";
        $row_fin_cb = "</select>";
        $comboHTML = $row_ini . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_med . $row_dato . $comboHTML_02 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    public function listaDatosSede($datos) {
        $o_Lcita = new LCita();
        $rs = $o_Lcita->getArrayListaSedes($datos);

        $seleccionado = '';
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
            if ($fila[2] == '1')
                $seleccionado = $op;
        }
        $o_ComboSede = new Combo($resultadoArray);
        //$comboHTML_01 = $o_ComboSede->getOptionsHTMLFirstSelected();
        $comboHTML_01 = $o_ComboSede->getOptionsHTML($seleccionado);
        //$row_ochg = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=busqueda_filtro_sede&opcionBusqueda='+document.getElementById('hOpcionBusqueda').value+'&patron='+document.getElementById('cal01').getElementsByTagName('input')[6].value+'-'+document.getElementById('cal01').getElementsByTagName('input')[5].value+'-'+document.getElementById('cal01').getElementsByTagName('input')[4].value+'&sede='+document.getElementById('hIdFiltroSede').value,'divConsulCronograma');\"";
        $row_ochg = "onchange=\"" . $datos["funcionEjecutar"] . "\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr><td align=\"left\" width=\"50%\" style=\"font-family:Arial;font-size:11pt\">";
        $row_fin = "</tr></table>";
        $row_etiqueta = "<b>Sede :<b></td>";
        $row_filtro = "<td align=\"left\" width=\"50%\" style=\"font-family:Arial;font-size:11pt\"><select align=\"center\" style=\"font-family:Arial;font-size: 11pt\" name=\"cb_filtroSede\" id=\"cb_filtroSede\" " . $row_ochg . ">";
        $row_fin_cb = "</select></td>";
        $comboHTML = $row_ini . $row_etiqueta . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    public function listaDatosSedeSolo($datos) {
        $o_Lcita = new LCita();
        $rs = $o_Lcita->getArrayListaSedes($datos);

        $seleccionado = '';
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
            if ($fila[2] == '1')
                $seleccionado = $op;
        }
        $o_ComboSede = new Combo($resultadoArray);
        //$comboHTML_01 = $o_ComboSede->getOptionsHTMLFirstSelected();
        $comboHTML_01 = $o_ComboSede->getOptionsHTML($seleccionado);
        //$row_ochg = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=busqueda_filtro_sede&opcionBusqueda='+document.getElementById('hOpcionBusqueda').value+'&patron='+document.getElementById('cal01').getElementsByTagName('input')[6].value+'-'+document.getElementById('cal01').getElementsByTagName('input')[5].value+'-'+document.getElementById('cal01').getElementsByTagName('input')[4].value+'&sede='+document.getElementById('hIdFiltroSede').value,'divConsulCronograma');\"";
        $row_ochg = "onchange=\"seleccionaServicioProgramacionMedicos()" . "\""; //$datos["funcionEjecutar"]
        $row_ini = "";
        $row_fin = "";
        $row_etiqueta = "";
        $row_filtro = "<select align=\"center\" style=\"font-family:Arial;font-size: 11pt\" name=\"cb_filtroSede\" id=\"cb_filtroSede\" " . $row_ochg . ">";
        $row_fin_cb = "</select>";
        $comboHTML = $row_ini . $row_etiqueta . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    public function listaDatosActividad() {
        $o_Lcita = new LCita();
        $datosComboActividad = $o_Lcita->getArrayListaActividades();
        $o_ComboActividad = new Combo($datosComboActividad);
        $comboHTML_01 = $o_ComboActividad->getOptionsHTML('0001');
        //$row_ochg = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=busqueda_filtro_sede&opcionBusqueda='+document.getElementById('hOpcionBusqueda').value+'&patron='+document.getElementById('cal01').getElementsByTagName('input')[6].value+'-'+document.getElementById('cal01').getElementsByTagName('input')[5].value+'-'+document.getElementById('cal01').getElementsByTagName('input')[4].value+'&sede='+document.getElementById('hIdFiltroSede').value,'divConsulCronograma');\"";
        $row_ochg = "onchange=\"\"";
        $row_ini = "<table width=\"100%\" align=\"center\"><tr><td align=\"left\" width=\"50%\" style=\"font-family:Arial;font-size:11pt\">";
        $row_fin = "</tr></table>";
        $row_etiqueta = "Actividad :</td>";
        $row_filtro = "<td align=\"left\" width=\"50%\" style=\"font-family:Arial;font-size:11pt\"><select align=\"center\" style=\"font-family:Arial;font-size: 11pt\" name=\"cb_filtroActividad\" id=\"cb_filtroActividad\" " . $row_ochg . ">";
        $row_fin_cb = "</select></td>";
        $comboHTML = $row_ini . $row_etiqueta . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

//ANONIMO
//------------
    function listaTurnosLibres($nro_programacionmedico) {
        $o_LCita = new LCita();
        $arrayComboTurnos = $o_LCita->getArraylistaCitasPermitidas($nro_programacionmedico);
        $o_Combo = new Combo($arrayComboTurnos);
        $comboHTML_01 = $o_Combo->getOptionsHTML();
        $comboHTML = "<table width=\"140\"><tr><td>Turno</td><td><select name=\"cb_horariopermitido\" title=\"Turno\" id=\"cb_horariopermitido\">" . $comboHTML_01 . "</select></td></tr></table>";
        return $comboHTML;
    }

    public function listaRadioFiltro($opcionBusqueda, $radio, $disabled) {
        $arrayRadio = array("0006" => "IMAGENES", "0003" => "EMERGENCIA", "0001" => "CONSULTA", "" => "TODOS");
        $o_Radio = new RadioButton($arrayRadio);
        //$row_ochg = "buscar_filtro_sede()";
        $row_ochg = "buscar_filtro_actividad()";
        $radioHTML_01 = $o_Radio->getOptionsHTML($radio, $row_ochg, 'Grupo');
        //$radioHTML=$row_ini.$row_filtro.$comboHTML_01.$row_fin_cb.$row_med.$row_dato.$comboHTML_02.$row_fin_cb.$row_fin;
        return $radioHTML_01;
    }

//-----------
    public function listaCronograma($parametros) {

        $o_LCronograma = new LCronograma();

        $opcionBusqueda = $parametros["opcionBusqueda"];
        switch ($opcionBusqueda) {
            case '1':

                $arraycabecera = array("v_desc_ser_pro" => "Prod/Serv", "nombre" => "Médico", "v_desc_amb" => "Ambiente", "v_descrip" => "Turno", "v_desc_con_consul" => "Actividad", "n_cupos" => "Cupos");
                $arrayFilas = $o_LCronograma->getCronogramaMedico($parametros);

                break;
            case '2':
                $arraycabecera = array("d_fecserv" => "Fecha", "v_desc_ser_pro" => "Prod/Serv", "nombre" => "Medico", "v_desc_con_consul" => "Actividad", "v_descrip" => "Turno", "n_cupos" => "Cupos");
                $arrayFilas = $o_LCronograma->getCronogramaMedicoporEspecialidad($parametros);
                break;
            case '3':
                $arraycabecera = array("d_fecserv" => "Fecha", "v_desc_ser_pro" => "Prod/Serv", "v_desc_amb" => "Ambiente", "v_desc_con_consul" => "Actividad", "v_descrip" => "Turno", "n_cupos" => "Cupos");
                $arrayFilas = $o_LCronograma->getCronogramaMedicoporMedico($parametros);
                break;
        }
        $dias = array('1' => 'Lun', '2' => 'Mar', '3' => 'Mie', '4' => 'Jue', '5' => 'Vie', '6' => 'Sab', '7' => 'Dom');
        foreach ($arrayFilas as $rs => $valor) {
            $fechastr = $arrayFilas[$rs]["d_fecserv"];
            $dateTime = new DateTime($fechastr);
            $arrayFilas[$rs]["d_fecserv"] = $dias[date('N', strtotime($fechastr))] . " " . date('d / m / Y', strtotime($fechastr));
        }
        $arrayFilas1 = $arrayFilas;
        //$o_Html = new Tabla($arraycabecera,$arrayFilas1,'fila1','fila2','filaEncima','filaCabecera','0','onClickFila');
        $o_Html = new Tabla1($arraycabecera, 15, $arrayFilas1, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'OnClick', 'onClickFila', 0);
        return $o_Html->getTabla();
    }

    public function listaCronogramaSede($parametros) {
        $o_LCronograma = new LCronograma();
        $opcionBusqueda = $parametros["opcionBusqueda"];
        $arrayFilas = $o_LCronograma->getCronogramaMedicoSede($parametros);
        switch ($opcionBusqueda) {
            case '1':
                $arraycabecera = array("v_desc_ser_pro" => "Prod/Serv", "nombre" => "Médico", "v_desc_amb" => "Ambiente", "v_descrip" => "Turno", "v_desc_con_consul" => "Actividad", "n_cupos" => "Cupos");
                break;
            case '2':
                $arraycabecera = array("d_fecserv" => "Fecha", "v_desc_ser_pro" => "Prod/Serv", "nombre" => "Medico", "v_desc_con_consul" => "Actividad", "v_descrip" => "Turno", "n_cupos" => "Cupos");
                break;
            case '3':
                $arraycabecera = array("d_fecserv" => "Fecha", "v_desc_ser_pro" => "Prod/Serv", "v_desc_amb" => "Ambiente", "v_desc_con_consul" => "Actividad", "v_descrip" => "Turno", "n_cupos" => "Cupos");
                break;
        }
        $dias = array('1' => 'Lun', '2' => 'Mar', '3' => 'Mie', '4' => 'Jue', '5' => 'Vie', '6' => 'Sab', '7' => 'Dom');
        foreach ($arrayFilas as $rs => $valor) {
            $fechastr = $arrayFilas[$rs]["d_fecserv"];
            $dateTime = new DateTime($fechastr);
            $arrayFilas[$rs]["d_fecserv"] = $dias[date('N', strtotime($fechastr))] . " " . date('d / m / Y', strtotime($fechastr));
        }

        $arrayFilas1 = $arrayFilas;
        //$o_Html = new Tabla($arraycabecera,$arrayFilas1,'fila1','fila2','filaEncima','filaCabecera','0','onClickFila');
        $o_Html = new Tabla1($arraycabecera, 15, $arrayFilas1, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'OnClick', 'onClickFila', 0);
        return $o_Html->getTabla();
    }

    public function listaCronogramaFiltroDato($parametros) {

        $o_LCronograma = new LCronograma();
        $arrayFilas = $o_LCronograma->getCronogramaFiltroDato($parametros);
        $arrayFilas1 = $arrayFilas;
        //$arraycabecera = array("3"=>"Ambiente","5"=>"Turnos","9"=>"Actividad","11"=>"Producto/Servicio","12"=>"Cupos","14"=>"Médico","19"=>"Especialidad");
        $arraycabecera = array("v_desc_ser_pro" => "Prod/Serv", "nombre" => "Médico", "v_desc_amb" => "Ambiente", "v_descrip" => "Turno", "v_desc_con_consul" => "Actividad", "n_cupos" => "Cupos");
        $o_Html = new Tabla1($arraycabecera, 15, $arrayFilas1, 'tablaOrden', 'fila1', 'fila2', 'filaSeleccionada', 'OnClick', 'onClickFila', 0);
        //$o_Html = new Tabla($arraycabecera,$arrayFilas1,'fila1','fila2','filaEncima','filaCabecera','0','onClickFila');
        return $o_Html->getTabla();
        //$o_Tabla = new z º1º1
    }

    public function listaCita($opcBusqueda, $patronBus, $enblanco = false) {
        $o_LCita = new LCita();
        if (!$enblaco) {
            $arrayFilas = $o_LCita->getArrayCita($opcBusqueda, $patronBus);
        } else {
            $arrayFilas = array();
        }
        //print_r($arrayFilas);
        $arrayFilas1 = $arrayFilas;
        $arrayTipo = array("18" => "c", "3" => "c", "2" => "c", "27" => "c", "44" => "c", "46" => "h", "47" => "h");
        //$arrayFilas1[][8] = $arrayFilas[][8]."-".$arrayFilas[][9];
        //el indice del array cabecera debe estar en numeros, es por ello el error, cuando auto completa filas
        //$arraycabecera = array("c_cod_hora"=>"HORA","v_apenom"=>"PACIENTE","v_desc_con_adm"=>"ESTADO CITA","c_cod_t_cita"=>"TIPO DE CITA","ambiente"=>"AMBIENTE","editar"=>"EDITAR","eliminar"=>"ELIMINAR");
        $arraycabecera = array("18" => "HORA", "3" => "PACIENTE", "2" => "ESTADO CITA", "27" => "TIPO DE CITA", "44" => "AMBIENTE", "46" => "EDITAR", "47" => "ELIMINAR");
        //$arraycabecera = array("0"=>"HORA","1"=>"PACIENTE","2"=>"ESTADO CITA","3"=>"TIPO DE CITA","4"=>"AMBIENTE","5"=>"EDITAR","6"=>"ELIMINAR");
        $arrayColorEstado = array("PAGADO" => "10");
        $o_Html = new Tabla1($arraycabecera, 10, $arrayFilas1, 'tablaOrden', 'filay', 'filay', 'filaSeleccionada', '', '', 0, $arrayTipo, 25, $arrayColorEstado);
        $tablaHTML = $o_Html->getTabla();
        $row_ini = "<table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'>";
        $row_fin = "</table>";
        return $row_ini . $tablaHTML . $row_fin;
    }

    public function gestionCita($bus, $id_cronograma) {
        $o_LCita = new LCita();
        $DatosCronogramaMedico = $o_LCita->getDatosCronogramaMedico($bus, $id_cronograma);
    }

    //JCQA 5 FEBRERO 2013

    public function AseleccionandoTratamientoParaCita($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->LseleccionandoTratamientoParaCita($datos);
    }

    public function muestraDatosPacienteCita($iid_persona) {

        $o_LCita = new LCita();
        $o_Persona = new LPersona();
        $paciente = new EPaciente();
        $resultadoDatosPaciente = $o_LCita->getObjectPacienteCita($iid_persona);
        $resultadoAfiliacionPaciente = $o_Persona->getArrayFiliacionPaciente($iid_persona);
        foreach ($resultadoAfiliacionPaciente as $rs => $valor) {
            if ($resultadoAfiliacionPaciente[$rs]["b_ultafil"] == 1) {
                $paciente->setAfiliacion($resultadoAfiliacionPaciente[$rs]["filia"]);
                $paciente->setIid_tafiliacion($resultadoAfiliacionPaciente[$rs]["c_cod_t_afil"]);
            }
        }
        $paciente->setIid_persona($iid_persona);
        $paciente->setVapellido_pat($resultadoDatosPaciente[0]["v_apepat"]);
        $paciente->setVapellido_mat($resultadoDatosPaciente[0]["v_apemat"]);
        $paciente->setVnombre($resultadoDatosPaciente[0]["v_nomper"]);
        $paciente->setFecha_nacimiento($resultadoDatosPaciente[0]["d_fecnac"]);
        $paciente->setCsexo($resultadoDatosPaciente[0]["b_sexo"]); //Sexo
        $paciente->setTipo_documento($resultadoDatosPaciente[0]["c_iddide"]);
        $paciente->setVnro_doc_identidad($resultadoDatosPaciente[0]["c_ndide"]);
        $paciente->setCid_ubigeo($resultadoDatosPaciente[0]["c_codubi"]);
        $paciente->setVdireccion($resultadoDatosPaciente[0]["v_direc"]);
//                $paciente ->setAfiliacion($resultadoAfiliacionPaciente[0]["filia"]);
//                $paciente ->setIid_tafiliacion($resultadoAfiliacionPaciente[0]["v_ult_afil"]);
        $fecha_nacimiento = date("d/m/Y", strtotime($paciente->getFecha_nacimiento()));
        if ($paciente->getCsexo() == 1)
            $sexo = 'HOMBRE'; elseif ($paciente->getCsexo() == 0)
            $sexo = 'MUJER';
        $edadpaciente = $o_Persona->formatoEdad($paciente->getFecha_nacimiento());
        $scriptJS = "pintarDatosPacienteCitas('" . $paciente->getIid_persona() . "','" . $paciente->getAfiliacion() . "','" . $paciente->getVnombre() . "','" . $paciente->getVapellido_pat() . "','" . $paciente->getVapellido_mat() . "','" . $paciente->getVnro_doc_identidad() . "','" . $fecha_nacimiento . "','" . $paciente->getIid_tafiliacion() . "');";
        return $scriptJS;
    }

    public function mostrarOpcionesBusqueda($opcionBusqueda) {
        //$opciones = array("0"=>"opcBusProgMedFecha","1"=>"opcBusProgMedEspec","2"=>"opcBusProgMedProfe");
        switch ($opcionBusqueda) {
            case '1': {
                    //$p2 =  $parametros["p2"];//Fecha
                    //$p3 = $parametros["p3"];//accion
                    $tsFechaActual = empty($p2) ? strtotime(date("Y-m-d")) : strtotime($p2);
                    $idAccion = '5';

                    $o_Cal01 = new Calendario('cal01', 'botonAccionCalendario', 'cabeceraCalendario', 'btnCalendario', 'estiloCasillaSeleccionada', $tsFechaActual, $idAccion, 'seleccionarFecha', 'accionCalendario');
                    $calendario = $o_Cal01->getHTMLFullCalendario();
                    //echo "<br>opcion calendario";
                    return $calendario;
                    break;
                }
            case '2': {
                    //echo "<br>opcion Especialidad";
                    require_once("../../cvista/cita/busqueda_cronograma_especialidad.php");
                    break;
                }
            case '3': {
                    //echo "<br>opcion Profesional";
                    require_once("../../cvista/cita/busqueda_cronograma_medico.php");
                    break;
                }
        }
    }

    public function grabarCita($parametros) {
        $oLCita = new LCita();
        $oLCita->grabarCita($parametros);
    }

    public function editarCita($parametros) {
        $oLCita = new LCita();
        $oLCita->editarCita($parametros);
    }

    public function eliminarcita($n_prog_pac) {
        $oLCita = new LCita();
        $oLCita->eliminarCita($n_prog_pac);
    }

    ////**************CITAS INFORMES*****************/////////////////


    public function mostrarDatosPaciente($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->listarDatosPersonaInformes($datos);
        return $resultado;
    }

    public function calculaprecioservicio($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->obtenercalculaprecio($datos);
        return $resultado;
    }

    public function reservarCitaInformesCronograma($codigoCronograma) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->getArrayCitaInformesCronograma($codigoCronograma);
        return $resultado;
    }

    public function reservarCitaInformesServicio($codigoHora, $codigoCronograma, $tipocitaProgramada) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->getArrayCitaInformesServicio($codigoHora, $codigoCronograma, $tipocitaProgramada);
        return $resultado;
    }

    public function aGenerarComoTurnos($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->lGenerarComoTurnos($datos);
        //print_r($resultado);
        return $resultado;
    }

    public function aGrabarEditarCita($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->lGrabarEditarCita($datos);
        return utf8_encode($resultado['0']['0']);
    }

    public function describirCitaProgramada($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->getArraydescripcionCitaInformes($datos);
        return $resultado;
    }

    public function cambiarEstadoConfirmacionCita($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->cambiarEstadoConfirmacionCita($datos);
        return $resultado;
    }

    public function aMantenimientoNumeroPlaca($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->lMantenimientoNumeroPlaca($datos);
        return $resultado;
    }

    public function aGrabarUbicacionImagenes($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->lGrabarUbicacionImagenes($datos);
        return $resultado;
    }

    public function grabarUbicacionPlacas($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->grabarUbicacionPlacas($datos);
        return $resultado;
    }

    public function cargarNumeroOrdenGenerada($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->getArraycargarNumeroOrdenGenerada($datos);
        return $resultado;
    }

    public function cargarCodigoPersona($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->getArraycargarCodigoPersona($datos);
        return $resultado;
    }

    function verificarCronogramaAfiliacion($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->verificarCronogramaAfiliacion($datos);
        return $resultado;
    }

    function xmlTablaProgramacionEmergenciaInformes($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LCita = new LCita();
        $datos == '' ? $arrayFilas = array() : $arrayFilas = $o_LCita->obtenerListaProgramacionEmergenciaInformes($datos);
        $arrayCabecera = array("0" => "codigoCronograma", "1" => "Dia", "2" => "Fecha", "3" => "Turno", "4" => "Medico", "5" => "Servicio", "6" => "fechahabilitada", "7" => "dFecha", "8" => "...");
        $arrayTamano = array("0" => "10", "1" => "30", "2" => "80", "3" => "90", "4" => "*", "5" => "*", "6" => "10", "7" => "10", "8" => "40");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro", "8" => "img");
        $arrayAlineacion = array("0" => "center", "1" => "center", "2" => "center", "3" => "center", "4" => "left", "5" => "left", "6" => "left", "7" => "left", "8" => "center");
        $arrayHidden = array("0" => "true", "1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false", "6" => "true", "7" => "true", "8" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    function aMostrarCronogramaMedicoCita($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LCita = new LCita();
        $datos == '' ? $arrayFilas = array() : $arrayFilas = $o_LCita->lMostrarCronogramaMedicoCita($datos);
        $arrayCabecera = array("0" => "codigoCronograma", "1" => "Dia", "2" => "Fecha", "3" => "Turno", "4" => "Medico", "5" => "Servicio", "6" => "Ambiente", "7" => "ahora", "8" => "pasado", "9" => "pasado");
        $arrayTamano = array("0" => "10", "1" => "30", "2" => "80", "3" => "90", "4" => "*", "5" => "*", "6" => "*", "7" => "10", "8" => "10", "9" => "10");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro", "8" => "ro", "9" => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "center", "2" => "center", "3" => "center", "4" => "left", "5" => "left", "6" => "left", "7" => "left", "8" => "left", "9" => "left");
        $arrayHidden = array("0" => "true", "1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false", "6" => "false", "7" => "false", "8" => "false", "9" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    /* ============================================================================== */
    /* DESCOMENTAR PARA QUE FUNCIONE LOS ADICIONALES IDEALMENTE!!!!!CUANDO SE HAGA EL MODULO PARA MEDICOS */
    /*
      public function getTablaAdicionales($datos) {
      $o_LCita = new LCita();
      $resultado = $o_LCita->getTablaAdicionales($datos);
      $arrayTipo=array("0"=>"c","1"=>"c","2"=>"c","3"=>"c","4"=>"c","7"=>"h","8"=>"c");
      $arrayCabecera = array("0"=>"PACIENTE","1"=>"ESTADO","2"=>"TIPO DE CITA","3"=>"AMBIENTE","4"=>"C.COSTO","7"=>"...","8"=>"...");
      $arrayFilas = '';
      if(!empty($resultado[0]["estado"])) {
      $arrayFilas = $resultado;
      }

      $arrayColorEstado=array("1"=>"5");
      $o_Html = new Tabla1($arrayCabecera,15,$arrayFilas,'tablaOrden','filax','filay','filaSeleccionada','onClick','',0,$arrayTipo,0,$arrayColorEstado);
      $tablaHTML=$o_Html->getTabla();
      $divtitle = "<div align=\"center\" style=\"width:100%;height:5%;\">Hay ";
      if(empty($resultado[0]["cuposdisponibles"])) {
      $divtitle.="0 cupos para citas adicionales</div>";
      }else {
      $divtitle.=$resultado[0]["cuposdisponibles"]." cupos para citas adicionales</div>";
      }

      $iniciodiv="<div style=\"height:80%\">";
      $findiv="</div>";
      $row_ini = "<table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'>";
      $row_fin= "</table>";
      $espacioabajo="<br/>";
      $botones="<table style=\"width:100%\" align=\"center\"><tr>";

      if($resultado[0]["cuposdisponibles"]>0) {
      if($_SESSION["permiso_formulario_servicio"][118]["AGREGAR_CITA_ADICIONAL"]==1) {
      $botones.="<td align=\"right\" style=\"width:50%\"><a href=\"javascript:nuevaCita('---','".$datos['codigoCronograma']."','1');\">
      <img src=\"../../../../fastmedical_front/imagen/btn/b_agregar_on1.gif\">
      </a>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
      }else{
      $botones.="<td align=\"right\" style=\"width:50%\">&nbsp;&nbsp;&nbsp;&nbsp;</td>";
      }
      }else {
      $botones.="<td align=\"right\" style=\"width:50%\">&nbsp;&nbsp;&nbsp;&nbsp;</td>";
      }
      if($_SESSION["permiso_formulario_servicio"][118]["CANCELAR_CITA_ADICIONAL"]==1) {
      $botones.="<td align=\"left\" style=\"width:50%\"><a href=\"javascript:cerrarVentanaAdicionales();\">
      <img src=\"../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif\">
      </a>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
      }else{
      $botones.="<td align=\"left\" style=\"width:50%\">&nbsp;&nbsp;&nbsp;&nbsp;</td>";
      }
      $botones.="</tr></table>";
      return $divtitle.$iniciodiv.$row_ini.$tablaHTML.$row_fin.$findiv.$espacioabajo.$botones;
      }
     */
    /* ============================================================================= */
    /* MOSTRAR LAS PROGRAMACIONES DETALLADAS CON ADICIONALES FUERA DE TURNOS=====PARCHE!!!! */
    /* COMENTAR O ELIMINAR CUANDO SE REALIZE EL MODULO PARA MEDICOS */

    public function getTablaProgramacionDetallada($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->getTablaProgramacionDetallada($datos);
        ////////////////peche sabado 22 de setiembre/////////////////////////////
        $datosCronograma = $o_LCita->getCronogramaDetallada($datos);

        //  print_r($resultado);
        $reservados = 0;
        $pagados = 0;
        $atendidos = 0;
        $anulados = 0;
        $adicionales = 0;
        $cupos = 0;
        foreach ($resultado as $value) {
            if ($value["estado"] == 'RESERVADO') {
                $reservados++;
            }
            if ($value["estado"] == 'PAGADO') {
                $pagados++;
            }
            if ($value["estado"] == 'ATENDIDO') {
                $atendidos++;
            }

            $anulados = $value["anulados"];
            $cupos = $value["iCuposTotales"];

            if ($value["cHoraProgramada"] == '---     ') {
                $adicionales++;
            }
        }
        $contadores = "<div id'contadores' style='width:780px;height:20px; margin:5px;' align='center' >
                    <div style='width:100px;float:left;'><b>Cupos:</b><input readonly value='$cupos' style='width:30px;'> </div>
                    <div style='width:120px;float:left;'><b>Reservados:</b> <input readonly value='$reservados' style='width:30px;'></div>
                    <div style='width:200px;float:left;'><b>Pagados o Confirmados: </b> <input readonly value='$pagados' style='width:30px;'></div>
                    <div style='width:120px;float:left;'><b>Atendidos:</b><input readonly value='$atendidos' style='width:30px;'> </div>
                    <div style='width:120px;float:left;'><b>Adicionales:</b><input readonly value='$adicionales' style='width:30px;'></div> 
                    <div style='width:120px;float:left;'><b>Anulados:</b><input readonly value='$anulados' style='width:30px;'> </div>
                    
                    </div>";

        ////////////////////////////////////////////
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "c", "4" => "c", "5" => "c", "11" => "h", "12" => "h");
        $arrayCabecera = array("0" => "HORA", "1" => "PACIENTE", "2" => "ESTADO", "3" => "TIPO DE CITA", "4" => "AMBIENTE", "5" => "C.COSTO", "11" => "...", "12" => "...");
        $arrayFilas = '';
        if (!empty($resultado[0]["estado"])) {
            $arrayFilas = $resultado;
        }

        $arrayColorEstado = array("ATENDIDO" => "18", 'RESERVADO' => '17', 'PAGADO' => '16');

        $o_Html = new Tabla1($arrayCabecera, 15, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', 'descripcionCitaAdicional', 6, $arrayTipo, 2, $arrayColorEstado);
        $tablaHTML = $o_Html->getTabla();
        $divtitle = "<div align=\"center\" style=\"width:100%;height:80px;\"><br>Hay ";
        $iniciodiv = "<div style=\"height:300px;overflow:auto;\">";
        $findiv = "</div>";
        $row_ini = "<table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'>";
        $row_fin = "</table>";
        $espacioabajo = "";
        $botones = "<table style=\"width:100%\" align=\"center\"><tr align=\"center\"><td>";
        if (isset($_SESSION["permiso_formulario_servicio"][118]["CITA_ADIC_X_SOLICITUD"]) && ($_SESSION["permiso_formulario_servicio"][118]["CITA_ADIC_X_SOLICITUD"] == 1)) {

            if (($resultado[0]["cuposdisponibles"] == -1) || !empty($resultado[0]["cuposdisponibles"])) {
                //echo $resultado[0]["cuposdisponibles"];
                $divtitle.="0 cupos para citas adicionales";
                $botones.="<a href=\"javascript:nuevaCita('---','" . $datos['codigoCronograma'] . "','2');\">
                        <img src=\"../../../../fastmedical_front/imagen/btn/btn_adic_solicitadomedico.png\">
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;";
                if (isset($_SESSION["permiso_formulario_servicio"][118]["PAGAR_CITA_CARTA_VIRTUAL_PAC"]) && ($_SESSION["permiso_formulario_servicio"][118]["PAGAR_CITA_CARTA_VIRTUAL_PAC"] == 1)) {
                    $botones.="<a href=\"javascript:cambiarEstadoConfirmacionCita();\"><img src=\"../../../../fastmedical_front/imagen/btn/b_pago_cvirtual.png\"></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;";
                }
                if (!empty($resultado[0]["turno"])) {
                    $divtitle.="<br> Turno <b>" . $resultado[0]["turno"] . " </b><br>  " . $datosCronograma[0][0] . "</div>";
                } else {
                    $divtitle.="</div>";
                }
            } else {
                echo $resultado[0]["cuposdisponibles"];
                $divtitle.="<b>" . $resultado[0]["cuposdisponibles"] . "</b> cupos para citas adicionales <br> Turno <b>" . $resultado[0]["turno"] . " </b><br>  " . $datosCronograma[0][0] . "</div>";
                if ($resultado[0]["cuposdisponibles"] > 0) {
                    $botones.="<a href=\"javascript:nuevaCita('---','" . $datos['codigoCronograma'] . "','2');\">
                        <img src=\"../../../../fastmedical_front/imagen/btn/btn_adic_solicitadomedico.png\">
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;";
                    if (isset($_SESSION["permiso_formulario_servicio"][118]["PAGAR_CITA_CARTA_VIRTUAL_PAC"]) && ($_SESSION["permiso_formulario_servicio"][118]["PAGAR_CITA_CARTA_VIRTUAL_PAC"] == 1)) {
                        $botones.="<a href=\"javascript:cambiarEstadoConfirmacionCita();\"><img src=\"../../../../fastmedical_front/imagen/btn/b_pago_cvirtual.png\"></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                } else {
                    $botones.="<td style=\"width:100%\">&nbsp;&nbsp;&nbsp;&nbsp;";
                }
                //print_R($resultado);
            }
//
        //
        }


        if (isset($_SESSION["permiso_formulario_servicio"][118]["EDITAR_CITA_VENT_PROG_DET"]) && ($_SESSION["permiso_formulario_servicio"][118]["EDITAR_CITA_VENT_PROG_DET"] == 1)) {
            $botones.="<a href=\"javascript:validaredicionCitaInformes('1');\">
                        <img src=\"../../../../fastmedical_front/imagen/btn/b_editar_on.gif\">
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;";
        }
        if (isset($_SESSION["permiso_formulario_servicio"][118]["CANCELAR_CITA_ADICIONAL"]) && ($_SESSION["permiso_formulario_servicio"][118]["CANCELAR_CITA_ADICIONAL"] == 1)) {
            $botones.="<a href=\"javascript:cerrarVentanaAdicionales();\">
                        <img src=\"../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif\">
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;";
        }
        $botones.="</td></tr></table>";

        return $divtitle . $iniciodiv . $tablaHTML . $findiv . $espacioabajo . $contadores . $botones;
    }

    /* ============================================================================= */

    public function eliminarCitaAdicional($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->getArrayeliminarCitaAdicional($datos);
        return $resultado;
    }

    public function guardarCitaProgramada($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->getArrayguardarCitaProgramada($datos);
        return $resultado;
    }

    public function editarCitaInformes($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->getArrayeditarCitaInformes($datos);
        return $resultado;
    }

    public function eliminarCitaProgramada($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->getArrayeliminarCitaProgramada($datos);
        return $resultado;
    }

    public function arestaurarOrdenesTratamientoCita($datos) {
        $o_LCita = new LCita();
        $resultado = $o_LCita->lrestaurarOrdenesTratamientoCita($datos);
        return $resultado;
    }

    public function aPopudVincularRecetasConTratamientos($datos) {
        $o_LCita = new LCita();
        require_once("../../cvista/cita/PopudVincularRecetasConTratamientos.php");
    }

    //Registro de triaje en la programacion de pacientes
    public function manteTriaje($parametros) {
        $accion = $parametros["accion"];
        $o_LCita = new LCita();

        $datosDesencriptados = base64_decode($parametros["datos"]);
        $datosSeparados = explode("|", $datosDesencriptados);

        //horaProgramacion+"|"+codCronograma+"|"+peso+"|"+talla+"|"+temp+"|"+frecCardiaca+"|"+presArterial+"|"+frecRespiratoria+"|"+satOxigeno;
        switch ($accion) {
            case 'insertar':
                //$horaProgramacion = $datosSeparados[0];
                //$codCronograma = $datosSeparados[1];
                $codigoProgramacion = $datosSeparados[0];
                $peso = $datosSeparados[1];
                $talla = $datosSeparados[2];
                $temp = $datosSeparados[3];
                $frecCardiaca = $datosSeparados[4];
                $presArterial = $datosSeparados[5];
                $frecRespiratoria = $datosSeparados[6];
                $satOxigeno = $datosSeparados[7];

                $rs = $o_LCita->spManteTriaje($accion, $codigoProgramacion, $peso, $talla, $temp, $frecCardiaca, $presArterial, $frecRespiratoria, $satOxigeno);
                $rpta = $rs[0][0];
                break;
            case 'actualizar':
                $horaProgramacion = $datosSeparados[0];
                $codCronograma = $datosSeparados[1];
                $peso = $datosSeparados[2];
                $talla = $datosSeparados[3];
                $temp = $datosSeparados[4];
                $frecCardiaca = $datosSeparados[5];
                $presArterial = $datosSeparados[6];
                $frecRespiratoria = $datosSeparados[7];
                $satOxigeno = $datosSeparados[8];

                $rs = $o_LCita->spManteTriaje($accion, $horaProgramacion, $codCronograma, $peso, $talla, $temp, $frecCardiaca, $presArterial, $frecRespiratoria, $satOxigeno);
                //$rpta = $rs[0][0]+1;
                $rpta = $rs[0][0];
                break;
            /* case 'eliminar':
              $idSistema = $parametros["idSistema"];
              $idForm = $parametros["idForm"];
              $rs = $o_LCita->spEliminarFormulario($idSistema,$idForm);
              //$rpta = $rs[0][0]+2;
              $rpta = $rs[0][0];
              break; */
        }
        /* if($rpta==1)
          $msj = "Se insertó el formulario con éxito";
          else
          if($rpta==2)
          $msj = "Se actualizó el formulario con éxito";
          else
          if($rpta==3)
          $msj = "Se eliminó el formulario con éxito";
          else
          $msj = "No se concretó la acción, inténtelo nuevamente o contáctese con su administrador"; */
        if ($rpta == 1)
            $msj = "Se realizó la acción con éxito";
        else
            $msj = "No se concretó la acción: " . $rpta;
        return $msj;
    }

    public function spListaTriaje($codigoProgramacion) {
        $o_LCita = new LCita();
        $rs = $o_LCita->spListaTriaje($codigoProgramacion);
        return $rs[0];
    }

    /*     * **************APOYO AL DIAGNOSTICO (IMAGENES)*************************** */

    public function mostrarventanaprogramacionTemporal() {
        require_once("../../cvista/cita/vProgramacionTemporal.php");
    }

    public function getTablaProgramacionTemporal($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LCita = new LCita();
        $datos == '' ? $arrayFilas = array() : $arrayFilas = $o_LCita->obtenerListaProgramacionTemporal($datos);
        $arrayCabecera = array("0" => "Hora", "1" => "Paciente", "2" => "Estado", "3" => "Tipo de Cita", "4" => "Ambiente", "5" => "C.Costo", "6" => "...");
        $arrayTamano = array("0" => "50", "1" => "50", "2" => "90", "3" => "100", "4" => "*", "5" => "*", "6" => "60");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "center", "2" => "center", "3" => "left", "4" => "left", "5" => "left", "6" => "center");
        $arrayHidden = array("0" => "true", "1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false", "6" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    ///////////////////////////////////------------------------------VER DETALLE ORDEN-------------------------------------

    public function ventanaVerDetalleOrden() {
        require_once("../../cvista/cita/vDetalleOrden.php");
    }

    function MostrarDetalleOrden($datos) {
        $o_LCita = new LCita();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LCita->LMostrarDetalleOrden($datos);
        $arrayCabecera = array(0 => "nrodoc", 1 => "fec_doc", 2 => "desc_t_afil", 3 => "desc_ser_pro", 4 => "preunit", 5 => "canti", 6 => "estado", 7 => "codProgramacion");
        $arrayTamano = array(0 => "80", 1 => "60", 2 => "60", 3 => "*", 4 => "60", 5 => "60", 6 => "40", 7 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "true", 6 => "true", 7 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "center", 7 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function MostrarUsuarioRegistro($datos) {
        $o_LCita = new LCita();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LCita->LMostrarUsuarioRegistro($datos);
        $arrayCabecera = array(0 => "fecha", 1 => "estacion", 2 => "nombre");
        $arrayTamano = array(0 => "*", 1 => "*", 2 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function MostrarUsuarioConfirma($datos) {
        $o_LCita = new LCita();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LCita->LMostrarUsuarioConfirma($datos);
        $arrayCabecera = array(0 => "fecha", 1 => "estacion", 2 => "nombre");
        $arrayTamano = array(0 => "*", 1 => "*", 2 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function MostrarUsuarioPaga($datos) {
        $o_LCita = new LCita();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LCita->LMostrarUsuarioPaga($datos);
        $arrayCabecera = array(0 => "fecha", 1 => "estacion", 2 => "nombre");
        $arrayTamano = array(0 => "*", 1 => "*", 2 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function MostrarAtencionInicio($datos) {
        $o_LCita = new LCita();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LCita->LMostrarAtencionInicio($datos);
        $arrayCabecera = array(0 => "fecha", 1 => "estacion", 2 => "nombre");
        $arrayTamano = array(0 => "*", 1 => "*", 2 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function MostrarAtencionFin($datos) {
        $o_LCita = new LCita();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LCita->LMostrarAtencionFin($datos);
        $arrayCabecera = array(0 => "fecha", 1 => "estacion", 2 => "nombre");
        $arrayTamano = array(0 => "*", 1 => "*", 2 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function AmostrarReceta($datos) {
        $o_LCita = new LCita();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LCita->LmostrarReceta($datos);
        $arrayCabecera = array(0 => "FechaServicio", 1 => "Doctor", 2 => "Servicio");
        $arrayTamano = array(0 => "60", 1 => "*", 2 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function aListarCronogramaMedicoEmergencia($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LCita = new LCita();
        $arrayFilas = $o_LCita->lListarCronogramaMedicoEmergencia($datos);
        $cboUbicacion = $o_LCita->lListaUbicacionCita();
//        $arrayCabecera = array("0" => "ID", "1" => "HORA", "2" => "IHORAORDEN", "3" => "ESTADO", "4" => "CODIGO PERSONA", "5" => "AFILIACION", "6" => "PACIENTE", "7" => "SEXO", "8" => "EDAD", "9" => "TIPO", "10" => "ACTIVIDAD", "11" => "FECHAHORAATENCION", "12" => "BACTIVO", "13" => "CODIGOPROGRAMACION", "14" => "CRONOGRAMA", "15" => "UBICACIÓN", "16" => "...", "17" => "...", "18" => "...");
//        $arrayTamano = array("0" => "10", "1" => "70", "2" => "10", "3" => "70", "4" => "10", "5" => "100", "6" => "200", "7" => "10", "8" => "10", "9" => "100", "10" => "*", "11" => "10", "12" => "10", "13" => "10", "14" => "10", "15" => "130", "16" => "30", "17" => "30", "18" => "30");
//        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro", "8" => "ro", "9" => "ro", "10" => "ro", "11" => "ro", "12" => "ro", "13" => "ro", "14" => "ro", "15" => "ro", "16" => "ro", "17" => "ro", "18" => "ro");
//        $arrayAlineacion = array("0" => "center", "1" => "center", "2" => "center", "3" => "left", "4" => "center", "5" => "left", "6" => "left", "7" => "center", "8" => "left", "9" => "left", "10" => "left", "11" => "center", "12" => "center", "13" => "center", "14" => "center", "15" => "center", "16" => "center", "17" => "center", "18" => "center");
//        $arrayHidden = array("0" => "true", "1" => "false", "2" => "true", "3" => "false", "4" => "true", "5" => "false", "6" => "false", "7" => "true", "8" => "true", "9" => "false", "10" => "false", "11" => "true", "12" => "true", "13" => "true", "14" => "true", "15" => "false", "16" => "true", "17" => "true", "18" => "true");
        //return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);

        $arrayCabecera = array("0" => "ID", "1" => "HORA", "20" => "TIEMPO", "2" => "IHORAORDEN", "3" => "IDUBICACION", "4" => "REFERENCIA", "5" => "CODIGO PERSONA", "6" => "AFILIACION", "7" => "PACIENTE", "8" => "SEXO", "9" => "EDAD", "10" => "TIPO", "11" => "DESCRIPCION", "18" => "Nro. Placa", "12" => "FECHAHORAATENCION", "13" => "BACTIVO", "14" => "CODIGOPROGRAMACION", "15" => "CRONOGRAMA", "16" => "UBICACIÓN", "17" => "...", "19" => "nsdHistoriaImagen", "21" => "...");
        $arrayTamano = array("0" => "10", "1" => "40", "20" => "30", "2" => "10", "3" => "10", "4" => "70", "5" => "40", "6" => "90", "7" => "210", "8" => "10", "9" => "10", "10" => "100", "11" => "270", "18" => "60", "12" => "10", "13" => "10", "14" => "10", "15" => "10", "16" => "100", "17" => "30", "19" => "30", "21" => "30");
        $arrayTipo = array("0" => "ro", "1" => "ro", "20" => "ro", "2" => "ro", "3" => "ro", "4" => "co", "5" => "ro", "6" => "ro", "7" => "ro", "8" => "ro", "9" => "ro", "10" => "ro", "11" => "ro", "18" => "ro", "12" => "ro", "13" => "ro", "14" => "ro", "15" => "ro", "16" => "ro", "17" => "ro", "19" => "ro", "21" => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "center", "20" => "center", "2" => "center", "3" => "left", "4" => "left", "5" => "center", "6" => "left", "7" => "left", "8" => "center", "9" => "left", "10" => "left", "11" => "left", "18" => "left", "12" => "center", "13" => "center", "14" => "center", "15" => "center", "16" => "center", "17" => "center", "19" => "center", "21" => "center");
        $arrayHidden = array("0" => "true", "1" => "false", "20" => "false", "2" => "true", "3" => "true", "4" => "false", "5" => "true", "6" => "false", "7" => "false", "8" => "true", "9" => "true", "10" => "true", "11" => "false", "18" => "false", "12" => "true", "13" => "true", "14" => "true", "15" => "true", "16" => "false", "17" => "true", "19" => "true", "21" => "false");

        return $o_TablaHtmlx->generaTablaFullCombo($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAlineacion, $cboUbicacion);
    }

    function aVentanaUbicacionImagenes($datos) {

        $o_LCita = new LCita();
        $arrayDatos = $o_LCita->lDatosNumeroPlaca($datos);
        $arrayUbicaciones = $o_LCita->lUbicacionesImagenes();
        $arrayHistorialUbicaciones = $o_LCita->lHistorialUbicacionesImagenes($datos);
        //print_r($arrayHistorialUbicaciones);
        require_once("../../cvista/cita/vistaSeguimientoImagenes.php");
    }

    function seleccionarUbicaciones() {
        $o_LCita = new LCita();
        $arrayUbicaciones = $o_LCita->lUbicacionesImagenes();
        require_once("../../cvista/cita/derivarMasivamente.php");
    }

    function aVentanaEditarCita($datos) {
        $o_LCita = new LCita();
        $arrayDatos = $o_LCita->lDatosEditarCita($datos);
        $arrayServicios=$o_LCita->lServicios($datos);
        require_once("../../cvista/cita/vistaEditarCita.php");
    }

    function aCargarMedicosEditarCita($datos) {

        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LCita = new LCita();
        $arrayFilas = $o_LCita->lCargarMedicosEditarCita($datos);
        $arrayCabecera = array("0" => "icodigoCronograma", "1" => "fecha", "2" => "c_cod_per", "3" => "Médico", "4" => "Ambiente", "5" => "Turno");
        $arrayTamano = array("0" => "*", "1" => "70", "2" => "*", "3" => "*", "4" => "*", "5" => "70");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "center", "2" => "center", "3" => "left", "4" => "center", "5" => "left");
        $arrayHidden = array("0" => "true", "1" => "false", "2" => "true", "3" => "false", "4" => "false", "5" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function aUpdateUbicacionCita($datos) {
        $o_LCita = new LCita();
        $rs = $o_LCita->lUpdateUbicacionCita($datos);
        return $rs;
    }

    public function aMostrarDetalleCronogramaMedico($datos) {
        $o_LCita = new LCita();
        $data = $o_LCita->lMostrarDetalleCronogramaMedico($datos);
        require_once("../../cvista/cita/aMostrarDetalleCronogramaMedico.php");
    }

    function ApupapAsignacionMedico($datos) {
        $o_LCita = new LCita();
//        $arrayDatos = $o_LCita->lDatosEditarCita($datos);
        require_once("../../cvista/cita/pupapAsignacionMedico.php");
    }

    function AcrearTablaAsignacionMedicoPacientes($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LCita = new LCita();
//        $arrayFilas = $o_LCita->lCargarMedicosEditarCita($datos);
        $arrayMatrizNombreCodigo = array();
//        $j = 0;
        $CadenaCodigoProgramacionNombre = $datos["hCadenaCodigoProgramacionNombre"];
        $arrayNombreCodigo = explode("***", $CadenaCodigoProgramacionNombre);
        foreach ($arrayNombreCodigo as $k => $value) {
            $arrayMatrizNombreCodigo[$k] = explode("---", $value);
        }

        $arrayCabecera = array("0" => "idProgramacionPaciente", "1" => "Nombre", "2" => "Acc");
        $arrayTamano = array("0" => "80", "1" => "220", "2" => "60");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false");
        $arrayAling = array("0" => "center", "1" => "left", "2" => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayMatrizNombreCodigo, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function AtablacargarMedicosAsignados($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LCita = new LCita();
        $arrayFilas = $o_LCita->LtablacargarMedicosAsignados($datos);
        $arrayCabecera = array("0" => "iCodigoCronograma", "1" => "dia", "2" => "dFechaServicio", "3" => "Turno", "4" => "Medico", "5" => "Servicio", "6" => "bHabilitado", "7" => "vacio");
        $arrayTamano = array("0" => "40", "1" => "280", "2" => "280", "3" => "80", "4" => "180", "5" => "180", "6" => "280", "7" => "280");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "left", "2" => "left", "3" => "left", "4" => "center", "5" => "left", "6" => "left", "7" => "left");
        $arrayHidden = array("0" => "true", "1" => "true", "2" => "true", "3" => "false", "4" => "false", "5" => "false", "6" => "true", "7" => "true");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function AguardarASignacionMedico($datos) {
        $o_LCita = new LCita();
        $rs = $o_LCita->LguardarASignacionMedico($datos);
        return $rs;
    }

    function aListarHistoriaCronogramaPaciente($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LCita = new LCita();
        $arrayFilas = $o_LCita->lListarHistoriaCronogramaPaciente($datos);
        $arrayCabecera = array("0" => "Id","1" => "Hora", "2" => "Tiempo", "3" => "Paciente", "4" => "Medico", "5" => "Servicio(s)", "6" => "Situacion", "7" => "Estado");
        $arrayTamano = array("0" => "50","1" => "50", "2" => "70", "3" => "*", "4" => "*", "5" => "*", "6" => "70", "7" => "70");
        $arrayTipo = array("0" => "ro","1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro");
        $arrayAlineacion = array("0" => "center","1" => "center", "2" => "left", "3" => "left", "4" => "left", "5" => "left", "6" => "center", "7" => "left");
        $arrayHidden = array("0" => "true","1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false", "6" => "false", "7" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function AvalidaServicionConProcedimiento($datos) {
        $o_LCita = new LCita();
        $rs = $o_LCita->LvalidaServicionConProcedimiento($datos);
        return $rs[0][0];
    }

     public function aCargarDatosLeyenda($datos) {
        $o_LCita = new LCita();
        $rs = $o_LCita->lCargarDatosLeyenda($datos);
        return $rs;
    }
    
       
//--------------------------------------------------------------------------------------------------------------
}

?>
