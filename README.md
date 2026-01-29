# 環境構築
---
## 1. Dockerビルド

### ①git@github.com:wakame251/exam-contact-form.git

### ②docker-compose up -d --build


## 2. Laravel環境構築

### ①docker-compose exec php bash

### ②composer install

### ③cp.env.example.env

*.envファイルは、以下の部分を変更*
   
DB_HOST=mysql  
   
DB_DATABASE=laravel_db  
   
DB_USERNAME=laravel_user  
   
DB_PASSWORD=laravel_pass  

### ④php artisan key:generate

### ⑤php artisan migrate

### ⑥php artisan db:seed

## 3. 開発環境

### ・お問い合わせ画面：http://localhost/

### ・ユーザー登録画面：http://localhost/register

### ・phpMyAdmin：http://localhost:8080/


## 4. 使用技術（実行環境）

### ・PHP Version 8.1.34

### ・Laravel Framework 8.83.8

### ・mysql  Ver 8.0.26

### ・nginx/1.21.1

## 5. ER図

<img width="505" height="741" alt="exam-contact-form drawio" src="https://github.com/user-attachments/assets/984a86db-cf72-4958-8fd6-ed9578343673" />

