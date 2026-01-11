<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Plataformas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/plataformasStyles.css">
</head>

<body>
    <a href="index.php?controller=plataformas&action=index" class="btn-home">← Volver</a>
    <h1>Crear plataforma</h1>

    <?php if (!empty($_GET['error'])): ?>
        <div class="mensaje-error"><b><?= htmlspecialchars($_GET['error']) ?></b></div>
    <?php endif; ?>


    <form method="POST" action="index.php?controller=plataformas&action=store">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required>
        <br><br>
        <button type="submit" class="btn-actualizar-guardar">Guardar</button>
    </form>

</body>

</html>