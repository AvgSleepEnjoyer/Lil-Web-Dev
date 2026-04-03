<main class="contenedor seccion">
        <h1>Contacto</h1>

        <?php if($mensaje){
            echo "<p class='alerta exito'>" . $mensaje . "</p>";
        } ?>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada3.jpg" alt="Imagen contacto" loading="lazy">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario" action="/contacto" method="POST">
            <fieldset>
                <legend>Informacion Personal</legend>
                
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" >

                

                
                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="contacto[mensaje]" ></textarea>

            </fieldset>

            <fieldset>
                <legend>Información Sobre la Propiedad</legend>
                <label for="opciones">Vende o compra</label>
                <select id="opciones" name="contacto[tipo]" >
                    <option value="" disabled selected>--Seleccione--</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o presupuesto</label>
                <input type="number" id="presupuesto" placeholder="$" name="contacto[precio]" >

                
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>   

                <p>¿Como desea ser contactado?</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>     
                    <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" >

                    <label for="contactar-email">E-Mail</label>
                    <input type="radio" value="Email" id="contactar-email" name="contacto[contacto]" >

                </div>

                <div id="contacto"></div>

                    
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>