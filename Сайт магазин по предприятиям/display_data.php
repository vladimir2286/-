<?php
// Подключение к базе данных
$pdo = new PDO("mysql:host=127.0.0.1;dbname=oborydovanie;charset=utf8", 'root', '');



// Фильтр по часам курсов
$oborydovanie = isset($_GET['oborydovanie']) ? $_GET['oborydovanie'] : '';
$oborydovanie = htmlspecialchars($oborydovanie); // Валидация ввода

// Фильтр по цене оборудования
$price_filter = isset($_GET['price']) ? $_GET['price'] : '';
$price_filter = htmlspecialchars($price_filter); // Валидация ввода

// Подготовка SQL-запроса с учетом фильтров и объединением таблиц
$sql = "SELECT s.id, s.name, s.description, s.oborydovanie, s.count, s.image
        FROM `oborydovanie1` AS s
        JOIN `oborydovanie2` AS t ON s.name = t.name
        WHERE 1"; // Используем "WHERE 1" для начала запроса

$params = array(); // Параметры запроса

// Добавление условий поиска и фильтрации, если они заданы


if (!empty($oborydovanie)) {
    $sql .= " AND s.oborydovanie = ?";
    $params[] = $oborydovanie;
}

if (!empty($price_filter)) {
    $sql .= " AND s.count <= ?";
    $params[] = $price_filter;
}

$stmt = $pdo->prepare($sql);

// Выполнение запроса с передачей параметров
$stmt->execute($params);
$rows = $stmt->fetchAll();

// Вывод данных в табличку
echo "<table border='1'>
        <tr>
            <th>Оборудование</th>
            <th>Описание</th>
            <th>Тип оборудования</th>
            <th>Стоимость</th>
            <th>Изображение</th>
        </tr>";

foreach ($rows as $row) {
    echo "<tr>
            <td>{$row['name']}</td>
            <td>{$row['description']}</td>
            <td>{$row['oborydovanie']}</td>
            <td>{$row['count']}</td>
            <td><img src='image1/{$row['image']}' width='100' height='100'></td>
        </tr>";
}

if (empty($rows)) {
    echo "<tr><td colspan='5'>Нет данных для отображения.</td></tr>";
}

echo "</table>";
?>