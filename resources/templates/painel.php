<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resources/static/css/painel.css">
    <link rel="stylesheet" href="./resources/static/css/menu.css">
    <title>Painel</title>
</head>

<body>

    <header>
        <?php require_once("../../resources/templates/menu.php"); ?>
    </header>
    <main>
        <section class="container_metricas">
            <div class="metricas_gerais" id="metrica_primaria_opcao_1">
                <p class="nome_metrica_primarias">Total de Receitas</p>
                <p class="valor_metrica">233</p>
                <img src="./resources/static/image/comida.png">
            </div>
            <div class="metricas_gerais" id="metrica_primaria_opcao_2">
                <p class="nome_metrica_primarias">Total de Livros</p>
                <p class="valor_metrica">345</p>
                <img src="./resources/static/image/livro.png">
            </div>
            <div class="metricas_gerais" id="metrica_primaria_opcao_3">
                <p class="nome_metrica_primarias">Total de Restaurantes</p>
                <p class="valor_metrica">35</p>
                <img src="./resources/static/image/restaurante.png">
            </div>
            <div class="metricas_gerais" id="metrica_primaria_opcao_4">
                <p class="nome_metrica_primarias">Total de Funcionários</p>
                <p class="valor_metrica">35</p>
                <img src="./resources/static/image/funcionarios.png">
            </div>

        </section>

        <section class="container_metrica_secundarias">
            <div class="metricas_secundarias metricas_secundarios_1" id="metrica_1">
                <p class="nome_metrica">Melhor receita: </p>
                <p class="valor_metrica_secundaria">Lamém</p>

                <p class="nome_metrica">Melhor cozinheiro(a): </p>
                <p class="valor_metrica_secundaria">Maria</p>

                <p class="nome_metrica">Ingrediente mais usado: </p>
                <p class="valor_metrica_secundaria">sal</p>

                <p class="nome_metrica">Restaurante com maior nº de receitas: </p>
                <p class="valor_metrica_secundaria">Tempero de Brasília</p>

            </div>

            <div class="metricas_secundarias scrool" id="container_tabela">
                <table class="tabela_usuarios">
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Cargo</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Jane</td>
                        <td>Cozinheira</td>
                        <td>Ativo</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Jane</td>
                        <td>Cozinheira</td>
                        <td>Ativo</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Jane</td>
                        <td>Cozinheira</td>
                        <td>Ativo</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Jane</td>
                        <td>Cozinheira</td>
                        <td>Ativo</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Jane</td>
                        <td>Cozinheira</td>
                        <td>Ativo</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Jane</td>
                        <td>Cozinheira</td>
                        <td>Ativo</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Jane</td>
                        <td>Cozinheira</td>
                        <td>Ativo</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Jane</td>
                        <td>Cozinheira</td>
                        <td>Ativo</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Jane</td>
                        <td>Cozinheira</td>
                        <td>Ativo</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Jane</td>
                        <td>Cozinheira</td>
                        <td>Ativo</td>
                    </tr>




                </table>
            </div>
        </section>


    </main>
</body>

</html>