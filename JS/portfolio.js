const slides = document.querySelectorAll('.project-slide');
const nextBtn = document.getElementById('nextBtn');
const prevBtn = document.getElementById('prevBtn');

let index = 0;

function showSlide(n) {
    slides.forEach(slide => slide.classList.remove('active', 'flip'));
    index = (n + slides.length) % slides.length;
    slides[index].classList.add('active');
}

nextBtn.addEventListener('click', () => {
    showSlide(index + 1);
});

prevBtn.addEventListener('click', () => {
    showSlide(index - 1);
});

slides.forEach(slide => {
    slide.addEventListener('mouseenter', () => {
        slide.classList.add('flip');
    });

    slide.addEventListener('mouseleave', () => {
        slide.classList.remove('flip');
    });
});

const skillCards = document.querySelectorAll('.skill-card');

skillCards.forEach(card => {

    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();

        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const centerX = rect.width / 25;
        const centerY = rect.height / 25;

        const rotateY = (x - centerX) / 25;
        const rotateX = (centerY - y) / 25;

        card.style.transform =
            `rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.05)`;
    });

    card.addEventListener('mouseleave', () => {
        card.style.transform = 'rotateX(0) rotateY(0) scale(1)';
    });

});

const form = document.getElementById('contactForm');
const formMsg = document.getElementById('formMsg');

form.addEventListener('submit', (e) => {
    e.preventDefault();

    formMsg.textContent = "Message envoyé avec succès !";
    form.reset();

    setTimeout(() => {
        formMsg.textContent = "";
    }, 3000);
});
skillCards.forEach(card => {

    card.addEventListener('click', () => {

        card.classList.toggle('active-skill');

        if (card.classList.contains('active-skill')) {
            card.style.transform = 'rotateX(0) rotateY(0) scale(1)';
        }

    });

});
