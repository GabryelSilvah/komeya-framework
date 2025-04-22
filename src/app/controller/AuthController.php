<?php

namespace Komeya\app\controller;

use Komeya\app\model\UsuarioModel;
use Komeya\app\services\AuthService;
use Komeya\core\architecture\Controller;
use function Komeya\core\resources\view;
use function Komeya\core\resources\getInput;

#[Controller]
class AuthController
{

    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService;
    }

    public function telaLogin()
    {
        view("telalogin");
    }

    public function autenticar()
    {

        $usuario = new UsuarioModel(95, "Gabriel", "123", "ADMIN");
     
        if ($this->authService->auntenticarUser($usuario)) {
            view("painel");
        } else {
            view("telalogin");
        }
    }


    public function logout(){
        $this->authService->sair();
        view("telaLogin");
    }
}
