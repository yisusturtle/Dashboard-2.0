//Navbar (GSAP animations)
let TimeLine = new TimelineMax({ paused: true });
let OpenMenu = document.getElementById('open-menu');
let CloseMenu = document.getElementById('close-menu');
let IconosMenu = document.getElementsByName('iconos');
let LinkIcono = document.getElementsByName('link-icono');

TimeLine.to(".menu-container", 0.4, {right: "0%",});

TimeLine.staggerTo(".open-menu", 0.1, { opacity: 0}, 0, "-=0.2");
TimeLine.staggerFrom(".link", 0.4, { opacity: 0, x:'100%' }, 0.1, "-=0.2");
TimeLine.staggerFrom(".login", 0.4, { opacity: 0, x:'100%' }, 0.1, "-=0.2");
TimeLine.staggerFrom('.iconos-link', 0.4, { opacity: 0, x:'100%', delay:0.5 }, 0.1, "-=0.2");
TimeLine.reverse();

OpenMenu.addEventListener('click',function(){
    TimeLine.reversed(!TimeLine.reversed());
});

CloseMenu.addEventListener('click',function(){
    TimeLine.reversed(!TimeLine.reversed());
});

//Animacion de lenguajes
let contenedor = document.getElementById('tag');
window.onload=function(){
    let entries= [
        {label : 'HTML', url:'https://es.wikipedia.org/wiki/HTML'},
        {label : 'CSS', url: 'https://developer.mozilla.org/es/docs/Web/CSS'},
        {label : 'JAVASCRIPT', url: 'https://developer.mozilla.org/es/docs/Web/JavaScript'},
        {label : 'GSAP(LIBRARY)', url: 'https://greensock.com/gsap/'},
        {label : 'JQUERY', url: 'https://jquery.com/'},
        {label : 'PHP', url: 'https://www.php.net/'},
        {label : 'PYTHON', url: 'https://www.python.org/'},
        {label : 'PROXMOX', url: 'https://www.proxmox.com/en/'},
        {label : 'KUBERNETES', url:'https://kubernetes.io/es/'},
        {label : 'BASH', url: 'https://es.wikipedia.org/wiki/Bash'}
    ];

    let settings = {
        entries: entries,
        radius:'50%',
        radiusMin:40,
        bgDraw:true,
        bgColor:'transparent',
        opacityOver:1.00,
        opacityOut:0.05,
        opacitySpeed:6,
        fov:800,
        speed:1.4,
        fontFamily: 'DotGothic16, sans-serif',
        fontSize:'30',
        fontColor:'#65da75',
        fontWeight: 'bold',
        fontStyle:'normal',
        fontSretch: 'normal',
        fontToUppercase:true
    };
    //Con js normal no fuciona bien asi que utilizo este pocquito de
    $('#ball').svg3DTagCloud(settings);
};

//Scroll animation
gsap.registerPlugin(ScrollTrigger);

gsap.to('.resumen-texto',{
    scrollTrigger:{
        trigger: ".resumen-projecto",
        scrub:2,
        start:"65% center",
        end:"65% 100px",
    },
    x:"-100%",
    opacity:0,
    duration:2,
    delay:10
    
});

gsap.to('.botones-link',{
    scrollTrigger:{
        trigger: ".resumen-projecto",
        scrub:1,
        start:"65% center",
        end:"65% 100px",
    },
    x:"-100%",
    opacity:0,
    stragger:1,
    duration:3,
});

gsap.to('.imagen-bola',{
    scrollTrigger:{
        trigger: ".resumen-projecto",
        scrub:1,
        start:"65% center",
        end:"65% 100px",
    },
    x:"-100%",
    opacity:0,
    stragger:1,
    duration:2,
});

gsap.to('.navbar-scroll',{
    scrollTrigger:{
        trigger: ".resumen-projecto",
        scrub:0.1,
        start:"80% center",
    },
    y:"0",
    duration:0.5,
});

gsap.to('.servicios-scroll', {
    scrollTrigger:{
        trigger:".services-scroll",
        scrub:0.5,
        start:"60% center",
    },
    x:"-100%",
    opacity:0,
    duration: 1}
);

gsap.to('.pods-scroll', {
    scrollTrigger:{
        trigger:".services-scroll",
        scrub:0.5,
        start:"60% center",
    },
    x:"-100%",
    opacity:0,
    duration: 1}
);

gsap.to('.tbody-scroll', {
    scrollTrigger:{
        trigger:".services-scroll",
        scrub:0.5,
        start:"60% center",
    },
    x:"-100%",
    duration: 1,
    opacity:0,
    delay:0.2}
);

gsap.to('.pods-titulo-scroll', {
    scrollTrigger:{
        trigger:".services-scroll",
        scrub:0.5,
        start:"60% center",
    },
    x:"-100%",
    duration: 1,
    opacity:0,
    delay:0.5}
);

gsap.to('.change-section-scroll', {
    scrollTrigger:{
        trigger:".services-scroll",
        scrub:0.5,
        start:"60% center",
    },
    x:"-100%",
    opacity:0,
    duration: 0.5,
    delay:0.1}
);

gsap.from('.jesus-jose', {
    scrollTrigger:{
        trigger:".services-scroll",
        scrub:1,
        start:"60% center",
    },
    x:"-100%",
    opacity:0,
    duration: 0.5,
    delay:0.1}
);

//Scroll table
let alturaPantalla= (screen.height - 400)
$('#tablaPods').DataTable( { //He desactivado todas las funciones del plugin, menos la del scroll
    "scrollY": `${alturaPantalla}px`,
    "scrollCollapse": true,
    "paging":false,
    "searching":false,
    "ordering":false,
    "entries":false,
    "info":false
} );

$('#tablaServices').DataTable( { //He desactivado todas las funciones del plugin, menos la del scroll
    "scrollY": `${alturaPantalla}px`,
    "scrollCollapse": true,
    "paging":false,
    "searching":false,
    "ordering":false,
    "entries":false,
    "info":false
} );

//Cambio de tablas
const toServicios = document.getElementById('cambiar-servicios');
const toPods = document.getElementById('cambiar-pods');
let tablaPods = document.getElementById('js-tablapods');
let tablaServicios =document.getElementById('js-tablaservicios');

toServicios.addEventListener('click',function(){
    tablaPods.style.display="none";
    tablaServicios.style.display="flex";
    gsap.from('.services', {duration: 1, x:"-100%"});
    gsap.from('.pods-titulo', {duration: 1, x:"-100%",delay:0.5});
    gsap.from('.tbody', {duration: 1, x:"-100%",delay:0.2, stragger:1})
});

toPods.addEventListener('click',function(){
    tablaPods.style.display="flex";
    tablaServicios.style.display="none";
    gsap.from('.pods', {duration: 1, x:"-100%"});
    gsap.from('.pods-titulo', {duration: 1, x:"-100%",delay:0.5});
    gsap.from('.tbody', {duration: 1, x:"-100%",delay:0.2, stragger:1})
});



