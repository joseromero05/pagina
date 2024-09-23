<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "uploads/";

    if (isset($_FILES["pdf_file"])) {
        if ($_FILES["pdf_file"]["error"] !== UPLOAD_ERR_OK) {
            $_SESSION['mensaje'] = "Error al subir el archivo: " . $_FILES["pdf_file"]["error"];
            header("Location: index.php");
            exit;
        }

        $file_name = basename($_FILES["pdf_file"]["name"]);
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if ($file_extension === 'pdf') {
            $new_file_name = uniqid('pdf_', true) . '.' . $file_extension;
            $target_file = $target_dir . $new_file_name;

            if (move_uploaded_file($_FILES["pdf_file"]["tmp_name"], $target_file)) {
                $_SESSION['mensaje'] = "El archivo ha sido subido exitosamente: " . htmlspecialchars($new_file_name);
            } else {
                $_SESSION['mensaje'] = "Lo siento, hubo un error al mover el archivo.";
            }
        } else {
            $_SESSION['mensaje'] = "Solo se permiten archivos PDF.";
        }
    } else {
        $_SESSION['mensaje'] = "No se ha enviado ningún archivo.";
    }

    header("Location: index.php");
}

