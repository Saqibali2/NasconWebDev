// Initialize GSAP ScrollTrigger
gsap.registerPlugin(ScrollTrigger);

// Fade Up Animation
gsap.utils.toArray('.gsap-fade-up').forEach(element => {
    const delay = element.getAttribute('data-delay') || 0;
    gsap.from(element, {
        scrollTrigger: {
            trigger: element,
            start: "top bottom-=100",
            toggleActions: "play none none reverse"
        },
        y: 50,
        opacity: 0,
        duration: 1,
        delay: parseFloat(delay),
        ease: "power2.out"
    });
});

// Scale Animation
gsap.utils.toArray('.gsap-scale').forEach(element => {
    gsap.from(element, {
        scrollTrigger: {
            trigger: element,
            start: "top bottom-=100",
            toggleActions: "play none none reverse"
        },
        scale: 0.8,
        opacity: 0,
        duration: 1,
        ease: "power2.out"
    });
});

// Service Box Hover Animation
gsap.utils.toArray('.service-bx').forEach(box => {
    box.addEventListener('mouseenter', () => {
        gsap.to(box, {
            y: -10,
            duration: 0.3,
            ease: "power2.out"
        });
    });

    box.addEventListener('mouseleave', () => {
        gsap.to(box, {
            y: 0,
            duration: 0.3,
            ease: "power2.out"
        });
    });
});

// Hero Section Animation
const heroSection = document.querySelector('.hero-section');
if (heroSection) {
    gsap.from(heroSection, {
        scrollTrigger: {
            trigger: heroSection,
            start: "top top",
            toggleActions: "play none none reverse"
        },
        y: 100,
        opacity: 0,
        duration: 1.5,
        ease: "power2.out"
    });
}

// Course Cards Animation
gsap.utils.toArray('.cours-bx').forEach((card, i) => {
    gsap.from(card, {
        scrollTrigger: {
            trigger: card,
            start: "top bottom-=100",
            toggleActions: "play none none reverse"
        },
        y: 50,
        opacity: 0,
        duration: 0.8,
        delay: i * 0.1,
        ease: "power2.out"
    });
});

// Testimonial Animation
gsap.from('.testimonial-bx', {
    scrollTrigger: {
        trigger: '.testimonial-bx',
        start: "top bottom-=100",
        toggleActions: "play none none reverse"
    },
    x: -100,
    opacity: 0,
    duration: 1,
    ease: "power2.out"
});

// Add smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            gsap.to(window, {
                duration: 1,
                scrollTo: {
                    y: target,
                    offsetY: 70
                },
                ease: "power2.inOut"
            });
        }
    });
}); 