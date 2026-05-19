<?php
require_once __DIR__ . '/../config/database.php';

class TarefaController {
    private $db;

    public function __construct() {
        // pego a conexao com o banco pra poder dar os inserts e updates
        $this->db = Database::getInstance()->getConnection();
    }

    public function adicionar() {
        // verifico se o form foi enviado por POST pra nao dar erro se alguem tentar acessar a url direto
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // pego os campos la do form usando isset pra nao dar warning
            $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
            $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
            
            // se a pessoa nao mandou status, eu coloco pendente como padrao
            $status = isset($_POST['status']) ? $_POST['status'] : 'pendente';

            // preparo a query pra evitar sql injection q o prof falou na aula
            $stmt = $this->db->prepare("INSERT INTO tarefas (usuario_id, titulo, descricao, status) VALUES (:usuario_id, :titulo, :descricao, :status)");
            
            // rodo a query passando o id do usuario logado q ta na sessao
            $stmt->execute([
                ':usuario_id' => $_SESSION['usuario_id'],
                ':titulo' => $titulo,
                ':descricao' => $descricao,
                ':status' => $status
            ]);

            // dps de salvar, volto pra tela inicial
            header("Location: views/dashboard.php");
            exit;
        }
    }

    public function editar() {
        // mesma coisa do adicionar, vejo se veio pelo form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
            $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
            $status = isset($_POST['status']) ? $_POST['status'] : 'pendente';

            // dou update na tabela, mas coloco o usuario_id no WHERE pra garantir que ele so edite a propria tarefa
            $stmt = $this->db->prepare("UPDATE tarefas SET titulo = :titulo, descricao = :descricao, status = :status WHERE id = :id AND usuario_id = :usuario_id");
            
            $stmt->execute([
                ':titulo' => $titulo,
                ':descricao' => $descricao,
                ':status' => $status,
                ':id' => $id,
                ':usuario_id' => $_SESSION['usuario_id']
            ]);

            // volta pro painel
            header("Location: views/dashboard.php");
            exit;
        }
    }

    public function remover() {
        // aqui pega o id que vem na url tipo ?action=remover_tarefa&id=2
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        
        // se tiver um id, mando apagar
        if ($id != null) {
            // de novo, passo o usuario_id pra evitar que alguem apague tarefa de outro mudando o id na url rs
            $stmt = $this->db->prepare("DELETE FROM tarefas WHERE id = :id AND usuario_id = :usuario_id");
            $stmt->execute([
                ':id' => $id,
                ':usuario_id' => $_SESSION['usuario_id']
            ]);
        }
        
        // atualiza a tela
        header("Location: views/dashboard.php");
        exit;
    }
}
?>