<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Series</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/serieStyles.css">
</head>

<body>
    <a href="index.php?controller=series&action=index" class="btn-home">← Volver</a>
    <h1>Editar serie</h1>

    <?php if (!empty($_GET['error'])): ?>
        <div class="mensaje-error"><b><?= htmlspecialchars($_GET['error']) ?></b></div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=series&action=update">
        <input type="hidden" name="id" value="<?= (int)$serie['id'] ?>">

        <label>Título:</label><br>
        <input type="text" name="titulo" value="<?= htmlspecialchars($serie['titulo']) ?>" required><br><br>

        <label>Plataforma:</label><br>
        <select name="plataforma_id" required>
            <?php foreach ($plataformas as $p): ?>
                <option value="<?= (int)$p['id'] ?>" <?= ((int)$serie['plataforma_id'] === (int)$p['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Director:</label><br>
        <select name="director_id" required>
            <?php foreach ($directores as $d): ?>
                <option value="<?= (int)$d['id'] ?>" <?= ((int)$serie['director_id'] === (int)$d['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($d['nombre'] . " " . $d['apellidos']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit" class="btn-actualizar-guardar">Actualizar</button>
    </form>

</body>

</html>