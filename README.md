# :star: ADRAR Classrooms :star:

## But :soccer:
Chaque personne va se voir être attribuée à une équipe (2 au total).
Dans chaque équipe, un *leader* sera désigné. C'est avec le *leader* que le formateur s'entretiendra.
Pensez donc à communiquer à celui-ci les choses faites... Le formateur les passera ensuite en "Fait" sur le Trello.

### Site web 🌐
Vous allez devoir développer en collaboration votre premier site web en utilisant les outils suivants: 
- Github (avec la CLI de Git) en utilisant *une branche par fonctionnalité*
- Trello pour se tenir à jour des tâches effectuées et à faire... Attention aux *deadlines* !
- Figma pour suivre la DA générale du site à produire
### API 🔨
Construire une API pour aider l'autre équipe à intéragir avec son application. Il devra y avoir:
- l'API de type REST
- l'utilisation des méthodes HTTP pour gérer tous les cas
- faire en sorte de gérer les routes qui demanderont des données auprès de l'application web

## Tâches ⏰
- Executer la commande `composer install` à l'intérieur du dossier pour installer les dépendances du fichier *composer.json*
- Rechercher toutes les `TODO:` dans le code (loupe dans le menu latéral gauche) pour voir toutes les actions à faire

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

Trois entités par défaut (Concessionnaire, Vehicule & VehiculeConcessionnaire) ont été créées dans cet exemple pour aller de A à Z. Vous pouvez librement vous en inspirer pour réaliser les vôtres.