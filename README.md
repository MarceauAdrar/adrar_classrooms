# :star: ADRAR Classrooms :star:

## But :soccer:
Cette fois, chaque personne va travailler en autonomie sur le projet pour assimiler les principes liés à la sécurité.

## Tâches ⏰
- Personnaliser votre fichier .env/.env.dev pour définir l'accès à votre BDD, puis executer la commande `symfony console doctrine:database:create` à l'intérieur du dossier
- Charger les structures des tables avec la commande `symfony console doctrine:migrations:migrate`
- Alimenter les tables avec la commande `symfony console doctrine:fixtures:load` 
- Executer la commande `composer install` à l'intérieur du dossier pour installer les dépendances du fichier *composer.json*
- Executer la commande `symfony console asset-map:compile` à l'intérieur du dossier pour compresser tout le dossier racine **assets** dans le dossier racine accessible au **public**
- Rechercher toutes les `TODO:` dans le code (loupe dans le menu latéral gauche) pour voir toutes les actions à faire
- Vous allez devoir implémenter ces différents éléments:
    - Mettre à jour le projet
    - Système de validation de compte par mail avant de se connecter
    - Filtrage des entrées utilisateurs pour faire en sorte de se protéger
    - Utiliser un pare-feu en s'aidant de la documentation et du cours et éléments pré-existants
    - Hiérarchiser l'accès **aux pages** et actions sur les pages en fonction du privilège de l'utilisateur
    - Jouer avec les en-têtes pour voir les changements qui ont lieu et gérer chaque cas qui doit-être géré (*not found*, *empty*, *found*, ...)
    - Mettre en place un système anti Ddos sur le formulaire de connexion en limitant le nombre de requêtes sur une période donée
    - Mettre en place une **journalisation** de débogage sécurisée

## Trame :link:
- Le lien vers le Figma est accessible: [`ici`](<https://www.figma.com/design/LhgsAaXHN8HVJfpXeyjhDQ/Adrar-Classrooms?node-id=0-1&node-type=canvas>)
- Le lien vers le Trello pour se tenir à jour de nos tâches à accomplir: [`ici`](<https://trello.com/b/3H405ux5/symfony-adrar-classrooms>)


## Rappels :warning:
Retrouvez ici les commandes principales dont vous aurez besoin:
- `symfony console make:controller` Permet de lancer l'assistant pour créer un contrôleur associé à une feuille twig
- `symfony console make:entity` Permet de lancer l'assistant pour créer une entité associée à un repository
- `symfony console make:crud` Permet de lancer l'assistant pour sélectionner l'entité sur laquelle effectuer un CRUD
- `symfony console make:migration` Permet de générer le fichier de migration contenant le SQL, à taper si ajout, modification ou suppression d'éléments d'une ou plusieurs entité(s)
- `symfony console doctrine:migrations:migrate` Permet de lancer l'exécution du/des fichier(s) de migration(s) permettant la mise à jour de la BDD
- `symfony console doctrine:fixtures:load` Permet de lancer l'exécution des fixtures pour alimenter la BDD à l'aide de Faker

**NB: Le travail a ici été pas mal pré-mâché, même si tout n'est pas terminé, vous avez une base solide pour vous entraîner. Vous avez la possibilité de faire cela sur un nouveau projet/sur votre projet, en Symfony, bien sûr.**