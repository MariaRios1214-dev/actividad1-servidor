<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Actores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/actorStyles.css">
</head>

<body>
    <a href="index.php" class="btn-home">← Home</a>
    <a href="index.php?controller=actores&action=create" class="btn-nuevo">+ Nuevo actor</a>
    
    <h1>Actores</h1>

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

    <table class="tabla-actores">
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
                    <a href="index.php?controller=actores&action=edit&id=<?= (int)$r['id'] ?>" class="btn-editar">Editar</a>
                    <a href="index.php?controller=actores&action=delete&id=<?= (int)$r['id'] ?>" 
                       class="btn-eliminar"
                       onclick="return confirm('¿Seguro que quieres eliminar?');">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>