# 概要
履修登録サイト

## 使用技術
PHP,Laravel,MySQL,TailwindCSS

## 手順

### 1.リポジトリのクローン  
ターミナルを開き、以下のコマンドを入力してリモートリポジトリの内容をローカルにクローンします：  
```
git clone git@github.com:Kitagawa19/laravel-2024.git
cd laravel-2024                                                
```
### 2.sailのインストール
以下のコマンドを実行して、Laravel Breezeをインストールします：
```
sail composer require laravel/breeze --dev
sail artisan breeze:install                                               
```
### 3.サーバーの起動
Sailを使用してサーバーを起動します：
```
sail up                                             
```
### 4.データベースのマイグレーション
サーバーが正常に立ち上がったことを確認した後、以下のコマンドを実行してデータベースのマイグレーションを行います：
```
sail artisan migrate                                             
```
