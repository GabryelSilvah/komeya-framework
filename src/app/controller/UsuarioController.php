<?php

namespace Komeya\app\controller;

use Komeya\app\model\UsuarioModel;
use Komeya\app\services\UsuarioService;
use Komeya\core\architecture\Controller;
use function Komeya\core\resources\response_json;


#[Controller]
class UsuarioController
{
  private $serviceUsuario;
  public function __construct()
  {
    $this->serviceUsuario = new UsuarioService;
  }

  public function exibir() {}

  public function cadastrar()
  {
    $usuario = new UsuarioModel(1, "Gabriel", "123", "ADMIN");
    $this->serviceUsuario->salvarUsuario($usuario);
    response_json($usuario);
  }

  public function alterar() {}

  public function delete() {}
}
