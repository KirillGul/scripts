<?php

//Хорошее описание исключений: https://wm-school.ru/php/php_exceptions.php

//Пример 1: просто бросить исключение (не ловить, скрипт прерывается в Fatal Error)
/*
function divide($divident, $divisor) {
    //Бросить исключение, если делитетль равен нулю
    if ($divisor == 0) {
        throw new Exception ("Деление на ноль");
    }

    return $divident / $divisor;
}

echo divide (5, 0);
*/

//Пример 2: поймать исключение (скрипт не прервывается)
/*
function divide($divident, $divisor) {
    //Бросить исключение, если делитетль равен нулю
    if ($divisor == 0) {
        throw new Exception ("Деление на ноль.");
    }

    return $divident / $divisor;
}

try {
    echo divide (5, 0);
} catch (Exception  $e) {
    echo "Невозможно разделить!";
}

echo '<br>Продолжение скрипта...';
*/

//Пример 3: поймать исключение (скрипт не прервывается) + Finally
/*
function divide($divident, $divisor) {
    //Бросить исключение, если делитетль равен нулю
    if ($divisor == 0) {
        throw new Exception ("Деление на ноль.");
    }

    return $divident / $divisor;
}

try {
    echo divide (5, 0);
} catch (Exception  $e) {
    echo "Невозможно разделить!";
} finally {
    echo "<br>Процесс завершён.";
}
*/

//Пример 4: поймать исключение (скрипт не прервывается) + методы Exception
/*
function divide($divident, $divisor)
{
    //Бросить исключение, если делитетль равен нулю
    if ($divisor == 0) {
        throw new Exception("Деление на ноль.");
    }

    return $divident / $divisor;
}

try {
    echo divide(5, 0);
} catch (Exception $ex) {
    $code = $ex->getCode();
    $message = $ex->getMessage();
    $file = $ex->getFile();
    $line = $ex->getLine();
    echo "Исключение добавлено в $file в строке $line: [Код $code]
    $message";
}
*/

//Пример 5: Создание своего класса исключения и как обрабатывать несколько исключений
/*
class EmptyEmailException extends Exception {};
class InvalidEmailException extends Exception {};

//$email = 'myemail@test.ru';
//$email = '';
$email = 'myemail@test';

try {
    //Выбрасываем исключение если электронная почта пуста
    if ($email == '') {
        throw new EmptyEmailException("Пожалуйста, введите ваш E-mail адрес!");
    }

    //Выбрасываем исключение, если адрес электронной почты не действителен
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        throw new InvalidEmailException("$email - это невалидный E-mail адрес!");
    }

    //Отобразить сообщение, если адрес электронной почты действителен
    echo "SUCCESS: Email проверку прошел успешно";
} catch (EmptyEmailException $e) {
    echo $e->getMessage();
} catch (InvalidEmailException $e) {
    echo $e->getMessage();
}
*/

//Пример 6: Установка глобального обработчика исключений, если не сработал ни один catch или если бы весь код был завернут в try ... catch

function handleUncaughtException($e){
    // Отображение общего сообщения об ошибке для пользователя
    echo "Оппс! Что-то пошло не так. Повторите попытку или свяжитесь с нами, если проблема не исчезнет.";
    
    // Создадим строку ошибки
    $error = "Неперехваченное исключение: " . $message = date("Y-m-d H:i:s - ");
    $error .= $e->getMessage() . " в файле " . $e->getFile() . " на строке " . $e->getLine() . "\n";
    
    // Записать сведения об ошибке в файл
    //error_log($error, 3, "var/log/exceptionLog.log");
    error_log($error, 3, __DIR__ . "/exceptionLog.log");
}
 
// Зарегистрировать пользовательский обработчик исключений
set_exception_handler("handleUncaughtException");
 
// Бросить исключение
throw new Exception("Тестовое исключение!");
