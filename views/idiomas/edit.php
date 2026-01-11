<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Idiomas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/idiomaStyles.css">
</head>

<body>
    <a href="index.php?controller=idiomas&action=index" class="btn-home">← Volver</a>
    <h1>Editar idioma</h1>

    <?php if (!empty($_GET['error'])): ?>
        <div class="mensaje-error"><b><?= htmlspecialchars($_GET['error']) ?></b></div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=idiomas&action=update">
        <input type="hidden" name="id" value="<?= (int)$idioma['id'] ?>">

        <label>Nombre del idioma:</label><br>
        <input type="text" name="nombre" value="<?= htmlspecialchars($idioma['nombre']) ?>" required><br><br>

        <label>Código ISO:</label><br>
        <input type="text" name="iso_code" value="<?= htmlspecialchars($idioma['iso_code']) ?>" required maxlength="10" placeholder="Ej: ES, EN, FR"><br><br>

        <button type="submit" class="btn-actualizar-guardar">Actualizar</button>
    </form>

</body>

</html>