<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Editar plataforma</title>
</head>

<body>
    <h1>Editar plataforma</h1>

    <?php if (!empty($_GET['error'])): ?>
        <p style="color:red;"><b><?= htmlspecialchars($_GET['error']) ?></b></p>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=plataformas&action=update">
        <input type="hidden" name="id" value="<?= (int)$plataforma['id'] ?>">

        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?= htmlspecialchars($plataforma['nombre']) ?>" required>
        <br><br>

        <button type="submit">Actualizar</button>
    </form>

    <p><a href="index.php?controller=plataformas&action=index">Volver</a></p>
</body>

</html>