### Composer
Use este comando para instalar todas as dependencias

composer install

### Database e Migrations
Use este comando para criar o banco de dados

CREATE DATABASE prova_duobox DEFAULT CHARACTER SET = 'utf8mb4';

Configurar o .env para

DB_CONNECTION=mysql (ou o banco de dados que estiver usando)
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=prova_duobox
DB_USERNAME=USUARIO_DATABASE
DB_PASSWORD=SENHA_DATABASE

Use este comando para rodar as migrations

php artisan migrate

### Tests
Use este comando para rodar os testes unitarios

php artisan test tests/Feature/AlunosControllerTest.php

### Rodar local
Use este comando para iniciar o servidor local

php artisan serve
