# ProjetoPHP
Exemplo register/login simples com CRUD mysql

# Projeto MVC em PHP

# Estrutura do projeto
* app/: Diretório que contém os arquivos da aplicação.
	+ controllers/: Diretório que contém os controladores da aplicação.
	+ models/: Diretório que contém os modelos da aplicação.
	+ views: Diretório que contém as views da aplicação.
* core/ : Diretório que contém arquivos centrais da aplicaçao.
  + Controller.php : contém a classe base para os controllers.
  + router.php : contém a classe Router, um roteador de rotas.
  + routes.php : array que contém as rotas, controllers e metodos chamada pela Router.
* config/: Diretório que contém os arquivos de configuração da aplicação.
	+ database.php: Arquivo que contém as configurações do banco de dados.
* public/ : Diretório que contém os arquivos públicos da aplicação.
	+ index.php: Arquivo que é o ponto de entrada da aplicação.
	+ .htaccess: Arquivo que contém as configurações do servidor Apache.


# Funcionamento
* O usuário faz uma requisição para a aplicação através do index.php.
* O index.php instancia a classe Router que trata a url e chama a rota solicitada e instancia o controller correspondente e chama o metódo.
* A view é chamada, usuários não logado é redirecionado para home, usuário que tentarem acessar a rotas de login e não estiver logado é redirecionado para view de login.
  
* O controlador instancia o modelo correspondente e realiza as operações necessárias.
* O model faz o CRUD com o banco mysql.
* O controlador instancia a view correspondente e passa os dados necessários.
* A view é renderizada e exibida ao usuário.



