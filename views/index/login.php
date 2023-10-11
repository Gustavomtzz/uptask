<main class="contenedor">
    <div class="titulo">
        <h1 class="nombre-pagina">UpTask</h1>
        <p class="descripcion-pagina">Crea y Administra tus Proyectos</p>
    </div>

    <p class="titulo">Iniciar Sesión</p>
    <form action="/" method="POST" class="formulario contenedor-sm">

        <div class="campo">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Tu Email" autocomplete="on" required>
        </div>

        <div class="campo">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Tu Password" autocomplete="off" required>
        </div>

        <input type="submit" value="Iniciar Sesión" class="boton">
    </form>

    <?php
    include_once __DIR__ . '/../templates/acciones.php';
    ?>



</main>