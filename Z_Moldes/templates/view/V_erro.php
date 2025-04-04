<?php

function render_page($dados = null)
{

    $popular_dados = $dados;

?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <base href="<?php echo DNS; ?>">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Z_Moldes/templates/css/tela_erro.css">
        <title>Erros</title>
    </head>

    <body>
        <main>
            <section>
                <h1>Relatório de erros</h1>
            </section>
            <section class="container_mensagem_erro">
                <h2>Erro: <?php echo $popular_dados["mensagem"]; ?></h2>
                <p>Controller: <?php echo $popular_dados["class"]; ?></p>
                <p>Método: <?php echo $popular_dados["metodo"]; ?></p>

            </section>
        </main>
    </body>

    </html>


<?php
}
