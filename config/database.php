<?php
class Database {
    // guarda a conexao pra nao ficar abrindo toda hora (padrao Singleton)
    private static $instance = null;
    private $conn;

    // infos do meu banco (no xampp padrao o root nao tem senha)
    private $host = "localhost";
    private $db = "lista_tarefas";
    private $user = "root";
    private $pass = "";

    // o construtor tem que ser private por causa do singleton q o exercicio pede pra usar
    private function __construct() {
        try {
            // juntei os textos pra montar a string de conexao certinha
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=utf8";
            
            // instancio o pdo aqui
            $this->conn = new PDO($dsn, $this->user, $this->pass);
            
            // pede pro PDO avisar se der algum erro nos comandos sql
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $e) {
            // se der pau na conexao o sistema morre aqui mesmo e mostra o erro
            die("Erro de conexão: " . $e->getMessage());
        }
    }

    // aq eu checo se ja tem uma instancia da conexao, se nao tiver eu crio uma nova
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // funcao pra eu conseguir usar a conexao la nos meus models e controllers
    public function getConnection() {
        return $this->conn;
    }
}
?>