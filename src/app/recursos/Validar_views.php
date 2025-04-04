<?php

class Validar_views
{

    public static function acesso_restrito(string $destinho, string $chave_session)
    {
        if (!isset($_SESSION[$chave_session]) && empty($_SESSION[$chave_session])) {
            header("Location: " . $destinho);
            exit;
        }
    }

    public static function acesso_publico(string $destinho, string $chave_session)
    {
        if (isset($_SESSION[$chave_session]) && !empty($_SESSION[$chave_session])) {
            header("Location: " . $destinho);
            exit;
        }
    }
}
