<?php if (empty($proyectos)) {  ?>
    <div class="sinproyectos">
        <p class="nombre-proyecto">Aun no Hay Proyectos</p>
        <a href="/crearproyecto" class="boton">Comienza creando uno...</a>
    </div>

<?php } else {  ?>
    <ul class="listar-proyectos">
        <?php foreach ($proyectos as $proyecto) { ?>
            <div class="proyectos">
                <div>
                    <p>Proyecto:</p>
                    <li class="nombre-proyecto"><?php echo $proyecto->proyecto ?></li>
                </div>
                <a href="/proyecto?id=<?php echo $proyecto->url ?>" class="boton">Ir al proyecto</a>
            </div>
        <?php }; ?>
    </ul>
<?php }; ?>