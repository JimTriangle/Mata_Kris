import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

// Enregistrer le plugin Collapse
Alpine.plugin(collapse);

// Rendre Alpine disponible globalement
window.Alpine = Alpine;

// Démarrer Alpine.js
Alpine.start();

document.addEventListener('DOMContentLoaded', function() {

    const container = document.getElementById('leaf-container');
    if (!container) {
        console.log('Conteneur de feuilles non trouvé - animation désactivée');
        return;
    }

    // Pas d'animation dans l'admin
    if (window.location.pathname.startsWith('/admin')) {
        return;
    }

    // Réduit le nombre de feuilles pour de meilleures performances
    const numberOfLeaves = 20;

    // Couleurs des feuilles (automne pour Mata, printemps pour Kris)
    const autumnColors = ['#c57b57', '#a47148', '#8a5a44'];
    const springColors = ['#6a994e', '#9cba8f', '#a7c957'];
    const allColors = [...autumnColors, ...springColors];

    // SVG d'une feuille optimisé
    const leafSVG = `
        <svg viewBox="0 0 160 160" xmlns="http://www.w3.org/2000/svg">
            <path d="M151.2 86.4c-6.2-12.5-51.2-30.1-61.2-32.3C70 48.9 31.2 6.4 22.2 3.4c-9-3-19.2 4.1-21.2 13.1-2 9 4.1 19.2 13.1 21.2 9 2 41.8 19.3 49.8 23.3-17.7 20.3-40.4 62.7-38.4 71.7 2 9 12.1 14.1 21.2 12.1s14.1-12.1 12.1-21.2c-1.3-5.9 14.7-37.4 25.8-51.4 12.5 4.1 48.8 24.5 54.8 26.5s14.1-12.1 12.1-21.2c-2.2-9-12.3-13.9-21.4-11.9z" fill="currentColor"/>
        </svg>
    `;

    // Création des feuilles avec propriétés optimisées
    for (let i = 0; i < numberOfLeaves; i++) {
        const leaf = document.createElement('div');
        leaf.className = 'leaf';
        leaf.innerHTML = leafSVG;

        // Position horizontale aléatoire
        leaf.style.left = Math.random() * 100 + 'vw';

        // Taille variable pour plus de réalisme
        const randomSize = Math.random() * 25 + 15; // 15-40px (réduit pour plus de subtilité)
        leaf.style.width = randomSize + 'px';
        leaf.style.height = randomSize + 'px';

        // Couleur aléatoire
        leaf.style.color = allColors[Math.floor(Math.random() * allColors.length)];

        // Durées d'animation variables
        const fallDuration = Math.random() * 10 + 10; // 10-20s (plus lent = plus subtil)
        const swayDuration = Math.random() * 4 + 4; // 4-8s
        const rotateDuration = Math.random() * 3 + 3; // 3-6s

        // Délai de départ échelonné
        const delay = Math.random() * 8;

        // Application des animations avec will-change pour performance
        leaf.style.animationDuration = `${fallDuration}s`;
        leaf.style.animationDelay = `${delay}s`;
        leaf.style.willChange = 'transform, opacity';

        // Animation du SVG interne
        const svg = leaf.querySelector('svg');
        svg.style.animationDuration = `${swayDuration}s, ${rotateDuration}s`;
        svg.style.animationDelay = `${delay}s, ${delay}s`;

        container.appendChild(leaf);
    }

    // Nettoyage pour performance : pause l'animation quand l'onglet n'est pas visible
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            container.style.animationPlayState = 'paused';
            const leaves = container.querySelectorAll('.leaf');
            leaves.forEach(leaf => {
                leaf.style.animationPlayState = 'paused';
            });
        } else {
            container.style.animationPlayState = 'running';
            const leaves = container.querySelectorAll('.leaf');
            leaves.forEach(leaf => {
                leaf.style.animationPlayState = 'running';
            });
        }
    });
});