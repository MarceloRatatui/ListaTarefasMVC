<?php
session_start();

// ve se o cara ta logado mesmo olhando a sessao, senao chuta ele pro login de novo pra nao ver o painel escondido
if (isset($_SESSION['usuario_id']) == false) {
    header("Location: login.php");
    exit;
}

// puxo a fabrica de tarefas que eu criei la nos models pra usar o padrao de projeto do exercicio
require_once __DIR__ . '/../models/TarefaFactory.php';
$factory = new TarefaFactory();

// pego a lista de tarefas passando o id do cara que ta na sessao pra nao misturar com as dos outros
$tarefas = $factory->getTarefasDoUsuario($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        /* css basicao pra nao deixar a tela toda branca */
        body { font-family: Arial; background: #f5f5f5; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #eee; }
        a { text-decoration: none; color: blue; }
        .btn { padding: 5px 10px; background: #007BFF; color: #fff; border-radius: 3px; }
        
        /* botao de sair vermelhinho */
        .logout { background: #dc3545; }
    </style>
</head>
<body>
    <!-- pega o nome que salvei na sessao la no login pra dar boas vindas -->
    <h2>Bem-vindo, <?php echo $_SESSION['usuario_nome']; ?>!</h2>
    
    <!-- manda la pro index pra acao de logout matar a sessao -->
    <a href="../index.php?action=logout" class="btn logout">Sair</a>

    <h3>Suas tarefas</h3>
    <a href="adicionar_tarefa.php" class="btn">Adicionar Tarefa</a>

    <table>
        <tr>
            <th>Título</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        
        <!-- conto se o array de tarefas tem alguma coisa. se for zero, aviso q ta vazio -->
        <?php if(count($tarefas) == 0): ?>
            <tr>
                <!-- colspan 4 pra mesclar a linha toda da tabela -->
                <td colspan="4">Você ainda não tem tarefas.</td>
            </tr>
        <?php else: ?>
            
            <!-- se tiver tarefas, rodo o foreach pra criar as linhas -->
            <?php foreach($tarefas as $tarefa): ?>
            <tr>
                <!-- uso o htmlspecialchars pra evitar do cara tentar rodar script (XSS) no titulo ou quebrar a tabela -->
                <td><?php echo htmlspecialchars($tarefa->titulo); ?></td>
                <td><?php echo htmlspecialchars($tarefa->descricao); ?></td>
                <td><?php echo $tarefa->status; ?></td>
                <td>
                    <!-- passo o ID pela url pro editar e pro remover saberem qual tarefa pegar -->
                    <a href="editar_tarefa.php?id=<?php echo $tarefa->id; ?>">Editar</a> |
                    <a href="../index.php?action=remover_tarefa&id=<?php echo $tarefa->id; ?>">Remover</a>
                </td>
            </tr>
            <?php endforeach; ?>
            
        <?php endif; ?>
    </table>
</body>
</html>