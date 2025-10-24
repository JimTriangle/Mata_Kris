# Guide de démarrage - Windows

Ce guide vous accompagne pour installer et lancer l'application **Mata & Kris** sur Windows.

## Prérequis à installer

### 1. PHP 8.2+

**Option A : Téléchargement direct**
1. Téléchargez PHP 8.2+ depuis https://windows.php.net/download/
2. Choisissez la version **Thread Safe** (x64)
3. Extrayez dans `C:\php`
4. Ajoutez `C:\php` aux variables d'environnement PATH

**Option B : Avec XAMPP (plus simple)**
1. Téléchargez XAMPP depuis https://www.apachefriends.org/
2. Installez XAMPP (inclut PHP, MySQL, Apache)
3. Ajoutez `C:\xampp\php` au PATH

**Vérifier l'installation :**
```cmd
php -v
```

### 2. Composer

1. Téléchargez Composer depuis https://getcomposer.org/download/
2. Exécutez `Composer-Setup.exe`
3. Suivez l'assistant d'installation

**Vérifier l'installation :**
```cmd
composer --version
```

### 3. Node.js et npm

1. Téléchargez Node.js LTS depuis https://nodejs.org/
2. Exécutez l'installeur (cochez "Automatically install necessary tools")
3. Redémarrez votre terminal

**Vérifier l'installation :**
```cmd
node --version
npm --version
```

## Installation de l'application

Ouvrez **PowerShell** ou **CMD** dans le dossier du projet, puis exécutez :

### Étape 1 : Installer les dépendances PHP

```cmd
composer install
```

### Étape 2 : Installer les dépendances Node.js

```cmd
npm install
```

### Étape 3 : Configuration (déjà fait automatiquement)

Les fichiers suivants ont déjà été créés :
- `.env` (configuration de l'application)
- `storage/database.sqlite` (base de données)

### Étape 4 : Générer la clé d'application

```cmd
php artisan key:generate
```

### Étape 5 : Exécuter les migrations de base de données

```cmd
php artisan migrate
```

Si on vous demande de créer la base de données, répondez **yes**.

### Étape 6 : Compiler les assets (CSS/JS)

```cmd
npm run build
```

## Démarrer l'application

### Option A : Mode développement (recommandé)

Dans **deux terminaux séparés** :

**Terminal 1 - Compiler les assets en mode watch :**
```cmd
npm run dev
```

**Terminal 2 - Démarrer le serveur Laravel :**
```cmd
php artisan serve
```

### Option B : Mode production

```cmd
npm run build
php artisan serve
```

## Accéder à l'application

Une fois démarrée, ouvrez votre navigateur sur :

- **Page d'accueil** : http://localhost:8000
- **Espace admin** : http://localhost:8000/admin
- **Connexion** : http://localhost:8000/login

## Créer un compte administrateur

Pour créer votre premier utilisateur administrateur :

```cmd
php artisan tinker
```

Puis tapez :
```php
\App\Models\User::create([
    'name' => 'Mata & Kris',
    'email' => 'admin@matakris.com',
    'password' => bcrypt('votre-mot-de-passe-ici')
]);
exit
```

Remplacez `votre-mot-de-passe-ici` par le mot de passe souhaité.

## Commandes utiles

### Nettoyer le cache
```cmd
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Recompiler les assets
```cmd
npm run build
```

### Voir les routes disponibles
```cmd
php artisan route:list
```

### Créer des données de test
```cmd
php artisan db:seed
```

## Résolution de problèmes

### Erreur "sqlite3 extension not found"

Éditez le fichier `php.ini` (généralement dans `C:\php` ou `C:\xampp\php`) :
1. Ouvrez `php.ini` avec un éditeur de texte
2. Cherchez la ligne `;extension=sqlite3`
3. Supprimez le `;` pour décommenter : `extension=sqlite3`
4. Sauvegardez et redémarrez le serveur

### Erreur "fileinfo extension not found"

Dans `php.ini`, décommentez :
```ini
extension=fileinfo
```

### Erreur de permissions

Sur Windows, les permissions sont généralement automatiques. Si vous avez des erreurs :
```cmd
icacls storage /grant Everyone:(OI)(CI)F /T
icacls bootstrap/cache /grant Everyone:(OI)(CI)F /T
```

### Le serveur ne démarre pas (port 8000 occupé)

Utilisez un autre port :
```cmd
php artisan serve --port=8001
```

### Erreur "APP_KEY is missing"

```cmd
php artisan key:generate
```

## Structure du projet

```
Mata_Kris/
├── app/                    # Code PHP de l'application
│   ├── Http/Controllers/   # Contrôleurs
│   ├── Models/            # Modèles de données
│   └── Livewire/          # Composants Livewire
├── resources/
│   ├── views/             # Templates Blade
│   │   ├── public/        # Pages publiques
│   │   └── admin/         # Pages admin
│   ├── css/               # Fichiers CSS
│   └── js/                # Fichiers JavaScript
├── routes/
│   └── web.php            # Routes de l'application
├── storage/
│   └── database.sqlite    # Base de données
├── .env                   # Configuration
└── public/                # Point d'entrée web
```

## Support

Pour plus d'informations sur Laravel :
- Documentation Laravel : https://laravel.com/docs
- Documentation Livewire : https://livewire.laravel.com

Bon développement !
