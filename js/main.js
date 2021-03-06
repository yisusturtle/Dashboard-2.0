//Navbar (GSAP animations)
let TimeLine = new TimelineMax({ paused: true });
let OpenMenu = document.getElementById('open-menu');
let CloseMenu = document.getElementById('close-menu');
let IconosMenu = document.getElementsByName('iconos');
let LinkIcono = document.getElementsByName('link-icono');

TimeLine.to(".menu-container", 0.4, { right: "0%", });

TimeLine.staggerTo(".open-menu", 0.1, { opacity: 0 }, 0, "-=0.2");
TimeLine.staggerFrom(".link", 0.4, { opacity: 0, x: '100%' }, 0.1, "-=0.2");
TimeLine.staggerFrom(".login", 0.4, { opacity: 0, x: '100%' }, 0.1, "-=0.2");
TimeLine.staggerFrom('.iconos-link', 0.4, { opacity: 0, x: '100%', delay: 0.5 }, 0.1, "-=0.2");
TimeLine.reverse();

OpenMenu.addEventListener('click', function() {
    TimeLine.reversed(!TimeLine.reversed());
});

CloseMenu.addEventListener('click', function() {
    TimeLine.reversed(!TimeLine.reversed());
});

//Animacion de lenguajes (archivo jquery_ball_interactive.js)
let contenedor = document.getElementById('tag');
window.onload = function() {
    let entries = [
        { label: 'HTML', url: 'https://es.wikipedia.org/wiki/HTML' },
        { label: 'CSS', url: 'https://developer.mozilla.org/es/docs/Web/CSS' },
        { label: 'JAVASCRIPT', url: 'https://developer.mozilla.org/es/docs/Web/JavaScript' },
        { label: 'GSAP(LIBRARY)', url: 'https://greensock.com/gsap/' },
        { label: 'JQUERY', url: 'https://jquery.com/' },
        { label: 'PHP', url: 'https://www.php.net/' },
        { label: 'PYTHON', url: 'https://www.python.org/' },
        { label: 'PROXMOX', url: 'https://www.proxmox.com/en/' },
        { label: 'KUBERNETES', url: 'https://kubernetes.io/es/' },
        { label: 'BASH', url: 'https://es.wikipedia.org/wiki/Bash' }
    ];

    let settings = {
        entries: entries,
        radius: '50%',
        radiusMin: 40,
        bgDraw: true,
        bgColor: 'transparent',
        opacityOver: 1.00,
        opacityOut: 0.05,
        opacitySpeed: 6,
        fov: 800,
        speed: 1.4,
        fontFamily: 'DotGothic16, sans-serif',
        fontSize: '30',
        fontColor: '#65da75',
        fontWeight: 'bold',
        fontStyle: 'normal',
        fontSretch: 'normal',
        fontToUppercase: true
    };
    //cargar settings en el elemento svg3d #ball
    $('#ball').svg3DTagCloud(settings);
};

//Scroll animation
gsap.registerPlugin(ScrollTrigger);

gsap.to('.resumen-texto', {
    scrollTrigger: {
        trigger: ".resumen-projecto",
        scrub: 2,
        start: "65% center",
        end: "65% 100px",
    },
    x: "-100%",
    opacity: 0,
    duration: 2,
    delay: 10

});

gsap.to('.botones-link', {
    scrollTrigger: {
        trigger: ".resumen-projecto",
        scrub: 1,
        start: "65% center",
        end: "65% 100px",
    },
    x: "-100%",
    opacity: 0,
    stragger: 1,
    duration: 3,
});

gsap.to('.imagen-bola', {
    scrollTrigger: {
        trigger: ".resumen-projecto",
        scrub: 1,
        start: "65% center",
        end: "65% 100px",
    },
    x: "-100%",
    opacity: 0,
    stragger: 1,
    duration: 2,
});

gsap.to('.navbar-scroll', {
    scrollTrigger: {
        trigger: ".resumen-projecto",
        scrub: 0.1,
        start: "80% center",
    },
    y: "0",
    duration: 0.5,
});

gsap.to('.info-image', {
    scrollTrigger: {
        trigger: ".info-image",
        scrub: 0.5,
        start: "70% center",
    },
    x: "-100%",
    opacity: 0,
    duration: 1
});

gsap.to('.info-text', {
    scrollTrigger: {
        trigger: ".info-text",
        scrub: 0.5,
        start: "70% center",
    },
    x: "-100%",
    opacity: 0,
    duration: 1
});

gsap.to('.tbody-scroll', {
    scrollTrigger: {
        trigger: ".services-scroll",
        scrub: 0.5,
        start: "60% center",
    },
    x: "-100%",
    duration: 1,
    opacity: 0,
    delay: 0.2
});

gsap.to('.pods-titulo-scroll', {
    scrollTrigger: {
        trigger: ".services-scroll",
        scrub: 0.5,
        start: "60% center",
    },
    x: "-100%",
    duration: 1,
    opacity: 0,
    delay: 0.5
});

gsap.to('.change-section-scroll', {
    scrollTrigger: {
        trigger: ".services-scroll",
        scrub: 0.5,
        start: "60% center",
    },
    x: "-100%",
    opacity: 0,
    duration: 0.5,
    delay: 0.1
});

gsap.from('.jesus-jose', {
    scrollTrigger: {
        trigger: ".services-scroll",
        scrub: 1,
        start: "60% center",
    },
    x: "-100%",
    opacity: 0,
    duration: 0.5,
    delay: 0.1
});