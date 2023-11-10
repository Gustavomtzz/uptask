<div class="contenedor-sm" id="contenedor-tareas">
    <div class="contenedor-nueva-tarea">
        <button type="button" class="agregar-tarea" id="agregar-tarea">&#43; Nueva Tarea </button>
    </div>
    <div class="contenedor-filtros" id="filtros">
        <h2>Filtros</h2>
        <div class="campo">
            <div>
                <label for="todas">Todas</label>
                <input type="radio" id="todas" name="filtros" value="">
            </div>
            <div>
                <label for="completadas">Completadas</label>
                <input type="radio" id="completadas" name="filtros" value="1">
            </div>
            <div>
                <label for="activo">Activo</label>
                <input type="radio" id="activo" name="filtros" value="0">
            </div>
        </div>
    </div>
</div>


<?php $script = "<script src='build/js/tareas.js'></script>;<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>" ?>