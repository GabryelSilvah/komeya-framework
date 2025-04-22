<?php


spl_autoload_register(
    function (string $nomeClasse) {
        $caminhoCompleto = str_replace('Komeya\\boot_system\\', "..\\boot_system\\", $nomeClasse);
        $caminhoCompleto = str_replace('\\', DIRECTORY_SEPARATOR, $caminhoCompleto);

        $pathFile =  $caminhoCompleto . ".php";

        //echo "Classe recebida: " . $pathFile . "<br><br>";
        if (file_exists($pathFile)) {
            // print_r($caminhoCompleto);
            require_once($pathFile);
        }
    }
);

spl_autoload_register(
    function (string $nomeClasse) {
        $directories = ["exceptions","resources"];

        foreach ($directories as $directory) {

            $caminhoCompleto = str_replace('Komeya\\', "..\\..\\Z_Moldes\\", $nomeClasse);
            $caminhoCompleto = str_replace('\\', DIRECTORY_SEPARATOR, $caminhoCompleto);

            $pathFile =  $caminhoCompleto . ".php";

            //echo "Classe recebida: " . $nomeClasse . "<br><br>";
            //echo "Classe pronta: " . $caminhoCompleto . "<br><br>";
            if (file_exists($pathFile)) {
                require_once($pathFile);
            }
        }
    }
);
