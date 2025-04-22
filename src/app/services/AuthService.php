<?php

namespace Komeya\app\services;

use Komeya\app\dao\AuthDAO;
use Komeya\app\model\UsuarioModel;
use Komeya\core\annotetions\Service;

#[Service]
class AuthService
{
    private AuthDAO $authdao;

    public function __construct()
    {
        $this->authdao = new AuthDAO;
    }

    public function auntenticarUser(UsuarioModel $user)
    {

        $usuario =   $this->authdao->findById(95);

        if (password_verify($user->getSenha(), $usuario[0]["senha"]) && $user->getUsuario() == $usuario[0]["email"]) {
            $_SESSION["usuario"] = $usuario[0]["email"];
            $_SESSION["role"] = "ADMIN";
            return true;
        }

        return false;
    }

    public function sair()
    {
        session_unset();
        session_destroy();
    }
}
