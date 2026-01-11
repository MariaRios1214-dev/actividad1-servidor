<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Actores</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 20px auto; max-width: 900px; text-align: center; position: relative;">
    <a href="index.php" style="position: absolute; top: -10px; left: -10px; background: #007cba; color: white; padding: 8px 15px; text-decoration: none; border-radius: 5px; font-size: 14px;">← Home</a>
    <a href="index.php?controller=actores&action=create" style="position: absolute; top: -10px; right: -10px; background: #28a745; color: white; padding: 8px 15px; border-radius: 5px; font-size: 14px;">+ Nuevo actor</a>
    
    <h1>Actores</h1>

    <?php if (!empty($_GET['success'])): ?>
        <div style="color:green; background:#f0f8f0; padding:10px; border:1px solid green; border-radius:5px; margin:10px 0;">
            <strong><?= htmlspecialchars($_GET['success']) ?></strong>
        </div>
    <?php endif; ?>

    <?php if (!empty($_GET['error'])): ?>
        <div style="color:red; background:#fff0f0; padding:10px; border:1px solid red; border-radius:5px; margin:10px 0;">
            <strong><?= htmlspecialchars($_GET['error']) ?></strong>
        </div>
    <?php endif; ?>

    <table style="margin: 20px auto; border-collapse: collapse; width: 100%; max-width: 800px; border: 1px solid #ccc;">
        <tr style="background-color: #f5f5f5;">
            <th style="padding: 8px; border: 1px solid #ccc; text-align: left;">ID</th>
            <th style="padding: 8px; border: 1px solid #ccc; text-align: left;">Nombre</th>
            <th style="padding: 8px; border: 1px solid #ccc; text-align: left;">Apellidos</th>
            <th style="padding: 8px; border: 1px solid #ccc; text-align: left;">Fecha nacimiento</th>
            <th style="padding: 8px; border: 1px solid #ccc; text-align: left;">Nacionalidad</th>
            <th style="padding: 8px; border: 1px solid #ccc; text-align: left;">Acciones</th>
        </tr>

        <?php foreach ($rows as $r): ?>
            <tr>
                <td style="padding: 8px; border: 1px solid #ccc;"><?= (int)$r['id'] ?></td>
                <td style="padding: 8px; border: 1px solid #ccc;"><?= htmlspecialchars($r['nombre']) ?></td>
                <td style="padding: 8px; border: 1px solid #ccc;"><?= htmlspecialchars($r['apellidos']) ?></td>
                <td style="padding: 8px; border: 1px solid #ccc;"><?= htmlspecialchars($r['fecha_nacimiento']) ?></td>
                <td style="padding: 8px; border: 1px solid #ccc;"><?= htmlspecialchars($r['nacionalidad']) ?></td>
                <td style="padding: 8px; border: 1px solid #ccc;">
                    <a style="color: white; background: #007cba; padding: 5px 10px; border-radius: 3px; margin-right: 5px; font-size: 12px;"
                    href="index.php?controller=actores&action=edit&id=<?= (int)$r['id'] ?>">Editar</a>
                    <a style="color: white; background: #dc3545; padding: 5px 10px; border-radius: 3px; font-size: 12px;"
                    href="index.php?controller=actores&action=delete&id=<?= (int)$r['id'] ?>"
                        onclick="return confirm('¿Seguro que quieres eliminar?');">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>