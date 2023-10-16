<main class="contenedor">
    <div class="titulo crear">
        <?php include_once __DIR__ . '/../templates/titulo.php'; ?>
    </div>

    <p class="nombre-pagina text-center">Crea tu cuenta en UpTask</p>
    <form action="/crear" method="POST" class="formulario contenedor-sm">

        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Tu Nombre">
        </div>


        <div class="campo">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" placeholder="Tu Apellido" required>
        </div>

        <div class="campo">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Tu Email" required>
        </div>

        <div class="campo">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Tu Password" required>
        </div>

        <div class="campo">
            <label for="repetirpassword">Repite Password</label>
            <input type="password" name="repetirpassword" id="repetirpassword" placeholder="Repite tu Password" required>
        </div>

        <input type="submit" value="Crear Cuenta" class="boton">
    </form>

    <div class="acciones contenedor-sm">
        <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
        <a href="/recuperar">¿Olvidaste tu Password?</a>
    </div>

</main>