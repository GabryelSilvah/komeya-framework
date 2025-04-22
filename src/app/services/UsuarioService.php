<?php
namespace Komeya\app\services;

use Komeya\app\dao\UsuarioDao;
use Komeya\app\model\UsuarioModel;
use Komeya\core\annotetions\Service;

#[Service]
class UsuarioService
{

    private $daoUsuario;
    public function __construct()
    {
        $this->daoUsuario = new UsuarioDao;
    }

    public function buscarUsuario(int $id) {

    }
    public function salvarUsuario(UsuarioModel $usuario)
    {

        //Criptografando senha
        $senhaSegura = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);
        $usuario->setSenha($senhaSegura);

        //Salvando usuário no banco de dados
        $encontrado = $this->daoUsuario->save($usuario);

        return true;
    }
    public function deletearUsuario() {}
    public function alterarUsuario() {}
}
