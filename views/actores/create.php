<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Actores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/actorStyles.css">
</head>

<body>
    <a href="index.php?controller=actores&action=index" class="btn-home">← Volver</a>
    <h1>Crear actor</h1>

    <?php if (!empty($_GET['error'])): ?>
        <p style="color:red;"><b><?= htmlspecialchars($_GET['error']) ?></b></p>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=actores&action=store">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Apellidos:</label><br>
        <input type="text" name="apellidos" required><br><br>

        <label>Fecha nacimiento:</label><br>
        <input type="date" name="fecha_nacimiento" required><br><br>

        <label>Nacionalidad:</label><br>
        <input type="text" name="nacionalidad" required><br><br>

        <button type="submit" class="btn-actualizar-guardar">Guardar</button>
    </form>

</body>

</html>