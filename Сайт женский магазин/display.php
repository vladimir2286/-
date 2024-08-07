<?php
// Подключение к базе данных
$pdo = new PDO("mysql:host=127.0.0.1;dbname=parikmaxerskay;charset=utf8", 'root', '');

// Обработка CRUD операций
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        // Создание записи
        $name = htmlspecialchars($_POST['name']);
        $descripton = htmlspecialchars($_POST['descripton']);
        $count = htmlspecialchars($_POST['count']);
        $image = htmlspecialchars($_POST['image']);
        $brand = htmlspecialchars($_POST['brand']);
        
        $stmt = $pdo->prepare("INSERT INTO parimaxer (name, descripton, count, image, brand) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $descripton, $count, $image, $brand]);
        
    } elseif (isset($_POST['update'])) {
        // Обновление записи
        $id = htmlspecialchars($_POST['id']);
        $name = htmlspecialchars($_POST['name']);
        $descripton = htmlspecialchars($_POST['descripton']);
        $count = htmlspecialchars($_POST['count']);
        $image = htmlspecialchars($_POST['image']);
        $brand = htmlspecialchars($_POST['brand']);
        
        $stmt = $pdo->prepare("UPDATE parimaxer SET name = ?, descripton = ?, count = ?, image = ?, brand = ? WHERE id = ?");
        $stmt->execute([$name, $descripton, $count, $image, $brand, $id]);
        
    } elseif (isset($_POST['delete'])) {
        // Удаление записи
        $id = htmlspecialchars($_POST['id']);
        
        $stmt = $pdo->prepare("DELETE FROM parimaxer WHERE id = ?");
        $stmt->execute([$id]);
    }
}

// Фильтр по цене
$price_from = isset($_GET['price_from']) ? $_GET['price_from'] : '';
$price_to = isset($_GET['price_to']) ? $_GET['price_to'] : '';
$price_from = htmlspecialchars($price_from); // Валидация ввода
$price_to = htmlspecialchars($price_to); // Валидация ввода

// Фильтр по бренду
$brand_filter = isset($_GET['brand_filter']) ? $_GET['brand_filter'] : '';
$brand_filter = htmlspecialchars($brand_filter); // Валидация ввода

// Подготовка SQL-запроса с учетом фильтров и объединением таблиц
$sql = "SELECT DISTINCT s.id, s.name, s.descripton, s.count, s.image, s.brand
        FROM `parimaxer` AS s
        JOIN `brands` AS t ON s.brand = t.brand"; // Начальное условие

$params = array(); // Параметры запроса

// Добавление условий фильтрации, если они заданы
$conditions = array();
if (!empty($price_from)) {
    $conditions[] = "s.count >= ?";
    $params[] = $price_from;
}

if (!empty($price_to)) {
    $conditions[] = "s.count <= ?";
    $params[] = $price_to;
}

if (!empty($brand_filter)) {
    $conditions[] = "s.brand = ?";
    $params[] = $brand_filter;
}

if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$stmt = $pdo->prepare($sql);

// Выполнение запроса с передачей параметров
$stmt->execute($params);
$rows = $stmt->fetchAll();

// Форма для создания и обновления записи
echo '<form method="post" action="">
        <input type="hidden" name="id" value="">
        <input type="text" name="name" placeholder="Название">
        <input type="text" name="descripton" placeholder="Описание">
        <input type="number" name="count" placeholder="Стоимость">
        <input type="text" name="image" placeholder="Изображение">
        <input type="text" name="brand" placeholder="Бренд">
        <button type="submit" name="create">Создать</button>
        <button type="submit" name="update">Обновить</button>
      </form>';

// Вывод данных в табличку
echo "<table border='1'>
        <tr>
            <th>Изображение</th>
            <th>Описание</th>
            <th>Стоимость</th>
            <th>Название</th>
            <th>Бренд</th>
            <th>Действия</th>
        </tr>";

foreach ($rows as $row) {
    echo "<tr>
            <td><img src='imagebd/{$row['image']}' width='100' height='100'></td>
            <td>{$row['descripton']}</td>
            <td>{$row['count']}</td>
            <td>{$row['name']}</td>
            <td>{$row['brand']}</td>
            <td>
                <form method='post' action='' style='display:inline-block;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='name' value='{$row['name']}'>
                    <input type='hidden' name='descripton' value='{$row['descripton']}'>
                    <input type='hidden' name='count' value='{$row['count']}'>
                    <input type='hidden' name='image' value='{$row['image']}'>
                    <input type='hidden' name='brand' value='{$row['brand']}'>
                    <button type='submit' name='update'>Редактировать</button>
                </form>
                <form method='post' action='' style='display:inline-block;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <button type='submit' name='delete'>Удалить</button>
                </form>
            </td>
         </tr>";
}

if (empty($rows)) {
    echo "<tr><td colspan='6'>Нет данных для отображения.</td></tr>";
}

echo "</table>";
?>