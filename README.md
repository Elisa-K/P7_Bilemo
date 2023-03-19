# Openclassrooms - Projet 7 - Créez un web service exposant une API - Bilemo
[![SymfonyInsight](https://insight.symfony.com/projects/2b19b896-0392-4700-8734-3245cb2cd064/big.svg)](https://insight.symfony.com/projects/2b19b896-0392-4700-8734-3245cb2cd064)

Projet n°7 du parcours Openclassrooms "Développeur d'application PHP/Symfony" :
Concevoir une API

## Pré-requis
- PHP 8.1 ou supérieur
- Symfony 6.2
- Symfony CLI
- Composer
- Serveur web (Apache, MySQL, PHP)
- Visual Studio Code, PHPStorm, SublimText, ...

## Installation
Pour installer le projet, suivez les étapes suivantes :

1. Cloner le repository
```bash
  git clone https://github.com/Elisa-K/P7_Bilemo.git
```
2. Accèder au répertoire du projet :
```bash
  cd P7_Bilemo
```
3. Installer les dépendances :
```bash
  composer install
```

4. Configurer la base de données dans le fichier `.env.local` ou `.env` à la racine du projet :
```
 	DATABASE_URL="mysql://db_user:db_password@db_host/db_name?serverVersion=8&charset=utf8mb4"
```
5. Créer la base de données :
```bash
  symfony console doctrine:database:create
```
6. Créer les tables de la base de données :
```bash
  symfony console doctrine:migrations:migrate
```
7. Ajouter les données fictives:
```bash
  symfony console doctrine:fixtures:load
```
8. Génerer les clés privées et publics JWT (nécessite OpenSSL):
```bash
  symfony console lexik:jwt:generate-keypair
```

9. Lancer le projet :
```bash
  symfony serve
```

## Documentation de l'API

https://127.0.0.1:8000/api/docs

## Connexion
Récupération du Token authentification:

https://127.0.0.1:8000/api/login
```json
{
	"email": "client0@bilemo.com",
	"password": "passwordClient0"
}
```