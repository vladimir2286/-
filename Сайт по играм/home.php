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
    <h1>Сайт сделан мною</h1>
    <form action="src/actions/logout.php" method="post">
        <button role="button">Выйти из своего аккаунта</button>
    </form>
</div>

<?php include_once __DIR__ . '/components/scripts.php' ?>
</body>
</html>