<?php
namespace Komeya\core\resources;
class Debug
{
    public static function preview($dataDebug)
    {
        require_once("./Z_Moldes/core/templates/V_preview.php");
        die();
    }

    public static function debugSQl($message, $erro)
    {
        $dataDebug =  [
            "typeErro" => $message,
            "file" => $erro->getFile(),
            "line" => $erro->getLine(),
            "message" => $erro->getMessage()
        ];
        require_once("../../Z_Moldes/core/templates/V_exception.php");
        die();
    }

    public static function debugException($dataDebug)
    {
        require_once("./Z_Moldes/core/templates/V_exception.php");
        die();
    }
}
