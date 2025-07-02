import './bootstrap';
import './leaves.js'; // Ajoutez cette ligne


document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('leaf-container');
    if (!container) return; // Sécurité si le conteneur n'existe pas

    const numberOfLeaves = 25; // <-- Vous pouvez changer ce nombre (plus = plus de feuilles)

    // On définit les couleurs de nos feuilles
    const autumnColors = ['#c57b57', '#a47148', '#8a5a44']; // Couleurs d'automne
    const springColors = ['#6a994e', '#9cba8f', '#a7c957']; // Couleurs de printemps
    const allColors = [...autumnColors, ...springColors];

    // SVG d'une feuille simple. On pourra changer sa couleur.
    const leafSVG = `
        <svg viewBox="0 0 160 160" xmlns="http://www.w3.org/2000/svg">
            <path d="M151.2 86.4c-6.2-12.5-51.2-30.1-61.2-32.3C70 48.9 31.2 6.4 22.2 3.4c-9-3-19.2 4.1-21.2 13.1-2 9 4.1 19.2 13.1 21.2 9 2 41.8 19.3 49.8 23.3-17.7 20.3-40.4 62.7-38.4 71.7 2 9 12.1 14.1 21.2 12.1s14.1-12.1 12.1-21.2c-1.3-5.9 14.7-37.4 25.8-51.4 12.5 4.1 48.8 24.5 54.8 26.5s14.1-12.1 12.1-21.2c-2.2-9-12.3-13.9-21.4-11.9z" fill="currentColor"/>
        </svg>
    `;

    for (let i = 0; i < numberOfLeaves; i++) {
        // Crée un div pour la feuille
        const leaf = document.createElement('div');
        leaf.className = 'leaf';
        leaf.innerHTML = leafSVG;

        // --- C'est ici qu'on ajoute l'aléatoire ---

        // Position de départ horizontale aléatoire
        leaf.style.left = Math.random() * 100 + 'vw';

        // Taille aléatoire
        const randomSize = Math.random() * 30 + 20; // Entre 20px et 50px
        leaf.style.width = randomSize + 'px';
        leaf.style.height = randomSize + 'px';

        // Couleur aléatoire parmi celles définies
        leaf.style.color = allColors[Math.floor(Math.random() * allColors.length)];
        
        // Vitesse de chute et de balancement aléatoire
        const fallDuration = Math.random() * 8 + 7; // Entre 7 et 15 secondes
        const swayDuration = Math.random() * 4 + 3; // Entre 3 et 7 secondes

        // Délai de départ aléatoire pour ne pas que toutes les feuilles partent en même temps
        const delay = Math.random() * 5;

        // On applique les animations avec les durées et délais aléatoires
        leaf.style.animationDuration = `${fallDuration}s, ${swayDuration}s`;
        leaf.style.animationDelay = `${delay}s, ${delay}s`;
        
        // Ajoute la feuille à notre scène
        container.appendChild(leaf);
    }
});