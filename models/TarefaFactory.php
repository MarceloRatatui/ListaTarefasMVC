<?php
require_once __DIR__ . '/../config/database.php';

// criei essa classe so pra guardar os dados de cada tarefa num objeto mais organizado
class Tarefa {
    public $id;
    public $usuario_id;
    public $titulo;
    public $descricao;
    public $status;
    public $data_criacao;

    // esse construtor preenche as variaveis quando eu dou um 'new Tarefa'
    public function __construct($id, $usuario_id, $titulo, $descricao, $status, $data_criacao) {
        $this->id = $id;
        $this->usuario_id = $usuario_id;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->status = $status;
        $this->data_criacao = $data_criacao;
    }
}

// como o exercicio pedia pelo menos 2 padroes de projeto, fiz esse Factory (fabrica) pra instanciar as tarefas
class TarefaFactory {
    private $db;

    public function __construct() {
        // chamo a conexao com aquele padrao Singleton
        $this->db = Database::getInstance()->getConnection();
    }

    // funcao que vai no banco, busca as tarefas e devolve uma lista de objetos pra tela usar
    public function getTarefasDoUsuario($usuario_id) {
        // procuro as tarefas do id logado e coloco DESC pro mais novo aparecer em cima
        $stmt = $this->db->prepare("SELECT * FROM tarefas WHERE usuario_id = :usuario_id ORDER BY data_criacao DESC");
        $stmt->execute([':usuario_id' => $usuario_id]);
        
        // fetchAll pega todas as linhas do select de uma vez so
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // crio uma lista vazia pra ir guardando
        $tarefas = [];
        
        // passo linha por linha do select com um foreach
        foreach ($resultados as $row) {
            // instancio uma tarefa nova com os dados que vieram do banco
            $tarefa_obj = new Tarefa(
                $row['id'],
                $row['usuario_id'],
                $row['titulo'],
                $row['descricao'],
                $row['status'],
                $row['data_criacao']
            );
            
            // coloco a tarefa dentro do meu array (tipo um push)
            $tarefas[] = $tarefa_obj;
        }
        
        // entrego a lista cheia
        return $tarefas;
    }
}
?>