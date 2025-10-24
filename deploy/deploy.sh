#!/bin/bash

###############################################################################
# Script de déploiement pour Mata & Kris
# Usage: ./deploy/deploy.sh
###############################################################################

set -e

echo "🚀 Début du déploiement de Mata & Kris..."

# Couleurs pour les messages
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Variables
APP_PATH="/var/www/mata-kris"
PHP_VERSION="8.2"

# Vérifier si on est dans le bon répertoire
if [ ! -f "artisan" ]; then
    echo -e "${RED}❌ Erreur: Le fichier artisan n'a pas été trouvé.${NC}"
    echo "Assurez-vous d'exécuter ce script depuis la racine du projet."
    exit 1
fi

# Mode maintenance
echo -e "${YELLOW}🔧 Activation du mode maintenance...${NC}"
php artisan down || true

# Pull du code
echo -e "${YELLOW}📥 Récupération du code depuis Git...${NC}"
git pull origin main

# Installation des dépendances PHP
echo -e "${YELLOW}📦 Installation des dépendances Composer...${NC}"
composer install --no-dev --optimize-autoloader --no-interaction

# Installation des dépendances Node
echo -e "${YELLOW}📦 Installation des dépendances npm...${NC}"
npm ci --production

# Compilation des assets
echo -e "${YELLOW}🔨 Compilation des assets...${NC}"
npm run build

# Exécution des migrations
echo -e "${YELLOW}🗄️  Exécution des migrations...${NC}"
php artisan migrate --force

# Clear et cache
echo -e "${YELLOW}🧹 Nettoyage et mise en cache...${NC}"
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

# Permissions
echo -e "${YELLOW}🔐 Configuration des permissions...${NC}"
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Redémarrage de PHP-FPM
echo -e "${YELLOW}🔄 Redémarrage de PHP-FPM...${NC}"
sudo systemctl reload php${PHP_VERSION}-fpm

# Désactivation du mode maintenance
echo -e "${YELLOW}✅ Désactivation du mode maintenance...${NC}"
php artisan up

echo -e "${GREEN}✨ Déploiement terminé avec succès !${NC}"
echo ""
echo "📊 Informations:"
echo "  - Version PHP: $(php -v | head -n 1)"
echo "  - Version Laravel: $(php artisan --version)"
echo "  - Environnement: $(php artisan env)"
echo ""
echo "🌐 Le site est maintenant en ligne !"
