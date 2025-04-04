<?php

class Debug
{
    public static function preview($dataDebug)
    {
        require_once("src/core/templates/V_preview.php");
        die();
    }

    public static function debugSQl($dataDebug)
    {
        require_once("src/core/templates/V_exception.php");
        die();
    }

    public static function debugException($dataDebug)
    {
        require_once("src/core/templates/V_exception.php");
        die();
    }
}
