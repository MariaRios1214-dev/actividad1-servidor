<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Directores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/directorStyles.css">
</head>

<body>
    <a href="index.php" class="btn-home">← Home</a>
    <a href="index.php?controller=directores&action=create" class="btn-nuevo">+ Nuevo director</a>
    
    <h1>Directores</h1>

    <?php if (!empty($_GET['success'])): ?>
        <div class="mensaje-exito"><b><?= htmlspecialchars($_GET['success']) ?></b></div>
    <?php endif; ?>

    <?php if (!empty($_GET['error'])): ?>
        <div class="mensaje-error"><b><?= htmlspecialchars($_GET['error']) ?></b></div>
    <?php endif; ?>

    <table class="tabla-directores">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Fecha nacimiento</th>
            <th>Nacionalidad</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?= (int)$r['id'] ?></td>
                <td><?= htmlspecialchars($r['nombre']) ?></td>
                <td><?= htmlspecialchars($r['apellidos']) ?></td>
                <td><?= htmlspecialchars($r['fecha_nacimiento']) ?></td>
                <td><?= htmlspecialchars($r['nacionalidad']) ?></td>
                <td>
                    <a href="index.php?controller=directores&action=edit&id=<?= (int)$r['id'] ?>" class="btn-editar">Editar</a>
                    <a href="index.php?controller=directores&action=delete&id=<?= (int)$r['id'] ?>" class="btn-eliminar"
                        onclick="return confirm('¿Seguro que quieres eliminar?');">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>