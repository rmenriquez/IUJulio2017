/**
 * Created by RaquelMarcos on 17/6/17.
 */
function noVacio(nombre){
    var respuesta = true;
    if(nombre.value == "" || nombre.value == null || nombre.value.length == 0){
        alert("Introduce un valor para " + nombre.name);
        respuesta = false;
    }
    return respuesta;
}

var tamCampo=function (nombre,tam){
    var respuesta = true;
    if((nombre.value.length <1) || (nombre.value.length > tam) ){
        alert("Introduce un valor para " + nombre.name + " entre " + 0 + " y " + tam);
        respuesta = false;
    }
    return respuesta;
}


var evitarProhibidos = function(nombre){
    var respuesta = true;
    var expresion = /[·$&#^*]+/;

    if(expresion.test(nombre.value)){
        alert("No se pueden incluir los caracteres · $ & # ^ * ");
        respuesta = false;
    }
    return respuesta;
}
