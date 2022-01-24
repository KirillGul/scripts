<?php

error_reporting(E_ALL); //задаёт уровень протоколирования ошибки (E_ALL)
ini_set('display_errors', 'on'); //требуется ли выводить ошибки на экран

require __DIR__ . '/auth.php';
$login = getUserLogin();
?>

<html>

<head>
    <title>Главная страница</title>
</head>

<body>
    <?php if ($login === null) : ?>
        <a href="login.php">Авторизуйтесь</a>
    <?php else : ?>
        Добро пожаловать, <?= $login ?>
        <br>
        <a href="logout.php">Выйти</a>
    <?php endif; ?>
</body>

</html>
