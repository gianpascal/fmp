<?php

require_once("../../../pholivo/adophp/Adophp.class.php");
require_once("../../../pholivo/Conexion.php");

class DPersonas extends Adophp {

    private $cnx;
    private $usuario;
    private $hostname;

    public function __construct($cnx = Array()) {
        $this->usuario = strtoupper($_SESSION['login_user']);
        $this->hostname = $_SESSION['host'];
        $this->cnx = empty($cnx) ? Conexion::getInitDsnMSSQLSimedh() : $cnx;
        parent::__construct('Spanish', $this->cnx);
    }

    /* public function listaPersonasAdmision($opcion,$patron){
      //echo "$opcion,$patron";
      parent::ConnectionOpen("paxadmision","dbweb");
      parent::SetParameterSP("$1",$opcion);
      parent::SetParameterSP("$2",$patron);
      parent::SetParameterSP("$3",'');
      $resultado=parent::executeSPArrayX();
      return $resultado;
      } */

    //Lista personas filtradas por apellidos paterno y materno.
    public function listaPersonasAdmisionxApellidos($paterno, $materno) {
        $cadena = "and vApellidoPaterno=''" . strtoupper(trim($paterno)) . "'' and vApellidoMaterno=''" . strtoupper(trim($materno)) . "''";
        parent::ConnectionOpen("pnsBuscaPersonas", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", $cadena);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista documentos de identidad de una persona.
    public function listaDocumentoIdentidad($c_cod_per) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", $opcion);
        parent::SetParameterSP("$2", $patron);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function validaPersonasDocIdentidad($tipo_documento, $nro_documento) {
        parent::ConnectionOpen("pnsBuscaPersonas", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", $nro_documento);
        parent::SetParameterSP("$3", $tipo_documento);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista personas filtradas por apellido paterno, materno y nombre.
    public function validaPersonasNombres($paterno, $materno, $nombres) {
        $cadena = "and vApellidoPaterno=''" . strtoupper(trim($paterno)) . "'' and vApellidoMaterno=''" . strtoupper(trim($materno)) . "'' and vNombre=''" . strtoupper(trim($nombres)) . "''";
        parent::ConnectionOpen("pnsBuscaPersonas", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", $cadena);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function seleccionarEstadoCivil() {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '07');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla grupos sanguíneos.
    public function seleccionarGrupoSanguineo() {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '10');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla medios de contacto.
    public function seleccionarMediosContacto() {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '18');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla clases de raza.
    public function seleccionarClaseRaza($sp1) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '11');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla tipo de vías.
    public function seleccionarTipoVia() {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '08');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla tipo de centros poblados.
    public function seleccionarTipoCentroPoblado() {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '09');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla grupo laboral.
    public function seleccionarGrupoLaboral() {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '12');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla subgrupo laboral.
    public function seleccionarSubgrupoLaboral($grupo_laboral) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '13');
        parent::SetParameterSP("$2", $grupo_laboral);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla condiciones laborales.
    public function seleccionarCondicionLaboral($sp1) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '14');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla grado de instrucción.
    public function seleccionarGradoInstruccion($sp1) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '15');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla tipo de Instituciones educativas.
    public function seleccionarTipoInstEducativa() {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '24');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla instituciones educativas.
    public function seleccionarInstEducativa($tipoInstitucion) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '25');
        parent::SetParameterSP("$2", $tipoInstitucion);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla grados de estudio.
    public function seleccionarGradoEstudio($tipoInstitucion) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '16');
        parent::SetParameterSP("$2", $tipoInstitucion);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla clases de vivienda.
    public function seleccionarClaseVivienda($sp1) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '17');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla medios de contacto.
    public function listaMediosDeContacto($sp1) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '18');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla tipos de documento.
    public function listaTiposDeDocumento($sp1) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '19');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla tipos de dirección.
    public function listaTiposDeDireccion($sp1) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '20');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla nsmAfiliacion.
    public function listaFiliacionPaciente($c_cod_per) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", $c_cod_per);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista las no afiliaciones de un paciente.
    public function listaNoFiliacionPaciente($c_cod_per) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '22');
        parent::SetParameterSP("$2", $c_cod_per);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista derecho habientes para una persona de una afiliación determinada.
    public function ListaDerHabienteFiliacion($c_cod_per, $cAfiliacion) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '23');
        parent::SetParameterSP("$2", $c_cod_per);
        parent::SetParameterSP("$3", $cAfiliacion);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista atenciones de un paciente en el tiempo.
    public function ListaPersonaCitas($c_cod_per) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '26');
        parent::SetParameterSP("$2", $c_cod_per);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista datos de hospitalización de una persona.
    public function ListaPersonaHospitalizacion($c_cod_per) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '28');
        parent::SetParameterSP("$2", $c_cod_per);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista tabla vínculo familiar.
    public function seleccionarVinculoFamiliar() {//Combo  Vinculo Familiar
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '27');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function genera_historia() {
        parent::ConnectionOpen("GenConsultas", "dbo");  //dbweb
        parent::SetParameterSP("$1", '12');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* public function getArrayPersonasDatos($iid_dato_nivel1){
      parent::ConnectionOpen("paxadmision","dbweb");
      parent::SetParameterSP("$1",'25');
      parent::SetParameterSP("$2",'');
      parent::SetParameterSP("$3",'');
      $resultado=parent::executeSPArrayX();
      return $resultado;
      } */

    //////////////////////FUNCIONES REGISTRO Y MANTENIMEINTO DE PERSONAS///////////////////////
    //Obtiene el código de c_cod_per incrementando en 1 a la tabla de dbweb.nsmContador.
    public function generaCodigoPersona() {
        parent::ConnectionOpen("pnsAdmision_inserta", "dbweb");
        parent::SetParameterSP("$1", '10');
        $resultado = parent::executeSPArrayX();
        return $resultado[0][0];
    }

    ///******************Actualizar fotos del paciente***************///////////////
    public function actualizarFotoPersona($codPersona, $nomFoto) {
        parent::ConnectionOpen("pnsAdmision_inserta", "dbweb");
        parent::SetParameterSP("$1", "18");
        parent::SetParameterSP("$2", $codPersona);
        parent::SetParameterSP("$3", $nomFoto);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Inserta o edita los datos principales de una persona.
    public function mantePersona($c_tipo, $p_iid, $arrP) {
        if (strcmp($arrP['p27'], '0000') == 0 || strcmp($arrP['p28'], '0000') == 0) {
            $ocupaciones = "";
        } else {
            $ocupaciones = $arrP['p27'] . $arrP['p28'] . "00000";
        }
        parent::ConnectionOpen("pnsAdmision_inserta", "dbweb");
        parent::SetParameterSP("$1", $c_tipo);
        parent::SetParameterSP("$2", $p_iid);
        parent::SetParameterSP("$3", "");
        parent::SetParameterSP("$4", $arrP['p4']);
        parent::SetParameterSP("$5", $arrP['p5']);
        parent::SetParameterSP("$6", $arrP['p6']);
        parent::SetParameterSP("$7", "1");
        parent::SetParameterSP("$8", "");
        parent::SetParameterSP("$9", $arrP['p43']);
        parent::SetParameterSP("$10", $arrP['p7']);
        parent::SetParameterSP("$11", $arrP['p9']);
        parent::SetParameterSP("$12", $arrP['p25']);
        parent::SetParameterSP("$13", $arrP['p10']);
        parent::SetParameterSP("$14", $arrP['p34']); //cb_vivienda
        parent::SetParameterSP("$15", $arrP['p30']); //Nivel Educativo
        parent::SetParameterSP("$16", $ocupaciones); //Ocupacion laboral
        parent::SetParameterSP("$17", $arrP['p29']);
        parent::SetParameterSP("$18", "");
        parent::SetParameterSP("$19", $arrP['p37']);
        parent::SetParameterSP("$20", $arrP['p35']);
        parent::SetParameterSP("$21", $arrP['p26']);
        parent::SetParameterSP("$22", $arrP['p42']);
        parent::SetParameterSP("$23", $arrP['p36']);
        parent::SetParameterSP("$24", $this->usuario);
        parent::SetParameterSP("$25", $this->hostname);
        parent::SetParameterSP("$26", $arrP['p38']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Inserta o edita las direcciones de una persona.
    public function mantePersonaDireccion($c_tipo, $p_iid, $arrP) {
        //echo "$c_tipo $arrP[p15]";
        parent::ConnectionOpen("pnsAdmision_inserta", "dbweb");
        parent::SetParameterSP("$1", trim($c_tipo));
        parent::SetParameterSP("$2", $p_iid);
        parent::SetParameterSP("$3", '01');
        parent::SetParameterSP("$4", $arrP['p45']);
        parent::SetParameterSP("$5", $arrP['p16']);
        parent::SetParameterSP("$6", $arrP['p18']);
        parent::SetParameterSP("$7", $arrP['p15']);
        parent::SetParameterSP("$8", $arrP['p17']);
        parent::SetParameterSP("$9", $arrP['p21']);
        parent::SetParameterSP("$10", $arrP['p22']);
        parent::SetParameterSP("$11", $arrP['p20']);
        parent::SetParameterSP("$12", '1');
        parent::SetParameterSP("$13", $arrP['p23']);
        parent::SetParameterSP("$14", $arrP['p19']);
        parent::SetParameterSP("$15", $this->usuario);
        parent::SetParameterSP("$16", $this->hostname);
        parent::SetParameterSP("$17", $arrP['p44']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Inserta o edita las direcciones de nacimiento de una persona.
    public function mantePersonaDireccionNac($c_tipo, $p_iid, $arrP) {
        //echo "$c_tipo,$p_iid,$arrP[p26]";
        parent::ConnectionOpen("pnsAdmision_inserta", "dbweb");
        parent::SetParameterSP("$1", $c_tipo);
        parent::SetParameterSP("$2", $p_iid);
        parent::SetParameterSP("$3", '02');
        parent::SetParameterSP("$4", $arrP['p46']);
        parent::SetParameterSP("$5", '0000');
        parent::SetParameterSP("$6", '0000');
        parent::SetParameterSP("$7", $arrP['p26']);
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        parent::SetParameterSP("$12", '1');
        parent::SetParameterSP("$13", '');
        parent::SetParameterSP("$14", '');
        parent::SetParameterSP("$15", $this->usuario);
        parent::SetParameterSP("$16", $this->hostname);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Inserta o edita los estudios de una persona.
    public function mantePersonaEstudios($c_tipo, $p_iid, $arrP) {
        //echo "$c_tipo,$p_iid,$arrP[p32],$arrP[p33]";
        parent::ConnectionOpen("pnsAdmision_inserta", "dbweb");
        parent::SetParameterSP("$1", $c_tipo);
        parent::SetParameterSP("$2", $p_iid);
        parent::SetParameterSP("$3", $arrP['p32']);
        parent::SetParameterSP("$4", $arrP['p33']);
        parent::SetParameterSP("$5", $this->usuario);
        parent::SetParameterSP("$6", $this->hostname);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Verifica si el registro de un paciente está con los datos completos.
    public function mantePersonaCompleto($p_iid) {
        //echo $p_iid;
        parent::ConnectionOpen("pnsAdmision_inserta", "dbweb");
        parent::SetParameterSP("$1", '17');
        parent::SetParameterSP("$2", $p_iid);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Inserta o edita los documentos de identidad de una persona.
    public function mantePersonaDocumentos($c_tipo, $p_iid, $tipoDoc, $numDoc) {
        parent::ConnectionOpen("pnsAdmision_inserta", "dbweb");
        parent::SetParameterSP("$1", $c_tipo);
        parent::SetParameterSP("$2", $p_iid);
        parent::SetParameterSP("$3", $tipoDoc);
        parent::SetParameterSP("$4", $numDoc);
        parent::SetParameterSP("$5", $this->usuario);
        parent::SetParameterSP("$6", $this->hostname);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Inserta o edita los derecho habientes.
    public function mantePersonaDerHab($cAfiliacion, $c_cod_per, $c_cod_per_r, $c_cod_per_h) {
        //echo "$cAfiliacion,$c_cod_per,$c_cod_per_r,$c_cod_per_h<br>";
        parent::ConnectionOpen("pnsAdmision_inserta", "dbweb");
        parent::SetParameterSP("$1", '16');
        parent::SetParameterSP("$2", $c_cod_per);
        parent::SetParameterSP("$3", $cAfiliacion);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", $c_cod_per_r);
        parent::SetParameterSP("$8", $c_cod_per_h);
        parent::SetParameterSP("$15", $this->usuario);
        parent::SetParameterSP("$16", $this->hostname);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Inserta o edita los contactos de una persona.
    public function mantePersonaContactos($c_tipo, $p_iid, $tipoContacto, $valor) {
        //echo "$c_tipo,$p_iid,$tipoContacto,$valor<br>";
        parent::ConnectionOpen("pnsAdmision_inserta", "dbweb");
        parent::SetParameterSP("$1", $c_tipo);
        parent::SetParameterSP("$2", $p_iid);
        parent::SetParameterSP("$3", $tipoContacto);
        parent::SetParameterSP("$4", $valor);
        parent::SetParameterSP("$5", "");
        parent::SetParameterSP("$6", $this->usuario);
        parent::SetParameterSP("$7", $this->hostname);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //lista los paises.
    public function getArraylistaDatosPais() {
        parent::ConnectionOpen("pnsUbigeo", "dbweb");
        parent::SetParameterSP("$1", 'pais');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //lista los departamentos del Perú.
    public function getArraylistaDatosUbigeoDep($pais) {
        parent::ConnectionOpen("pnsUbigeo", "dbweb");
        parent::SetParameterSP("$1", 'dpt');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", $pais);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista las provincias del Perú.
    public function getArraylistaDatosUbigeoProv($anioUbigeo, $dep_ubi) {
        parent::ConnectionOpen("pnsUbigeo", "dbweb");
        parent::SetParameterSP("$1", 'prv');
        parent::SetParameterSP("$2", $dep_ubi);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista los distritos del Perú.
    public function getArraylistaDatosUbigeoDist($anioUbigeo, $dep_ubi, $pro_ubi) {
        parent::ConnectionOpen("pnsUbigeo", "dbweb");
        parent::SetParameterSP("$1", 'dst');
        parent::SetParameterSP("$2", $dep_ubi);
        parent::SetParameterSP("$3", $pro_ubi);
        parent::SetParameterSP("$4", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* public function getArraylistaAnioUbigeo(){
      parent::ConnectionOpen("sel_cano_ubigeo","hospitalizacion");
      parent::SetSelect("*");
      $resultado=parent::ExecuteSPArray();
      return $resultado[0]['sel_cano_ubigeo'];
      } */

    public function getVerificacionAfiliacionPrecio($parametros) {
        $idafiliacion = $parametros["iidafiliacion"];
        $idservicioproducto = $parametros["idservicioproducto"];
        parent::ConnectionOpen("verificarprecioafiliacion", "dbweb");
        parent::SetParameterSP("codigoafiliacion", $idafiliacion);
        parent::SetParameterSP("codigoservicioproducto", $idservicioproducto);
        //parent::SetParameterSP("Mensaje",'');
        $resultado = parent::ExecuteStoreProcedure();
        echo $resultado . "luis";
        return $resultado;
    }

    //Asigna una afiliaciación a un paciente.
    public function AgregaFiliacion($cAfiliacion, $c_cod_per, $ipare, $bTitular, $c_cod_per_r, $bUAfiliacion, $besta, $dvi_i, $dvi_f, $bcadu) {
        //echo "$cAfiliacion,$c_cod_per,$ipare,$bTitular,$c_cod_per_r,$bUAfiliacion,$besta,$dvi_i,$dvi_f,$bcadu";
        parent::ConnectionOpen("pnsAdmision_inserta", "dbweb");
        parent::SetParameterSP("$1", '16');
        parent::SetParameterSP("$2", $c_cod_per);
        parent::SetParameterSP("$3", $cAfiliacion);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", $c_cod_per_r);
        parent::SetParameterSP("$8", $bTitular);
        parent::SetParameterSP("$9", $bUAfiliacion);
        parent::SetParameterSP("$10", $besta);
        parent::SetParameterSP("$11", '');
        parent::SetParameterSP("$12", '');
        parent::SetParameterSP("$13", '');
        parent::SetParameterSP("$14", '');
        parent::SetSelect("*");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Edita una afiliación a un paciente.
    public function ActualizaFiliacion($cAfiliacion, $c_cod_per, $c_cod_per_h, $bTitular, $c_cod_per_r, $bUAfiliacion, $besta, $dvi_i, $dvi_f, $bcadu) {
        //echo "$cAfiliacion,$c_cod_per,$c_cod_per_h,$bTitular,$c_cod_per_r,$bUAfiliacion,$besta,$dvi_i,$dvi_f,$bcadu";
        //Falta enviar el numero de afiliacion
        parent::ConnectionOpen("pnsAdmision_inserta", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", $c_cod_per);
        parent::SetParameterSP("$3", $cAfiliacion);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", $c_cod_per_h);
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", $c_cod_per_r);
        parent::SetParameterSP("$8", $bTitular);
        parent::SetParameterSP("$9", $bUAfiliacion);
        parent::SetParameterSP("$10", $besta);
        parent::SetParameterSP("$11", '');
        parent::SetParameterSP("$12", '');
        parent::SetParameterSP("$13", '');
        parent::SetParameterSP("$14", '');
        parent::SetSelect("*");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* public function MantenimientoDerechoHabiente($op_bd,$usuario,$iafil,$ipers,$ipare,$btitu,$ipe_r,$bacti,$besta,$dvi_i,$dvi_f,$bcadu,$ipe_rsexo){
      //echo "$op_bd,$usuario,$iafil,$ipers,$ipare,$btitu,$ipe_r,$bacti,$besta,$dvi_i,$dvi_f,$bcadu,$ipe_rsexo";die();
      parent::ConnectionOpen("paxinserta_persona","dbweb");
      parent::SetParameterSP("$1",'03');
      parent::SetParameterSP("$2",$usuario);
      parent::SetParameterSP("$3",$btitu);
      parent::SetParameterSP("$4",$iafil);
      parent::SetParameterSP("$5",$ipe_r);
      parent::SetParameterSP("$6",$ipare);
      parent::SetParameterSP("$7",$ipers);
      parent::SetParameterSP("$8",'');
      parent::SetParameterSP("$9",'');
      parent::SetParameterSP("$10",'');
      parent::SetParameterSP("$11",$ipe_rsexo);
      parent::SetParameterSP("$12",'');
      parent::SetParameterSP("$13",'');
      parent::SetParameterSP("$14",'');
      parent::SetSelect("*");
      $resultado=parent::executeSPArrayX();
      return $resultado;
      } */

    //Lista Tipos de documentos sin considerar documentos repetidos.
    public function seleccionarTipoDocumento($cadDocs) {
        $cadDocs = "0000," . $cadDocs;
        //echo $cadDocs;
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '19');
        parent::SetParameterSP("$2", $cadDocs);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista Tipos de documentos para busqueda
    public function seleccionarTipoDocumentoBusqueda() {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '29');
        parent::SetParameterSP("$2", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* public function listaNombreColegio($sp1){
      parent::ConnectionOpen("paxadmision","dbweb");
      parent::SetParameterSP("$1",'34');
      parent::SetParameterSP("$2",'1006');
      parent::SetParameterSP("$3",'');
      $resultado=parent::executeSPArrayX();
      return $resultado;
      } */
    /* public function listaOcupacionLaboral($sp1){
      parent::ConnectionOpen("paxadmision","dbweb");
      parent::SetParameterSP("$1",'34');
      parent::SetParameterSP("$2",'0010');
      parent::SetParameterSP("$3",'');
      $resultado=parent::executeSPArrayX();
      return $resultado;
      } */

    public function fn_mante_paswd($sp1, $sp2, $sp3, $sp4) {
        parent::ConnectionOpen("fn_mante_paswd", "personas");
        parent::SetParameterSP("$1", $sp1);
        parent::SetParameterSP("$2", $sp2);
        parent::SetParameterSP("$3", $sp3);
        parent::SetParameterSP("$4", $sp4);
        parent::SetSelect("*");
        $resultado = parent::ExecuteSPArray();
        return $resultado;
    }

    /////////////MANTENIMIENTO RRHH /////////////////////////
    public function fn_mante_trabajador($sp1, $sp2, $sp3) {
        parent::ConnectionOpen("fn_mante_trabajador", "personas");
        parent::SetParameterSP("$1", $sp1);
        parent::SetParameterSP("$2", $sp2);
        parent::SetParameterSP("$3", $sp3);
        parent::SetSelect("*");
        $resultado = parent::ExecuteSPArray();
        return $resultado;
    }

    public function fn_mante_profesion($sp1, $sp2, $sp3, $sp4, $sp5) {
        parent::ConnectionOpen("fn_mante_trabajador", "personas");
        parent::SetParameterSP("$1", $sp1);
        parent::SetParameterSP("$2", $sp2);
        parent::SetParameterSP("$3", $sp3);
        parent::SetParameterSP("$4", $sp4);
        parent::SetParameterSP("$5", $sp5);
        parent::SetSelect("*");
        $resultado = parent::ExecuteSPArray();
        return $resultado;
    }

    public function fn_mante_cargo_ofic_trab($sp1, $sp2, $sp3, $sp4, $sp5, $sp6, $sp7, $sp8) {
        parent::ConnectionOpen("fn_mante_cargo_ofic_trab", "nucleo");
        parent::SetParameterSP("$1", $sp1);
        parent::SetParameterSP("$2", $sp2);
        parent::SetParameterSP("$3", $sp3);
        parent::SetParameterSP("$4", $sp4);
        parent::SetParameterSP("$5", $sp5);
        parent::SetParameterSP("$6", $sp6);
        parent::SetParameterSP("$7", $sp7);
        parent::SetParameterSP("$8", $sp8);
        parent::SetSelect("*");
        $resultado = parent::ExecuteSPArray();
        return $resultado;
    }

    ///////////// FIN MANTENIMIENOT RRHH /////////////////////////
    //Busca personas por patrón, tipo de documento y parámetro.
    public function getArrayListPersonas($patron, $tipoDoc, $parametro) {
        //para buscar a las personas
        parent::ConnectionOpen("pnsBuscaPersonas", "dbweb");
        parent::SetParameterSP("$1", $parametro);
        parent::SetParameterSP("$2", $patron);
        parent::SetParameterSP("$3", $tipoDoc);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //////////***********CITAS INFORMES***************////////////
    //Lista de citas de los pacientes.

    public function getArrayDatosPersonaInformes($datos) {
        parent::ConnectionOpen("pnsDatosPacienteCitas", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("codigopersona", $datos["codigopersona"]);
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));

        $resultado = parent::executeSPArrayX();

        return $resultado;
    }

    //////////////////////////////////////busca medicos
    //Lista de médicos.
    /*  public function getArrayListMedicos($apellidoPaterno, $ApellidoMaterno, $Nombres) {
      //para buscar a las personas
      parent::ConnectionOpen("pnsBuscaPersonas", "dbweb");
      //parent::SetParameterSP("$1",'08'); parche para la nueva busqueda de medicos
      parent::SetParameterSP("$1", '13');
      parent::SetParameterSP("$2", $apellidoPaterno);
      parent::SetParameterSP("$3", $ApellidoMaterno);
      parent::SetParameterSP("$4", $Nombres);

      $resultado = parent::executeSPArrayX();
      return $resultado;
      } */

    public function getArrayListMedicos($datos) {
        //para buscar a las personas
        parent::ConnectionOpen("pnsBuscaPersonas", "dbweb");
        parent::SetParameterSP("$1", '15');
        parent::SetParameterSP("$2", $datos["apellidoPaterno"]);
        parent::SetParameterSP("$3", $datos["apellidoMaterno"]);
        parent::SetParameterSP("$4", $datos["nombres"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getArrayListMedicosGeneral($apellidoPaterno, $ApellidoMaterno, $Nombres) {
        parent::ConnectionOpen("pnsBuscaPersonas", "dbweb");
        //parent::SetParameterSP("$1",'08'); parche para la nueva busqueda de medicos
        parent::SetParameterSP("$1", '14');
        parent::SetParameterSP("$2", $apellidoPaterno);
        parent::SetParameterSP("$3", $ApellidoMaterno);
        parent::SetParameterSP("$4", $Nombres);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /////////////////////////////////////////
    //Lista de actos médicos.
    public function getActosMedicos($c_cod_per) {
        //para buscar a las personas
        parent::ConnectionOpen("pnsActosMedicos", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", $c_cod_per);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getCronogramaMedicoMensual($codigo, $fecha) {
        //para buscar a las personas
        parent::ConnectionOpen("pnsCronogramaMedico", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", $fecha);
        parent::SetParameterSP("$3", '0');
        parent::SetParameterSP("$4", '0');
        parent::SetParameterSP("$5", '0');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", $codigo);
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("contadoroptimofechas", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getArrayDatosMedicoCronogramaMensual($datos) {
        //para buscar a las personas
        parent::ConnectionOpen("pnsCronogramaMedico", "dbweb");
        parent::SetParameterSP("$1", "8");
        parent::SetParameterSP("$2", "");
        parent::SetParameterSP("$3", "0");
        parent::SetParameterSP("$4", "0");
        parent::SetParameterSP("$5", "0");
        parent::SetParameterSP("$6", "0");
        parent::SetParameterSP("$7", $datos["codigoMedico"]);
        parent::SetParameterSP("$8", "");
        parent::SetParameterSP("contadoroptimofechas", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function personaRegistrada($autoGenerado) {

        parent::ConnectionOpen("pnsBuscaPersonas", "dbweb");
        parent::SetParameterSP("$1", '11');
        parent::SetParameterSP("$2", $autoGenerado);

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function obtenerCoincidencias($apellidoPaterno, $ApellidoMaterno, $nombres, $dni) {
        parent::ConnectionOpen("pnsBuscaPersonas", "dbweb");
        parent::SetParameterSP("$1", '09');
        parent::SetParameterSP("$2", $apellidoPaterno);
        parent::SetParameterSP("$3", $ApellidoMaterno);
        parent::SetParameterSP("$4", $nombres);
        parent::SetParameterSP("$5", $dni);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaIpAcreditacion($ipAcreditacion) {
        parent::ConnectionOpen("pnsListaIpAcreditacion", "dbweb");
        parent::SetParameterSP("$1", "%" . $ipAcreditacion . "%");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function updatePersonasdesdeEssalud($codigo, $parametros) {
        parent::ConnectionOpen("pnsAdmision_actualizaEssalud", "dbweb");
        parent::SetParameterSP("ubigeo", $parametros["cb_departamento"] . $parametros["cb_provincia"] . $parametros["cb_distrito"]);
        parent::SetParameterSP("fechanacimiento", $parametros["txtFechaNacimiento"]);
        parent::SetParameterSP("tipoDocumento", $parametros["cbTipoDoc"][1]);
        parent::SetParameterSP("numeroDocumento", $parametros["numeroDocumento"]);
        parent::SetParameterSP("sexo", $parametros["sexo"]);
        parent::SetParameterSP("codigopersona", $codigo);
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function grabaEssalud($codigo, $parametros, $edad, $fechain, $fechafin) {
        parent::ConnectionOpen("pnsGrabaDatosAsegurados", "dbweb");
        parent::SetParameterSP("$1", $parametros["cbTipoDoc"][1]);
        parent::SetParameterSP("$2", $parametros["numeroDocumento"]);
        parent::SetParameterSP("$3", $parametros["txtApellidoPat"]);
        parent::SetParameterSP("$4", $parametros["txtApellidoMat"]);
        parent::SetParameterSP("$5", $parametros["txtNombrePaciente"]);
        parent::SetParameterSP("$6", $_SESSION["login_user"]);
        parent::SetParameterSP("$7", $_SESSION['host']);
        parent::SetParameterSP("$8", $parametros["p6"]);
        parent::SetParameterSP("$9", $fechain);
        parent::SetParameterSP("$10", $fechafin);
        parent::SetParameterSP("$11", $edad);
        parent::SetParameterSP("$12", $codigo);

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function grabaTablaEssalud($codigo, $parametros) {
        //echo "grabaTablaEssalud";
        parent::ConnectionOpen("pnsAcreditaPersonaRegistrada", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", '1');
        parent::SetParameterSP("$3", $parametros["txtApellidoPat"]);
        parent::SetParameterSP("$4", $parametros["txtApellidoMat"]);
        parent::SetParameterSP("$5", $parametros["primerNombre"]);
        parent::SetParameterSP("$6", $parametros["segundoNombre"]);
        parent::SetParameterSP("$7", $parametros["p6"]);
        parent::SetParameterSP("$8", '150117');
        parent::SetParameterSP("$9", $parametros["p8"]);
        parent::SetParameterSP("$10", $parametros["fechaVencimiento"]);
        parent::SetParameterSP("$11", $parametros["tipoDocumento"]);
        parent::SetParameterSP("$12", $parametros["numeroDocumento"]);
        parent::SetParameterSP("$13", $parametros["p12"]);
        parent::SetParameterSP("$14", $parametros["txtFechaNacimiento"]);
        parent::SetParameterSP("$15", "");
        parent::SetParameterSP("$16", "");
        parent::SetParameterSP("$17", "");
        parent::SetParameterSP("$18", "");
        parent::SetParameterSP("$19", $codigo);

        parent::SetParameterSP("$20", $_SESSION["login_user"]);
        parent::SetParameterSP("$21", $_SESSION['host']);
        //print_r($parametros);

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function actualizarTablaEssalud($parametros) {//ya ha sido llamado
        // echo "actualizarTablaEssalud";
        parent::ConnectionOpen("pnsAcreditaPersonaRegistrada", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", $parametros["p2"]);
        parent::SetParameterSP("$3", $parametros["p3"]);
        parent::SetParameterSP("$4", $parametros["p4"]);
        parent::SetParameterSP("$5", $parametros["p5"]);
        parent::SetParameterSP("$6", $parametros["p6"]);
        parent::SetParameterSP("$7", $parametros["p7"]);
        parent::SetParameterSP("$8", $parametros["p8"]);
        parent::SetParameterSP("$9", $parametros["p9"]);
        parent::SetParameterSP("$10", $parametros["p10"]);
        parent::SetParameterSP("$11", $parametros["p11"]);
        parent::SetParameterSP("$12", $parametros["p12"]);
        parent::SetParameterSP("$13", $parametros["p13"]);
        parent::SetParameterSP("$14", $parametros["p14"]);
        parent::SetParameterSP("$15", $parametros["p15"]);
        parent::SetParameterSP("$16", $parametros["p16"]);
        parent::SetParameterSP("$17", $parametros["p17"]);
        parent::SetParameterSP("$18", $parametros["p18"]);
        parent::SetParameterSP("$19", $parametros["p19"]);
        parent::SetParameterSP("$20", $_SESSION["login_user"]);
        parent::SetParameterSP("$21", $_SESSION['host']);
        //print_r($parametros);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function detalleAcredita($c_cod_per) {
        // echo "actualizarTablaEssalud";
        parent::ConnectionOpen("pnsBuscaPersonas", "dbweb");
        parent::SetParameterSP("$1", '12');
        parent::SetParameterSP("$2", $c_cod_per);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function cambiarAfiliacionAmbulatorio($datos) {
        parent::ConnectionOpen("pnsAfiliaciones", "dbweb");
        parent::SetParameterSP("accion", '01');
        parent::SetParameterSP("codigopersona", $datos["codigoPersona"]);
        parent::SetParameterSP("codigoafiliacion", '0001');
        parent::SetParameterSP("codigopersonahabiente", $datos["codigoPersona"]);
        parent::SetParameterSP("btitular", '1');
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("estacion", $_SESSION['host']);
        parent::SetParameterSP("c_cod_per_h", $datos["codigoPersona"]);
        parent::SetParameterSP("autogenerado", null);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function cambiarAfiliacionContribuyente($datos) {
        parent::ConnectionOpen("pnsAfiliaciones", "dbweb");
        parent::SetParameterSP("accion", '02');
        parent::SetParameterSP("codigopersona", $datos["codigopersona"]);
        parent::SetParameterSP("codigoafiliacion", '0002');
        parent::SetParameterSP("codigopersonahabiente", $datos["codigopersona"]);
        parent::SetParameterSP("btitular", '1');
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("estacion", $_SESSION['host']);
        parent::SetParameterSP("c_cod_per_h", $datos["codigopersona"]);
        parent::SetParameterSP("codigocontribuyente", $datos["codigocontribuyente"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    /* CONTRIBUYENTE PUNTUAL */

    public function getArrayDatosPersonaContribuyente($datos) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("accion", '30');
        parent::SetParameterSP("codigopersona", $datos["codigopersona"]);
        parent::SetParameterSP("var2", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function grabarParentescoPaciente($codPersonaTitular, $codPariente) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("accion", '31');
        parent::SetParameterSP("codigopersona", $codPersonaTitular);
        parent::SetParameterSP("var2", $codPariente);
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function listaParentescoPaciente($codPersona) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("accion", '32');
        parent::SetParameterSP("codigopersona", $codPersona);
        parent::SetParameterSP("var2", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function listaParentesco() {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("accion", '33');
        parent::SetParameterSP("codigopersona", '');
        parent::SetParameterSP("var2", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function eliminarParentescoPaciente($idParentescoDePersona) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("accion", '34');
        parent::SetParameterSP("codigopersona", $idParentescoDePersona);
        parent::SetParameterSP("var2", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function asingarParientePaciente($datos) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("accion", '35');
        parent::SetParameterSP("idPerentescoDePersona", $datos["idPerentescoDePersona"]);
        parent::SetParameterSP("idParentesco", $datos["idParentesco"]);
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function getArrayListMedicosGeneraldhtmlx($datos) {
        parent::ConnectionOpen("pnsBuscaPersonas", "dbweb");
        parent::SetParameterSP("$1", '14');
        parent::SetParameterSP("$2", $datos['apellidoPaterno']);
        parent::SetParameterSP("$3", $datos['apellidoMaterno']);
        parent::SetParameterSP("$4", $datos['nombres']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

}

?>