<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Editar idioma</title>
</head>

<body>
    <h1>Editar idioma</h1>

    <?php if (!empty($_GET['error'])): ?>
        <p style="color:red;"><b><?= htmlspecialchars($_GET['error']) ?></b></p>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=idiomas&action=update">
        <input type="hidden" name="id" value="<?= (int)$idioma['id'] ?>">

        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?= htmlspecialchars($idioma['nombre']) ?>" required><br><br>

        <label>ISO code:</label><br>
        <input type="text" name="iso_code" value="<?= htmlspecialchars($idioma['iso_code']) ?>" required maxlength="10"><br><br>

        <button type="submit">Actualizar</button>
    </form>

    <p><a href="index.php?controller=idiomas&action=index">Volver</a></p>
</body>

</html>