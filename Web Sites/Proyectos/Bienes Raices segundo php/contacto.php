<?php  
    require "includes/app.php";

    incluirTemplate("header");
    ?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada3.jpg" alt="Imagen contacto" loading="lazy">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario">
            <fieldset>
                <legend>Informacion Personal</legend>
                
                <label for="nombre">Nombre</label>                <input type="text" placeholder="Tu Nombre" id="nombre">

                <label for="email">E-Mail</label>                <input type="email" id="email" placeholder="Tu E-mail">

                <label for="telefono">Télefono</label>                <input type="tel" id="telefono" placeholder="Tu Télefono">

                <label for="mensaje">Mensaje</label>                <textarea id="mensaje"></textarea>

            </fieldset>

            <fieldset>
                <legend>Información Sobre la Propiedad</legend>
                <label for="opciones">Vende o compra</label>
                <select id="opciones">
                    <option value="" disabled selected>--Seleccione--</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o presupuesto</label>
                <input type="number" id="presupuesto" placeholder="$">

                
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>¿Como desea ser contactado?</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>     <input name="contacto" type="radio" value="Telefono" id="contactar-telefono">
                    <label for="contactar-email">E-Mail</label>     <input name="contacto" type="radio" value="Email" id="contactar-email">

                </div>
                    <p>Si eligió teléfono, elija la fecha y hora de contactado</p>
                    <label for="fecha">Fecha</label>
                    <input type="date" id="fecha">

                    <label for="hora">Hora</label>
                    <input type="time" name="" id="hora" min="09:00" max="18:00">
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>

    <?php incluirTemplate("footer");?>
