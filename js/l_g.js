/*LOGIN-REGISTER*/
const login = document.getElementById('login');
const register = document.getElementById('register');
const recover = document.getElementById('recovery');

const button_register = document.getElementById('go-register');
const button_login = document.getElementById('go-login');
const button_recover = document.getElementById('forgot');

button_register.addEventListener('click',function(){
    login.style.display= 'none';
    register.style.display= 'flex';
    gsap.from('#register', {duration: 1, x:'-100%', opacity: 0, delay:0.5});
    gsap.from('#form-titulo', {duration: 1, x:'-100%', opacity: 0, delay:0.6});
    gsap.from('#logo-estatico', {duration: 1, y:'-100%', opacity: 0, delay:0.5});imagen-cohete
});

button_login.addEventListener('click',function(){
    register.style.display= 'none';
    login.style.display= 'flex';
    gsap.from('#login', {duration: 1, x:'-100%', opacity: 0, delay:0.5});
    gsap.from('#form-titulo', {duration: 1, x:'-100%', opacity: 0, delay:0.6});
    gsap.from('#logo-estatico', {duration: 1, y:'-100%', opacity: 0, delay:0.5})
});

button_recover.addEventListener('click',function(){
    login.style.display= 'none';
    recover.style.display= 'flex';
    gsap.from('#recovery', {duration: 1, x:'-100%', opacity: 0, delay:0.5});
    gsap.from('#form-titulo', {duration: 1, x:'-100%', opacity: 0, delay:0.6});
    gsap.from('#logo-estatico', {duration: 1, y:'-100%', opacity: 0, delay:0.5})
});

const back_register = document.getElementById('back-register');
const back_login = document.getElementById('back-login');

back_login.addEventListener('click',function(){
    recover.style.display= 'none';
    login.style.display= 'flex';
    gsap.from('#login', {duration: 1, x:'-100%', opacity: 0, delay:0.5});
    gsap.from('#form-titulo', {duration: 1, x:'-100%', opacity: 0, delay:0.6});
    gsap.from('#logo-estatico', {duration: 1, y:'-100%', opacity: 0, delay:0.5})
});

back_register.addEventListener('click',function(){
    recover.style.display= 'none';
    register.style.display= 'flex';
    gsap.from('#register', {duration: 1, x:'-100%', opacity: 0, delay:0.5});
    gsap.from('#form-titulo', {duration: 1, x:'-100%', opacity: 0, delay:0.6});
    gsap.from('#logo-estatico', {duration: 1, y:'-100%', opacity: 0, delay:0.5})
});


