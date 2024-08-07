<?php

require_once __DIR__ . '/../helpers.php';

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setOldValue('email', $email);
    setValidationError('email', 'Неверный формат электронной почты');
    setMessage('error', 'Ошибка валидации');
    redirect('/index22.php');
}

$user = findUser($email);

if (!$user) {
    setMessage('error', "Почта $email не найдена");
    redirect('/index22.php');
}

if (!password_verify($password, $user['password'])) {
    setMessage('error', 'Неверный пароль');
    redirect('/index22.php');
}

$_SESSION['user']['id'] = $user['id'];

redirect('/home.php');