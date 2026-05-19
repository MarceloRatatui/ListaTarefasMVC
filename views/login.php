<?php
// preciso iniciar a sessao aqui no topo senao o php nao consegue guardar os dados de quem logou depois
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Acesso ao Sistema</title>
    <style>
        /* fundo cinza bem claro pra nao doer a vista */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: #333;
        }

        /* usei flexbox pra colocar o form de login e o de cadastro lado a lado, achei q ficou mais legal */
        .container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        /* caixinhas brancas padrao pros formularios */
        form {
            background-color: #ffffff; 
            padding: 30px;
            border-radius: 8px;
            width: 300px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05); /* sombrinha bem de leve */
        }

        h2 {
            margin-top: 0;
            color: #444;
            text-align: center;
            margin-bottom: 20px;
            font-size: 22px;
        }

        /* arrumei os inputs pra ficarem um embaixo do outro ocupando o espaco todo */
        input {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; 
            font-size: 14px;
        }

        /* borda azul quando clica pra digitar */
        input:focus {
            outline: none;
            border-color: #007bff;
        }

        button {
            width: 100%;
            padding: 10px;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        /* deixei o botao de login azul e o de cadastro verde pra pessoa nao se confundir e clicar errado */
        .btn-login {
            background-color: #007bff;
        }
        .btn-login:hover {
            background-color: #0056b3;
        }

        .btn-cadastro {
            background-color: #28a745;
        }
        .btn-cadastro:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <!-- FORMULARIO 1: LOGIN -->
        <!-- manda pro nosso roteador index.php passando a acao=login -->
        <form method="post" action="../index.php?action=login">
            <h2>Login</h2>
            <!-- coloco required pra evitar do cara tentar logar com espaco em branco -->
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit" class="btn-login">Entrar</button>
        </form>

        <!-- FORMULARIO 2: CADASTRO -->
        <!-- esse aqui manda pro mesmo index, mas com a acao=cadastrar -->
        <form method="post" action="../index.php?action=cadastrar">
            <h2>Novo Cadastro</h2>
            <input type="text" name="nome" placeholder="Nome completo" required>
            <input type="email" name="email" placeholder="E-mail" required>
            
            <!-- a senha vai ser criptografada pelo bcrypt la no Model depois -->
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit" class="btn-cadastro">Cadastrar</button>
        </form>
        
    </div>
</body>
</html>