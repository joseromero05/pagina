<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "uploads/";

    // Verificar que el archivo se haya subido correctamente
    if (isset($_FILES["pdf_file"])) {
        if ($_FILES["pdf_file"]["error"] !== UPLOAD_ERR_OK) {
            echo "Error al subir el archivo: " . $_FILES["pdf_file"]["error"];
            exit;
        }

        $file_name = basename($_FILES["pdf_file"]["name"]);
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validar que sea un archivo PDF
        if ($file_extension === 'pdf') {
            $new_file_name = uniqid('pdf_', true) . '.' . $file_extension;
            $target_file = $target_dir . $new_file_name;

            if (move_uploaded_file($_FILES["pdf_file"]["tmp_name"], $target_file)) {
                echo "El archivo ha sido subido exitosamente: " . htmlspecialchars($new_file_name);
            } else {
                echo "Lo siento, hubo un error al mover el archivo.";
            }
        } else {
            echo "Solo se permiten archivos PDF.";
        }
    } else {
        echo "No se ha enviado ningún archivo.";
    }
}

