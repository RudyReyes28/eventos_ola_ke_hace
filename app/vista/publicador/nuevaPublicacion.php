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
            <div id="elementos-container">
                <div class="elemento mb-3">
                    <div class="mb-3">
                        <label for="tipo_elemento[]" class="form-label">Tipo de elemento</label>
                        <select class="form-select tipo-elemento" name="tipo_elemento[]">
                            <option value="h1">Título</option>
                            <option value="p">Párrafo</option>
                            <option value="video">Video</option>
                            <option value="img">Imagen</option>
                            <option value="audio">Audio</option>
                        </select>
                    </div>
                    <div class="mb-3 contenido-elemento">
                        <label for="contenido[]" class="form-label">Contenido</label>
                        <textarea class="form-control" name="contenido[]"></textarea> <!-- Por defecto es un textarea -->
                    </div>
                </div>
            </div>

            <!-- Botón para agregar más elementos -->
            <button type="button" class="btn btn-secondary mb-3" id="agregarElementoBtn">Agregar otro elemento</button>

            <div class="mb-3">
                <!-- Botón para crear la publicación -->
                <button type="submit" class="btn btn-primary">Crear Publicación</button>
            </div>
            
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para cambiar el campo "contenido" según el tipo de elemento seleccionado
        function cambiarCampoContenido(selectElement) {
            const elementoContainer = selectElement.closest('.elemento');
            const contenidoDiv = elementoContainer.querySelector('.contenido-elemento');
            
            // Borrar el contenido actual del div de contenido
            contenidoDiv.innerHTML = '';

            // Obtener el valor seleccionado
            const tipoElemento = selectElement.value;

            // Generar el campo de contenido según el tipo de elemento
            if (tipoElemento === 'h1' || tipoElemento === 'p') {
                // Si es Título o Párrafo, mostrar textarea
                contenidoDiv.innerHTML = `
                    <label for="contenido[]" class="form-label">Contenido</label>
                    <textarea class="form-control" name="contenido[]" rows="3"></textarea>
                `;
            } else {
                // Si es video, img o audio, mostrar input de archivo
                contenidoDiv.innerHTML = `
                    <label for="contenido[]" class="form-label">Contenido</label>
                    <input type="file" class="form-control" name="contenido[]">
                `;
            }
        }

        // Llamar la función cuando se cambie el tipo de elemento
        document.querySelectorAll('.tipo-elemento').forEach(select => {
            select.addEventListener('change', function() {
                cambiarCampoContenido(this);
            });
        });

        // Función para agregar un nuevo conjunto de campos de elemento
        document.getElementById('agregarElementoBtn').addEventListener('click', function() {
            const container = document.getElementById('elementos-container');
            const nuevoElemento = document.createElement('div');
            nuevoElemento.classList.add('elemento', 'mb-3');
            
            nuevoElemento.innerHTML = `
                <div class="mb-3">
                    <label for="tipo_elemento[]" class="form-label">Tipo de elemento</label>
                    <select class="form-select tipo-elemento" name="tipo_elemento[]">
                        <option value="h1">Título</option>
                        <option value="p">Párrafo</option>
                        <option value="video">Video</option>
                        <option value="img">Imagen</option>
                        <option value="audio">Audio</option>
                    </select>
                </div>
                <div class="mb-3 contenido-elemento">
                    <label for="contenido[]" class="form-label">Contenido</label>
                    <textarea class="form-control" name="contenido[]" rows="3"></textarea>
                </div>
            `;

            container.appendChild(nuevoElemento);

            // Agregar el listener para el nuevo select agregado
            nuevoElemento.querySelector('.tipo-elemento').addEventListener('change', function() {
                cambiarCampoContenido(this);
            });
        });
    </script>
</body>
</html>
