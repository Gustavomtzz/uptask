<main>
    <div class="titulo recuperar">
        <?php include_once __DIR__ . '/../templates/titulo.php';  ?>
    </div>

    <p class="nombre-pagina text-center">Recupera tu acceso a UpTask</p>
    <form action="/recuperar" method="POST" class="formulario contenedor-sm">

        <div class="campo">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Tu Email" required>
        </div>

        <input type="submit" value="Enviar Instrucciones" class="boton">
    </form>

    <div class="acciones contenedor-sm">
        <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
        <a href="/crear">¿Aún no tienes una cuenta? Obtener una</a>
    </div>

</main>