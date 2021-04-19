//cambios de sections
var btnS1=document.getElementById('s1');
var btnS2=document.getElementById('s2');
var btnS3=document.getElementById('s3');
var btnS4=document.getElementById('s4');
var btnS5=document.getElementById('s5');

var section1=document.getElementById('section1');
var section2=document.getElementById('section2');
var section3=document.getElementById('section3');
var section4=document.getElementById('section4');
var section5=document.getElementById('section5');

btnS1.addEventListener('click',function(){
    section1.style.display="block";
    section2.style.display="none";
    section3.style.display="none";
    section4.style.display="none";
    section5.style.display="none";
});

btnS2.addEventListener('click',function(){
    section2.style.display="block";
    section1.style.display="none";
    section3.style.display="none";
    section4.style.display="none";
    section5.style.display="none";
});

btnS3.addEventListener('click',function(){
    section3.style.display="block";
    section2.style.display="none";
    section1.style.display="none";
    section4.style.display="none";
    section5.style.display="none";
});

btnS4.addEventListener('click',function(){
    section4.style.display="block";
    section2.style.display="none";
    section3.style.display="none";
    section1.style.display="none";
    section5.style.display="none";
});

btnS5.addEventListener('click',function(){
    section5.style.display="block";
    section2.style.display="none";
    section3.style.display="none";
    section4.style.display="none";
    section1.style.display="none";
});