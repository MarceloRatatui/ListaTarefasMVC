<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Erro no Cadastro</title>
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
            color: #dc3545; 
        }

        p {
            color: #666;
            line-height: 1.5;
            margin-bottom: 25px;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            background-color: #6c757d; 
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <!-- essa div toda aqui so aparece se a validacao la do banco avisar que o email ja tem dono -->
    <div class="card">
        <h2>Atenção</h2>
        <p>O e-mail informado já está cadastrado em nosso sistema. Por favor, tente fazer login ou utilize outro e-mail.</p>
        
        <!-- o botao volta pro index principal (roteador), senao o cara fica travado nessa tela pra sempre -->
        <a href="../index.php" class="btn">Voltar</a>
    </div>
</body>
</html>