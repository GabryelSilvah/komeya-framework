<?php

namespace Komeya\app\dao;

use Komeya\core\annotetions\Query;
use Komeya\core\annotetions\Repository;
use Komeya\core\architecture\Dao;

#[Repository("UsuarioModel")]
class AuthDAO extends Dao
{
    #[Query("SELECT * FROM usuarios WHERE email = 'adm'")]
    function findByUser() {}
}
