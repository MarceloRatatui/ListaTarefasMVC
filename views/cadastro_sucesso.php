<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro Concluído</title>
    <style>
        
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

        .card {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            width: 350px;
            text-align: center;
            border: 1px solid #ddd;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        h2 {
            margin-top: 0;
            
            color: #28a745; 
        }

        p {
            color: #666;
            line-height: 1.5;
            margin-bottom: 25px;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- tela simpleszinha so pra dar um feedback pro usuario, senao ele clica e nao sabe se salvou no banco -->
    <div class="card">
        <h2>Sucesso!</h2>
        <p>Seu cadastro foi realizado. Agora você já pode acessar o sistema.</p>
        
        <!-- manda de volta pro index.php (nosso roteador) pro cara finalmente logar com o email e a senha q ele acabou de criar -->
        <a href="../index.php" class="btn">Ir para o Login</a>
    </div>
</body>
</html>