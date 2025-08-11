Livros-app
Este é um mini-projeto de sistema de cadastro de livros desenvolvido em PHP, utilizando PDO para interação com um banco de dados MySQL. Ele permite adicionar, listar, editar e excluir informações de livros.

Funcionalidades
Adicionar Livro: Cadastre novos livros informando título, autor, ano e ISBN.
Listar Livros: Visualize todos os livros cadastrados.
Editar Livro: Modifique os dados de um livro existente.
Excluir Livro: Remova um livro do cadastro.
Validação de Entrada: Implementa validação básica no front-end (JavaScript) e back-end (PHP) para garantir a integridade dos dados e remover caracteres especiais indesejados.
Tecnologias Utilizadas
PHP: Linguagem de programação back-end.
MySQL: Sistema de gerenciamento de banco de dados.
PDO: Extensão PHP para acesso a banco de dados, utilizada para interagir com o MySQL de forma segura.
JavaScript: Para validações de formulário no lado do cliente.
HTML: Estrutura das páginas web.
Estrutura do Projeto

.
├── class/
│   ├── Livro.php             # Define a classe Livro (modelo de dados)
│   └── LivroRepository.php   # Gerencia as operações CRUD com o banco de dados
├── assets/
│   └── js/
│       └── validacao.js      # Funções JavaScript para validação de formulário
├── views/
│   ├── adicionar.php         # Formulário para adicionar novos livros
│   ├── editar.php            # Formulário para editar/excluir livros existentes
├── index.php                 # Página principal que lista os livros
├── sistema_livros_livros.sql # Script SQL para criação da tabela (binário)
└── README.md                 # Este arquivo de documentação
Como Configurar e Rodar
Siga os passos abaixo para colocar o projeto em funcionamento em seu ambiente local.

Pré-requisitos
Certifique-se de ter o seguinte software instalado:

Servidor Web: Apache ou Nginx (com PHP configurado)
PHP: Versão 7.4 ou superior (com extensão pdo_mysql habilitada)
MySQL: Servidor de banco de dados MySQL
Passos de Configuração
Clone o Repositório:

bash

git clone <https://github.com/GalaxyLuckas/Livros.git>
cd Livros
Configurar o Banco de Dados:

Acesse seu servidor MySQL (via phpMyAdmin, MySQL Workbench ou linha de comando).
Crie um novo banco de dados chamado sistema_livros.
sql

CREATE DATABASE sistema_livros;
Importe o esquema da tabela livros usando o arquivo sistema_livros_livros.sql. Este arquivo contém a estrutura da tabela necessária.
sql

USE sistema_livros;
-- Execute o conteúdo do arquivo sistema_livros_livros.sql aqui
-- Ou importe-o diretamente via sua ferramenta de gerenciamento de DB.
A tabela livros deve ter a seguinte estrutura:
sql

CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    ano INT NOT NULL,
    isbn VARCHAR(20) UNIQUE NOT NULL
);
Configurar a Conexão com o Banco de Dados:

Abra os arquivos index.php, views/adicionar.php e views/editar.php.
Localize a linha de conexão PDO:
php

$pdo = new PDO('mysql:host=localhost;dbname=sistema_livros', 'root', '&tec77@info!');
Altere root e &tec77@info! para o nome de usuário e senha do seu banco de dados MySQL, respectivamente.
Hospedar o Projeto:

Mova a pasta Livros para o diretório raiz do seu servidor web (ex: htdocs para Apache, www para Nginx).
Acessar o Sistema:

Abra seu navegador e acesse a URL onde o projeto está hospedado. Geralmente, será algo como:

http://localhost/livros-app/
Uso
Na página inicial (index.php), você verá a lista de livros cadastrados.
Clique em "Adicionar Novo Livro" para ir para o formulário de cadastro.
Clique em "Editar" ao lado de um livro para modificar seus dados ou excluí-lo.