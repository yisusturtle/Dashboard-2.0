function validarPasswd () {
    let contra1 = document.getElementById("contraseña_1");
    let contra2 = document.getElementById("contraseña_2");
    let contra1Value = contra1.value;
    let contra2Value = contra2.value;
    let espacios = false;
    let error = document.getElementById('error');
    let cont = 0;
    
    // Este bucle recorre la cadena para comprobar
    // que no todo son espacios
        while (!espacios && (cont < contra1Value.length)) {
            if (contra1Value.charAt(cont) == " ")
                espacios = true;
            cont++;
        }

    if (espacios){
        error.style.display="block";
        contra1.style="border: salmon 2px solid";
        contra2.style="border: salmon 2px solid";
        error.innerHTML="La contraseña no puede contener espacios en blanco";
        return false;
    }
        
    if (contra1Value.length == 0 || contra2Value.length == 0) {
        error.style.display="block";
        contra1.style="border: salmon 2px solid";
        contra2.style="border: salmon 2px solid";
        error.innerHTML="Los campos de la password no pueden quedar vacios";
        return false;
    }
        
    if (contra1Value != contra2Value) {
        error.style.display="block";
        contra1.style="border: salmon 2px solid";
        contra2.style="border: salmon 2px solid";
        error.innerHTML="Las passwords deben de coincidir";
        return false;
    } else {
        return true; 
    }
}