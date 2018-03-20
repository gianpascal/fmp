<?php
/********************************************************************
***	Clase de Permisos 											  ***
*** Realiza el seteo y recuperacion de permisos                   ***
*** dentro del sistema  										  ***
*** creado : 24/01/2009      									  ***
*** desarrollado por : Helmut Pacheco							  ***
*********************************************************************/
class Permisos {
    public static $arrayPermisosFormularios;
    public static $arrayPermisosServicios;	
    public function __construct($driver){
        
    } 	
    public static function getPermisosFormularios(){
        return self::$arrayPermisosFormularios;
    }
    public static function getPermisosServicios(){
        return self::$arrayPermisosServicios;
    }
}
?>