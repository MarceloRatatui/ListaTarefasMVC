<?php
// ligo a exibição de erros aqui no topo pq se der pau em alguma coisa o PHP me avisa direto na tela (ajuda mt a debugar)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// inicio a sessao logo de cara pra não ter problema do login ficar caindo nas outras telas
session_start();    

// pego a acao que vm pela url (ex: ?action=login). se a pessoa nao mandou nada, deixo a variavel vazia
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '';
}

// puxo os arquivos dos meus dois controllers pra poder usar as funcoes deles
require_once __DIR__ . '/controllers/LoginController.php';
require_once __DIR__ . '/controllers/TarefaController.php'; 

// dou um new nos dois controllers aqui pra eles ficarem prontos pra uso
$loginController = new LoginController();
$tarefaController = new TarefaController(); 

// esse switch funciona como o ROTEADOR principal do meu MVC. 
// ele olha a variavel $action e decide qual mtdo de qual controller ele vai chamar
switch ($action) {
    case 'login':
        $loginController->login();
        break;
        
    case 'cadastrar':
        $loginController->cadastrar();
        break;
        
    case 'logout':
        $loginController->logout();
        break;
        
    case 'adicionar_tarefa':
        $tarefaController->adicionar();
        break;
        
    case 'editar_tarefa':
        $tarefaController->editar();
        break;
        
    case 'remover_tarefa':
        $tarefaController->remover();
        break;
        
    default:
        // se a pessoa digitou a url limpa (localhost/ListaTarefasMVC) sem nenhuma acao, 
        // cai no default e eu jogo ela pra tela de login por padrao
        header("Location: views/login.php");
        exit;
}
?>