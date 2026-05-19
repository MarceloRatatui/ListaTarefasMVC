<?php
session_start();

// verifico se o cara ta logado conferindo a sessao. se nao tiver, chuto ele de volta pro login
if (isset($_SESSION['usuario_id']) == false) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Tarefa</title>
    <style>
        /* um css basico pra tela nao ficar tao feia e a tabela nao ficar torta rs */
        body { font-family: Arial; background: #f5f5f5; padding: 20px; }
        form { background: #fff; padding: 20px; border-radius: 5px; width: 400px; margin: auto; }
        input, textarea, select, button { display: block; width: 100%; margin-bottom: 10px; padding: 8px; }
        button { background: #28a745; color: #fff; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Adicionar Nova Tarefa</h2>
    
    <!-- o form manda os dados la pro roteador no index.php passando a acao pela url pro switch pegar -->
    <form method="post" action="../index.php?action=adicionar_tarefa">
        
        <!-- coloco required no titulo pra nao deixar salvar tarefa vazia e bugar o layout depois -->
        <input type="text" name="titulo" placeholder="Título" required>
        
        <textarea name="descricao" placeholder="Descrição"></textarea>
        
        <select name="status">
            <option value="pendente">Pendente</option>
            <option value="concluida">Concluída</option>
        </select>
        
        <button type="submit">Adicionar</button>
    </form>
    
    <br>
    <a href="dashboard.php">Voltar</a>
</body>
</html>