<?php
$pdo = new PDO("mysql:host=127.0.0.1;dbname=games;charset=utf8", 'root', '');

// Обработка создания, обновления и удаления
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $game = $_POST['game'];
    $description = $_POST['description'];
    $ganre = $_POST['ganre'];
    $count = $_POST['count'];

    // Обработка изображения
    $image = $_FILES['image']['name'];
    $target = 'image1/' . basename($image);

    if ($image) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    if ($id) {
        // Обновление записи
        if ($image) {
            $sql = "UPDATE `game` SET game = ?, description = ?, ganre = ?, count = ?, image = ? WHERE id = ?";
            $params = [$game, $description, $ganre, $count, $image, $id];
        } else {
            $sql = "UPDATE `game` SET game = ?, description = ?, ganre = ?, count = ? WHERE id = ?";
            $params = [$game, $description, $ganre, $count, $id];
        }
    } else {
        // Создание новой записи
        $sql = "INSERT INTO `game` (game, description, ganre, count, image) VALUES (?, ?, ?, ?, ?)";
        $params = [$game, $description, $ganre, $count, $image];
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    header('Location: index.php');
    exit();
} elseif (isset($_GET['delete_id'])) {
    // Удаление записи
    $id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM `game` WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: index.php');
    exit();
}

// Поиск и фильтрация
$search = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '';
$search = htmlspecialchars($search);

$min_price = isset($_GET['min_price']) ? $_GET['min_price'] : '';
$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : '';
$min_price = htmlspecialchars($min_price);
$max_price = htmlspecialchars($max_price);

$sql = "SELECT s.id, s.game, s.description, s.ganre, s.count, s.image
        FROM `game` AS s
        JOIN `ganres` AS t ON s.ganre = t.ganre
        WHERE 1=1";

$params = array();

if (!empty($search)) {
    $sql .= " AND s.ganre LIKE ?";
    $params[] = $search;
}

if (!empty($min_price)) {
    $sql .= " AND s.count >= ?";
    $params[] = $min_price;
}

if (!empty($max_price)) {
    $sql .= " AND s.count <= ?";
    $params[] = $max_price;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll();

// Получение данных для редактирования
$id = isset($_GET['id']) ? $_GET['id'] : '';
$row = [];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM `game` WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Games</title>
</head>
<body>

<h1>CRUD Games</h1>

<form method="get">
    <label>Поиск по жанру:</label>
    <input type="text" name="search" value="<?= htmlspecialchars(isset($_GET['search']) ? $_GET['search'] : '') ?>">
    <label>Мин. цена:</label>
    <input type="number" name="min_price" value="<?= htmlspecialchars(isset($_GET['min_price']) ? $_GET['min_price'] : '') ?>">
    <label>Макс. цена:</label>
    <input type="number" name="max_price" value="<?= htmlspecialchars(isset($_GET['max_price']) ? $_GET['max_price'] : '') ?>">
    <button type="submit">Фильтр</button>
</form>

<form action="index.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= isset($row['id']) ? $row['id'] : '' ?>">
    <label>Название:</label>
    <input type="text" name="game" value="<?= isset($row['game']) ? $row['game'] : '' ?>"><br>
    <label>Описание:</label>
    <textarea name="description"><?= isset($row['description']) ? $row['description'] : '' ?></textarea><br>
    <label>Жанр:</label>
    <input type="text" name="ganre" value="<?= isset($row['ganre']) ? $row['ganre'] : '' ?>"><br>
    <label>Стоимость:</label>
    <input type="number" name="count" value="<?= isset($row['count']) ? $row['count'] : '' ?>"><br>
    <label>Изображение:</label>
    <input type="file" name="image"><br>
    <button type="submit">Сохранить</button>
</form>

<table border='1'>
    <tr>
        <th>Название</th>
        <th>Описание</th>
        <th>Жанр</th>
        <th>Стоимость</th>
        <th>Изображение</th>
        <th>Действия</th>
    </tr>
    <?php foreach ($rows as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['game']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td><?= htmlspecialchars($row['ganre']) ?></td>
            <td><?= htmlspecialchars($row['count']) ?></td>
            <td><img src='image1/<?= htmlspecialchars($row['image']) ?>' width='100' height='100'></td>
            <td>
                <a href='index.php?id=<?= $row['id'] ?>'>Изменить</a> | 
                <a href='index.php?delete_id=<?= $row['id'] ?>'>Удалить</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if (empty($rows)): ?>
        <tr><td colspan='6'>Нет данных для отображения.</td></tr>
    <?php endif; ?>
</table>

</body>
</html>