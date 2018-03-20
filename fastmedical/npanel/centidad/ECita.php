<?php
class ECita{

    private $codigoformato;
    private $codigoclaseformato;
    private $codigoambiente;
    private $codigocentrocostos;
    private $codigoturno;
    private $fechahoraservicio;
    private $codigohora;
    private $fechahoraing;
    private $fechahoraltaf;
    private $fechahoraltam;
    private $estadoatencion;
    private $codigotipocita;
    private $condicionllegada;
    private $codigoCIEingreso;
    private $cont_cama;
    private $codigopersona;
    private $codigopersonaresponsable;
    private $codigopersonaresponsableentidad;
    private $codigoprogramacion;
    private $descripcioncita;
    private $nombreusuario;

    public function _construct(){
    }
    public function setCodigoFormato($codigoformato){
        $this->codigoformato = $codigoformato;
    }
    public function getCodigoFormato(){
        return $this->codigoformato;
    }
    public function setCodigoClaseFormato($codigoclaseformato){
        $this->codigoclaseformato = $codigoclaseformato;
    }
    public function getCodigoClaseFormato(){
        return $this->codigoclaseformato;
    }
    public function setCodigoAmbiente($codigoambiente){
        $this->codigoambiente = $codigoambiente;
    }
    public function getCodigoAmbiente(){
        return $this->codigoambiente;
    }
    public function setCodigoCentroCostos($codigocentrocostos){
        $this->codigocentrocostos = $codigocentrocostos;
    }
    public function getCodigoCentroCostos(){
        return $this->codigocentrocostos;
    }
    public function setCodigoTurno($codigoturno){
        $this->codigoturno = $codigoturno;
    }
    public function getCodigoTurno(){
        return $this->codigoturno;
    }
    public function setFechaHoraServicio($fechahoraservicio){
        $this -> fechahoraservicio = $fechahoraservicio;
    }
    public function getFechaHoraServicio(){
        return $this->fechahoraservicio;
    }
    public function setCodigoHora($codigohora){
        $this->codigohora = $codigohora;
    }
    public function getCodigoHora(){
        return $this->codigohora;
    }
    public function setFechaHoraIng($fechahoraing){
        $this->fechahoraing = $fechahoraing;
    }
    public function getFechaHoraIng(){
        return $this->fechahoraing;
    }
    public function setFechaHoraAltaF($fechahoraltaf){
        $this->fechahoraltaf = fechahoraaltaf;
    }
    public function getFechaHoraAltaF(){
        return $this->fechahoraltaf;
    }
    public function setFechaHoraAltaM($fechahoraltam){
        $this -> fechahoraltam = $fechahoraltam;
    }
    public function getFechaHoraAltaM(){
        return $this->fechahoraltam;
    }
    public function setEstadoAtencion($estadoatencion){
        $this->estadoatencion = $estadoatencion;
    }
    public function getEstadoAtencion(){
        return $this->estadoatencion;
    }
    public function setCodigoTipoCita($codigotipocita){
        $this->codigotipocita = $codigotipocita;
    }
    public function getCodigoTipoCita(){
        return $this->codigotipocita;
    }
    public function setCondicionLlegada($condicionllegada){
        $this->condicionllegada = $condicionllegada;
    }
    public function getCondicionLlegada(){
        return $this->condicionllegada;
    }
    public function setCodigoCIEIngreso($codigoCieingreso){
        $this->codigoCIEingreso = $codigoCieingreso;
    }
    public function getCodigoCIEIngreso(){
        return $this->codigoCIEingreso;
    }
    public function setCont_cama($cont_cama){
        $this->cont_cama = $cont_cama;
    }
    public function getCont_cama(){
        return $this->cont_cama;
    }
    public function setCodigoPersona($codigopersona){
        $this->codigopersona = $codigopersona;
    }
    public function getCodigoPersona(){
        return $this->codigopersona;
    }
    public function setCodigoPersonaResponsable($codigopersonaresponsable){
        $this->codigopersonaresponsable = $codigopersonaresponsable;
    }
    public function getCodigoPersonaResponsable(){
        return $this->codigopersonaresponsable;
    }
    public function setCodigoPersonaResponsableEntidad($codigopersonaresponsableentidad){
        $this->codigopersonaresponsableentidad = $cocodigopersonaresponsableentidad;
    }
    public function getCodigoPersonaResponsableEntidad(){
        return $this->codigopersonaresponsableentidad;
    }
    public function setCodigoProgramacion($codigoprogramacion){
        $this->codigoprogramacion = $codigoprogramacion;
    }
    public function getCodigoProgramacion(){
        return $this->codigoprogramacion;
    }
    public function setDescripcionCita($descripcioncita){
        $this->descripcioncita = $descripcioncita;
    }
    public function getDescripcionCita(){
        return $this -> descripcioncita;
    }
    public function setNombreUsuario($nombreusuario){
        $this->nombreusuario = $nombreusuario;
    }
    public function getNombreUsuario(){
        return $this->nombreusuario;
    }


}
?>