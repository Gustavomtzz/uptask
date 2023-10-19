<main class="contenedor">

    <div class="titulo">
        <?php include_once __DIR__ . '/../templates/titulo.php';  ?>
        <?php include_once __DIR__ . '/../templates/alertas.php';  ?>
    </div>

    <p class="nombre-pagina text-center">Iniciar Sesión</p>
    <form action="/" method="POST" class="formulario contenedor-sm">

        <div class="campo">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Tu Email" autocomplete="on">
        </div>

        <div class="campo">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Tu Password" autocomplete="off" required>
        </div>

        <input type="submit" value="Iniciar Sesión" class="boton">
    </form>

    <?php
    include_once __DIR__ . '/../templates/acciones.php';
    $script = "<script src='build/js/app.js'></script>";
    ?>



</main>