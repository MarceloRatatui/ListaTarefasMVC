<?php
require_once __DIR__ . '/../models/Usuario.php';

class LoginController {
    private $usuarioModel;

    public function __construct() {
        // instancio o model de usuario aqui pra poder usar as funcoes dele la no banco
        $this->usuarioModel = new Usuario();
    }

    public function cadastrar() {
        // pega as variaveis do post. se nao mandou nada, deixa vazio pra nao dar erro
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

        // aqui eu verifico se o cara ja tem conta com esse email
        if ($this->usuarioModel->emailExiste($email) == true) {
            // se o email ja existir, mando pra tela avisando que deu ruim
            header("Location: views/cadastro_erro.php");
            exit;
        }

        // tenta cadastrar no banco chamando o model
        $cadastrou = $this->usuarioModel->cadastrar($nome, $email, $senha);

        if ($cadastrou == true) {
            // se salvou certinho, vai pra tela de sucesso
            header("Location: views/cadastro_sucesso.php");
            exit;
        } else {
            // se nao entrar no if de cima, deu algum pau no insert
            echo "Erro ao cadastrar usuário!";
        }
    }

    public function login() {
        // pega o que o cara digitou no form de login
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

        // mando pro model testar se o email e a senha estao certos mesmo
        $usuario = $this->usuarioModel->login($email, $senha);

        if ($usuario != false) {
            // se achou o cara no banco, crio as sessoes com o id e nome dele
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            
            // e jogo ele pra tela inicial (dashboard)
            header("Location: views/dashboard.php");
            exit; // coloquei exit aqui pra parar de carregar o resto
        } else {
            echo "Email ou senha incorretos!";
        }
    }

    public function logout() {
        // aqui eu mato a sessao pra deslogar o cara do sistema
        session_destroy();
        
        // e redireciono ele de volta pro form de entrar
        header("Location: views/login.php");
        exit;
    }
}
?>