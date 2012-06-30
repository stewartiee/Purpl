<?php
/*
 * Purpl
 * Development, 0.01 
 */

if(!defined("IN_PURPL")) die("Direct execution of this file isn't allowed.");

class Database {
    
    public $QueryCount = 0;
    
    function DatabaseConnect()
    {
        require("config.php");

        $Connection = mysql_connect($Config['database_server'], $Config['database_username'], $Config['database_password']);
        mysql_select_db($Config['database_name'], $Connection);
    }
    
    function GetAllRecords($Table = NULL, $Select = array(), $Options = array(), $ID_Key = FALSE)
    {
        /* Create our strings used for the final query. */
        $select_variable = null;
        $options_variable = null;
        
        /* Get all our fields to select. */
        foreach($Select as $Select_Field) {
            if($select_variable != null) {
                $select_variable .= ', '.$Select_Field;
            } else {
                $select_variable = $Select_Field;
            }
        }
        
        /* Get our options sent by the user. */
        foreach($Options as $Option => $Val) {
            $options_variable .= $Option.' '.$Val;
        }
        
        $GetAllRecords_Query = mysql_query("SELECT $select_variable FROM $Table $options_variable") or die("GetAllRecords_Query Error: ".mysql_error());
        $this->QueryCount++;
                
        $Return = array();
        
        while($row = $this->_FetchArray($GetAllRecords_Query)) {
            if($ID_Key == TRUE) {
                $Return[$row['id']] = $row;
            } else {
                $Return[] = $row;
            }
        }
        
        return $Return;
    }
    
    function GetSingleRow($Table = NULL, $Select = array(), $Options = array())
    {
        /* Create our strings used for the final query. */
        $select_variable = null;
        $options_variable = null;
        
        /* Get all our fields to select. */
        foreach($Select as $Select_Field) {
            if($select_variable != null) {
                $select_variable .= ', '.$Select_Field;
            } else {
                $select_variable = $Select_Field;
            }
        }
        
        /* Get our options sent by the user. */
        foreach($Options as $Option => $Val) {
            $options_variable .= $Option.' '.$Val;
        }
        
        /* Run our query. */
        $GetSingleRow_Query = mysql_query("SELECT $select_variable FROM $Table $options_variable") or die("GetSingleRow_Query Error: ".mysql_error());
        $this->QueryCount++;
        
        return $this->_FetchAssoc($GetSingleRow_Query);
    }
    
    function QueryCount() {
        return $this->QueryCount;
    }
    
    
    function _FetchRow($Query) {
        $FetchArray = mysql_fetch_row($Query);
        $this->QueryCount++;
        return $FetchArray;
    }
    
    function _FetchArray($Query) {
        $FetchArray = mysql_fetch_array($Query, MYSQL_ASSOC);
        $this->QueryCount++;
        return $FetchArray;
    }
    
    function _FetchAssoc($Query) {
        $FetchAssoc = mysql_fetch_assoc($Query);
        $this->QueryCount++;
        return $FetchAssoc;
    }
    
} // close class Database