<?php

class Exception_rota
{
    public function erro_rota($erro, $controller, $metodo)
    {

        require_once("Z_moldes/templates/view/V_erro.php");
        render_page([
            "mensagem" => $erro,
            "class" => $controller,
            "metodo" => $metodo
        ]);
    }
}
