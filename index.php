<?php
$data = json_decode(file_get_contents('scripts.json'), true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>💻 Scripts para Termux</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <header>
        <h1>💻 Terminal Scripts Hub</h1>
        <nav>
        </nav>
    </header>
    <main>
        <?php foreach ($data as $script): ?>
            <div class="card">
                <img src="uploads/<?= htmlspecialchars($script['image']) ?>" alt="Script Image" onclick="toggleDetails(this)">
                <h2><?= htmlspecialchars($script['title']) ?></h2>
                <p><?= htmlspecialchars($script['description']) ?></p>
                <div class="commands">
                    <pre><?= htmlspecialchars($script['commands']) ?></pre>
                </div>
                <a href="<?= htmlspecialchars($script['link']) ?>" target="_blank">🔗 Ver en GitHub</a>
            </div>
        <?php endforeach; ?>
    </main>
    <footer>
        <p>© 2024 Terminal Scripts Hub</p>
    </footer>
</body>
</html>
