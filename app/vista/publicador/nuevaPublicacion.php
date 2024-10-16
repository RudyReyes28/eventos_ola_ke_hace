<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Publicación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Crear Publicación</h1>
        <form action="../../controlador/publicador/guardar_publicacion.php" method="POST" enctype="multipart/form-data">

             <!-- Datos de la Publicación -->
             <div class="mb-3">
                <label for="lugar" class="form-label">Lugar</label>
                <input type="text" class="form-control" id="lugar" name="lugar" required>
            </div>
            
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            
            <div class="mb-3">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" class="form-control" id="hora" name="hora" required>
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" class="form-control" id="categoria" name="categoria" required>
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="url" class="form-control" id="url" name="url">
            </div>

            <div class="mb-3">
                <label for="cant_cupo" class="form-label">Cantidad de cupo</label>
                <input type="number" class="form-control" id="cant_cupo" name="cant_cupo" required>
            </div>

            <div class="mb-3">
                <label for="tipo_publico" class="form-label">Tipo de público</label>
                <input type="text" class="form-control" id="tipo_publico" name="tipo_publico" required>
            </div>
            <!-- Elementos de la Publicación -->
            <h2>Agregar Elementos</h2>
<div id="elementos-texto-container">
    <h3>Elementos de Texto</h3>
    <!-- Contenedor para elementos de texto -->
    <div class="elemento-texto mb-3">
        <label for="tipo_elemento_texto[]" class="form-label">Tipo de texto</label>
        <select class="form-select tipo-elemento-texto" name="tipo_elemento_texto[]">
            <option value="h1">Título</option>
            <option value="p">Párrafo</option>
        </select>
        <div class="mb-3 contenido-elemento-texto">
            <label for="contenido_texto[]" class="form-label">Contenido</label>
            <textarea class="form-control" name="contenido_texto[]" rows="3"></textarea>
        </div>
    </div>
</div>

<!-- Botón para agregar más elementos de texto -->
<button type="button" class="btn btn-secondary mb-3" id="agregarElementoTextoBtn">Agregar otro elemento de texto</button>

<hr>

<div id="elementos-archivo-container">
    <h3>Elementos Multimedia</h3>
    <!-- Contenedor para elementos de archivo -->
    <div class="elemento-archivo mb-3">
        <label for="tipo_elemento_archivo[]" class="form-label">Tipo de archivo</label>
        <select class="form-select tipo-elemento-archivo" name="tipo_elemento_archivo[]">
            <option value="video">Video</option>
            <option value="img">Imagen</option>
            <option value="audio">Audio</option>
        </select>
        <div class="mb-3 contenido-elemento-archivo">
            <label for="contenido_archivo[]" class="form-label">Archivo</label>
            <input type="file" class="form-control" name="contenido_archivo[]">
        </div>
    </div>
</div>

<!-- Botón para agregar más elementos multimedia -->
<button type="button" class="btn btn-secondary mb-3" id="agregarElementoArchivoBtn">Agregar otro elemento multimedia</button>

<div class="mb-3">
    <!-- Botón para crear la publicación -->
    <button type="submit" class="btn btn-primary">Crear Publicación</button>
</div>

<script>
    // Función para agregar un nuevo conjunto de campos de texto
    document.getElementById('agregarElementoTextoBtn').addEventListener('click', function() {
        const containerTexto = document.getElementById('elementos-texto-container');
        const nuevoElementoTexto = document.createElement('div');
        nuevoElementoTexto.classList.add('elemento-texto', 'mb-3');
        
        nuevoElementoTexto.innerHTML = `
            <label for="tipo_elemento_texto[]" class="form-label">Tipo de texto</label>
            <select class="form-select tipo-elemento-texto" name="tipo_elemento_texto[]">
                <option value="h1">Título</option>
                <option value="p">Párrafo</option>
            </select>
            <div class="mb-3 contenido-elemento-texto">
                <label for="contenido_texto[]" class="form-label">Contenido</label>
                <textarea class="form-control" name="contenido_texto[]" rows="3"></textarea>
            </div>
        `;

        containerTexto.appendChild(nuevoElementoTexto);
    });

    // Función para agregar un nuevo conjunto de campos de archivo
    document.getElementById('agregarElementoArchivoBtn').addEventListener('click', function() {
        const containerArchivo = document.getElementById('elementos-archivo-container');
        const nuevoElementoArchivo = document.createElement('div');
        nuevoElementoArchivo.classList.add('elemento-archivo', 'mb-3');
        
        nuevoElementoArchivo.innerHTML = `
            <label for="tipo_elemento_archivo[]" class="form-label">Tipo de archivo</label>
            <select class="form-select tipo-elemento-archivo" name="tipo_elemento_archivo[]">
                <option value="video">Video</option>
                <option value="img">Imagen</option>
                <option value="audio">Audio</option>
            </select>
            <div class="mb-3 contenido-elemento-archivo">
                <label for="contenido_archivo[]" class="form-label">Archivo</label>
                <input type="file" class="form-control" name="contenido_archivo[]">
            </div>
        `;

        containerArchivo.appendChild(nuevoElementoArchivo);
    });
</script>
</body>
</html>
