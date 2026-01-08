<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Crear actor</title>
</head>

<body>
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

        <button type="submit">Guardar</button>
    </form>

    <p><a href="index.php?controller=actores&action=index">Volver</a></p>
</body>

</html>