function validarContrasena(){
    var contrasena = document.getElementById("password").value
    var rcontrasena = document.getElementById("rpassword").value
    
    if(rcontrasena.length >0){
        if(rcontrasena === contrasena){
            document.getElementById("cajaP").style.background = "rgba(135, 246, 7,0.5)"
            document.getElementById("cajaR").style.background = "rgba(135, 246, 7,0.5)"
        }else{
            document.getElementById("cajaP").style.background = "rgba(255, 0, 0,0.5)"
            document.getElementById("cajaR").style.background = "rgba(255, 0, 0,0.5)"

        }
    }else{
        document.getElementById("cajaP").style.background = "none"
            document.getElementById("cajaR").style.background = "none"
    }
}

function validarCamposObligatorios(){
    var palabra = ""
    var bandera = true
    for(var i = 0; i < document.forms[0].length ; i++){
        var elemento = document.forms[0].elements[i]
        if(elemento.value.trim() == ''){
            bandera=false
            palabra = palabra +" "+ elemento.id
        }
    }
    if(bandera == true){
        return true
    }else{
       
        alert("Llenar los campos de: " + palabra)
        return false
    }
}