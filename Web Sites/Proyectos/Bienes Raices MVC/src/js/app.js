document.addEventListener("DOMContentLoaded", function(){
    eventListeners();

    darkMode()
});

function darkMode(){

    const prefiereDarkMode = window.matchMedia("(prefers-color-scheme: dark)")

    if(prefiereDarkMode.matches){
        document.body.classList.add("dark-mode")
    }else{
        document.body.classList.remove("dark-mode")
    }

    prefiereDarkMode.addEventListener("change", function(){
        if(prefiereDarkMode.matches){
        document.body.classList.add("dark-mode")
    }else{
        document.body.classList.remove("dark-mode")
    }
    })

    const botonDarkMode = document.querySelector(".dark-mode-boton")

    botonDarkMode.addEventListener("click", function(){
        document.body.classList.toggle("dark-mode");
    })
}

function eventListeners(){
    const movilMenu = document.querySelector(".movil-menu");

    movilMenu.addEventListener("click", navegacionResponsive);

    // Muestra campos condicionales (telefono o email) del contacto
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]')

    metodoContacto.forEach(input => input.addEventListener("click", mostrarMetodosContactos))

}

function navegacionResponsive(){
    const navegacion = document.querySelector(".navegacion");

    navegacion.classList.toggle("mostrar")
    
}

function mostrarMetodosContactos(e){
    const contactoDiv = document.querySelector("#contacto")
    if (e.target.value === "telefono" ) {
        contactoDiv.innerHTML = `
                <label for="telefono">Número de télefono</label>
                <input type="tel" id="telefono" placeholder="Tu Télefono" name="contacto[telefono]">
                <p>Elija la fecha y hora para ser contactado</p>
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="contacto[fecha]">

                <label for="hora">Hora</label>
                <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `
    } else {
        contactoDiv.innerHTML = `
                <label for="email">E-Mail</label>
                <input type="email" id="email" placeholder="Tu E-mail" name="contacto[email]" >
        ` 
    }

}