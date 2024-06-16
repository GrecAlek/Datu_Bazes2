// Funkcija kas ģenerē random
function randomInRange(min, max) {
    return Math.random() * (max - min) + min;
}

// Funkcija kas izveide lietus piles
function createRain() {
    const numParticles = 50; // pilu skaits
    const container = document.body; 

    for (let i = 0; i < numParticles; i++) { // cikls kas nosaka kad veidot piles
        const particle = document.createElement('div'); // mainigais kas parstav lietu
        particle.className = 'rain-particle';
        particle.style.left = `${randomInRange(0, window.innerWidth)}px`;// random spawns
        particle.style.top = `${randomInRange(-500, -50)}px`; // lietus sakas atrak neka ekrans
        particle.style.animationDuration = `${randomInRange(2, 5)}s`; //random krituma ilgums
        particle.style.animationDelay = `${randomInRange(0, 5)}s`;  //random respwanosanas partraukums
        container.appendChild(particle); // pievieno jauno lietus pili
    }
}

//kad lapa pilniba ieladejusies izsauksies funkcija
document.addEventListener('DOMContentLoaded', createRain); 