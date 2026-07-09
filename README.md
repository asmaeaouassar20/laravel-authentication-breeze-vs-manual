# Hey

## Hey

### Hey

#### Hey

##### Hey

###### JHey

## Authentication with Breeze
**Remarque** : Lorsque tu installes Breeze, ce dernier ajoute un système d’authentification (login, register, logout, reset password), mais il peut modifier ou écraser quelques fichiers si tu avais déjà créé des pages ou fichiers au même endroit. Donc, tu peux perdre quelques fichiers/pages liés à l’auth ou au front si ça se chevauche. Il est donc recommandé de créer un commit Git ou une sauvegarde avant d’installer Breeze afin de pouvoir revenir en arrière si nécessaire.  

**Laravel Breeze** est un kit (pack/une boîte à outils) de démarrage officiel de Laravel qui fournit une authentification simple (connexion, inscription, réinitialisation de mot de passe, gestion de profil) avec une base de code prête à personnaliser.

- `composer require laravel/breeze --dev` : Installe Laravel Breeze comme dépendance de développement pour ajouter un système d’authentification prêt à l’emploi.

- `php artisan breeze:install` : Génère les fichiers nécessaires de Laravel Breeze (routes, contrôleurs, vues et configuration d’authentification).

- `npm install` : Installe les dépendances JavaScript nécessaires au build des assets frontend du projet.

- `npm run dev` : Lance le serveur de développement Vite pour compiler et surveiller les fichiers frontend en temps réel.
