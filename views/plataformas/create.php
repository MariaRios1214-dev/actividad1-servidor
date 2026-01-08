<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Crear plataforma</title>
</head>

<body>
    <h1>Crear plataforma</h1>

    <?php if (!empty($_GET['error'])): ?>
        <p style="color:red;"><b><?= htmlspecialchars($_GET['error']) ?></b></p>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=plataformas&action=store">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required>
        <br><br>
        <button type="submit">Guardar</button>
    </form>

    <p><a href="index.php?controller=plataformas&action=index">Volver</a></p>
</body>

</html>