//Intro items (para transicion de carga GSAP)
gsap.from('.login-container',{duration: 2, x:'-100%',opacity:0 ,ease: 'elastic', delay:0.5})

//main.js
/*LOGIN-REGISTER*/
const login = document.getElementById('login');
const register = document.getElementById('register');
const recover = document.getElementById('recovery');

const button_register = document.getElementById('go-register');
const button_login = document.getElementById('go-login');
const button_recover = document.getElementById('forgot');

button_register.addEventListener('click',function(){
    gsap.from('#register', {duration: 1, y:'-100%', opacity: 0, rotation:0, ease: 'bounce', delay:0.5});
    login.style.display= 'none';
    register.style.display= 'block';
});

button_login.addEventListener('click',function(){
    gsap.from('#login', {duration: 1, y:'-100%', opacity: 0, rotation:0, ease: 'bounce', delay:0.5});
    register.style.display= 'none';
    login.style.display= 'block';
});

button_recover.addEventListener('click',function(){
    gsap.from('#recovery', {duration: 1, y:'-100%', opacity: 0, rotation:0, ease: 'bounce', delay:0.5});
    login.style.display= 'none';
    recover.style.display= 'block';
});

const back_register = document.getElementById('back-register');
const back_login = document.getElementById('back-login');

back_login.addEventListener('click',function(){
    gsap.from('#login', {duration: 1, y:'-100%', opacity: 0, rotation:0, ease: 'bounce', delay:0.5});
    recover.style.display= 'none';
    login.style.display= 'block';
});

back_register.addEventListener('click',function(){
    gsap.from('#register', {duration: 1, y:'-100%', opacity: 0, rotation:0, ease: 'bounce', delay:0.5});
    recover.style.display= 'none';
    register.style.display= 'block';
});


