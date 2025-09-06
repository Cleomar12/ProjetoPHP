ProjetoPHP
Exemplo register/login simples com CRUD mysql

Projeto MVC em PHP
Estrutura do projeto
app/: Diretório que contém os arquivos da aplicação.
controllers/: Diretório que contém os controladores da aplicação.
models/: Diretório que contém os modelos da aplicação.
views: Diretório que contém as views da aplicação.
core/ : Diretório que contém arquivos centrais da aplicaçao.
Controller.php : contém a classe base para os controllers.
router.php : contém a classe Router, um roteador de rotas.
routes.php : array que contém as rotas, controllers e metodos chamada pela Router.
config/: Diretório que contém os arquivos de configuração da aplicação.
database.php: Arquivo que contém as configurações do banco de dados.
public/ : Diretório que contém os arquivos públicos da aplicação.
index.php: Arquivo que é o ponto de entrada da aplicação.
.htaccess: Arquivo que contém as configurações do servidor Apache.

Nome do banco: testephp_crud

tabela:
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(100) NOT NULL,
    email         VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) DEFAULT NULL,  -- senha só para "database"
    provider      VARCHAR(50)  NOT NULL,      -- 'database', 'google', 'facebook'
    provider_id   VARCHAR(255) DEFAULT NULL,  -- ID único do provedor (ex: GoogleID)
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
