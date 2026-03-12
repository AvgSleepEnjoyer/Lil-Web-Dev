<?php  
    require "includes/funciones.php";

    incluirTemplate("header");
    ?>

    <section class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" alt="Sobre nosotros" loading="lazy">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>25 años de experiencia</blockquote>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta molestias delectus possimus dolores adipisci architecto alias et ratione quasi laboriosam assumenda, rem exercitationem totam quas autem dicta temporibus esse fugit.
                Aliquid suscipit temporibus atque enim ipsam consequuntur beatae rerum deserunt molestiae, harum aliquam error exercitationem, repellat, placeat dolorem cum voluptas ab recusandae maiores voluptatem. Doloremque harum quaerat fugit molestiae repellendus?
                Pariatur, libero! Accusamus modi nisi accusantium consectetur provident et aperiam optio magni, distinctio consequuntur ipsam veniam temporibus quibusdam minima eum amet ipsa, magnam expedita. Optio rem laborum deleniti provident necessitatibus.</p>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet quae inventore ipsum. Id, asperiores facere in quas rerum esse ex, itaque fugit veniam et soluta, necessitatibus cupiditate maxime sequi nulla! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Saepe aut eius ratione nulla facilis dolorum suscipit fugit minus aspernatur explicabo asperiores obcaecati repellendus culpa reprehenderit rem corporis alias, earum recusandae.</p>
            </div>

        </div>
    </main>


        <main class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam quasi officia magni nihil praesentium perferendis, nesciunt quia aliquid, odio libero tempore eius quaerat laboriosam quis autem quos molestiae, accusantium nostrum.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam quasi officia magni nihil praesentium perferendis, nesciunt quia aliquid, odio libero tempore eius quaerat laboriosam quis autem quos molestiae, accusantium nostrum.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam quasi officia magni nihil praesentium perferendis, nesciunt quia aliquid, odio libero tempore eius quaerat laboriosam quis autem quos molestiae, accusantium nostrum.</p>
            </div>
        </div>
    </section>

    <?php incluirTemplate("footer");?>
