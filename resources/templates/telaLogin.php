<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resources/static/css/telaLogin.css">
    <title>Login</title>
</head>

<body>

    <form action="./autenticar" class="formLogin" method="post">
        <label for="">Usuário</label>
        <input type="text" placeholder="Insira seu usuário..." name="usuario" required>
        <label for="">Senha</label>
        <input type="password" placeholder="Insira sua senha..." name="senha" required>
        <button type="submit">Entrar</button>
    </form>

</body>

</html>