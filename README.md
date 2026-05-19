# Sistema de Lista de Tarefas (PHP + MVC)
 O tema escolhido foi um gerenciador de tarefas com cadastro de usuários, login e um CRUD completo.

## 📝 Conclusão e Estrutura do Código

O sistema foi construído do usando a arquitetura MVC, separando as responsabilidades para deixar o código organizado:

- Models: Onde ficam as classes `Usuario` e `Tarefa`. Faz a comunicação direta com o banco.
- Views: São as telas (formulários, painel, etc.). Contêm o HTML e apenas o PHP necessário para exibir os dados na tela.
- Controllers: Fazem o meio de campo. Vão receber as informações do user, chamam os Models para salvar ou buscar no banco e indicam para a View certa.
- Roteador (`index.php`): O arquivo principal faz o papel dw um "Front Controller", pegando a ação via URL e decidindo o Controller que vai acionar.

### Padrões de Projeto (Design Patterns)
Apliquei 2 padrões de projeto no sistema:
1. Singleton (`Database.php`): Garante que somente uma única conexão com o banco de dados abra por requisição, deixando o sistema mais otimizado.
2. Factory (`TarefaFactory.php`): Possui a lógica de buscar os registros no banco de dados e instancia automaticamente os objetos da classe `Tarefa` para aparecerem no painel.

### Funcionalidades e Segurança
- O CRUD de tarefas está 100% (Adicionar, Listar, Editar e Remover).
- As senhas dos usuários são salvas com criptografia forte usando a função nativa do PHP com Bcrypt (`password_hash`).
- Utilizei PDO com `Prepared Statements` nas consultas pra evitar ataques de SQL Injection.
- O sistema valida o ID da sessão, de forma que o usuário só veja, edite ou apague as tarefas que pertencem a ele.