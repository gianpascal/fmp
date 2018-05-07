<?php

/* * ******************************************************************
 * **	Clase de Conexion 											  ***
 * ** Realiza el seteo y recuperacion de las conexiones utilizadas  ***
 * ** dentro del sistema  					***
 * ** creado : 14/01/2009                                         ***
 * ** desarrollado por : Helmut Pacheco				 ***
 * ** CARGA LAS CONEXIONES                                       ***
 * ******************************************************************* */

class Conexion {

    public static $arrayDsnUser;
    public static $arrayDsnUserMSSQL;
    public static $cadConexion;
    public static $cnx;

    public function __construct($driver) {

    }

    public function getInitDsnPg() {
        //$arrayDsnPg['dbname'] = 'PANEL';
        //$arrayDsnPg['dbuser'] = 'postgres';
        //$arrayDsnPg['dbpasw'] = '123456';
        //$arrayDsnPg['dbhost'] = '127.0.0.1';
        //$arrayDsnPg['dbdriv'] = 'POSTGRES';
//		$arrayDsnPg['dbname'] = 'allikay2_latin';
//		$arrayDsnPg['dbuser'] = 'postgres';
//		$arrayDsnPg['dbpasw'] = '123456';
//		$arrayDsnPg['dbhost'] = '192.168.31.231';
//		$arrayDsnPg['dbdriv'] = 'POSTGRES';
//		return $arrayDsnPg;
    }

    public static function getPgConexion() {
        return self::$arrayDsnUser;
    }

    public static function getPgConexionX($_cadConexion='') {
        self::$cadConexion = "host=192.168.31.231 port=5432 user=postgres dbname=allikay2_latin password=123456";
        //self::$cadConexion ="host=10.10.10.10 port=5432 user=postgres dbname=PANEL password=123456";
        self::$cadConexion = empty($_cadConexion) ? self::$cadConexion : $_cadConexion;
        if (empty(self::$cnx)) {
            self::$cnx = pg_connect(self::$cadConexion) or die("Error en la Conexion: " . pg_last_error());
        }
        return self::$cnx;
    }

    public static function getPgConexionMSSQL() {
        return self::$arrayDsnUserMSSQL;
    }

    public static function getSQLConexionAuditoria($_cadConexion='') {
        self::$cadConexion = "host=192.168.31.234 port=2243 user=sa dbname=Auditoria password=123456";
        self::$cadConexion = empty($_cadConexion) ? self::$cadConexion : $_cadConexion;
        if (empty(self::$cnx)) {
            self::$cnx = mssql_connect(self::$cadConexion) or die("Error en la Conexion: ");
        }
        return self::$cnx;
    }

    public static function getSQLConexionAuditoriaWeb($_cadConexion='') {
        self::$cadConexion = "host=192.168.31.235 port=2243 user=sa dbname=AuditoriaWeb password=123456";
        //self::$cadConexion ="host=127.0.0.1 port=5432 user=postgres dbname=PANEL password=123456";
        self::$cadConexion = empty($_cadConexion) ? self::$cadConexion : $_cadConexion;
        if (empty(self::$cnx)) {
            self::$cnx = mssql_connect(self::$cadConexion) or die("Error en la Conexion: ");
        }
        return self::$cnx;
    }

    public static function getSQLConexionSimedh($_cadConexion='') {
        self::$cadConexion = "host=192.168.31.234 port=2243 user=sa dbname=Simedh password=123456";
        //self::$cadConexion ="host=127.0.0.1 port=5432 user=postgres dbname=PANEL password=123456";
        self::$cadConexion = empty($_cadConexion) ? self::$cadConexion : $_cadConexion;
        if (empty(self::$cnx)) {
            self::$cnx = mssql_connect(self::$cadConexion) or die("Error en la Conexion: ");
        }
        return self::$cnx;
    }

    /* public static function  getSQLConexionSimedh($_cadConexion=''){
      self::$cadConexion ="host=127.0.0.1 port=5432 user=postgres dbname=allikay2_latin password=123456";
      //self::$cadConexion ="host=127.0.0.1 port=5432 user=postgres dbname=PANEL password=123456";
      self::$cadConexion = empty($_cadConexion)?self::$cadConexion:$_cadConexion;
      if(empty(self::$cnx)){
      self::$cnx = pg_connect(self::$cadConexion) or die("Error en la Conexion: ".pg_last_error());
      }
      return self::$cnx;
      } */

    public static function getInitDsnMSSQLAuditoria() {
        $arrayDsnMSSQL['dbname'] = 'Auditoria';
        $arrayDsnMSSQL['dbuser'] = 'sa'; //simedhgranja';
        $arrayDsnMSSQL['dbpasw'] = '123456'; //p3ch3';
//        $arrayDsnMSSQL['dbhost'] = '192.168.88.51';
        $arrayDsnMSSQL['dbhost'] = '192.168.1.109';
        $arrayDsnMSSQL['dbdriv'] = 'SQLSRV';
        return $arrayDsnMSSQL;
    }

    public static function getInitDsnMSSQLAuditoriaWeb() {
        $arrayDsnMSSQL['dbname'] = 'yachayPanel';
      
        $arrayDsnMSSQL['dbuser'] = 'sa';
        $arrayDsnMSSQL['dbpasw'] = '123456';
        $arrayDsnMSSQL['dbhost'] = '192.168.1.109';
    //    $arrayDsnMSSQL['dbhost'] = 'DESKTOP-FRC01VR\gianp';
        $arrayDsnMSSQL['dbdriv'] = 'SQLSRV';
        return $arrayDsnMSSQL;
    }

    public static function getInitDsnMSSQLSimedh() {
        $arrayDsnMSSQL['dbname'] = 'yachay';
       
        $arrayDsnMSSQL['dbuser'] = 'sa';
        $arrayDsnMSSQL['dbpasw'] = '123456';
        $arrayDsnMSSQL['dbhost'] = '192.168.1.109';
        $arrayDsnMSSQL['dbdriv'] = 'SQLSRV';
        return $arrayDsnMSSQL;
    }

    public static function getInitDsnMSSQLSimi() {
        $arrayDsnMSSQL['dbname'] = 'SIMI';
        $arrayDsnMSSQL['dbuser'] = 'desa'; //simedhgranja';
        $arrayDsnMSSQL['dbpasw'] = 'desa'; //p3ch3';
        $arrayDsnMSSQL['dbhost'] = '192.168.90.47';
        $arrayDsnMSSQL['dbdriv'] = 'MSSQL';
        return $arrayDsnMSSQL;
    }

}

?>
