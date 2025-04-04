<!DOCTYPE html>
<html lang="pt-br">

<head>
    <base href="<?php URL_padrao; ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/core/templates/preview.css">
    <title>Preview</title>
</head>

<body>

    <main>
        <h2 class="titulo_preview">Preview de debug</h2>
        <section class="container_dados">
            <p class="texto_debug">
                <?php print_r($dataDebug); ?>
            </p>
        </section>
    </main>

</body>

</html>