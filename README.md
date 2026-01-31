環境構築

Dockerビルド

・git@github.com:wakame251/exam-contact-form.git

・docker-compose up -d --build


Laravel環境構築

・docker-compose exec php bash

・composer install

・cp.env.example.env,環境変数を適宜変更

・php artisan key:generate

・php artisan migrate


開発環境

・お問い合わせ画面：http://localhost/

・ユーザー登録：http://localhost/register

・phpMyAdmin：http://localhost:8080/


使用技術（実行環境）
・PHP Version 8.1.34

・Laravel Framework 8.83.8

・mysql  Ver 8.0.26

・nginx/1.21.1

ER図

![ER図](docs/images/exam-contact-form.drawio.png)