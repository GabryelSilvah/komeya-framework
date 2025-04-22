<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Z_Moldes/core/templates/exception.css">
    <title>Debug</title>
</head>

<body>

    <main>
        <section class="container_mensagem_erro">
            <h2 id="titulo_erro">Erro: <?= $dataDebug["typeErro"] ?? null ?></h2>
            <p id="linha">Linha: <?= $dataDebug["line"] ?? null ?></p>
            <p id="arquivo">Arquivo: <?= $dataDebug["file"] ?? null ?></p>
            <p id="mensagem">Mensagem de erro: <?= $dataDebug["message"] ?? null ?></p>
        </section>
    </main>

</body>

</html>