(function() {  // IIFE immediatly invoked function expression sirve para no mezclar codigo entre archivos js
    // Botón para mostrar el form de agregar tarea en /proyecto?id....
    const nuevaTareaBtn = document.querySelector("#agregar-tarea")
    nuevaTareaBtn.addEventListener("click", mostrarFormulario)

    function mostrarFormulario(){
        const modal = document.createElement("DIV")
        modal.classList.add("modal")
        modal.innerHTML =  `
            <form class="formulario nueva-tarea">
                <legend>Añade una nueva tarea</legend>
                <div class="campo">
                    <label for="tarea">Tarea</label>
                    <input
                        type="text"
                        name="tarea"
                        placeholder="Añadir Tarea al Proyecto Actual"
                        id="tarea"
                    />
            </div>
                <div class="opciones">
                    <input type="submit" class="submit-nueva-tarea" value="Añadir Tarea"/>
                    <button type="button" class="cerrar-modal">Cancelar</button>
                </div>
            </form>
       `;

        setTimeout(() => {
            const formulario = document.querySelector(".formulario")
            formulario.classList.add("animar")
        }, 0);

        modal.addEventListener("click", function(e){
            e.preventDefault();

            if (e.target.classList.contains("cerrar-modal")) {
                const formulario = document.querySelector(".formulario")
                formulario.classList.add("cerrar")
                setTimeout(() => {
                    modal.remove()
                }, 500);
            }
            if (e.target.classList.contains("submit-nueva-tarea")) {
                submitFormularioNuevaTarea();
            }
        })

        document.querySelector(".dashboard").appendChild(modal)
    }
    
    function submitFormularioNuevaTarea() {
        const tarea = document.querySelector("#tarea").value.trim();
        
        if (tarea === "") {
            // Mostrar alerta de error
            mostrarAlerta("El nombre de la tarea es obligatorio", "error", document.querySelector(".formulario legend"));
            return
        } 

        agregarTarea(tarea);
    }

    // Muestra un mensaje en la interfaz
    function mostrarAlerta(mensaje, tipo, referencia) {
        // Previene que aparezcan mas de una alerta
        const alertaPrevia = document.querySelector(".alerta")
        if (alertaPrevia) {
            alertaPrevia.remove();
        }
        
        const alerta = document.createElement("DIV")
        alerta.classList.add("alerta", tipo)
        
        alerta.textContent=mensaje

        // Inserta la alerta antes del Legend en el formulario
        referencia.parentElement.insertBefore(alerta, referencia);

        // Eliminar la alerta despues de 5 segundos
        setTimeout(() => {
            alerta.remove()
        }, 4000);


    }

    // Consultar el servidor para añadir una nueva tarea al proyecto actual
    async function agregarTarea(tarea) {
        // Construir la peticion
        const datos = new FormData();
        datos.append("nombre", tarea)
        datos.append("proyectoId", obtenerProyecto())

        try {
            const url = "http://localhost:3000/api/tarea"
            const respuesta = await fetch(url, {
                method: "POST",
                body: datos
            });

            const resultado = await respuesta.json()
            
            if (resultado.tipo === "exito") {
                const modal = document.querySelector(".modal")
                setTimeout(() => {
                    modal.remove()
                }, 3000);
            } 
            mostrarAlerta(resultado.mensaje, resultado.tipo, document.querySelector(".formulario legend"));
            return

        } catch (error) {
            console.log(error);
        }
    }

    function obtenerProyecto() {
        const proyectoParams = new URLSearchParams(window.location.search);
        const proyecto = Object.fromEntries(proyectoParams.entries())
        return proyecto.id
    }

})();