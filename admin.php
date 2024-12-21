<?php
$data = json_decode(file_get_contents('scripts.json'), true);

// Agregar Script
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $commands = $_POST['commands'];
    $link = $_POST['link'];
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$image");
    }

    $data[] = [
        'title' => $title,
        'description' => $description,
        'commands' => $commands,
        'link' => $link,
        'image' => $image
    ];
    file_put_contents('scripts.json', json_encode($data, JSON_PRETTY_PRINT));
    header('Location: admin.php');
    exit();
}

// Eliminar Script
if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    unset($data[$index]);
    $data = array_values($data); // Reindexar array
    file_put_contents('scripts.json', json_encode($data, JSON_PRETTY_PRINT));
    header('Location: admin.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔒 Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
    <script src="admin.js" defer></script>
</head>
<body>
    <header>
        <h1>🔒 Panel de Administración</h1>
        <nav>
            <a href="index.php">🏠 Volver</a>
        </nav>
    </header>

    <section>
        <h2>➕ Agregar Nuevo Script</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">
            <label>Título: <input type="text" name="title" required></label>
            <label>Descripción: <textarea name="description" required></textarea></label>
            <label>Comandos: <textarea name="commands" required></textarea></label>
            <label>Enlace de GitHub: <input type="url" name="link" required></label>
            <label>Imagen: <input type="file" name="image" accept="image/*"></label>
            <button type="submit">Guardar</button>
        </form>
    </section>

    <section>
        <h2>🗑️ Eliminar Scripts</h2>
        <ul>
            <?php foreach ($data as $index => $script): ?>
                <li>
                    <?= htmlspecialchars($script['title']) ?>
                    <a href="?delete=<?= $index ?>" onclick="return confirm('¿Estás seguro de eliminar este script?')">❌ Eliminar</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</body>
</html>
