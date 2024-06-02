## Clone o Projeto
Clone o repositório do projeto para o seu ambiente local usando Git. Vá para o diretório onde deseja armazenar o projeto e execute o seguinte comando:

git clone 'url'
Customer Management System API
A Customer Management System (CMS) API é uma aplicação backend desenvolvida com Laravel para gerenciar informações de clientes. Esta API oferece endpoints para adição, edição e remoção de registros de clientes, proporcionando uma interface de programação de aplicações robusta e segura para facilitar a gestão de dados.

### Funcionalidades
Adição de Clientes: Permite adicionar novos clientes ao sistema com informações detalhadas.
Edição de Clientes: Facilita a atualização das informações dos clientes existentes.
Remoção de Clientes: Possibilita a exclusão de registros de clientes.
Validação de Dados: Implementação de validações para garantir a integridade dos dados inseridos.

### Tecnologias Utilizadas
Laravel: Framework PHP robusto para construção de aplicações web e APIs.
Eloquent ORM: ORM (Object-Relational Mapping) elegante para interagir com o banco de dados.

### Configuração do projeto
Clone o Projeto
Clone o repositório do projeto para o seu ambiente local usando Git. Vá para o diretório onde deseja armazenar o projeto e execute o seguinte comando:

git clone 'url'


### Crie um Arquivo de Configuração do Ambiente:
Copie o arquivo .env.example para um novo arquivo chamado .env:
cp .env.example .env

### Gere a Chave de Aplicação
php artisan key:generate


### Migrar o Banco de Dados:
php artisan migrate


### Inicie o Servidor Embutido:
Inicie o servidor embutido do Laravel com o seguinte comando:
php artisan serve

O servidor será iniciado em http://localhost:PORTA por padrão.
