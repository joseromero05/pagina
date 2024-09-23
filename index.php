<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Gestión de Archivos</title>
</head>
<body>
    <h1>Gestión de Archivos</h1>

    <?php
    if (isset($_SESSION['mensaje'])) {
        echo "<div class='mensaje'>" . htmlspecialchars($_SESSION['mensaje']) . "</div>";
        unset($_SESSION['mensaje']); // Limpiar el mensaje después de mostrarlo
    }
    ?>

    <!-- SECCION SUBIR PDF -->
    <section class="subir-pdf" id="subir-pdf">
        <div class="contenido-seccion">
            <div class="contenedor-titulo">
                <div class="numero">07</div>
                <div class="info">
                    <span class="frase">Sube tu PDF</span>
                    <h2>SUBIR PDF</h2>
                </div>
            </div>
            <form action="upload_pdf.php" method="post" enctype="multipart/form-data">
                <input type="file" name="pdf_file" accept="application/pdf" required>
                <button type="submit">Subir PDF</button>
            </form>

            <div class="archivos-pdf">
                <h3>Archivos PDF Disponibles</h3>
                <ul>
                    <?php
                    $directory = 'uploads/';
                    if (is_dir($directory)) {
                        $files = array_diff(scandir($directory), array('..', '.'));
                        foreach ($files as $file) {
                            if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
                                echo "<li><a href='$directory$file' target='_blank'>" . htmlspecialchars($file) . "</a></li>";
                            }
                        }
                    } else {
                        echo "<li>No hay archivos disponibles.</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </section>

    <!-- SECCION SUBIR IMÁGENES -->
    <section class="subir-imagenes" id="subir-imagenes">
        <div class="contenido-seccion">
            <div class="contenedor-titulo">
                <div class="numero">08</div>
                <div class="info">
                    <span class="frase">Sube tu Imagen</span>
                    <h2>SUBIR IMAGEN</h2>
                </div>
            </div>
            <form action="upload_image.php" method="post" enctype="multipart/form-data">
                <input type="file" name="image_file" accept="image/*" required>
                <button type="submit">Subir Imagen</button>
            </form>

            <div class="galeria">
                <h3>Imágenes Disponibles</h3>
                <div class="imagenes">
                    <?php
                    $directory = 'uploads/';
                    if (is_dir($directory)) {
                        $files = array_diff(scandir($directory), array('..', '.'));
                        foreach ($files as $file) {
                            if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
                                echo "<div class='imagen'><img src='$directory$file' alt='" . htmlspecialchars($file) . "'><p>" . htmlspecialchars($file) . "</p></div>";
                            }
                        }
                    } else {
                        echo "<p>No hay imágenes disponibles.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ... (tu footer y scripts) -->
</body>
</html>

