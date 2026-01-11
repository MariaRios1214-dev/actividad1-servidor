<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Series</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/seriesStyles.css">
</head>

<body>
    <a href="index.php" class="btn-home">Home</a>
    <a href="index.php?controller=series&action=create" class="btn-nuevo">+ Nueva serie</a>
    
    <h1>Series</h1>

    <?php if (!empty($_GET['success'])): ?>
        <div class="mensaje-exito">
            <strong><?= htmlspecialchars($_GET['success']) ?></strong>
        </div>
    <?php endif; ?>

    <?php if (!empty($_GET['error'])): ?>
        <div class="mensaje-error">
            <strong><?= htmlspecialchars($_GET['error']) ?></strong>
        </div>
    <?php endif; ?>

    <table class="tabla-series">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Plataforma</th>
            <th>Director</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?= (int)$r['id'] ?></td>
                <td><?= htmlspecialchars($r['titulo']) ?></td>
                <td><?= htmlspecialchars($r['plataforma']) ?></td>
                <td><?= htmlspecialchars($r['director']) ?></td>
                <td>
                    <a href="index.php?controller=series&action=edit&id=<?= (int)$r['id'] ?>" class="btn-editar">Editar</a>
                    <a href="index.php?controller=series&action=delete&id=<?= (int)$r['id'] ?>" 
                       class="btn-eliminar"
                       onclick="return confirm('¿Seguro que quieres eliminar?');">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>