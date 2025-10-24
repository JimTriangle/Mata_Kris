# 🚀 Guide de déploiement - Mata & Kris

Guide complet pour déployer le site Mata & Kris sur un VPS Debian avec déploiement automatisé.

## 📋 Table des matières

- [Prérequis](#prérequis)
- [Configuration du serveur](#configuration-du-serveur)
- [Installation de l'application](#installation-de-lapplication)
- [Configuration de Nginx](#configuration-de-nginx)
- [Configuration SSL](#configuration-ssl)
- [Déploiement automatique](#déploiement-automatique)
- [Déploiement manuel](#déploiement-manuel)
- [Maintenance](#maintenance)
- [Dépannage](#dépannage)

---

## Prérequis

### Sur votre VPS Debian

- VPS avec accès SSH root ou sudo
- Debian 11 ou 12
- Nom de domaine pointant vers le VPS
- Au moins 1 Go de RAM

---

## Configuration du serveur

### 1. Connexion au serveur

```bash
ssh votre-utilisateur@ip-du-serveur
```

### 2. Mise à jour du système

```bash
sudo apt update && sudo apt upgrade -y
```

### 3. Installation de PHP 8.2 et extensions

```bash
# Ajouter le dépôt Sury pour PHP
sudo apt install -y lsb-release ca-certificates apt-transport-https software-properties-common
wget -qO - https://packages.sury.org/php/apt.gpg | sudo apt-key add -
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php.list

# Mise à jour et installation de PHP
sudo apt update
sudo apt install -y php8.2 php8.2-fpm php8.2-cli php8.2-common php8.2-mysql php8.2-zip php8.2-gd php8.2-mbstring php8.2-curl php8.2-xml php8.2-bcmath php8.2-sqlite3

# Vérifier l'installation
php -v
```

### 4. Installation de Composer

```bash
cd ~
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer --version
```

### 5. Installation de Node.js et npm

```bash
# Installation de Node.js 20 LTS
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs

# Vérifier l'installation
node -v
npm -v
```

### 6. Installation de Nginx

```bash
sudo apt install -y nginx

# Démarrer et activer Nginx
sudo systemctl start nginx
sudo systemctl enable nginx
```

### 7. Installation de Git

```bash
sudo apt install -y git
git --version
```

### 8. Configuration de SQLite (base de données)

```bash
# SQLite est généralement déjà installé
sqlite3 --version

# Si non installé :
sudo apt install -y sqlite3
```

---

## Installation de l'application

### 1. Créer le répertoire de l'application

```bash
sudo mkdir -p /var/www/mata-kris
sudo chown -R $USER:www-data /var/www/mata-kris
```

### 2. Cloner le dépôt

```bash
cd /var/www/mata-kris
git clone https://github.com/JimTriangle/Mata_Kris.git .

# Ou si vous avez déjà cloné ailleurs
# git clone git@github.com:JimTriangle/Mata_Kris.git /var/www/mata-kris
```

### 3. Installer les dépendances

```bash
cd /var/www/mata-kris

# Dépendances PHP
composer install --no-dev --optimize-autoloader

# Dépendances Node
npm ci --production

# Compiler les assets
npm run build
```

### 4. Configuration de l'environnement

```bash
# Copier le fichier d'environnement de production
cp deploy/.env.production.example .env

# Générer la clé d'application
php artisan key:generate

# Modifier le fichier .env avec vos paramètres
nano .env
```

**Paramètres importants à modifier dans `.env` :**

```env
APP_NAME="Mata & Kris"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.com

DB_CONNECTION=sqlite
```

### 5. Préparer la base de données

```bash
# Créer le fichier de base de données SQLite
touch database/database.sqlite

# Exécuter les migrations
php artisan migrate --force
```

### 6. Créer un utilisateur admin

```bash
php artisan tinker
```

Puis dans tinker :

```php
$user = new App\Models\User();
$user->name = 'Mata & Kris';
$user->email = 'votre@email.com';
$user->password = bcrypt('VotreMotDePasseSecurisé');
$user->save();
exit
```

### 7. Configurer les permissions

```bash
sudo chown -R www-data:www-data /var/www/mata-kris/storage
sudo chown -R www-data:www-data /var/www/mata-kris/bootstrap/cache
sudo chmod -R 775 /var/www/mata-kris/storage
sudo chmod -R 775 /var/www/mata-kris/bootstrap/cache
```

---

## Configuration de Nginx

### 1. Copier la configuration

```bash
sudo cp /var/www/mata-kris/deploy/nginx.conf /etc/nginx/sites-available/mata-kris
```

### 2. Modifier la configuration

```bash
sudo nano /etc/nginx/sites-available/mata-kris
```

**Remplacer :**
- `votre-domaine.com` par votre nom de domaine réel
- Adapter le chemin si nécessaire

### 3. Activer le site

```bash
# Créer le lien symbolique
sudo ln -s /etc/nginx/sites-available/mata-kris /etc/nginx/sites-enabled/

# Désactiver le site par défaut
sudo rm /etc/nginx/sites-enabled/default

# Tester la configuration
sudo nginx -t

# Recharger Nginx
sudo systemctl reload nginx
```

---

## Configuration SSL

### 1. Installer Certbot

```bash
sudo apt install -y certbot python3-certbot-nginx
```

### 2. Obtenir un certificat SSL

```bash
sudo certbot --nginx -d votre-domaine.com -d www.votre-domaine.com
```

Suivez les instructions à l'écran.

### 3. Renouvellement automatique

```bash
# Tester le renouvellement
sudo certbot renew --dry-run

# Le renouvellement automatique est déjà configuré via un cron
```

---

## Déploiement automatique

### 1. Configurer les secrets GitHub

Dans votre dépôt GitHub, allez dans **Settings → Secrets and variables → Actions** et ajoutez :

| Secret | Description | Exemple |
|--------|-------------|---------|
| `SSH_HOST` | IP ou domaine du serveur | `123.45.67.89` |
| `SSH_USER` | Utilisateur SSH | `votre-user` |
| `SSH_PRIVATE_KEY` | Clé privée SSH | Contenu de `~/.ssh/id_rsa` |
| `SSH_PORT` | Port SSH (défaut: 22) | `22` |
| `DEPLOY_PATH` | Chemin de l'application | `/var/www/mata-kris` |

### 2. Générer une clé SSH (si nécessaire)

**Sur votre machine locale :**

```bash
ssh-keygen -t ed25519 -C "github-actions" -f ~/.ssh/mata-kris-deploy
```

**Sur le serveur :**

```bash
# Ajouter la clé publique aux clés autorisées
echo "VOTRE_CLE_PUBLIQUE" >> ~/.ssh/authorized_keys
```

**Dans GitHub :**

Copiez le contenu de la clé **privée** dans le secret `SSH_PRIVATE_KEY`.

### 3. Configuration du serveur pour le déploiement

```bash
# Permettre à l'utilisateur de recharger PHP-FPM sans mot de passe
sudo visudo
```

Ajoutez la ligne :

```
votre-user ALL=(ALL) NOPASSWD: /bin/systemctl reload php8.2-fpm
```

### 4. Déploiement

Chaque push sur la branche `main` déclenchera automatiquement :

1. ✅ Exécution des tests
2. ✅ Compilation des assets
3. ✅ Déploiement sur le serveur
4. ✅ Migrations de base de données
5. ✅ Mise en cache

---

## Déploiement manuel

### Utilisation du script

```bash
cd /var/www/mata-kris
chmod +x deploy/deploy.sh
./deploy/deploy.sh
```

Le script effectue :

- ✅ Activation du mode maintenance
- ✅ Pull du code
- ✅ Installation des dépendances
- ✅ Compilation des assets
- ✅ Migrations
- ✅ Nettoyage et cache
- ✅ Redémarrage de PHP-FPM
- ✅ Désactivation du mode maintenance

---

## Maintenance

### Mode maintenance

```bash
# Activer
php artisan down

# Désactiver
php artisan up

# Avec message personnalisé
php artisan down --message="Maintenance en cours" --retry=60
```

### Logs

```bash
# Logs Laravel
tail -f storage/logs/laravel.log

# Logs Nginx
sudo tail -f /var/log/nginx/mata-kris-access.log
sudo tail -f /var/log/nginx/mata-kris-error.log

# Logs PHP-FPM
sudo tail -f /var/log/php8.2-fpm.log
```

### Sauvegarde de la base de données

```bash
# Créer une sauvegarde
cp database/database.sqlite database/backups/database-$(date +%Y%m%d).sqlite

# Script de sauvegarde automatique (cron)
crontab -e
```

Ajouter :

```cron
0 2 * * * cp /var/www/mata-kris/database/database.sqlite /var/www/mata-kris/database/backups/database-$(date +\%Y\%m\%d).sqlite
```

---

## Dépannage

### Erreur 500

```bash
# Vérifier les logs
tail -n 50 storage/logs/laravel.log

# Vérifier les permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# Vider les caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Erreur 502 Bad Gateway

```bash
# Vérifier PHP-FPM
sudo systemctl status php8.2-fpm

# Redémarrer PHP-FPM
sudo systemctl restart php8.2-fpm

# Vérifier la configuration Nginx
sudo nginx -t
```

### Assets non chargés

```bash
# Recompiler les assets
npm run build

# Vérifier les permissions
sudo chown -R www-data:www-data public/build
sudo chmod -R 755 public/build
```

### Base de données verrouillée (SQLite)

```bash
# Vérifier les permissions
sudo chown www-data:www-data database/database.sqlite
sudo chmod 664 database/database.sqlite
sudo chmod 775 database/
```

---

## 📊 Monitoring

### Vérifier l'état des services

```bash
# Nginx
sudo systemctl status nginx

# PHP-FPM
sudo systemctl status php8.2-fpm

# Espace disque
df -h

# Mémoire
free -h

# Processus PHP
ps aux | grep php
```

---

## 🔐 Sécurité

### Firewall (UFW)

```bash
# Installer UFW
sudo apt install -y ufw

# Autoriser SSH, HTTP et HTTPS
sudo ufw allow OpenSSH
sudo ufw allow 'Nginx Full'

# Activer le firewall
sudo ufw enable

# Vérifier le statut
sudo ufw status
```

### Mises à jour de sécurité

```bash
# Activer les mises à jour automatiques de sécurité
sudo apt install -y unattended-upgrades
sudo dpkg-reconfigure -plow unattended-upgrades
```

---

## 📞 Support

Pour toute question ou problème :

1. Vérifiez d'abord les logs
2. Consultez la section dépannage
3. Contactez l'administrateur

---

🎸 **Mata & Kris** - Les Feuilles Chantantes

Généré avec [Claude Code](https://claude.com/claude-code)
