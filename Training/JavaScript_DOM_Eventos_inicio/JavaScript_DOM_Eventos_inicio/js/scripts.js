//querySelector

const heading = document.querySelector(".header__texto h2") //lo de header__texto es porque agarra el h2 que esta en un div con ese nombre de clase

// const heading = document-querySelector(#heading) esto si le pones una id en vez de clase

console.log(heading);
//querySelectorAll

//getElementById

const nuevoEnlace = document.createElement("a")

nuevoEnlace.href = "nuevo-enlace.html"

nuevoEnlace.textContent = "Un nuevo enlace"

nuevoEnlace.classList.add("navegacion__enlace")

const navegacion = document.querySelector(".navegacion")
navegacion.appendChild(nuevoEnlace)

console.log(nuevoEnlace);


console.log(1);

window.addEventListener("load", function(){     //Load espera a que JS y archivos del html (imgs) esten listos
    console.log(2);
})

window.onload = function(){                     //Sirve igual que el de arriba
    console.log(4);
}

document.addEventListener("DOMContentLoaded", function(){       //Espera a que se descargue el html, no CSS ni /imgs
    console.log(5);
})

console.log(3);

// window.onscroll = function(){
//     console.log("scroll...");
// }


//Seleccionar elementos y asociarles un evento

// const botonEnviar = document.querySelector(".boton--primario")
// botonEnviar.addEventListener("click", function(evento){
//     console.log("Enviando fomulario");
//     console.log(evento);
//     evento.preventDefault()
// })



// Eventos de los INputs y Textarea

const datos = {     //Tiene que llevar el mismo nombre las llaves del objeto a la id del formulario, mejor dicho los inputs 
    nombre: "",
    email: "",
    mensaje: ""
}

const nombre = document.querySelector("#nombre")
const email = document.querySelector("#email")
const mensaje = document.querySelector("#mensaje")
const formulario = document.querySelector(".formulario")


nombre.addEventListener("input", leerTexto)

email.addEventListener("input", leerTexto)

mensaje.addEventListener("input", leerTexto)

// Evento submit    Es mejor practica que el de button-principal, el click es en general ,imgs, txt, botones, etc
formulario.addEventListener("submit", function(evento){
    evento.preventDefault()

    // Validar formulario

    const {nombre, email, mensaje} = datos

    

    if (nombre === "" || email === "" || mensaje === "" ){
        mostrarAlerta("Todos los campos son obligatorios", true)

        return
    }

    mostrarAlerta("La informacion se mando con exito")

    // Enviar formulario

    console.log("Enviando formulario");
    console.log(evento);
})




function leerTexto(evento){
    // console.log(evento.target.value);
    // console.log("Escribiendo");

    datos[evento.target.id] = evento.target.value       //Para que se guarde en el objeto

    // console.log(datos);          
}

function mostrarAlerta(mensaje, error=null){
    const alerta = document.createElement("P")
    alerta.textContent = mensaje

    if(error){
        alerta.classList.add("error")
    }else{
        alerta.classList.add("enviado")
    }

    formulario.appendChild(alerta)

    setTimeout(() => {
        alerta.remove
    }, 5000);

}
