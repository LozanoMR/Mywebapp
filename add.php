<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $commands = $_POST['commands'];
    $link = $_POST['link'];
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$image");
    }

    $data = json_decode(file_get_contents('scripts.json'), true);
    $data[] = [
        'title' => $title,
        'description' => $description,
        'commands' => $commands,
        'link' => $link,
        'image' => $image
    ];
    file_put_contents('scripts.json', json_encode($data, JSON_PRETTY_PRINT));
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Script</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>➕ Agregar Nuevo Script</h1>
        <nav>
            <a href="index.php">🏠 Volver</a>
        </nav>
    </header>
    <form method="POST" enctype="multipart/form-data">
        <label>Título: <input type="text" name="title" required></label>
        <label>Descripción: <textarea name="description" required></textarea></label>
        <label>Comandos: <textarea name="commands" required></textarea></label>
        <label>Enlace de GitHub: <input type="url" name="link" required></label>
        <label>Imagen: <input type="file" name="image" accept="image/*"></label>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
