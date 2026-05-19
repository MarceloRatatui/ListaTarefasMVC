<?php
session_start();

// se nao tem sessao, volta pro login
if (isset($_SESSION['usuario_id']) == false) {
    header("Location: login.php");
    exit;
}

// chamo o banco de dados aqui so pra buscar os dados antigos e preencher o form (o update de verdade ta no controller)
require_once __DIR__ . '/../config/database.php';
$db = Database::getInstance()->getConnection();

// pego o id que veio no link la do dashboard
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = null;
}

// se o cara tentar acessar a tela sem passar o id da tarefa na url, eu mando ele voltar pro painel
if ($id == null) {
    header("Location: dashboard.php");
    exit;
}

// busco a tarefa pelo id, e coloco o usuario_id pra ter certeza q a tarefa é da pessoa msm e nao de outro aluno rs
$stmt = $db->prepare("SELECT * FROM tarefas WHERE id = :id AND usuario_id = :usuario_id");
$stmt->execute([
    ':id' => $id, 
    ':usuario_id' => $_SESSION['usuario_id']
]);
$tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

// se o banco devolver falso é pq a tarefa nao existe ou ele ta tentando hackear tarefa dos outros
if ($tarefa == false) {
    echo "Tarefa não encontrada!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <style>
        /* mesmo css do adicionar pra manter o padrao */
        body { font-family: Arial; background: #f5f5f5; padding: 20px; }
        form { background: #fff; padding: 20px; border-radius: 5px; width: 400px; margin: auto; }
        input, textarea, select, button { display: block; width: 100%; margin-bottom: 10px; padding: 8px; }
        button { background: #ffc107; color: #000; border: none; cursor: pointer; } /* botao amarelinho pra dar ideia de edicao */
    </style>
</head>
<body>
    <h2>Editar Tarefa</h2>
    
    <!-- manda pro index e a acao de editar pega la no switch -->
    <form method="post" action="../index.php?action=editar_tarefa">
        
        <!-- coloco o id escondido aqui (hidden) pq o controller precisa saber qual tarefa vai dar update no WHERE, mas o usuario nao precisa ver -->
        <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">
        
        <!-- preencho o value com o titulo que veio do banco. uso htmlspecialchars de novo por seguranca -->
        <input type="text" name="titulo" value="<?php echo htmlspecialchars($tarefa['titulo']); ?>" required>
        
        <textarea name="descricao"><?php echo htmlspecialchars($tarefa['descricao']); ?></textarea>
        
        <!-- aqui eu faco um if basico pra ver qual status veio do banco e deixar ele selecionado (selected) no form pra facilitar -->
        <select name="status">
            <option value="pendente" <?php if($tarefa['status'] == 'pendente') { echo 'selected'; } ?>>Pendente</option>
            <option value="concluida" <?php if($tarefa['status'] == 'concluida') { echo 'selected'; } ?>>Concluída</option>
        </select>
        
        <button type="submit">Salvar Alterações</button>
    </form>
    
    <br>
    <a href="dashboard.php">Voltar</a>
</body>
</html>