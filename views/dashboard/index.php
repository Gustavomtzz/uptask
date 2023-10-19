<main class="contenedor">
    <div class="dashboard">
        <?php include_once __DIR__ . '/../templates/sidebar.php';  ?>
        <div class="principal">
            <?php include_once __DIR__ . '/../templates/barra.php';  ?>


            <div class="contenido">
                <h2 class="nombre-pagina"><?php echo $titulo ?></h2>
                <?php include_once __DIR__ . '/../templates/alertas.php';  ?>
                <?php include_once __DIR__ . "/{$contenido}.php";  ?>
            </div>
        </div>
    </div>

</main>