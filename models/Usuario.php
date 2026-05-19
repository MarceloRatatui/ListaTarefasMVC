<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {
    private $db;

    public function __construct() {
        // puxa a conexao com o banco igual eu fiz na fabrica de tarefas
        $this->db = Database::getInstance()->getConnection();
    }

    // funcao pra salvar o cara novo no banco
    public function cadastrar($nome, $email, $senha) {
        // o exercicio pediu pra usar bcrypt pra criptografar a senha, entao fiz assim:
        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

        // prepared statement pra evitar o tal do SQL Injection
        $stmt = $this->db->prepare("INSERT INTO usuarios (nome, email, senha_hash) VALUES (:nome, :email, :senha)");
        
        // executa e guarda se deu certo ou errado numa variavel
        $salvou = $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senhaHash
        ]);

        // verifico se o insert funcionou de verdade
        if ($salvou == true) {
            return true;
        } else {
            return false;
        }
    }

    // checar se o email e a senha estao certos pra entrar
    public function login($email, $senha) {
        // primeiro procuro se tem alguem cadastrado com esse email
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute([':email' => $email]);
        
        // pego os dados do banco
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // se o fetch retornar algo diferente de falso, o usuario existe
        if ($usuario != false) {
            
            // agora eu uso o verify pra comparar a senha q ele digitou com o hash do banco
            if (password_verify($senha, $usuario['senha_hash'])) {
                return $usuario; // login ok, devolvo os dados dele pro controller
            } else {
                return false; // errou a senha
            }
            
        } else {
            return false; // nao achou ninguem com esse email
        }
    }

    // isso aqui eu uso la no controller pra nao deixar cadastrar email duplicado
    public function emailExiste($email) {
        // busco so o id pra ficar mais leve no banco
        $stmt = $this->db->prepare("SELECT id FROM usuarios WHERE email = :email");
        $stmt->execute([':email' => $email]);
        
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // se veio algum resultado, quer dizer que o email ja ta em uso
        if ($resultado != false) {
            return true;
        } else {
            return false;
        }
    }
}
?>