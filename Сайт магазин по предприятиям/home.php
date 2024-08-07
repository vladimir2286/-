<?php
require_once __DIR__ . '/src/helpers.php';

checkAuth();

$user = currentUser();
?>

<!DOCTYPE html>
<html lang="ru" data-theme="">
<?php include_once __DIR__ . '/components/head.php'?>
<body>

<div class="">
    <img
        class="avatar"
        src="<?php echo $user['avatar'] ?>"
        alt="<?php echo $user['name'] ?>"
    >
    <h1>Привет, <?php echo $user['name'] ?>!</h1>
    <div class="col-md-4 text-left">
                        <h3>Линия газирования напитков, Агростроймонтаж</h3>
                        <p>Код товара: 16539</p>
                        <p>Страна-производитель: Агростроймонтаж-2, ООО</p>
                        <p>Назначение: Комплексы оборудования для обеспечения двуокисью углерода линий по газированию и консервации напитков, производства пива, шампанского:</p>
                        <ul>
                            <li>резервуары для хранения углекислоты РДХ 12,5-2,0; 22,5-2,0; 40-2,0; 50-2,0;</li>
                            <li>резервуар для хранения и транспортировки углекислоты РХТУ 4-1,8;</li>
                        </ul>
                        <h3>Цена 150 000 руб</h3>
                        <button class="btn btn-success mt-3">Заказать</button>
                        <button class="btn btn-warning mt-3">Рассчитать в лизинг</button>
                    </div>
    <form action="src/actions/logout.php" method="post">
        <button role="button">Выйти из аккаунта</button>
    </form>
</div>

<?php include_once __DIR__ . '/components/scripts.php' ?>
</body>
</html>