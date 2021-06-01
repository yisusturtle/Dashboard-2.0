//cambios de secciones (intro, deploy, mis servicios,ayuda)
var btnS1 = document.getElementById('s1');
var btnS2 = document.getElementById('s2');
var btnS3 = document.getElementById('s3');
var btnS4 = document.getElementById('s4');

var section1 = document.getElementById('section1');
var section2 = document.getElementById('section2');
var section3 = document.getElementById('section3');
var section4 = document.getElementById('section4');

btnS1.addEventListener('click', function() {
    section1.style.display = "block";
    section2.style.display = "none";
    section3.style.display = "none";
    section4.style.display = "none";
});

btnS2.addEventListener('click', function() {
    section2.style.display = "block";
    section1.style.display = "none";
    section3.style.display = "none";
    section4.style.display = "none";
});

btnS3.addEventListener('click', function() {
    section3.style.display = "block";
    section2.style.display = "none";
    section1.style.display = "none";
    section4.style.display = "none";
});

btnS4.addEventListener('click', function() {
    section4.style.display = "block";
    section2.style.display = "none";
    section3.style.display = "none";
    section1.style.display = "none";
});


//Cambiar deploy (wordpress, apache y nginx)
wordpressForm = document.getElementById('wordpress');
apacheForm = document.getElementById('apache');
nginxForm = document.getElementById('nginx');

classWordpress = document.getElementsByClassName('.wordpress');
classNginx = document.getElementsByClassName('.nginx');
classApache = document.getElementsByClassName('.apache');

wordpressBtn = document.getElementById('wordpress-btn');
nginxBtn = document.getElementById('nginx-btn');
apacheBtn = document.getElementById('apache-btn');

wordpressBtn.addEventListener('click', function() {
    wordpressForm.style.display = "flex";
    nginxForm.style.display = "none";
    apacheForm.style.display = "none";

    wordpressBtn.classList.add("selected");
    nginxBtn.classList.remove("selected");
    apacheBtn.classList.remove("selected");

});

nginxBtn.addEventListener('click', function() {
    nginxForm.style.display = "flex";
    wordpressForm.style.display = "none";
    apacheForm.style.display = "none";

    nginxBtn.classList.add("selected");
    apacheBtn.classList.remove("selected");
    wordpressBtn.classList.remove("selected");

});

apacheBtn.addEventListener('click', function() {
    apacheForm.style.display = "flex";
    nginxForm.style.display = "none";
    wordpressForm.style.display = "none";

    apacheBtn.classList.add("selected");
    nginxBtn.classList.remove("selected");
    wordpressBtn.classList.remove("selected");

});