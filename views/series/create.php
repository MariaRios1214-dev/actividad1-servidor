<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Crear serie</title>
</head>

<body>
    <h1>Crear serie</h1>

    <?php if (!empty($_GET['error'])): ?>
        <p style="color:red;"><b><?= htmlspecialchars($_GET['error']) ?></b></p>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=series&action=store">
        <label>Título:</label><br>
        <input type="text" name="titulo" required><br><br>

        <label>Plataforma:</label><br>
        <select name="plataforma_id" required>
            <option value="">-- Selecciona --</option>
            <?php foreach ($plataformas as $p): ?>
                <option value="<?= (int)$p['id'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Director:</label><br>
        <select name="director_id" required>
            <option value="">-- Selecciona --</option>
            <?php foreach ($directores as $d): ?>
                <option value="<?= (int)$d['id'] ?>">
                    <?= htmlspecialchars($d['nombre'] . " " . $d['apellidos']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Guardar</button>
    </form>

    <p><a href="index.php?controller=series&action=index">Volver</a></p>
</body>

</html>