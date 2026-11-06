<?php include_once __DIR__ . "/header-dashboard.php"; ?>

<?php  ?>

<?php if (count($proyectos) === 0) { ?>
        <div class="no-proyectos">No Hay Proyectos Aún <a href="/crear-proyecto">Comieza Creando Uno</a></div>
    <?php } else { ?>
        <ul class="listado-proyectos">
            <?php foreach ($proyectos as $proyecto) { ?>
                <li class="proyecto">
                    <a href="/proyecto?id=<?php echo $proyecto->url; ?>">
                        <?php echo $proyecto->proyecto; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>


<?php include_once __DIR__ . "/footer-dashboard.php"; ?>