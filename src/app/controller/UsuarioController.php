<?php

class UsuarioController extends Controller
{

  public function show()
  {
    echo "<pre>";
    print_r(file_get_contents("php://input"));
    $this->response_json("Ola");
  }

  public function exibir()
  {
    echo "Olá, controller";
  }
}
