const canvas = document.getElementById("canvas");           
const ctx = canvas.getContext("2d");

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

let origin = {
    x: canvas.width / 2,
    y: canvas.height / 2
};

let mouse = { x: origin.x, y: origin.y };

window.addEventListener("mousemove", (e) => {           //le suivie de la sourie
    mouse.x = e.clientX;
    mouse.y = e.clientY;
});

function drawPoint(x, y, size = 3, alpha = 1) {           //les effet de point
    ctx.fillStyle = `rgba(255, 0, 0, ${alpha})`;
    ctx.beginPath();
    ctx.arc(x, y, size, 0, Math.PI * 2);
    ctx.fill();
}

function polar(rad, time) {

    rad += Math.sin(time / 200);

    let x = 16 * Math.sin(rad) ** 3;
    let y =
        13 * Math.cos(rad) -
        5 * Math.cos(2 * rad) -
        2 * Math.cos(3 * rad) -
        Math.cos(4 * rad);

    let scale = (Math.sin(time / 110) + 3) * 5;         //le coeur qui bat

    let targetX = origin.x + (mouse.x - origin.x) * 0.4;
    let targetY = origin.y + (mouse.y - origin.y) * 0.4;        //effet de sourie

    return {
        x: x * scale + targetX,
        y: -y * scale + targetY
    };
}

let particles = [];

function createParticle(x, y) {
    particles.push({
        x,
        y,
        size: Math.random() * 3 + 1,
        alpha: 1,                           //les particules
        vx: (Math.random() - 0.5) * 2,
        vy: (Math.random() - 0.5) * 2
    });
}

function updateParticles() {
    for (let p of particles) {
        p.x += p.vx;
        p.y += p.vy;
        p.alpha -= 0.02;
    }

    particles = particles.filter(p => p.alpha > 0);
}

function animate(time) {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    for (let rad = 0; rad < Math.PI * 2; rad += 0.05) {     //animation
        let p = polar(rad, time);

        drawPoint(p.x, p.y, 3, 1); //le repert pour les point

        if (Math.random() < 0.3) {
            createParticle(p.x, p.y);
        }
    }

    updateParticles();

    for (let p of particles) {
        drawPoint(p.x, p.y, p.size, p.alpha);       //dessin des particul
    }

    requestAnimationFrame(animate);
}

animate(0);
