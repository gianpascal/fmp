<?php

require_once("../../clogica/LMantenimientoGeneral.php");
require_once("../../../pholivo/Html.php");
require_once("../../../pholivo/Html1.php");
require_once("../../clogica/LRrhh.php");
require_once("../../../pholivo/tablaDHTMLX.php");

class ActionMantenimientoGeneral {

    public function __construct() {
        
    }

    /*     * ****************************MANTENIMIENTO TURNOS************************************* */

    //Dibuja tabla de todos los turnos

    public function listaTurnoL($descTurno) {
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();
        $o_TablaHtmlx = new tablaDHTMLX();
        $descTurno = ($descTurno == '' || $descTurno == null) ? '%' : $descTurno;
        $arrayFilas = $o_LMantenimientoGeneral->listaTurnoL($descTurno);
        $arrayCabecera = array(0 => "CODIGO", 1 => "TURNOS", 2 => "H.INICIO", 3 => "H.FIN", 4 => "TOTAL HORAS", 5 => "TIPO", 6 => "NOMENCLATURA", 7 => "ESTADO", 8 => "...", 9 => "...");
        $arrayTamano = array(0 => "*", 1 => "*", 2 => "*", 3 => "*", 4 => "*", 5 => "*", 6 => "*", 7 => "*  ", 8 => "30", 9 => "30");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "img", 9 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "pointer", 9 => "pointer");
        $arrayHidden = array(0 => "TRUE", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false", 7 => "false", 8 => "false", 9 => "false");
        $arrayAling = array(0 => "center", 1 => "center", 2 => "center", 3 => "center", 4 => "center", 5 => "center", 6 => "center", 7 => "center", 8 => "center", 9 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function listaTurno($descTurno) {
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();
        $descTurno = ($descTurno == '' || $descTurno == null) ? '%' : $descTurno;
        $arrayFilas = $o_LMantenimientoGeneral->listaTurno($descTurno);
        $arrayTipo = array("cCodigoTurno" => "c",
            "vDescripcionTurno" => "c",
            "nHorainicio" => "c", //Comentario 1
            "nHorafinal" => "c", //Comentario 2
            "nTotalHoras" => "c",
            "cNomenclatura" => "c",
            "cTipoHorario" => "c",
            "opciones" => "h",
                //"opciones1"=>"h",
                //"bActivo" => "c"
        );

        $arrayCabecera = array("cCodigoTurno" => "ID",
            "vDescripcionTurno" => "Descripción",
            "nHorainicio" => "Hinicial", //comentario 1
            "nHorafinal" => "HFinal", //comentario 2
            "nTotalHoras" => "Total",
            "cNomenclatura" => "Nomenclatura",
            "cTipoHorario" => "Tipo",
            "opciones" => "Opciones",
                //"opciones1"=>"h",
                //"bActivo" => "c"
        );
        // "cNomenclatura"=>"Nomenclatura");
        //$arrayColorEstado=array("0"=>"6","2"=>"2");
        //($_arrayCabecera,$_numFilas,$_arrayFilas='',$_estiloTabla='',$_estiloFila='',$_estiloFilaAlterna='',$_estiloFilaSeleccionada='',$_arrayEventosJS='',$_oyenteEventosJS='',$_indClave='',$_arrayTipos='' ,$_indiceEstados='',$_arrayColorEstado='')
        $o_Tabla = new Tabla1($arrayCabecera, 25, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', '', 4, $arrayTipo, 0, '');
        //$o_Tabla->setColumnasOrdenar(array("cCodigoTurno","vDescripcionTurno","nHorainicio","nHorafinal","cTipoHorario"));
        $o_Tabla->setColumnasOrdenar(array("cCodigoTurno", "vDescripcionTurno", "cTipoHorario", "cNomenclatura", "cTipoHorario"));
        $tablaHTML = $o_Tabla->getTabla();
        $row_ini = "<table width='100%'>";
        $row_fin = "</table>";
        return $row_ini . $tablaHTML . $row_fin;
    }

    //Mantenimiento de Turnos
    public function manteTurno($parametros) {
        $accion = $parametros["accion"];
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();
        //  print_r($parametros);


        switch ($accion) {
            case 'insertar':
                $datosDesencriptados = base64_decode($parametros["datos"]);
                $datosSeparados = explode("|", $datosDesencriptados);
                $codTurno = $datosSeparados[0];
                $descTurno = $datosSeparados[1];
                $horaInicioTurno = $datosSeparados[2];
                $horaFinalTurno = $datosSeparados[3];
                $totalHorasTurno = $datosSeparados[4];
                $tipoHorarioTurno = $datosSeparados[5];
                $nomenclatura = $datosSeparados[6];

                $rs = $o_LMantenimientoGeneral->spManteTurno($accion, $codTurno, $descTurno, $horaInicioTurno, $horaFinalTurno, $totalHorasTurno, $tipoHorarioTurno, $nomenclatura);
                $rpta = $rs[0][0];
                break;
            case 'actualizar':
                $datosDesencriptados = base64_decode($parametros["datos"]);
                $datosSeparados = explode("|", $datosDesencriptados);
                $codTurno = $datosSeparados[0];
                $descTurno = $datosSeparados[1];
                $horaInicioTurno = $datosSeparados[2];
                $horaFinalTurno = $datosSeparados[3];
                $totalHorasTurno = $datosSeparados[4];
                $tipoHorarioTurno = $datosSeparados[5];
                $nomenclatura = $datosSeparados[6]; //prueba

                $rs = $o_LMantenimientoGeneral->spManteTurno($accion, $codTurno, $descTurno, $horaInicioTurno, $horaFinalTurno, $totalHorasTurno, $tipoHorarioTurno, $nomenclatura);
                $rpta = $rs[0][0];
                break;

            case 'eliminar':
                $codTurno = $parametros["codTurno"];
                $rs = $o_LMantenimientoGeneral->spEliminarTurno($codTurno);
                //echo $codTurno;
                $rpta = trim($rs[0][0]);
                //echo 'inic';
                //print_r($rpta);
                //echo 'fin';
                break;
        }
        if ($rpta == -1) {
            $msj = "El turno seleccionado ya existe";
        }
        if ($rpta == 1) {
            $msj = "Se realizó la acción con éxito";
        }
        if ($rpta == 0) {
            $msj = "El turno escogido no se puede borrar porque esta asignado a un Area";
        }
//        else {
//            $msj = "No se concretó la acción, inténtelo nuevamente o contáctese con su administrador";
//        }

        return $msj;
    }

    /*     * ****************MANTENIMIENTO AMBIENTES FISICOS************************************** */

    //Dibuja combo de empresas
    public function listaDatosEmpresa($codEmpresa, $codSede, $disabled) {
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();

        $nomEmpresa = "%";
        $arrayCombo = $o_LMantenimientoGeneral->getArrayListaEmpresas($nomEmpresa);
        $o_Combo = new Combo($arrayCombo);
        $opcionesHTML_01 = $o_Combo->getOptionsHTML($codEmpresa);

        $nomSede = "%";
        $arrayCombo = $o_LMantenimientoGeneral->getArrayListaSedes($codEmpresa, $nomSede);
        $o_Combo = new Combo($arrayCombo);
        $opcionesHTML_02 = $o_Combo->getOptionsHTML();
        //$opcionesHTML_02 = $o_Combo->getOptionsHTML($codSede);

        $row_ochg_empresa = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=comboEmpresas&p2='+document.getElementById('cboEmpresa').value+'&p3='+document.getElementById('cboSede').value,'divEmpresas');\"";
        $row_ochg_sede = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=listaAmbientesFisicos&p2='+document.getElementById('cboSede').value,'contenido_detalle');\"";

        $row_ini = "<table><tr><td>Empresa</td><td>Sede</td></tr><tr><td>";
        $row_med = "</td><td>";
        $row_fin = "</td></tr></table>";
        /* $row_empresa = "<select tabindex=1 id=\"cboEmpresa\" name=\"cboEmpresa\" onkeypress=\"return validFormSalt('cbo',this,event,'cb_provincia')\" $disabled ".$row_ochg." title=\"Empresa\">";
          $row_sede = "<select tabindex=2 id=\"cboSede\" name=\"cboSede\" onkeypress=\"return validFormSalt('cbo',this,event,'cb_distrito')\" $disabled ".$row_ochg." style=\"width:100px\" title=\"Sede\">"; */
        $row_empresa = "<select tabindex=1 id=\"cboEmpresa\" name=\"cboEmpresa\" disabled " . $row_ochg_empresa . " title=\"Empresa\">";
        $row_sede = "<select tabindex=2 id=\"cboSede\" name=\"cboSede\" $disabled " . $row_ochg_sede . " title=\"Sede\">";
        $row_fin_cb = "</select>";

        $comboHTML = $row_ini . $row_empresa . $opcionesHTML_01 . $row_fin_cb . $row_med . $row_sede . $opcionesHTML_02 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    public function listaSede($codEmpresa, $codSede, $disabled) {
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();

        $nomEmpresa = "%";
        $arrayCombo = $o_LMantenimientoGeneral->getArrayListaEmpresas($nomEmpresa);
        $o_Combo = new Combo($arrayCombo);
        $opcionesHTML_01 = $o_Combo->getOptionsHTML($codEmpresa);

        $nomSede = "%";
        $arrayCombo = $o_LMantenimientoGeneral->getArrayListaSedes($codEmpresa, $nomSede);
        $o_Combo = new Combo($arrayCombo);
        $opcionesHTML_02 = $o_Combo->getOptionsHTML();
        //$opcionesHTML_02 = $o_Combo->getOptionsHTML($codSede);
        // $row_ochg_empresa = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=comboEmpresas&p2='+document.getElementById('cboEmpresa').value+'&p3='+document.getElementById('cboSede').value,'divEmpresas');\"";
        //$row_ochg_sede = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=listaAmbientesFisicos&p2='+document.getElementById('cboSede').value,'contenido_detalle');\"";

        $row_ini = "<table  align=\"center\" ><tr align=\"center\><td align=\"center\>";
        //$row_med="</td><td>";
        $row_fin = "</td></tr></table>";
        /* $row_empresa = "<select tabindex=1 id=\"cboEmpresa\" name=\"cboEmpresa\" onkeypress=\"return validFormSalt('cbo',this,event,'cb_provincia')\" $disabled ".$row_ochg." title=\"Empresa\">";
          $row_sede = "<select tabindex=2 id=\"cboSede\" name=\"cboSede\" onkeypress=\"return validFormSalt('cbo',this,event,'cb_distrito')\" $disabled ".$row_ochg." style=\"width:100px\" title=\"Sede\">"; */
        // $row_empresa = "<select tabindex=1 id=\"cboEmpresa\" name=\"cboEmpresa\" disabled  title=\"Empresa\">";
        $row_sede = "<select tabindex=2 id=\"cboSede\" name=\"cboSede\  align=\"center\ $disabled  title=\"Sede\">";
        $row_fin_cb = "</select>";

        $comboHTML = $row_ini . $row_sede . $opcionesHTML_02 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    //


    public function seleccionAmbientesFisicos($idSedeEmpresa, $nomAmbienteFisico) {
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();
        $nomAmbienteFisico = ($nomAmbienteFisico == '' || $nomAmbienteFisico == null) ? '%' : $nomAmbienteFisico;
        $arrayCombo = $o_LMantenimientoGeneral->getArrayListaAmbientesFisicos($idSedeEmpresa, $nomAmbienteFisico);
        $o_Combo = new Combo($arrayCombo);
        $opcionesHTML_01 = $o_Combo->getOptionsHTML();
        //$row_ochg_sede = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=listaAmbientesFisicos&p2='+document.getElementById('cboSede').value,'contenido_detalle');\"";
        $row_ambFisicos = "<select tabindex=2 id=\"cboAmbFisicos\" name=\"cboAmbFisicos\" title=\"Ambientes Fisicos\">";
        $row_fin_cb = "</select>";
        return $row_ambFisicos . $opcionesHTML_01 . $row_fin_cb;
    }

    //Dibuja tabla de todos los ambientes fisicos de la sede de una empresa
    public function listaAmbientesFisicos($idSedeEmpresa, $nomAmbienteFisico) {
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();
        $nomAmbienteFisico = ($nomAmbienteFisico == '' || $nomAmbienteFisico == null) ? '%' : $nomAmbienteFisico;
        $arrayFilas = $o_LMantenimientoGeneral->listaAmbientesFisicos($idSedeEmpresa, $nomAmbienteFisico);

        $arrayTipo = array("iCodigoAmbienteFisico" => "c",
            "vNombreAmbienteFisico" => "c",
            "vDescAmbienteFisico" => "c",
            "iTipo" => "c",
            "iNumeroDePiso" => "c",
            "rAncho" => "c",
            "rLargo" => "c",
            "rAlto" => "c",
            "vUnidadDeMedida" => "c",
            //"chk_activo"=>"h",
            "opciones" => "h");
        $arrayColorEstado = array();
//        $arrayColorEstado=array("1"=>"5","2"=>"2","3"=>"3","4"=>"4","5"=>"5","6"=>"6","7"=>"7","8"=>"8","9"=>"9");
        //$arrayCabecera = array("5"=>"...","1"=>"NOMBRE","2"=>"SERVICIO");
        $arrayCabecera = array("iCodigoAmbienteFisico" => "ID",
            "vNombreAmbienteFisico" => "NOMBRE",
            "vDescAmbienteFisico" => "DESCRIPCIÓN",
            "vTipo" => "TIPO",
            "iNumeroDePiso" => "PISO",
            "rAncho" => "ANCHO",
            "rLargo" => "LARGO",
            "rAlto" => "ALTO",
            "vUnidadDeMedida" => "UM",
            //"chk_activo"=>"ACT",
            "opciones" => "...");
        //$o_Tabla = new Tabla($arrayCabecera,$arrayFilas,'col1','col2','sele','title','0','');
        //($_arrayCabecera,$_numFilas,$_arrayFilas='',$_estiloTabla='',$_estiloFila='',$_estiloFilaAlterna='',$_estiloFilaSeleccionada='',$_arrayEventosJS='',$_oyenteEventosJS='',$_indClave='',$_arrayTipos='' ,$_indiceEstados='',$_arrayColorEstado='')
        $o_Tabla = new Tabla1($arrayCabecera, 25, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', '', 4, $arrayTipo, 0, '');
        //$o_Tabla->setColumnasOrdenar(array("1","2"));
        //$o_Tabla = new Tabla1($arrayCabecera,10,$arrayFilas,'tablaOrden','filax','filay','filaSeleccionada','OnClick','acaVa',0);
        $tablaHTML = $o_Tabla->getTabla();
        return $tablaHTML;
    }

    //Dibuja tabla de los servicios básicos de un ambiente físico
    public function listaAmbFisicoxServBasico($codAmbienteFisico, $nomServicioBasico) {
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();
        $nomServicioBasico = ($nomServicioBasico == '' || $nomServicioBasico == null) ? '%' : $nomServicioBasico;
        $arrayFilas = $o_LMantenimientoGeneral->listaAmbFisicoxServBasico($codAmbienteFisico, $nomServicioBasico);
        $n = 0;
        $n = count($arrayFilas);

        $arrayTipo = array("iCodigoServBasico" => "c",
            "vNombreServBasico" => "c",
            "chk_activo" => "h",
            "opciones" => "h");

        $arrayCabecera = array("iCodigoServBasico" => "ID",
            "vNombreServBasico" => "NOMBRE",
            "chk_activo" => "HAB",
            "opciones" => "...");

        //($_arrayCabecera,$_numFilas,$_arrayFilas='',$_estiloTabla='',$_estiloFila='',$_estiloFilaAlterna='',$_estiloFilaSeleccionada='',$_arrayEventosJS='',$_oyenteEventosJS='',$_indClave='',$_arrayTipos='' ,$_indiceEstados='',$_arrayColorEstado='')
        $o_Tabla = new Tabla1($arrayCabecera, $n, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', '', 4, $arrayTipo, 0, $arrayColorEstado);
        $tablaHTML = $o_Tabla->getTabla();

        return $tablaHTML;
    }

    public function spHabServBasicoDeAmbFisico($parametros) {
        $codAmbienteFisico = $parametros['p2'];
        $codServicioBasico = $parametros['p3'];
        $estado = $parametros['p4'];

        $o_LMantenimientoGeneral = new LMantenimientoGeneral();
        $rs = $o_LMantenimientoGeneral->spHabServBasicoDeAmbFisico($codAmbienteFisico, $codServicioBasico, $estado); //$rs=1 si tiene éxito
        return $rs[0][0];
    }

    //Dibuja tabla de las camas de un ambiente físico
    public function listaCamaxAmbFisico($codAmbienteFisico, $descCama) {
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();
        $descCama = ($descCama == '' || $descCama == null) ? '%' : $descCama;
        $arrayFilas = $o_LMantenimientoGeneral->listaCamaxAmbFisico($codAmbienteFisico, $descCama);
        $n = 0;
        $n = count($arrayFilas);

        $arrayTipo = array("iIdCodigoCama" => "c",
            "iNumeroCama" => "c",
            "vDescripcionCama" => "c",
            "chk_activo" => "h",
            "opciones" => "h");

        $arrayCabecera = array("iIdCodigoCama" => "ID",
            "iNumeroCama" => "NUM",
            "vDescripcionCama" => "DESC",
            "chk_activo" => "HAB",
            "opciones" => "...");
        $n = 10; //numero de filas que se mostrarán inicialmente
        //($_arrayCabecera,$_numFilas,$_arrayFilas='',$_estiloTabla='',$_estiloFila='',$_estiloFilaAlterna='',$_estiloFilaSeleccionada='',$_arrayEventosJS='',$_oyenteEventosJS='',$_indClave='',$_arrayTipos='' ,$_indiceEstados='',$_arrayColorEstado='')
        $o_Tabla = new Tabla1($arrayCabecera, $n, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', '', 0, $arrayTipo, 0, '');
        $tablaHTML = $o_Tabla->getTabla();

        return $tablaHTML;
    }

    public function getUltimoNumCamaxAmbFisico($codAmbienteFisico) {
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();
        $rs = $o_LMantenimientoGeneral->getUltimoNumCamaxAmbFisico($codAmbienteFisico);
        return $rs[0][0];
    }

    public function spHabCamaDeAmbFisico($parametros) {
        $codAmbienteFisico = $parametros['p2'];
        $codCama = $parametros['p3'];
        $estado = $parametros['p4'];

        $o_LMantenimientoGeneral = new LMantenimientoGeneral();
        $rs = $o_LMantenimientoGeneral->spHabCamaDeAmbFisico($codAmbienteFisico, $codCama, $estado); //$rs=1 si tiene éxito
        return $rs[0][0];
    }

    //Mantenimiento de cama Ambiente Físico
    public function manteCamaxAmbienteFisico($parametros) {
        $accion = $parametros["accion"];
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();

        $datosDesencriptados = base64_decode($parametros["datos"]);
        $datosSeparados = explode("|", $datosDesencriptados);

        switch ($accion) {
            case 'insertar':
                $idCama = $datosSeparados[0];
                $codAmbienteFisico = $datosSeparados[1];
                $numCama = $datosSeparados[2];
                $descCama = $datosSeparados[3];

                $rs = $o_LMantenimientoGeneral->spManteCamaxAmbienteFisico($accion, $idCama, $codAmbienteFisico, $numCama, $descCama);
                $rpta = $rs[0][0];
                break;
            case 'actualizar':
                $idCama = $datosSeparados[0];
                $codAmbienteFisico = $datosSeparados[1];
                $numCama = $datosSeparados[2];
                $descCama = $datosSeparados[3];

                $rs = $o_LMantenimientoGeneral->spManteCamaxAmbienteFisico($accion, $idCama, $codAmbienteFisico, $numCama, $descCama);
                $rpta = $rs[0][0];
                break;
            /* case 'eliminar':
              $codAmbienteFisico = $parametros["codAmbienteFisico"];
              $idSedeEmpresa = $parametros["idSedeEmpresa"];
              $rs = $o_LMantenimientoGeneral->spEliminarAmbienteFisico($codAmbienteFisico,$idSedeEmpresa);
              $rpta = $rs[0][0];
              break; */
        }
        if ($rpta == 1)
            $msj = "Se realizó la acción con éxito";
        else
            $msj = "No se concretó la acción, inténtelo nuevamente o contáctese con su administrador";
        return $msj;
    }

    //Mantenimiento de Ambientes Físicos
    public function manteAmbienteFisico($parametros) {
        $accion = $parametros["accion"];
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();

        $datosDesencriptados = base64_decode($parametros["datos"]);
        $datosSeparados = explode("|", $datosDesencriptados);

        switch ($accion) {
            case 'insertar':
                $codAmbienteFisico = $datosSeparados[0];
                $idSedeEmpresa = $datosSeparados[1];

                //$nomAmbienteFisico = $datosSeparados[2];

                $numPisoAmbienteFisico = $datosSeparados[4];
                if ($numPisoAmbienteFisico < 10) {
                    $nomAmbienteFisico = "0" . $numPisoAmbienteFisico;
                } else {
                    $nomAmbienteFisico = $numPisoAmbienteFisico;
                }


                $descAmbienteFisico = $datosSeparados[3];
                $numPisoAmbienteFisico = $datosSeparados[4];
                $anchoAmbienteFisico = $datosSeparados[5];
                $largoAmbienteFisico = $datosSeparados[6];
                $altoAmbienteFisico = $datosSeparados[7];
                $umAmbienteFisico = $datosSeparados[8];
                $idTipo = $datosSeparados[9];
                $rs = $o_LMantenimientoGeneral->spManteAmbienteFisico($accion, $codAmbienteFisico, $idSedeEmpresa, $nomAmbienteFisico, $descAmbienteFisico, $numPisoAmbienteFisico, $anchoAmbienteFisico, $largoAmbienteFisico, $altoAmbienteFisico, $umAmbienteFisico, $idTipo);
                $rpta = $rs[0][0];
                break;
            case 'actualizar':
                $codAmbienteFisico = $datosSeparados[0];
                $idSedeEmpresa = $datosSeparados[1];
                $nomAmbienteFisico = $datosSeparados[2];
                $descAmbienteFisico = $datosSeparados[3];
                $numPisoAmbienteFisico = $datosSeparados[4];
                $anchoAmbienteFisico = $datosSeparados[5];
                $largoAmbienteFisico = $datosSeparados[6];
                $altoAmbienteFisico = $datosSeparados[7];
                $umAmbienteFisico = $datosSeparados[8];
                $idTipo = $datosSeparados[9];

                $rs = $o_LMantenimientoGeneral->spManteAmbienteFisico($accion, $codAmbienteFisico, $idSedeEmpresa, $nomAmbienteFisico, $descAmbienteFisico, $numPisoAmbienteFisico, $anchoAmbienteFisico, $largoAmbienteFisico, $altoAmbienteFisico, $umAmbienteFisico, $idTipo);
                $rpta = $rs[0][0];
                break;
            case 'eliminar':
                $codAmbienteFisico = $parametros["codAmbienteFisico"];
                $idSedeEmpresa = $parametros["idSedeEmpresa"];
                $rs = $o_LMantenimientoGeneral->spEliminarAmbienteFisico($codAmbienteFisico, $idSedeEmpresa);
                $rpta = $rs[0][0];
                break;
        }
        if ($rpta == 1)
            $msj = "Se realizó la acción con éxito";
        else
            $msj = "No se concretó la acción, inténtelo nuevamente o contáctese con su administrador";
        return $msj;
    }

    /*     * ****************MANTENIMIENTO AMBIENTES LOGICOS************************************** */

    public function listadoAmbientesLogicos($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $datos == '' ? $arrayFilas1 = array() : $arrayFilas1 = $oLMantenimientoGeneral->getListaAmbientesLogicos($datos);
        $arrayCabecera = array("1" => "NOMBRE C.COSTO", "2" => "NOMBRE AMBIENTE LÓGICO", "4" => "...", "5" => "...", "6" => "...", "7" => " ");
//        $arrayTipo=array("1"=>"c","2"=>"c","3"=>"h","4"=>"h");
        $arrayTipo = array("1" => "c", "2" => "c", "4" => "h", "5" => "h", "6" => "h", "7" => "h");
        $o_Tabla = new Tabla1($arrayCabecera, 10, $arrayFilas1, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'OnClick', 'irmostrarAmbienteLogico', 0, $arrayTipo);
        $tablaHTML = $o_Tabla->getTabla();
        $row_ini = "<table width='100%'>";
        $row_fin = "</table>";
        return $row_ini . $tablaHTML . $row_fin;
    }

    public function editarAmbienteLogico($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $resultado = $oLMantenimientoGeneral->obtenerAmbienteLogico($datos);
        $nombrecentrocosto = $resultado[0]["vDescripcionCcosto"];
        $nombreambientelogico = $resultado[0]["vNombreAmbienteLogico"];
        $descripcionambientelogico = $resultado[0]["vDescripcionAmbiente"];
        $bactivo = $resultado[0]["bActivo"];
        $scriptJS = "pintarDatosAmbienteLogico('" . $nombrecentrocosto . "','" . $nombreambientelogico . "','" . $descripcionambientelogico . "','" . $bactivo . "');";
        return utf8_encode($scriptJS);
    }

    public function activaryDesactivarAmbienteLogico($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $resultado = $oLMantenimientoGeneral->activaryDesactivarAmbienteLogico($datos);
        return $resultado;
    }

    public function grabarAmbienteLogico($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $resultado = $oLMantenimientoGeneral->grabarAmbienteLogico($datos);
        return $resultado;
    }

    /*     * ****************MANTENIMIENTO ASIGNACION AMBIENTES LOGICOS X AMBIENTES FISICOS************************************** */

    function mostrarTablaAsignacionAmbientesFisicosaAmbientesLogicos($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $datos == '' ? $arrayFilas1 = array() : $arrayFilas1 = $oLMantenimientoGeneral->getListaAsignacionAmbienteFisicosaAmbientesLogicos($datos);
        $arrayTipo = array("3" => "c", "4" => "c", "5" => "", "7" => "h", "8" => "h", "9" => "c");
        $arrayCabecera = array("3" => "SEDE", "4" => "AMBIENTE FÍSICO", "5" => "ACTIVIDAD", "7" => "...", "8" => "...", "9" => " ");
        $row_ini = "<table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'>";
        $row_fin = "</table>";
        $o_Html = new Tabla1($arrayCabecera, 15, $arrayFilas1, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', '', 0, $arrayTipo, 0);
        $tablaHTML = $o_Html->getTabla();
        return "<div style=\"width:90%;height:90%\">" . $row_ini . $tablaHTML . $row_fin . "</div>";
    }

    function obtenerAsignacionAmbientesFisicosaAmbientesLogicos($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $datos == '' ? $arrayFilas1 = array() : $arrayFilas1 = $oLMantenimientoGeneral->getListaAsignacionAmbienteFisicosaAmbientesLogicos($datos);
        $arrayTipo = array("3" => "c", "4" => "c", "5" => "", "7" => "h", "8" => "h", "9" => "c");
        $arrayCabecera = array("3" => "SEDE", "4" => "AMBIENTE FÍSICO", "5" => "ACTIVIDAD", "7" => "...", "8" => "...", "9" => " ");
        $row_ini = "<table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'>";
        $row_fin = "</table>";
        $o_Html = new Tabla1($arrayCabecera, 15, $arrayFilas1, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', '', 0, $arrayTipo, 0);
        $tablaHTML = $o_Html->getTabla();

        $codEmpresa = "0110073";
        $nomSede = "%";
        $arrayCombo = $oLMantenimientoGeneral->getArrayListaSedes($codEmpresa, $nomSede);
        $o_Combo = new Combo($arrayCombo);
        $opcionesHTML_01 = $o_Combo->getOptionsHTML();
        $row_ochg_sede = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=seleccionAmbientesFisicos&p2='+document.getElementById('cboSede').value,'div_ambfisicos');\"";
        $row_sede = "<select tabindex=2 id=\"cboSede\" name=\"cboSede\"" . $row_ochg_sede . " title=\"Sede\">";
        $row_fin_cb = "</select>";

        $arrayComboActividades = $oLMantenimientoGeneral->getArrayListaActividades();
        $o_ComboActividad = new Combo($arrayComboActividades);
        $opcionesHTML_03 = $o_ComboActividad->getOptionsHTML();
        $row_actividad = "<select tabindex=2 id=\"cboActividad\" name=\"cboActividad\" title=\"Actividad\">";
        $row_fin_cb = "</select>";

        require_once('../../cvista/mantenimientogeneral/asignacionambientesfisicosaambienteslogicos.php');
    }

    public function agregarAmbienteFisicoaAmbienteLogico($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $resultado = $oLMantenimientoGeneral->agregarAmbienteFisicoaAmbienteLogico($datos);
        return $resultado;
    }

    public function activarydesactivarAsignacionAmbFisicoaAmbLogico($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $resultado = $oLMantenimientoGeneral->activarydesactivarAsignacionAmbFisicoaAmbLogico($datos);
        return $resultado;
    }

    public function eliminarAsignacionAmbFisicoaAmbLogico($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $resultado = $oLMantenimientoGeneral->eliminarAsignacionAmbFisicoaAmbLogico($datos);
        return $resultado;
    }
      public function aguardarMantenimientoIp($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $resultado = $oLMantenimientoGeneral->lguardarMantenimientoIp($datos);
        return $resultado;
    }
     public function actualizarMantenimiento($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $resultado = $oLMantenimientoGeneral->actualizarMantenimiento($datos);
        return $resultado;
    }
    
      public function eliminarMantenimiento($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $resultado = $oLMantenimientoGeneral->eliminarMantenimiento($datos);
        return $resultado;
    }
    
    
    
    

    public function mantenimientoAlmacenes() {
        $oLRrhh = new LRrhh();
        require_once '../../cvista/mantenimientogeneral/Mantenimiento_Almacen.php';
    }

    public function resultadoalmacenes() {
        $oLMantenimientoGeneral = new LMantenimientoGeneral;
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $oLMantenimientoGeneral->getListarAlmacenes();
        //$arrayExp = array();

        $arrayCabecera = array("0" => "Id", "1" => "Cod. Per", "2" => "Nombre Almacen", "3" => "Sede", "4" => "Editar");
        $arrayTamano = array("0" => "30", "1" => "70", "2" => "*", "3" => "*", "4" => "50");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "img");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "center", "3" => "center", "4" => "pointer");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "lefth", "3" => "lefth", "4" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function asignarAmbienteFisico() {
        require_once '../../cvista/mantenimientogeneral/AsignaAmbienteFisico.php';
    }

    public function aMantenimientoAlmacen($datos) {
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();
        $idAlmacen = $datos['idAlmacen'];
        $arrayDatosAlmacen = $o_LMantenimientoGeneral->lCargarDatosMantenimientoAlmacen($datos);
        $arrayComboM = $o_LMantenimientoGeneral->comboSedes();
        $o_ComboM = new Combo($arrayComboM);
        $optionsHTML = $arrayDatosAlmacen[0][2];
        $comboM = $o_ComboM->getOptionsHTML($optionsHTML);
        require_once '../../cvista/mantenimientogeneral/NuevoAlmacen.php';
    }

    public function buscarAmbienteFisico($codigoSucursal, $txtNombreAmbienteFisico) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLMantenimientoGeneral->buscarAmbienteFisico($codigoSucursal, $txtNombreAmbienteFisico);

        $arrayCabecera = array(0 => "iCodigoAmbienteFisico", 1 => "NombreAmbienteFisico", 2 => "DescAmbienteFisico", 3 => "Accion");
        $arrayTamano = array(0 => "*", 1 => "*", 2 => "*", 3 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "false");
        $arrayAling = array(0 => "left", 1 => "center", 2 => "center", 3 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
        return $resultado;
    }
    
     public function cargarTablaIPs() {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLMantenimientoGeneral->cargarTablaIPs();
        $arrayCabecera = array(0 => "Id", 1 => "IP", 2 => "Nombre PC",  3 => "Ambiente",   4 => "IdAmbiente",5 => "Editar", 6 => "Eliminar");
        $arrayTamano = array(0 => "30", 1 => "*", 2 => "*", 3 => "*", 4 => "*", 5 => "40", 6 => "40");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro",3 => "ro",4 => "ro",5 => "img", 6 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default",  4 => "default",5 => "pointer", 6 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false",3 => "false",4 => "true", 5 => "false", 6 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "center", 6 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);

    }
    
     public function cargarTablaAmbientes() {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLMantenimientoGeneral->cargarTablaAmbientes();
        $arrayCabecera = array(0 => "Id", 1 => "Nombre", 2 => "Descripcion", 3 => "Agregar");
        $arrayTamano = array(0 => "30", 1 => "50", 2 => "*", 3 => "40");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);

    }
    

    public function guardarAlmacen($datos) {

        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLMantenimientoGeneral->guardarAlmacen($datos);
    }

    // 2012/02/27 jose
    public function guardarSedeEmpresaAreaMasivamente($cadenaIdArea, $cadenaIdSede) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLMantenimientoGeneral->guardarSedeEmpresaAreaMasivamente($cadenaIdArea, $cadenaIdSede);

        $arrayCabecera = array(0 => "Sede", 1 => "Descripción", 2 => "estado");
        $arrayTamano = array(0 => "200", 1 => "500", 2 => "150");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);

        //  echo $cadenaIdArea;
        // echo $cadenaIdSede;
//        
//         $arrayCabecera = array(0 => "idArea", 1 => "idDependencia", 2 => "Descripcion", 3 => "Abreviatura",4 => "estado", 5 => "Estado",6 => "Accion");
//        $arrayTamano = array(0 => "50", 1 => "280", 2 => "350", 3 => "100",4 => "50", 5 => "90", 6 => "50");
//        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro",4 => "ro", 5 => "ro", 6 => "img");
//        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default",4 => "default", 5 => "default", 6 => "pointer");
//        $arrayHidden = array(0 => "true", 1 => "true", 2 => "false", 3 => "false",4 => "true", 5 => "false", 6 => "false");
//        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left",4 => "left", 5 => "left", 6 => "center");
    }

    public function tablaSucursalesXidArea($idArea) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLMantenimientoGeneral->tablaSucursalesXidArea($idArea);

        $arrayCabecera = array(0 => "idSedeEmpresaArea", 1 => "IdSedeEmpresa", 2 => "Sede", 3 => "idArea", 4 => "Área", 5 => "estado", 6 => "Estado", 7 => "Editar", 8 => "Eliminar");
        $arrayTamano = array(0 => "150", 1 => "100", 2 => "200", 3 => "100", 4 => "290", 5 => "100", 6 => "150", 7 => "60", 8 => "60");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "img", 8 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "false", 3 => "true", 4 => "false", 5 => "true", 6 => "false", 7 => "true", 8 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left", 7 => "center", 8 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    //2012/02/28 Jose
    public function preeditaArea($idArea) {
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();
        $p = $o_LMantenimientoGeneral->preeditaArea($idArea);
        $estado = $p['0']['0'];
        $Abreviatura = $p['0']['1'];
        return trim($estado . "|" . $Abreviatura);
    }

    public function preeditaAreaXSedeEmpresa($idArea, $idSedeEmpresa, $nivel) {
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();
        $p = $o_LMantenimientoGeneral->preeditaAreaXSedeEmpresa($idArea, $idSedeEmpresa, $nivel);
        $Abreviatura = $p['0']['0'];
        $estado = $p['0']['1'];
        $idSedeEmpresaArea = $p['0']['2'];
        return trim($estado . "|" . $Abreviatura . "|" . $idSedeEmpresaArea);
    }

    function aCargarDatosMantenimientoAlmacen($datos) {
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();
        // $idAlmacen = $datos['idAlmacen'];
        $arrayDatosAlmacen = $o_LMantenimientoGeneral->lCargarDatosMantenimientoAlmacen($datos);
        require_once '../../cvista/mantenimientogeneral/NuevoAlmacen.php';
    }

    public function grabarAreaJerarquicamente($datos) {
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();
        $resultado = $o_LMantenimientoGeneral->grabarAreaJerarquicamente($datos);
        return $resultado;
    }

    //Jose 2012/03/01
    public function actualizarEstadoSedeEmpresaArea($datos) {
        $o_LMantenimientoGeneral = new LMantenimientoGeneral();
        $resultado = $o_LMantenimientoGeneral->actualizarEstadoSedeEmpresaArea($datos);
        return $resultado;
    }

    //Muestra texto
    public function presentacionTurnos($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $arrayFilas = $oLMantenimientoGeneral->presentacionTurnos($datos);
        $turnosDescripcion = '';
        foreach ($arrayFilas as $i => $value) {
            if ($value[6] != '') {
                if ($turnosDescripcion == '') {
                    $turnosDescripcion = $value[6];
                } else {
                    $turnosDescripcion = $turnosDescripcion . '--' . $value[6];
                }
            }
        }


        //$txtTurnos = '<input type="text" size="80" name="txtdescripcionTurno" value="'.$turnosDescripcion.'"/> ';
        $txtTurnos = '<table ><tr><td><h2><font color="red"><b>' . $turnosDescripcion . '</b></font></h2></td></tr></table>';


//       $txtTurnos = '<select id="cboSedeEmpresaArea" name="cboSedeEmpresaArea" style="width: 200px;">';
//        $cboSedeEmpresaArea.='<option  value="' . $value[0] . '|' . $value[1] . '">' . htmlentities($value[2]) . '</option>';
        return $txtTurnos;
    }

    public function ventanaAsignaAreaSede() {

        $oLRrhh = new LRrhh();
        $comboSucursal = $oLRrhh->listaSucursal('0110073', '');
        require_once("../../cvista/mantenimientogeneral/vAsignaAreaSede.php");
    }

    public function actualizacionLogicaSedeEmpresaArea($idSedeEmpresaArea) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $arrayFilas = $oLMantenimientoGeneral->actualizacionLogicaSedeEmpresaArea($idSedeEmpresaArea);
    }

    public function pruebaHorarios() {
        require_once("../../cvista/rrhh/vPruebaFechas.php");
    }

    public function grabarMantenimientoAlmacen($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        //$idAlmacen = $datos['codPersona'];
        $arrayDatosAlmacen = $oLMantenimientoGeneral->grabarMantenimientoAlmacen($datos);
        require_once '../../cvista/mantenimientogeneral/NuevoAlmacen.php';
    }

    public function grabarAgregarAlmacen($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        //$idAlmacen = $datos['iIdCodigoAlmacen'];
        $arrayDatosAlmacen = $oLMantenimientoGeneral->lgrabarAgregarAlmacen($datos);
        require_once '../../cvista/mantenimientogeneral/NuevoAlmacen.php';
    }

    //Mantenimiento Unidad de Medida  - Sayes
    public function vistaUnidadMedida() {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        require_once '../../cvista/mantenimientogeneral/vistaUnidadMedida.php';
    }

    public function tablaUnidadMedida() {
        $oLMantenimientoGeneral = new LMantenimientoGeneral;
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $oLMantenimientoGeneral->getUnidadMedida();
        $arrayCabecera = array("0" => "Id", "1" => "Tipo Unidad Medida", "2" => "Editar", "3" => "Eliminar");
        $arrayTamano = array("0" => "45", "1" => "*", "2" => "45", "3" => "50");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "img", "3" => "img");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "pointer", "3" => "pointer");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "center", "3" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function tablaUnidad($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral;
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $oLMantenimientoGeneral->getUnidad($datos);
        $arrayCabecera = array("0" => "Id", "1" => "Unidad Medida", "2" => "Principal", "3" => "Equivalente", "4" => "Editar", "5" => "Eliminar");
        $arrayTamano = array("0" => "45", "1" => "*", "2" => "*", "3" => "*", "4" => "45", "5" => "50");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ra", "3" => "ro", "4" => "img", "5" => "img");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "default", "3" => "default", "4" => "pointer", "5" => "pointer");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "lefth", "3" => "lefth", "4" => "center", "5" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function MantenimientoTiposUnidadMedida($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $arrayDatosUnidad = $oLMantenimientoGeneral->lMantenimientoTiposUnidadMedida($datos);
        require_once '../../cvista/mantenimientogeneral/PopadMantenimientoTipoUnidadMedida.php';
    }

    public function MantenimientoEliminarTiposUnidadMedida($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $arrayDatosUnidad = $oLMantenimientoGeneral->lMantenimientoTiposUnidadMedida($datos);
        require_once '../../cvista/mantenimientogeneral/PopadEliminarTipoUnidadMedida.php';
    }

    public function MantenimientoEliminarUnidadMedida($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $arrayDatosUnidadMedida = $oLMantenimientoGeneral->lMantenimientoUnidadMedida($datos);
        require_once '../../cvista/mantenimientogeneral/PopadEliminarUnidadMedida.php';
    }

    public function EliminarTipoUnidadMedida($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $arrayDatosUnidad = $oLMantenimientoGeneral->EliminarTipoUnidadMedida($datos);
        require_once '../../cvista/mantenimientogeneral/PopadEliminarTipoUnidadMedida.php';
    }

    public function modificarRadioButtonUnidadMedida($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();

        $resultado = $oLMantenimientoGeneral->lmodificarRadioButtonUnidadMedida($datos);
        return $resultado;
    }

    public function EliminarUnidadMedida($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $arrayDatosUnidadMedida = $oLMantenimientoGeneral->EliminarUnidadMedida($datos);
        require_once '../../cvista/mantenimientogeneral/PopadEliminarUnidadMedida.php';
    }

    public function grabarMantenimientoTipoUnidadMedida($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $arrayDatosUnidad = $oLMantenimientoGeneral->grabarMantenimientoTipoUnidadMedida($datos);
        require_once '../../cvista/mantenimientogeneral/PopadMantenimientoTipoUnidadMedida.php';
    }

    public function grabarAgregarTipoUnidadMedida($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $arrayDatosUnidad = $oLMantenimientoGeneral->grabarAgregarTipoUnidadMedida($datos);
        require_once '../../cvista/mantenimientogeneral/PopadMantenimientoTipoUnidadMedida.php';
    }

    public function MantenimientoUnidadMedida($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $arrayDatosUnidadMedida = $oLMantenimientoGeneral->lMantenimientoUnidadMedida($datos);
        require_once '../../cvista/mantenimientogeneral/PopadMantenimientoUnidadMedida.php';
    }

    public function grabarMantenimientoUnidadMedida($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        // $idAlmacen = $datos['codPersona'];
        $arrayDatosUnidadMedida = $oLMantenimientoGeneral->grabarMantenimientoUnidadMedida($datos);
        require_once '../../cvista/mantenimientogeneral/PopadMantenimientoUnidadMedida.php';
    }

    public function grabarAgregarUnidadMedida($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $arrayDatosUnidadMedida = $oLMantenimientoGeneral->grabarAgregarUnidadMedida($datos);
        require_once '../../cvista/mantenimientogeneral/PopadMantenimientoUnidadMedida.php';
    }
     public function agregarCIEaGrupoEtareo($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $resultado = $oLMantenimientoGeneral->agregarCIEaGrupoEtareo($datos);
        return $resultado[0][0];
    }
    public function cambiarEstadoCieGrupoEtareo($datos) {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $resultado = $oLMantenimientoGeneral->cambiarEstadoCieGrupoEtareo($datos);
        return $resultado;
    }
    

    public function listarGrupoEtareo() {
        require_once("tablaAngelSayes.php");
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $tabla = new TablaAngelSayes();
        $array = $oLMantenimientoGeneral->listarGrupoEtareo();
        // print_r($array);
        $arrayWidth = array(0 => "40", 1 => "600", 2 => "40");
        $arrayTitulos = array(0 => "Id", 1 => "Grupo Etareo", 2 => "Ver");
        $arrayAlign = array(0 => "center", 1 => "left", 2 => "center");
        $arrayType = array(0 => "text", 1 => "text", 2 => "text");
        $arrayCursor = array(0 => "pointer", 1 => "pointer" , 2 => "pointer");
        $arrayImagenPorCelda = array(0 => "0", 1 => "0", 2 => "1");
        $arrayUrlImagen = array(0 => "", 1 => "", 2 => "../../../../medifacil_front/imagen/icono/Download.png");
        $arrayFunction = array(0 => "", 1 => "", 2 => "verListaDeCiePorGrupoEtareo");
        $arrayTitle = array(0 => "", 1 => "", 2 => "Ver Lista");
        $arrayFunctionXCelda = array(0 => "verListaDeCiePorGrupoEtareo", 1 => "verListaDeCiePorGrupoEtareo", 2 => "");
        $numDatosEnviadosFuncionCadena=1;
         $scroll=0;
        $height = 300;
        $resultado = $tabla->contructorTabla($scroll,$numDatosEnviadosFuncionCadena,$arrayFunctionXCelda, $arrayTitle, $arrayFunction, $arrayImagenPorCelda, $arrayUrlImagen, $array, $arrayWidth, $arrayTitulos, $arrayAlign, $arrayType, $arrayCursor, $height);
    }
    
    
    
    
    
     public function buscarCieListado($nombreCie) {
         require_once("tablaAngelSayes.php");
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $tabla = new TablaAngelSayes();
        $array = $oLMantenimientoGeneral->buscarCieListado($nombreCie);
        // print_r($array);
        $arrayWidth = array(0 => "40", 1 => "400", 2 => "40");
        $arrayTitulos = array(0 => "Id", 1 => "Descripcion", 2 => "...");
        $arrayAlign = array(0 => "center", 1 => "left", 2 => "center");
        $arrayType = array(0 => "text", 1 => "text", 2 => "text");
        $arrayCursor = array(0 => "pointer", 1 => "pointer", 2 => "pointer");
        $arrayImagenPorCelda = array(0 => "0", 1 => "0", 2 => "1");
        $arrayUrlImagen = array(0 => "", 1 => "", 2 => "../../../../medifacil_front/imagen/icono/apply.png");
        $arrayFunction = array(0 => "", 1 => "", 2 => "agregarCIEaGrupoEtareo");
        $arrayTitle = array(0 => "", 1 => "", 2 => "Agregar");
        $arrayFunctionXCelda = array(0 => "", 1 => "", 2 => "");
           $numDatosEnviadosFuncionCadena=1;
            $scroll=0;
        $height = 250;
        $resultado = $tabla->contructorTabla($scroll,$numDatosEnviadosFuncionCadena,$arrayFunctionXCelda, $arrayTitle, $arrayFunction, $arrayImagenPorCelda, $arrayUrlImagen, $array, $arrayWidth, $arrayTitulos, $arrayAlign, $arrayType, $arrayCursor, $height);
    }


    public function listarCie() {
        require_once("tablaAngelSayes.php");
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $tabla = new TablaAngelSayes();
        $array = $oLMantenimientoGeneral->listarCie();
        // print_r($array);
        $arrayWidth = array(0 => "40", 1 => "400", 2 => "40");
        $arrayTitulos = array(0 => "Id", 1 => "Descripcion", 2 => "...");
        $arrayAlign = array(0 => "center", 1 => "left", 2 => "center");
        $arrayType = array(0 => "text", 1 => "text", 2 => "text");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer");
        $arrayImagenPorCelda = array(0 => "0", 1 => "0", 2 => "1");
        $arrayUrlImagen = array(0 => "", 1 => "", 2 => "../../../../medifacil_front/imagen/icono/apply.png");
        $arrayFunction = array(0 => "", 1 => "", 2 => "agregarCIEaGrupoEtareo");
        $arrayTitle = array(0 => "", 1 => "", 2 => "Agregar");
        $arrayFunctionXCelda = array(0 => "", 1 => "", 2 => "");
          $numDatosEnviadosFuncionCadena=1;
           $scroll=0;
        $height = 250;
        $resultado = $tabla->contructorTabla($scroll,$numDatosEnviadosFuncionCadena,$arrayFunctionXCelda, $arrayTitle, $arrayFunction, $arrayImagenPorCelda, $arrayUrlImagen, $array, $arrayWidth, $arrayTitulos, $arrayAlign, $arrayType, $arrayCursor, $height);
    }

    public function verListaDeCiePorGrupoEtareo($iIdGrupoEtareo) {
        require_once("tablaAngelSayes.php");
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $tabla = new TablaAngelSayes();
        $array = $oLMantenimientoGeneral->verListaDeCiePorGrupoEtareo($iIdGrupoEtareo);
        //print_r($array);
        $arrayWidth = array(0 => "100", 1 => "100" , 2 => "100", 3 => "800", 4 => "90");
        $arrayTitulos = array(0 => "Id Cie", 1 => "IdDetalle",2 => "Codigo Cie", 3 => "Descripcion", 4 => "Estado");
        $arrayAlign = array(0 => "center", 1 => "center", 2 => "center", 3 => "left",4 => "center");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default",  3 => "default", 4 => "pointer");
        $arrayType = array(0 => "text", 1 => "text", 2 => "text", 3 => "text", 4=> "bit");
        $arrayFunctionXCelda = array(0 => "", 1 => "", 2 => "", 3 => "" ,4 => "" );
        $arrayImagenPorCelda = array(0 => "0", 1 => "0", 2 => "0", 3 => "0",4 => "0");
        $arrayUrlImagen = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "");
        $arrayFunction = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "cambiarEstadoCieGrupoEtareo");
        $arrayTitle = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "Cambiar Estado");
          $numDatosEnviadosFuncionCadena=1;
           $scroll=0;
        $height = 250;
        $resultado = $tabla->contructorTabla($scroll,$numDatosEnviadosFuncionCadena ,$arrayFunctionXCelda, $arrayTitle, $arrayFunction, $arrayImagenPorCelda, $arrayUrlImagen, $array, $arrayWidth, $arrayTitulos, $arrayAlign, $arrayType, $arrayCursor, $height);
    }

}

?>
