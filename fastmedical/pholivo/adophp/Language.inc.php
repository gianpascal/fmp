<?php
Class Language{
    public static function pickMessage($typeerror,$id,$language){
        global $pathLanguages;
        echo $pathLanguages;
        require_once($pathLanguages.$language.".inc.php");
        $MessageList = new MessageList();
        return $MessageList->ErrorMessages[$typeerror][$id];
    }
}
?>