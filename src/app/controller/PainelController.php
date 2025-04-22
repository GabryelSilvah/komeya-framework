<?php

namespace Komeya\app\controller;

use Komeya\core\architecture\Controller;

use function Komeya\core\resources\view;

#[Controller]
class PainelController
{

    public function exibir()
    {
        view("painel");
    }
}
