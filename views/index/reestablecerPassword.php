<main class="contenedor">

    <div class="titulo reestablecer">
        <?php
        include_once __DIR__ . '/../templates/titulo.php';
        include_once __DIR__ . '/../templates/alertas.php';
        ?>
    </div>

    <p class="nombre-pagina text-center">Restablecer Password</p>
    <?php if ($form) : ?>
        <form method="POST" class="formulario contenedor-sm">

            <div class="campo">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Nuevo Password" autocomplete="off" required>
            </div>
            <input type="submit" value="Reestablecer" class="boton">
        </form>
    <?php endif;  ?>
</main>