# eval-symfony
Il s'agit d'un projet crée en php/symfony dans le cadre d'une évaluation en cours de formation pour Studi

## Prérequis

Avant de pouvoir exécuter l'application localement, assurez-vous que les éléments suivants sont installés sur votre système :

- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/) (pour installer les dépendances)
- [Symfony CLI](https://symfony.com/download) (pour exécuter des commandes Symfony)

## Installation

1. Clonez le dépôt Git :

    ```git clone https://github.com/votre-utilisateur/votre-projet.git```

2. Accédez au répertoire du projet :

    ```cd votre-projet```

3. Installez les dépendances avec Composer :

    ```composer install```

## Configuration

1. Vérifiez la présence du fichier .env .

2. Configurez les variables d'environnement dans le fichier `.env` selon vos besoins.

## Base de Données

1. Créez la base de données :

    ```php bin/console doctrine:database:create```

2. Appliquez les migrations :

    ```php bin/console doctrine:migrations:migrate```

## Fixtures

Pour ajouter les données de test avec Faker. Exécutez la commande suivante :

```php bin/console doctrine:fixtures:load```

## Démarrage

Pour tester l'app en local : 

```symfony serve -d```

