<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Chatterboxs

Chatterboxs est une application de messagerie instantaner destiner au professionnel.

![](C:\Users\lazaa\Documents\work\M2I\php\framework\laravel\fil-rouge-test\ChatterBocx\public\ChatterBocs.png)

###Installation :  

Étape 1 : cloner le repository

```shell
git clone https://github.com/TanvirUd/ChatterBocx.git
cd ChatterBocx
```

Étape 2 : Cree un fichier ".env" a l'aide du fichier  ".env.example" en remplissant les informations de votre base de données

Étape 3 : cree une base de donner en fonction du .env en locurrence ici "test".

```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test
DB_USERNAME=root
DB_PASSWORD=
```

Étape 4 : Installer les dépendances PHP

```shell
composer install
```

Étape 5 : Installer les dépendances NPM et les executer

```shell
npm install && npm run dev
```

Étape 6 : generer une cle d'application

```shell
php artisan key:generate
```

Étape 7 : faire une refresh de la migration pour appliquer toutes les données dans la base de données.

```shell
php artisan migrate:fresh
```

Étape 8 : executer la commande php artisan optimize pour optimiser le code

```shell
php artisan optimize
```

Étape 8 :  executer toutes les instance pour lancer l'application

```shell
npm run dev
```

```shell
php artisan queue:listen
```

```shell
php artisan reverb:start
```

et pour finir le lancement du server

```shell
php artisan serve
```

Et si toutes les étapes ont été fait dans l'ordre l'application devrait marcher.

## ## Credits

- By Tanvir et Laza
