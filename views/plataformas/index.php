<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Plataformas</title>
</head>

<body>
    <h1>Plataformas</h1>

    <?php if (!empty($_GET['success'])): ?>
        <p style="color:green;"><b><?= htmlspecialchars($_GET['success']) ?></b></p>
    <?php endif; ?>

    <?php if (!empty($_GET['error'])): ?>
        <p style="color:red;"><b><?= htmlspecialchars($_GET['error']) ?></b></p>
    <?php endif; ?>

    <a href="index.php?controller=plataformas&action=create">+ Nueva plataforma</a>

    <table border="1" cellpadding="6" cellspacing="0" style="margin-top:10px;">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?= (int)$r['id'] ?></td>
                <td><?= htmlspecialchars($r['nombre']) ?></td>
                <td>
                    <a href="index.php?controller=plataformas&action=edit&id=<?= (int)$r['id'] ?>">Editar</a>
                    |
                    <a href="index.php?controller=plataformas&action=delete&id=<?= (int)$r['id'] ?>"
                        onclick="return confirm('¿Seguro que quieres eliminar?');">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>