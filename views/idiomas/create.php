<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Crear idioma</title>
</head>

<body>
    <h1>Crear idioma</h1>

    <?php if (!empty($_GET['error'])): ?>
        <p style="color:red;"><b><?= htmlspecialchars($_GET['error']) ?></b></p>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=idiomas&action=store">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>ISO code (ej: EN, ES):</label><br>
        <input type="text" name="iso_code" required maxlength="10"><br><br>

        <button type="submit">Guardar</button>
    </form>

    <p><a href="index.php?controller=idiomas&action=index">Volver</a></p>
</body>

</html>