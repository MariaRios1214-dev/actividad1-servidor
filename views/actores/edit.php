<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Editar actor</title>
</head>

<body>
    <h1>Editar actor</h1>

    <?php if (!empty($_GET['error'])): ?>
        <p style="color:red;"><b><?= htmlspecialchars($_GET['error']) ?></b></p>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=actores&action=update">
        <input type="hidden" name="id" value="<?= (int)$actor['id'] ?>">

        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?= htmlspecialchars($actor['nombre']) ?>" required><br><br>

        <label>Apellidos:</label><br>
        <input type="text" name="apellidos" value="<?= htmlspecialchars($actor['apellidos']) ?>" required><br><br>

        <label>Fecha nacimiento:</label><br>
        <input type="date" name="fecha_nacimiento" value="<?= htmlspecialchars($actor['fecha_nacimiento']) ?>" required><br><br>

        <label>Nacionalidad:</label><br>
        <input type="text" name="nacionalidad" value="<?= htmlspecialchars($actor['nacionalidad']) ?>" required><br><br>

        <button type="submit">Actualizar</button>
    </form>

    <p><a href="index.php?controller=actores&action=index">Volver</a></p>
</body>

</html>