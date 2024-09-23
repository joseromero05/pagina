<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "uploads/";

    if (isset($_FILES["image_file"])) {
        if ($_FILES["image_file"]["error"] !== UPLOAD_ERR_OK) {
            $_SESSION['mensaje'] = "Error al subir la imagen: " . $_FILES["image_file"]["error"];
            header("Location: index.php");
            exit;
        }

        $file_name = basename($_FILES["image_file"]["name"]);
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validar extensiones de imagen
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($file_extension, $allowed_extensions)) {
            $new_file_name = uniqid('img_', true) . '.' . $file_extension;
            $target_file = $target_dir . $new_file_name;

            if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
                $_SESSION['mensaje'] = "La imagen ha sido subida exitosamente: " . htmlspecialchars($new_file_name);
            } else {
                $_SESSION['mensaje'] = "Lo siento, hubo un error al mover la imagen.";
            }
        } else {
            $_SESSION['mensaje'] = "Solo se permiten imágenes en formato JPG, JPEG, PNG o GIF.";
        }
    } else {
        $_SESSION['mensaje'] = "No se ha enviado ninguna imagen.";
    }

    header("Location: index.php");
}

