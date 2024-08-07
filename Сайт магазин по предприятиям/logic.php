<?php
// Подключение к базе данных
$pdo = new PDO("mysql:host=127.0.0.1;dbname=predpriytie;charset=utf8", 'root', '');

// Валидация ввода
function validate_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Создание новой записи
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $name = validate_input($_POST['name']);
    $description = validate_input($_POST['description']);
    $region = validate_input($_POST['region']);
    $count_E_R = validate_input($_POST['count_E_R']);
    $image = validate_input($_POST['image']);

    $sql = "INSERT INTO predpri (name, descripton, region, count_E_R, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $description, $region, $count_E_R, $image]);
}

// Обновление записи
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = validate_input($_POST['id']);
    $name = validate_input($_POST['name']);
    $description = validate_input($_POST['description']);
    $region = validate_input($_POST['region']);
    $count_E_R = validate_input($_POST['count_E_R']);
    $image = validate_input($_POST['image']);

    $sql = "UPDATE predpri SET name = ?, descripton = ?, region = ?, count_E_R = ?, image = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $description, $region, $count_E_R, $image, $id]);
}

// Удаление записи
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = validate_input($_POST['id']);

    $sql = "DELETE FROM predpri WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

// Поиск
$search = isset($_GET['search']) ? '%' . validate_input($_GET['search']) . '%' : '';
$hours_filter = isset($_GET['hours']) ? validate_input($_GET['hours']) : '';

// Подготовка SQL-запроса с учетом фильтров и объединением таблиц
$sql = "SELECT s.id, s.name, s.descripton, s.region, s.count_E_R, s.image
        FROM predpri AS s
        JOIN regions AS t ON s.region = t.region
        WHERE 1=1"; // Начальное условие

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

// Форма для добавления/обновления/удаления записи
?>
<form method="post">
    <input type="hidden" name="id" id="id">
    <input type="text" name="name" placeholder="Название предприятия" required>
    <input type="text" name="description" placeholder="Описание" required>
    <input type="text" name="region" placeholder="Регион" required>
    <input type="text" name="count_E_R" placeholder="Стоимость" required>
    <input type="text" name="image" placeholder="Изображение" required>
    <button type="submit" name="create">Добавить</button>
    <button type="submit" name="update">Обновить</button>
    <button type="submit" name="delete">Удалить</button>
</form>

<?php
// Вывод данных в табличку
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Название предприятия</th>
            <th>Описание</th>
            <th>Регион</th>
            <th>Стоимость</th>
            <th>Изображение</th>
            <th>Действия</th>
        </tr>";

foreach ($rows as $row) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['descripton']}</td>
            <td>{$row['region']}</td>
            <td>{$row['count_E_R']}</td>
            <td><img src='image1/{$row['image']}' width='100' height='100'></td>
            <td>
                <button onclick=\"editRecord({$row['id']}, '{$row['name']}', '{$row['descripton']}', '{$row['region']}', '{$row['count_E_R']}', '{$row['image']}')\">Редактировать</button>
            </td>
        </tr>";
}

if (empty($rows)) {
    echo "<tr><td colspan='7'>Нет данных для отображения.</td></tr>";
}

echo "</table>";
?>

<script>
function editRecord(id, name, description, region, count_E_R, image) {
    document.getElementById('id').value = id;
    document.getElementsByName('name')[0].value = name;
    document.getElementsByName('description')[0].value = description;
    document.getElementsByName('region')[0].value = region;
    document.getElementsByName('count_E_R')[0].value = count_E_R;
    document.getElementsByName('image')[0].value = image;
}
</script>