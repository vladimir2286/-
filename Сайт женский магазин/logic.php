<?php
// Подключение к базе данных
$pdo = new PDO("mysql:host=127.0.0.1;dbname=predpriytie;charset=utf8", 'root', '');

// Поиск
$search = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '';
$search = htmlspecialchars($search); // Валидация ввода

// Фильтр по часам курсов
$hours_filter = isset($_GET['hours']) ? $_GET['hours'] : '';
$hours_filter = htmlspecialchars($hours_filter); // Валидация ввода

// Подготовка SQL-запроса с учетом фильтров и объединением таблиц
$sql = "SELECT s.id, s.name, s.descripton, s.region, s.count_E_R, s.image
        FROM `predpri` AS s
        JOIN `regions` AS t ON s.region = t.region"; // Начальное условие

$params = array(); // Параметры запроса

// Добавление условий поиска и фильтрации, если они заданы
if (!empty($search)) {
    $sql .= " AND s.name LIKE ?";
    $params[] = $search;
}

if (!empty($hours_filter)) {
    $sql .= " AND s.region = ?";
    $params[] = $hours_filter;
}

$stmt = $pdo->prepare($sql);

// Выполнение запроса с передачей параметров
$stmt->execute($params);
$rows = $stmt->fetchAll();

// Вывод данных в табличку
echo "<table border='1'>
        <tr>
            <th>нАЗВАНИЯ ПРЕДПРИЯТИЯ</th>
            <th>Описание</th>
            <th>Регион</th>
            <th>Часы</th>
            <th>Изображение</th>
        </tr>";

foreach ($rows as $row) {
    echo "<tr>
            <td>{$row['name']}</td>
            <td>{$row['descripton']}</td>
            <td>{$row['region']}</td>
            <td>{$row['count_E_R']}</td>
            <td><img src='image1/{$row['image']}' width='100' height='100'></td>
        </tr>";
}

if (empty($rows)) {
    echo "<tr><td colspan='5'>Нет данных для отображения.</td></tr>";
}

echo "</table>";
?>