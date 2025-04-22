<?php

namespace Komeya\app\controller;

use Komeya\core\architecture\Controller;

use function Komeya\core\resources\view;

#[Controller]
class ReceitaController
{

    public function exibir()
    {
        view("receitasTela");
    }
}
