<?php if (isset($alertas['error'])) : ?>
    <?php foreach ($alertas['error'] as $error) : ?>
        <div class="alerta-error">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <p class="descripcion-pagina"><?php echo $error ?></p>
        </div>
<?php endforeach;
endif; ?>
<?php if (isset($alertas['exito'])) : ?>
    <?php foreach ($alertas['exito'] as $exito) : ?>
        <div class="alerta-exito">
            <i class="fa-regular fa-circle-check" style="color: #007800;"></i>
            <p class="descripcion-pagina"><?php echo $exito ?></p>
        </div>
<?php endforeach;
endif; ?>


<!-- Alertas exito -->
<?php if (isset($mensaje)) : ?>
    <?php if ($mensaje === 1) : ?>
        <div class="alerta-exito" id="alerta-index">
            <i class="fa-regular fa-circle-check" style="color: #007800;"></i>
            <p class="descripcion-pagina ">Cuenta Creada Correctamente</p>
        </div>
    <?php endif; ?>
    <?php if ($mensaje === 2) : ?>
        <div class="alerta-exito" id="alerta-index">
            <i class="fa-regular fa-circle-check" style="color: #007800;"></i>
            <p class="descripcion-pagina">Iniciando Sesión</p>
        </div>
    <?php endif; ?>
    <?php if ($mensaje === 3) : ?>
        <div class="alerta-exito" id="alerta-index">
            <i class="fa-regular fa-circle-check" style="color: #007800;"></i>
            <p class="descripcion-pagina">Password Reestablecido Correctamente</p>
        </div>
    <?php endif; ?>
<?php endif; ?>