<?php

/* * **************************************************************
/*** ADOdb Database Abstraction Library for PHP (and Python)  ***
/****************************************************************
/*** modificado por rene choque
/*** fecha modificacion 04/05/2008
/*** modificado por helmut pacheco
/*** fecha modificacion 06/01/2009
 * ** Mod. Por Motumbo Cel 996464642 Talla: 20cm ExecuteSPArrayCombo, ExecuteSPArrayObject, SetParameter
 */
//Conexion con panel
/* * **************************************************************
/*************************************************************** */
require_once "Config.inc.php";
require_once "Language.inc.php";

class Adophp
{

    public $pConnection;
    public $pSchema;
    public $pFieldsSelect;
    public $pTables;
    public $pFieldsCondition;
    public $pParameter;
    public $pParameterName;
    public $pParameterType;
    public $pParameterIsOutput;
    public $pParameterIsNull;
    public $pParameterLength;
    public $pParameterOutput;
    public $pParamFilterField;
    public $pParamFilterType;
    public $pParamFilterValue1;
    public $pParamFilterValue2;
    public $pNameStoreProcedure;
    public $pRow;
    public $pRowArray;
    public $pRowFields;
    public $pSql;
    public $sps;
    //var $pRs;
    public $pNumRows;
    public $pTotRows;
    public $pNumFields;
    public $pRowCursor;
    protected $pStrCase;
    public $pOffset;
    public $pRowsPage;
    public $ptotalPages;
    public $pFieldsOrder;
    public $pTypeOrder;
    public $pNumRecord;
    public $pSP;
    public $obj;
    public $RecordSet;
    public $retval;
    public $aRecords;
    //public  $aFields = array();
    public $aFieldsName;
    public $aFieldsType;
    //private $dsn;
    public $Con;
    public $dbhost;
    public $dbuser;
    public $dbpasw;
    public $dbname;
    private $dbdriver;
    public $language;

    public function __construct($language = "Spanish", $dsn = array())
    {
        $this->language = $language;
        $this->BeginValues();
        /* $this->dbhost = "10.10.10.10";
        $this->dbuser = "postgres";
        $this->dbpasw = "123456";
        $this->dbname = "allikay2_latin";
        $this->dbdriver = "POSTGRES"; */
        $this->dbhost = $dsn['dbhost'];
        $this->dbuser = $dsn['dbuser'];
        $this->dbpasw = $dsn['dbpasw'];
        $this->dbname = $dsn['dbname'];
        $this->dbdriver = $dsn['dbdriv'];
        /* $this->dbhost = "10.10.10.10";
        $this->dbuser = "sa";
        $this->dbpasw = "123456";
        $this->dbname = "Simedhweb";
        $this->dbdriver = "MSSQL"; */
        $this->pParameter = array();
        $this->pParameterName = array();
        $this->pParameterType = array();
        $this->pParameterIsOutput = array();
        $this->pParameterIsNull = array();
        $this->pParameterLength = array();
        $this->pParameterOutput = array();
        $this->pParamFilterField = array();
        $this->pParamFilterType = array();
        $this->pParamFilterValue1 = array();
        $this->pParamFilterValue2 = array();
        $this->aRecords = array();
        //private  $aFields = array();
        $this->aFieldsName = array();
        $this->aFieldsType = array();
        //echo "<br>Mirame primera vez".$this->dbdriver;
    }

    public function setDsn($dsn = array())
    {
//        $this->dbhost = '192.168.31.231';
        //        $this->dbuser = 'postgres';
        //        $this->dbpasw = '123456';
        //        $this->dbname = 'allikay2_latin';
        //        $this->dbdriver = 'POSTGRES';
        $this->dbhost = $dsn['dbhost'];
        $this->dbuser = $dsn['dbuser'];
        $this->dbpasw = $dsn['dbpasw'];
        $this->dbname = $dsn['dbname'];
        $this->dbdriver = $dsn['dbdriv'];
    }

    public function __destruct()
    {
        $this->Close();
    }

    public function ConnectionOpen($pSPName = "", $pSchema = "", $pSP = "SP")
    {
        $pSP = strtoupper($pSP);
        if ($pSP == "SP" or $pSP == "STOREPROCEDURE" or $pSP == "PROCEDURE") {
            $this->pSP = "PROCEDURE";
        } else if ($pSP == "FUNCTION" or $pSP == "FUN" or $pSP == "F") {
            $this->pSP = "FUNCTION";
        } else {
            $this->pSP = "";
        }

        $this->pSchema = $this->GetBeginSchema($this->dbdriver, $pSchema);
        $this->pNameStoreProcedure = $pSPName;

        try {
            switch (strtoupper($this->dbdriver)) {
                case "POSTGRES":
                    $cnString = "host=" . $this->dbhost . " port=5432 dbname=" . $this->dbname . " user=" . $this->dbuser . " password=" . $this->dbpasw;
                    $this->pConnection = pg_connect($cnString);
                    if (!$this->pConnection) {
                        echo Language::pickMessage('adophp', 1, $this->language);
                        exit();
                    }
                    break;
                case "MSSQL":
                    //echo "$this->dbhost,  $this->dbuser,  $this->dbpasw"."<br>";die();
                    $this->pConnection = mssql_connect($this->dbhost, $this->dbuser, $this->dbpasw);
                    if (!$this->pConnection) {
                        echo Language::pickMessage('adophp', 0, $this->language);
                        exit();
                    } else {
                        $db = mssql_select_db($this->dbname, $this->pConnection);
                        if (!($db)) {
                            echo Language::pickMessage('adophp', 1, $this->language);
                            exit();
                        }
                    }
                    break;
                case "SQLSRV":

                    //$serverName = "serverName\sqlexpress, 1542"; //serverName\instanceName, portNumber (por defecto es 1433)
                    $connectionInfo = array("Database" => $this->dbname, "UID" => $this->dbuser, "PWD" => $this->dbpasw);
                    //  var_dump($connectionInfo);
                    $this->pConnection = sqlsrv_connect($this->dbhost, $connectionInfo);
                    if (!$this->pConnection) {
                        var_dump(sqlsrv_errors());
                        echo Language::pickMessage('adophp', 0, $this->language);
                        exit();
                    }
                    break;
            }
        } catch (exception $ex) {
            print_r($ex);
        }
    }

    public function ConnectionClose()
    {
        try {
            switch (strtoupper($this->dbdriver)) {
                case "POSTGRES":
                    if (isset($this->RecordSet) && $this->RecordSet !== false) {
                        pg_free_result($this->RecordSet);
                    }

                    @pg_close($this->pConnection);
                    break;
                case "MSSQL":
                    if (isset($this->RecordSet) && $this->RecordSet !== false && $this->RecordSet != 1) {
                        @mssql_free_result($this->RecordSet);
                    }

                    @mssql_close($this->pConnection);
                    break;
            }
        } catch (exception $ex) {
            print_r($ex);
        }
        unset($this->RecordSet);
    }

    public function Close_over()
    {
        $this->Close();
        try {
            switch (strtoupper($this->dbdriver)) {
                case "POSTGRES":
                    @pg_close($this->pConnection);
                    break;
                case "MSSQL":
                    @mssql_close($this->pConnection);
                    break;
            }
        } catch (exception $ex) {
            print_r($ex);
        }
    }

    public function Close()
    {
        $this->ConnectionClose();
        $this->Liberar_Parametros();
    }

    public function BeginValues()
    {
        $this->pNumRows = -1;
        $this->pRowsPage = "ALL";
        $this->pFieldsSelect = "*";
        $this->pOffset = "";
        $this->pTypeOrder = " ASC";
        $this->mParametro_Busca = "";
        $this->pRowCursor = 0;
    }

    public function ReiniciarSQL()
    {
        $this->Liberar_Parametros();
        $this->BeginValues();
    }

    public function ReiniciarStoreProcedure()
    {
        $this->Liberar_Parametros();
        $this->BeginValues();
    }

    public function ReiniciarSP()
    {
        $this->Liberar_Parametros();
        $this->BeginValues();
    }

    public function Liberar_Parametros()
    {

        unset($this->pFieldsSelect);
        unset($this->pTables);
        unset($this->pFieldsCondition);
        //unset($this->pParameter);
        $this->pParameter = array();
        unset($this->pParameterName);
        unset($this->pParameterType);
        unset($this->pParameterIsOutput);
        unset($this->pParameterIsNull);
        unset($this->pParameterLength);

        unset($this->pParamFilterField);
        unset($this->pParamFilterType);
        unset($this->pParamFilterValue1);
        unset($this->pParamFilterValue2);

        unset($this->pTextSearch);
        unset($this->pOffset);
        unset($this->pTotalPages);
        unset($this->pRowsPage);

        unset($this->pFieldsOrder);
        unset($this->pTypeOrder);
        unset($this->pSql);
        $this->Liberar_Proceso();
    }

    public function Liberar_Proceso()
    {
        unset($this->RecordSet);
        unset($this->sps);
        unset($this->pNumRows);
        unset($this->pRow);
        unset($this->pRowArray);
        unset($this->pRowFields);
        unset($this->pRowCursor);
        unset($this->pTotRows);
        unset($this->pNumFields);
        unset($this->aRecords);
        unset($this->aFieldsName);
        unset($this->aFieldsType);
    }

    public function GetBeginSchema($dbdriver, $pSchema)
    {
        if (trim($pSchema) != "") {
            return $pSchema;
        } else {
            switch (strtoupper($dbdriver)) {
                case "POSTGRES":return "public";
                    break;
                case "MSSQL":return "dbo";
                    break;
                default:return "";
                    break;
            }
        }

    }

    public function SetSchema($pSchema)
    {
        $this->pSchema = $this->GetBeginSchema($this->dbdriver, $pSchema);
    }

    public function SetStoreProcedure($pName)
    {
        if (trim($pName) != "") {
            $this->pNameStoreProcedure = $pName;
        }

    }

    public function SetSelect($pName)
    {
        if (trim($pName) != "") {
            $this->pFieldsSelect = $pName;
        }

    }

    public function SetTables($pName)
    {
        if (trim($pName) != "") {
            $this->pTables = $pName;
        }

    }

    public function SetCondition($pName)
    {
        if (trim($pName) != "") {
            $this->pFieldsCondition = $pName;
        }

    }

    public function SetParameterSP($pName, $pValue, $pType = "VARCHAR", $pIsOutput = false, $pIsNull = false, $plength = null)
    {
        if (trim($pType) == "") {
            $pType = "VARCHAR";
        }

        $oculto = substr($pName, 0, 1);

        switch (strtoupper($pType)) {
            case "NUMERIC":case "INT":case "INTEGER":
                if ($pValue == "") {
                    $pValue = "NULL";
                } else if (strtoupper($pValue) == "NULL") {
                    $pValue = "NULL";
                } else {
                    $pValue = "$pValue";
                }

                break;
            case "VARCHAR":case "DATE":case "TEXT":default:
                if ($pValue == "") {
                    $pValue = "''";
                } else if (strtoupper($pValue) == "NULL") {
                    $pValue = "NULL";
                } else if ($oculto == ".") {
                    $pValue = $pValue;
                    $pName = substr($pName, 1, strlen($pName) - 2);
                } else {
                    $pValue = "'$pValue'";
                }

                break;
        }
        //echo "$pValue:$oculto<br>";

        switch (strtoupper($this->dbdriver)) {
            case "POSTGRES":
                break;
            case "MSSQL":
                switch (strtoupper($pType)) {
                    case "INT":case "INTEGER":$pType = "SQLINT4";
                        break;
                    case "CHAR":$pType = "SQLCHAR";
                        break;
                    case "VARCHAR":$pType = "SQLVARCHAR";
                        break;
                    case "TEXT":$pType = "SQLTEXT";
                        break;
                    case "NUMERIC":case "FLOAT":$pType = "SQLFLT8";
                        break;
                    case "DATETIME":case "DATE":$pType = "SQLDATETIME";
                        break;
                }
            case "SQLSRV":
                // echo 'a';
                switch (strtoupper($pType)) {
                    case "INT":case "INTEGER":$pType = "SQLINT4";
                        break;
                    case "CHAR":$pType = "SQLCHAR";
                        break;
                    case "VARCHAR":$pType = "SQLVARCHAR";
                        break;
                    case "TEXT":$pType = "SQLTEXT";
                        break;
                    case "NUMERIC":case "FLOAT":$pType = "SQLFLT8";
                        break;
                    case "DATETIME":case "DATE":$pType = "SQLDATETIME";
                        break;
                }
            default:
                break;
        }

        //var_dump($this->pParameter);
        //echo "Conexion: ".$this->pConnection."<br>";die();
        //var_dump($this->pParameter);
        //echo "<br>";
        // echo "$pName:".$pName."- ";
        $i = count($this->pParameter);
        $this->pParameter[$i] = $pValue;
        $this->pParameterName[$i] = $pName;
        $this->pParameterType[$i] = $pType;
        $this->pParameterIsOutput[$i] = $pIsOutput;
        $this->pParameterIsNull[$i] = $pIsNull;
        $this->pParameterLength[$i] = $plength;
        //echo "$i $pValue<br>";
        //echo strtoupper($pType);die();
    }

    public function SetFilterSP($pField, $pType, $pValue1, $pValue2 = "")
    {
        $i = count($this->pParamFilterField);
        $this->pParamFilterField[$i] = $pField;
        $this->pParamFilterType[$i] = $pType;
        $this->pParamFilterValue1[$i] = $pValue1;
        $this->pParamFilterValue2[$i] = $pValue2;
    }

    public function SetTextSearch($pTextSearch)
    {
        $this->pTextSearch = $pTextSearch;
    }

    public function SetSql($pSql)
    {
        $this->pSql = $pSql;
    }

    public function SetPagination($vRowsPage, $vPagina = "")
    {
        if (is_integer($vRowsPage) && $vRowsPage > 0) {
            $this->pRowsPage = $vRowsPage;
        } else {
            $this->pRowsPage = "ALL";
        }

        if ($vPagina == "") {
            $this->pOffset = "";
        } else {
            $this->pOffset = ($vPagina - 1) * $this->pRowsPage;
        }

    }

    private function setTotalPages($vRowsPage)
    {
        if (is_integer($vRowsPage) and $vRowsPage > 0) {
            $this->pTotalPages = ceil($this->pNumRows / $vRowsPage);
        } else {
            $this->pTotalPages = 1;
        }

        return $this->pTotalPages;
    }

    private function GetPagination()
    {
        switch (strtoupper($this->dbdriver)) {
            case "POSTGRES":
                $pagination = " LIMIT $this->pRowsPage";
                if ($this->pOffset != "") {
                    $pagination .= " OFFSET $this->pOffset";
                }

                break;
            case "MSSQL":

                break;
        }
        return $pagination;
    }

    public function SetFieldsOrder($pName, $pOrder = "ASC")
    {
        if (strtoupper($pOrder) == 'DESC') {
            $ord = " DESC";
        } else {
            $ord = " ASC";
        }

        $this->pFieldsOrder = $pName;
        $this->pTypeOrder = $ord;
    }

    public function InitSp()
    {
        switch (strtoupper($this->dbdriver)) {
            case "POSTGRES":
                break;
            case "MSSQL":
                return mssql_init($this->pSchema . "." . $this->pNameStoreProcedure, $this->pConnection);
                break;
        }
    }

    private function Prepare_Sql()
    {

        switch (strtoupper($this->dbdriver)) {
            case "POSTGRES":
                if (trim($this->pFieldsSelect) == "") {
                    $query = "SELECT * ";
                } else {
                    $query = "SELECT " . $this->pFieldsSelect;
                }

                $query .= " FROM " . $this->pTables;
                if (trim($this->pFieldsCondition) != "") {
                    $query .= " WHERE " . $this->pFieldsCondition;
                }

                if (trim($this->pFieldsOrder) != "") {
                    $query .= " ORDER BY " . $this->pFieldsOrder . " " . $this->pTypeOrder;
                }

                $this->pSql = $query;

                break;
            case "MSSQL":
                if (trim($this->pFieldsSelect) == "") {
                    $query = "SELECT * ";
                } else {
                    $query = "SELECT " . $this->pFieldsSelect;
                }

                $query .= " FROM " . $this->pTables;
                if (trim($this->pFieldsCondition) != "") {
                    $query .= " WHERE " . $this->pFieldsCondition;
                }

                if (trim($this->pFieldsOrder) != "") {
                    $query .= " ORDER BY " . $this->pFieldsOrder . " " . $this->pTypeOrder;
                }

                $this->pSql = $query;
                break;
        }
    }

    private function Prepare_StoreProcedure()
    {

        switch (strtoupper($this->dbdriver)) {
            case "POSTGRES":

                if ($this->pNameStoreProcedure == 'fn_mante_persona_natural') {
                    //echo "<br><br>Aqui empieza el error<br><br>";
                    if (trim($this->pFieldsSelect) == "") {
                        $query = "SELECT * ";
                    } else {
                        $query = "SELECT " . $this->pFieldsSelect;
                    }

                    $query .= " FROM " . $this->pSchema . "." . $this->pNameStoreProcedure . "(";
                    foreach ($this->pParameter as $Value) {
                        $query .= $Value . ",";
                    }

                    $len = strlen($query);
                    if (count($this->pParameter) > 0) {
                        $len -= 1;
                    }

                    $query = substr($query, 0, $len) . ")";
                    $spcondition = "";
                    //echo $query."123<br><br>";
                }
                if (trim($this->pFieldsSelect) == "") {
                    $query = "SELECT * ";
                } else {
                    $query = "SELECT " . $this->pFieldsSelect;
                }

                $query .= " FROM " . $this->pSchema . "." . $this->pNameStoreProcedure . "(";
                foreach ($this->pParameter as $Value) {
                    $query .= $Value . ",";
                }

                $len = strlen($query);
                if (count($this->pParameter) > 0) {
                    $len -= 1;
                }

                $query = substr($query, 0, $len) . ")";
                $spcondition = "";
                for ($i = 0; $i < count($this->pParamFilterField); $i++) {
                    switch (strtoupper($this->pParamFilterType[$i])) {
                        case ":":case "=":case "IGUAL":case "EQUALS":
                            $spcondition .= $this->pParamFilterField[$i] . " = " . $this->pParamFilterValue1[$i] . " AND ";
                            break;
                        case "LIKE":
                            $spcondition .= $this->pParamFilterField[$i] . " LIKE " . $this->pParamFilterValue1[$i] . " AND ";
                            break;
                        case "BETWEEN":
                            $spcondition .= $this->pParamFilterField[$i] . " BEETWEN " . $this->pParamFilterValue1[$i] . " AND " . $this->pParamFilterValue2[$i] . " AND ";
                            break;
                    }
                }
                $spcondition = substr($spcondition, 0, -5);
                if (trim($spcondition) != "") {
                    $query .= " WHERE " . $spcondition;
                }

                if (trim($this->pFieldsOrder) != "") {
                    $query .= " ORDER BY " . $this->pFieldsOrder . " " . $this->pTypeOrder;
                }

                $this->pSql = $query;
                break;
            case "MSSQL": //echo $this->pSP;
                if ($this->pSP == "PROCEDURE") {
                    $query = " EXECUTE " . $this->pSchema . "." . $this->pNameStoreProcedure . " ";
                    foreach ($this->pParameter as $i => $Value) {
                        //echo "$i $Value<br>";
                        $query .= $Value . ",";
                    }
                    $len = strlen($query);
                    if (count($this->pParameter) > 0) {
                        $len -= 1;
                    }

                    $query = substr($query, 0, $len);
                } else if ($this->pSP == "FUNCTION") {
                    $query = " SELECT  " . $this->pSchema . "." . $this->pNameStoreProcedure . "( ";
                    foreach ($this->pParameter as $Value) {
                        $query .= $Value . ",";
                    }

                    $len = strlen($query);
                    if (count($this->pParameter) > 0) {
                        $len -= 1;
                    }

                    $query = substr($query, 0, $len) . ")";
                }
                $this->pSql = utf8_decode($query);
                //echo $query."<br>";
                break;
            case "SQLSRV": //echo $this->pSP;
                if ($this->pSP == "PROCEDURE") {
                    $query = " EXECUTE " . $this->pSchema . "." . $this->pNameStoreProcedure . " ";
                    foreach ($this->pParameter as $i => $Value) {
                        //echo "$i $Value<br>";
                        $query .= $Value . ",";
                    }
                    $len = strlen($query);
                    if (count($this->pParameter) > 0) {
                        $len -= 1;
                    }

                    $query = substr($query, 0, $len);
                } else if ($this->pSP == "FUNCTION") {
                    $query = " SELECT  " . $this->pSchema . "." . $this->pNameStoreProcedure . "( ";
                    foreach ($this->pParameter as $Value) {
                        $query .= $Value . ",";
                    }

                    $len = strlen($query);
                    if (count($this->pParameter) > 0) {
                        $len -= 1;
                    }

                    $query = substr($query, 0, $len) . ")";
                }
                $this->pSql = utf8_decode($query);
                //echo $query."<br>";
                break;
        }
    }

    public function Move($MoveRow)
    {
        $result = true;
        if (isset($this->aRecords)) {
            switch ($MoveRow) {
                case 1:$this->pRowCursor = 0;
                    break;
                case 2:$this->pRowCursor -= 1;
                    break;
                case 3:$this->pRowCursor += 1;
                    break;
                case 4:$this->pRowCursor = $this->pNumRows - 1;
                    break;
                default:$this->pRowCursor += 1;
                    break;
            }

            if ($this->pRowCursor < 0 or $this->pRowCursor > ($this->pNumRows - 1)) {
                $result = false;
            }

            $this->pRow = false;
            if ($result) {
                $arreglo = array();
                $arreglo2 = array();
                $arreglo3 = array();
                for ($j = 0; $j < $this->pNumFields; $j++) {
                    $arreglo[$j] = $this->aRecords[$this->pRowCursor][$j];
                    $arreglo[$this->aFieldsName[$j]] = $this->aRecords[$this->pRowCursor][$j];

                    $arreglo2[$j] = $this->aRecords[$this->pRowCursor][$j];
                    $arreglo3[$this->aFieldsName[$j]] = $this->aRecords[$this->pRowCursor][$j];
                }

                $this->pRow = $arreglo;
                $this->pRowArray = $arreglo2;
                $this->pRowFields = $arreglo3;

                unset($arreglo);
                unset($arreglo2);
                unset($arreglo3);
            }
        }
        return $result;
    }

    public function ExecuteStoreProcedure($outputType = "Message")
    {
        return $this->ExecuteSP($outputType);
    }

    public function ExecuteFunction($outputType = "Message")
    {
        return $this->ExecuteSP($outputType);
    }

    public function ExecuteSPArray($outputType = "Message")
    {
        $this->Liberar_Proceso();
        switch (strtoupper($this->dbdriver)) {
            case "POSTGRES":
                $this->Prepare_StoreProcedure();
                $query = $this->pSql;
                $cnString = "host=" . $this->dbhost . " port=5432 dbname=" . $this->dbname . " user=" . $this->dbuser . " password=" . $this->dbpasw;

                $this->pConnection = pg_connect($cnString);
                $this->RecordSet = pg_query($this->pConnection, $query) or die("\"$query\" " . Language::pickMessage('adophp', 2, $this->language));
                $this->pNumRows = pg_num_rows($this->RecordSet);
                $this->pTotRows = $this->pNumRows;
                $this->pNumFields = pg_num_fields($this->RecordSet);
                if ($this->pRowsPage != "ALL") {
                    $this->setTotalPages($this->pRowsPage);
                    $pagination = $this->GetPagination();
                    $query = $query . " " . $pagination;
                    $this->pSql = $query;
                    $this->RecordSet = pg_query($this->pConnection, $query);
                    $this->pNumRows = pg_num_rows($this->RecordSet);
                }
                //echo "<br><br>hola".$query."<br><br>";
                $this->_Execute();
                //echo "Por aki es ...<br>"; echo $this->GetSql()."<br>";
                $resultadoArray = array();
                //Comente lo siguiente no estoy seguro revizar por siaca
                //print_r($fila);
                while ($fila = $this->pRow) {
                    array_push($resultadoArray, $fila);
                    $this->MoveNext();
                }
                $this->Liberar_Parametros();
                return $resultadoArray;
                break;
            case "MSSQL":
                /*                 * ********************************************
                /*** NO IMPLEMENTADO APOYA COLABORA OPEN SOURCE
                /********************************************* */
                break;
        }
    }

    public function executeSPArrayX()
    {
        $this->ExecuteSP();
        $array = array();
        switch (strtoupper($this->dbdriver)) {
            case "POSTGRES":
                $array = pg_fetch_all($this->RecordSet);
                break;
            case "MSSQL":
                $numFilas = @mssql_num_rows($this->RecordSet);
                if ($numFilas == 1) {
                    $array[0] = $this->GetRow();
                } else {
                    @mssql_data_seek($this->RecordSet, 0);
                    while ($f = @mssql_fetch_array($this->RecordSet)) {
                        //echo '---------------------gggg';
                        array_push($array, $f);
                    }
                    //$array=$this->aRecords;
                }
                break;
            case "SQLSRV":
                //var_dump($this->RecordSet);
                $numFilas = sqlsrv_num_rows($this->RecordSet);
              //  echo "Numfilas: $numFilas";
                if ($numFilas == 1) {
                    $array[0] = $this->GetRow();
                } else {
                    do {

                        while ($f = sqlsrv_fetch_array($this->RecordSet)) {
                            array_push($array, $f);
                        }
                        $next_result = sqlsrv_next_result($this->RecordSet);
                    } while ($next_result);

                }

                break;
        }
        return $array;
        /*
    $this->ExecuteSP();
    $array = array();
    if (strtoupper($this->dbdriver) == "POSTGRES") {
    $array = pg_fetch_all($this->RecordSet);
    } elseif (strtoupper($this->dbdriver) == "MSSQL") {

    $numFilas = @mssql_num_rows($this->RecordSet);
    if ($numFilas == 1) {
    $array[0] = $this->GetRow();
    } else {
    @mssql_data_seek($this->RecordSet, 0);
    while ($f = @mssql_fetch_array($this->RecordSet)) {
    //echo '---------------------gggg';
    array_push($array, $f);
    }
    //$array=$this->aRecords;
    }
    //echo "Numero de Filas: ".$numFilas;
    }
    return $array;
     */
    }

    public function ExecuteSPArrayCombo($ms = '')
    {
        $resultado = $this->ExecuteSPArray($ms);
        $a = array();
        if (count($resultado) > 0) {
            foreach ($resultado as $f) {
                $a[$f["0"]] = $f["1"];
            }
        }
        return $a;
    }

    public function ExecuteSPArrayObject($ms = '')
    {
        $resultado = $this->ExecuteSPArray($ms);
        $resultadoObject = null;
        foreach ($resultado as $f) {
            foreach ($f as $index => $e) {
                if (!is_numeric($index)) {
                    $resultadoObject->$index = $e;
                }
            }
            break;
        }
        return $resultadoObject;
    }

    public function ExecuteSP($outputType = "Message")
    {
        $this->Liberar_Proceso();
        switch (strtoupper($this->dbdriver)) {
            case "POSTGRES":
                $this->Prepare_StoreProcedure();
                $query = $this->pSql;
                $this->RecordSet = pg_query($this->pConnection, $query) or die("\"$query\" " . Language::pickMessage('adophp', 2, $this->language));
                $this->pNumRows = pg_num_rows($this->RecordSet);
                $this->pTotRows = $this->pNumRows;
                $this->pNumFields = pg_num_fields($this->RecordSet);
                if ($this->pRowsPage != "ALL") {
                    $this->setTotalPages($this->pRowsPage);
                    $pagination = $this->GetPagination();
                    $query = $query . " " . $pagination;
                    $this->pSql = $query;
                    $this->RecordSet = pg_query($this->pConnection, $query);
                    $this->pNumRows = pg_num_rows($this->RecordSet);
                }
                return $this->_Execute();
                break;
            case "MSSQL":
                $this->Prepare_StoreProcedure();
                $query = $this->pSql;
                //echo $query;
                $this->RecordSet = mssql_query($query); // or die("\"$query\" ".Language::pickMessage('adophp',2,$this->language));
                if ($this->RecordSet == "1") {
                    $this->pNumRows = 1;
                    $this->pTotRows = $this->pNumRows;
                    $this->pNumFields = 1;
                    $this->aRecords[0][0] = $this->retval;
                    $this->aFieldsName[0] = "RETVAL";
                    $this->aFieldsType[0] = "INTEGER";
                    $this->MoveFirst();
                    return $this->RecordSet;
                } else {
                    $this->pNumRows = mssql_num_rows($this->RecordSet);
                    $this->pTotRows = $this->pNumRows;
                    $this->pNumFields = mssql_num_fields($this->RecordSet);
                    return $this->_Execute();
                }
                break;
            case "SQLSRV":
                $this->Prepare_StoreProcedure();
                $query = $this->pSql;
                //var_dump($query);
                //var_dump($this->pConnection);
                $this->RecordSet = sqlsrv_query($this->pConnection, $query, null); // or die("\"$query\" ".Language::pickMessage('adophp',2,$this->language));
                //  var_dump($this->RecordSet);
                if ($this->RecordSet) {
                    // echo "<br>peche a";
                    $this->pNumRows = 1;
                    $this->pTotRows = $this->pNumRows;
                    $this->pNumFields = 1;
                    $this->aRecords[0][0] = $this->retval;
                    $this->aFieldsName[0] = "RETVAL";
                    $this->aFieldsType[0] = "INTEGER";
                    $this->MoveFirst();
                    return $this->RecordSet;
                } else {
                    //echo "<br>Ini b";
                    //print_r(sqlsrv_errors());
                    //  echo "<br>Fin b";
                    $this->pNumRows = sqlsrv_num_rows($this->RecordSet);
                    $this->pTotRows = $this->pNumRows;
                    $this->pNumFields = sqlsrv_num_fields($this->RecordSet);
                    return $this->_Execute();
                }
                break;
        }
    }

    public function ExecuteSQL()
    {
        $this->Liberar_Proceso();
        if (!$this->pSql or $this->pSql == "") {
            $this->Prepare_Sql();
        }
        $query = $this->pSql;
        $this->RecordSet = null;
        try {
            switch (strtoupper($this->dbdriver)) {
                case "POSTGRES":
                    $this->RecordSet = pg_query($this->pConnection, $query) or die("\"$query\" " . Language::pickMessage('adophp', 2, $this->language));
                    $this->pNumRows = pg_num_rows($this->RecordSet);
                    $this->pTotRows = $this->pNumRows;
                    $this->pNumFields = pg_num_fields($this->RecordSet);

                    if ($this->pRowsPage != "ALL") {
                        $this->setTotalPages($this->pRowsPage);
                        $pagination = $this->GetPagination();
                        $query = $query . " " . $pagination;
                        $this->pSql = $query;
                        $this->RecordSet = pg_query($this->pConnection, $query);
                        $this->pNumRows = pg_num_rows($this->RecordSet);
                    }

                    break;
                case "MSSQL":
                    $this->RecordSet = mssql_query($query) or die("\"$query\" " . Language::pickMessage('adophp', 2, $this->language));
                    $this->pNumRows = mssql_num_rows($this->RecordSet);
                    $this->pTotRows = $this->pNumRows;
                    $this->pNumFields = mssql_num_fields($this->RecordSet);
                    break;
            }
        } catch (exception $ex) {
            print_r($ex);
        }
        return $this->_Execute();
    }

    public function escribir_consulta()
    {
        return $this->pSql;
    }

    public function _Execute()
    {
        switch (strtoupper($this->dbdriver)) {
            case "POSTGRES":
                for ($i = 0; $i < $this->pNumRows; $i++) {
                    $this->pRow = pg_fetch_array($this->RecordSet);
                    for ($j = 0; $j < $this->pNumFields; $j++) {
                        $this->aRecords[$i][$j] = $this->pRow[$j];
                        if ($i == 0) {
                            $this->aFieldsName[$j] = pg_field_name($this->RecordSet, $j);
                            $this->aFieldsType[$j] = pg_field_type($this->RecordSet, $j);
                        }
                    }
                }
                break;
            case "MSSQL":
                if (trim($this->pFieldsSelect) != "" and trim($this->pFieldsSelect) != "*" and $this->pNameStoreProcedure) {
                    $sw = 1;
                }

                if ($this->pRowsPage != "ALL") {
                    $this->setTotalPages($this->pRowsPage);
                    $k = 0;
                    for ($i = 0; $i < $this->pNumRows; $i++) {
                        if ($k < $this->pRowsPage) {
                            break;
                        }

                        $this->pRow = mssql_fetch_array($this->RecordSet);
                        if ($i >= $this->pOffset and $k < $this->pRowsPage) {
                            if ($sw == 1) {
                                $m = 0;
                            }

                            for ($j = 0; $j < $this->pNumFields; $j++) {
                                if ($sw == 1) {
                                    $posicion = strpos($this->pFieldsSelect, mssql_field_name($this->RecordSet, $j));
                                    if ($posicion) {
                                        $this->aRecords[$k][$m] = $this->pRow[$j];
                                        if ($k == 0) {
                                            $this->aFieldsName[$m] = mssql_field_name($this->RecordSet, $j);
                                            $this->aFieldsType[$m] = mssql_field_type($this->RecordSet, $j);
                                            $m++;
                                        }
                                    }
                                } else {
                                    $this->aRecords[$k][$j] = $this->pRow[$j];
                                    if ($k == 0) {
                                        $this->aFieldsName[$j] = mssql_field_name($this->RecordSet, $j);
                                        $this->aFieldsType[$j] = mssql_field_type($this->RecordSet, $j);
                                    }
                                    $m = $j + 1;
                                }
                            }
                        }
                        $k++;
                    }
                    $this->pNumRows = $k;
                    $this->pNumFields = $m;
                } else {
                    $cont = 0;
                    for ($i = 0; $i < $this->pNumRows; $i++) {
                        $this->pRow = mssql_fetch_array($this->RecordSet);
                        $almacena_reg = 0;
                        if (count($this->pParamFilterField) > 0) {
                            switch ($this->pParamFilterType[0]) {
                                case '=':
                                    if (trim($this->pRow[$this->pParamFilterField[0]]) == trim($this->pParamFilterValue1[0])) {
                                        $almacena_reg = 1;
                                    }

                                    break;
                                case '!=':
                                case '<>':
                                    if (trim($this->pRow[$this->pParamFilterField[0]]) != trim($this->pParamFilterValue1[0])) {
                                        $almacena_reg = 1;
                                    }

                                    break;
                            }
                        } else {
                            $almacena_reg = 1;
                        }

                        if ($almacena_reg == 1) {
                            $sw = 1;
                            if ($sw == 1) {
                                $m = 0;
                            }

                            for ($j = 0; $j < $this->pNumFields; $j++) {
                                if ($sw == 1) {
                                    $posicion = strpos($this->pFieldsSelect, mssql_field_name($this->RecordSet, $j));
                                    if ($posicion) {
                                        $this->aRecords[$cont][$m] = $this->pRow[$j];
                                        if ($cont == 0) {
                                            $this->aFieldsName[$m] = mssql_field_name($this->RecordSet, $j);
                                            $this->aFieldsType[$m] = mssql_field_type($this->RecordSet, $j);
                                            $m++;
                                        }
                                    }
                                } else {
                                    $this->aRecords[$cont][$j] = $this->pRow[$j];
                                    if ($cont == 0) {
                                        $this->aFieldsName[$j] = mssql_field_name($this->RecordSet, $j);
                                        $this->aFieldsType[$j] = mssql_field_type($this->RecordSet, $j);
                                    }
                                    $m = $j + 1;
                                }
                            }
                            $cont++;
                        }
                    }
                    $m = 1; //añadido por mi
                    $this->pNumRows = $cont;
                    $this->pNumFields = $m;
                }
                break;
        }
        $this->MoveFirst();
        return $this->RecordSet;
    }

    public function MoveFirst()
    {
        return $this->Move(1);
    }

    public function MovePrevious()
    {
        return $this->Move(2);
    }

    public function MoveNext()
    {
        return $this->Move(3);
    }

    public function MoveLast()
    {
        return $this->Move(4);
    }

    public function GetTotalRows()
    {
        return $this->pTotRows;
    }

    public function GetNumRows()
    {
        return $this->pNumRows;
    }

    public function GetNumFields()
    {
        return $this->pNumFields;
    }

    public function GetFieldName($col)
    {
        return $this->aFieldsName[$col];
    }

    public function GetFieldType($col)
    {
        return $this->aFieldsType[$col];
    }

    public function GetRow()
    {
        return $this->pRow;
    }

    public function GetRowArray()
    {
        return $this->pRowArray;
    }

    public function GetRowField()
    {
        return $this->pRowFields;
    }

    public function GetTotalPages()
    {
        return $this->pTotalPages;
    }

    public function GetSql()
    {
        if (!$this->pSql or $this->pSql == "") {
            if (!$this->pNameStoreProcedure or $this->pNameStoreProcedure == "") {
                $this->Prepare_Sql();
            } else {
                $this->Prepare_StoreProcedure();
            }
        }
        return $this->pSql;
    }

    public function GetNameStoreProcedure()
    {
        return $this->pNameStoreProcedure;
    }

}
