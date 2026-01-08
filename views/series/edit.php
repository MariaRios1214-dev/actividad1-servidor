<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Editar serie</title>
</head>

<body>
    <h1>Editar serie</h1>

    <?php if (!empty($_GET['error'])): ?>
        <p style="color:red;"><b><?= htmlspecialchars($_GET['error']) ?></b></p>
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

        <button type="submit">Actualizar</button>
    </form>

    <p><a href="index.php?controller=series&action=index">Volver</a></p>
</body>

</html>