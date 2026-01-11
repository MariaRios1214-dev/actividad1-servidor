<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Directores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/directorStyles.css">
</head>

<body>
    <a href="index.php?controller=directores&action=index" class="btn-home">← Volver</a>
    <h1>Editar director</h1>

    <?php if (!empty($_GET['error'])): ?>
        <div class="mensaje-error"><b><?= htmlspecialchars($_GET['error']) ?></b></div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=directores&action=update">
        <input type="hidden" name="id" value="<?= (int)$director['id'] ?>">

        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?= htmlspecialchars($director['nombre']) ?>" required><br><br>

        <label>Apellidos:</label><br>
        <input type="text" name="apellidos" value="<?= htmlspecialchars($director['apellidos']) ?>" required><br><br>

        <label>Fecha nacimiento:</label><br>
        <input type="date" name="fecha_nacimiento" value="<?= htmlspecialchars($director['fecha_nacimiento']) ?>" required><br><br>

        <label>Nacionalidad:</label><br>
        <input type="text" name="nacionalidad" value="<?= htmlspecialchars($director['nacionalidad']) ?>" required><br><br>
        
        <button type="submit" class="btn-actualizar-guardar">Guardar</button>
    </form>

</body>

</html>