<?php

spl_autoload_register(function ($class) {

    $pastas = ["model", "dao", "controller", "services"];

    foreach ($pastas as $pasta) {


        $caminho = ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . $pasta . DIRECTORY_SEPARATOR . $class . ".php";

        if (file_exists($caminho)) {

            require_once($caminho);
        }
    }
});

spl_autoload_register(function ($class) {

    $pastas = ["arquitetura", "recursos"];

    foreach ($pastas as $pasta) {


        $caminho = ".." . DIRECTORY_SEPARATOR . "Z_Moldes" . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . $pasta . DIRECTORY_SEPARATOR . $class . ".php";

        if (file_exists($caminho)) {

            require_once($caminho);
        }
    }
});
