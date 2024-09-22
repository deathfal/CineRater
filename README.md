# 🎬 Cinerater
Cinerater est une application web permettant aux utilisateurs de rechercher, noter et commenter des films. Ce projet utilise un framework MVC personnalisé en PHP, avec une base de données PostgreSQL et Docker pour la gestion des conteneurs.

## 🚀 Démarrage rapide
Suivez ces étapes pour installer et lancer Cinerater sur votre machine locale.

## 📋 Prérequis
Assurez-vous d'avoir les logiciels suivants installés :

- [Docker](https://www.docker.com/get-started)
- [Node.js](https://nodejs.org/) et [npm](https://www.npmjs.com/)

### ⚙️ Installation

1. Clonez le dépôt sur votre machine :

   ```bash
   git clone https://github.com/deathfal/CineRater.git

   ```
2. Accédez au répertoire du projet :

   ```bash
   cd CineRater

   ```
3. Installez les dépendances PHP et JavaScript :

   ```bash
   composer install
   npm install

   ```
4. Compilez les fichiers SCSS :

   ```bash
   npm run-script sass

   ```
### 🐳 Exécution avec Docker

1. Construisez et lancez les conteneurs Docker :

   ```bash
   docker-compose up --build

   ```
2. Accédez à l'application dans votre navigateur à l'adresse suivante :

   ```arduino
   http://localhost

   ```
3. Pour accéder à l'interface d'administration de la base de données PostgreSQL via pgAdmin, allez à :

   ```arduino
   http://localhost:8080

   ```

   Identifiants :

   - Email :
   - Mot de passe :

### 🗄️ Base de données

Les tables de la base de données seront initialisées automatiquement lors de l'exécution de Docker. Si nécessaire, vous pouvez recréer la base de données en supprimant les volumes Docker puis en relançant les conteneurs :

```bash

docker-compose down --volumes

docker-compose up --build

```

### 📂 Structure du projet

- www/: Contient le code source PHP (contrôleurs, modèles, vues)

- assets/: Contient les fichiers CSS, JS, et les images

- vendor/: Contient les dépendances PHP installées via Composer

- server/: Contient les fichiers de configuration pour Apache et PostgreSQL

- init_db.sql: Script pour créer et insérer des données dans la base de données

### 🌐 Environnement de production

L'application est également déployée et accessible en production ici : [http://148.113.204.188/]