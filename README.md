# **AutomaClient – Sistema de Gestão de Clientes**  

![Laravel](https://img.shields.io/badge/Laravel-10-red?style=flat&logo=laravel)  ![Vue.js](https://img.shields.io/badge/Vue.js-3-green?style=flat&logo=vue.js)  ![MySQL](https://img.shields.io/badge/MySQL-Database-blue?style=flat&logo=mysql)  ![PHP](https://img.shields.io/badge/PHP-8+-purple?style=flat&logo=php)  

🚀 **AutomaClient** é um sistema de **gestão de clientes** que incorpora **automações avançadas** para otimizar processos. Desenvolvido com **Laravel 10** no backend e **Vue.js 3** no frontend, o projeto possui autenticação segura, um CRUD otimizado, API REST, envio automático de e-mails e geração de relatórios em PDF.  

---

## **📌 Funcionalidades**  

✅ **Autenticação Segura**  
- Login com **Laravel Breeze**  
- Controle de acesso com **middlewares**  
- **Senhas hashadas** e proteção CSRF  

✅ **CRUD de Clientes**  
- Cadastro, listagem, edição e remoção de clientes  
- **Relacionamento entre clientes e pedidos**  
- Busca otimizada com **indexes no MySQL**  

✅ **API REST**  
- Endpoints estruturados (`GET/POST/PUT/DELETE`)  
- Retorno padronizado em **JSON**  

✅ **Front-End com Vue.js 3**  
- **Listagem dinâmica de clientes** (Axios + API REST)  
- Interface moderna substituindo **Blade**  

✅ **Automações Profissionais**  
- **Envio automático de e-mails** (Laravel Mail)  
- **Geração de relatórios em PDF** (DomPDF)  

✅ **Testes Básicos (Opcional)**  
- Testes unitários para validar o CRUD de clientes  

---

## **⚙️ Tecnologias Utilizadas**  

- **Back-end**: Laravel 10 (PHP 8+)  
- **Banco de Dados**: MySQL  
- **Front-end**: Vue.js 3 (Composition API) + Axios  
- **Segurança**: Hash de senhas, proteção CSRF  
- **Automações**: Laravel Mail (SMTP), DomPDF  
- **Controle de Versão**: Git/GitHub  

---

## **🛠 Como Executar o Projeto**  

### 🔹 **Pré-requisitos**  
Certifique-se de ter instalado:  
- **PHP 8+**  
- **Composer**  
- **Node.js + NPM**  
- **MySQL**  

### 🔹 **Passos**  

1️⃣ Clone o repositório:  

git clone https://github.com/seu-usuario/AutomaClient.git
cd AutomaClient

2️⃣ Instale as dependências do backend:

composer install

3️⃣ Instale as dependências do frontend:

npm install

4️⃣ Configure o banco de dados no .env e rode as migrations:

php artisan migrate --seepiar

5️⃣ Gere a chave da aplicação e inicie o servidor:<br>
php artisan key:generate<br>
php artisan serve

6️⃣ Compile o frontend e inicie o Vite:

npm run dev

Agora o sistema estará rodando em http://localhost:8000 🚀

### 📝 Licença
Este projeto está sob a licença MIT.
