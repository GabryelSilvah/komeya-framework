<?php

namespace Komeya\app\model;

use Komeya\core\annotetions\Entity;
use Komeya\core\annotetions\Id;
use Komeya\core\annotetions\Table;

#[Entity]
#[Table("usuarios")]
class UsuarioModel
{
    #[Id]
    private int $id;
    private string $email;
    private string $senha;
    private string $role;

    public function __construct(int $id = 0, string $email, string $senha, string $role)
    {
        $this->id = $id;
        $this->email = $email;
        $this->senha = $senha;
        $this->role = $role;
    }

    //Gettes and Settes
    public function getId()
    {
        return $this->id;
    }
    public function setId(string $id)
    {
        $this->id = $id;
    }
    public function getUsuario()
    {
        return $this->email;
    }
    public function setUsuario(string $email)
    {
        $this->email = $email;
    }
    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha(string $senha)
    {
        $this->senha = $senha;
    }
}
