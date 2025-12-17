# Gerenciador de Tarefas com Laravel

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

## 📝 Sobre o Projeto

Este é um sistema de gerenciamento de tarefas (To-Do List) desenvolvido com o framework PHP Laravel. O projeto foi criado para demonstrar habilidades práticas com Laravel, aplicando conceitos essenciais como MVC (Model-View-Controller), rotas, Eloquent ORM, Blade templates e validação de dados.

É uma aplicação simples, mas que demonstra uma base sólida para a construção de aplicações web mais complexas e robustas.

## ✨ Funcionalidades Principais

-   **CRUD de Tarefas**: Crie, leia, atualize e exclua tarefas de forma intuitiva.
-   **Status da Tarefa**: Marque tarefas como "concluídas" ou "pendentes" com um único clique.
-   **Validação de Formulário**: Garante que os dados inseridos (como o título da tarefa) sejam válidos antes de serem salvos no banco de dados.
-   **Interface Responsiva**: Layout limpo e funcional que se adapta a diferentes tamanhos de tela, construído com Tailwind CSS.

## 🚀 Tecnologias Utilizadas

-   **Backend**: PHP 8+ e Laravel 10+
-   **Frontend**: Blade Template Engine e Tailwind CSS
-   **Banco de Dados**: MySQL
-   **Gerenciador de Pacotes**: Composer

## ⚙️ Como Executar o Projeto Localmente

Siga os passos abaixo para configurar e executar o projeto em seu ambiente de desenvolvimento.

### Pré-requisitos

-   PHP >= 8.1
-   Composer
-   Node.js e NPM (para compilar os assets do frontend)
-   Um servidor local como Laragon, XAMPP, WAMP ou o servidor embutido do PHP/Laravel.

### Passos para Instalação

1.  **Clone o repositório** (substitua pela URL do seu repositório no GitHub):
    ```bash
    git clone https://github.com/seu-usuario/task-list-laravel.git
    cd task-list-laravel
    ```

2.  **Instale as dependências do PHP**:
    ```bash
    composer install
    ```

3.  **Instale as dependências do Node.js**:
    ```bash
    npm install
    ```

4.  **Compile os assets do frontend**:
    ```bash
    npm run dev
    ```

5.  **Configure o ambiente**:
    -   Copie o arquivo de exemplo `.env.example` para `.env`.
    ```bash
    copy .env.example .env
    ```
    -   Gere a chave da aplicação:
    ```bash
    php artisan key:generate
    ```

6.  **Execute as migrações do banco de dados**:
    (Este comando criará as tabelas necessárias no banco de dados configurado no seu `.env`)
    ```bash
    php artisan migrate
    ```

7.  **Inicie o servidor de desenvolvimento**:
    ```bash
    php artisan serve
    ```

8.  Acesse a aplicação em seu navegador: [http://127.0.0.1:8000](http://127.0.0.1:8000)


## 👨‍💻 Autor

**Jocely Marques**

-   LinkedIn: [https://linkedin.com/in/jocelymarques](https://linkedin.com/in/jocelymarques)
-   GitHub: [https://github.com/jocelymarques](https://github.com/jocelymarques)
-   Email: [jocelymarques1@gmail.com](jocelymarques1@gmail.com)

---
*Este projeto foi desenvolvido como parte do meu portfólio pessoal.*