<?php

if (!empty($_FILES)) {
    $message = '';
    $extensions = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
    $code = $_FILES['img']['error'];
    $uploads_dir = __DIR__ . '/uploads';
    $tmp_name = $_FILES["img"]["tmp_name"];
    $name = basename($_FILES["img"]["name"]);

    if ($_FILES['img']['size'] == 0) {

        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'index.php';
        header("Location: http://$host$uri/$extra");

    } elseif ($_FILES['img']['size'] > 31457280) {

        $message = "<div class=\"alert alert-warning\" role=\"alert\">";
        $message .= "Слишком большой файл";

    } elseif (!preg_match('#image/[a-z0-9]#', $_FILES['img']['type']) && ($extensions != 'jpeg' || $extensions != 'png' || $extensions != 'jpg')) {

        $message = "<div class=\"alert alert-warning\" role=\"alert\">";
        $message .= "Файл должен быть картинкой";

    } elseif (file_exists($uploads_dir . '/' . $name)) {

        $message = "<div class=\"alert alert-warning\" role=\"alert\">";
        $message .= "Такой файл уже существует.";
    
    } elseif ($code !== 0) {

        switch ($code) {
            case 1: //UPLOAD_ERR_INI_SIZE
                $message = "<div class=\"alert alert-danger\" role=\"alert\">";
                $message = "Размер принятого файла превысил максимально допустимый размер, который задан директивой upload_max_filesize конфигурационного файла php.ini.";
                break;
            case 2: //UPLOAD_ERR_FORM_SIZE
                $message = "<div class=\"alert alert-danger\" role=\"alert\">";
                $message = "Размер загружаемого файла превысил значение MAX_FILE_SIZE, указанное в HTML-форме.";
                break;
            case 3: //UPLOAD_ERR_PARTIAL
                $message = "<div class=\"alert alert-danger\" role=\"alert\">";
                $message = "Загружаемый файл был получен только частично.";
                break;
            case 4: //UPLOAD_ERR_NO_FILE
                $message = "<div class=\"alert alert-danger\" role=\"alert\">";
                $message = "Файл не был загружен.";
                break;
            case 6: //UPLOAD_ERR_NO_TMP_DIR
                $message = "<div class=\"alert alert-danger\" role=\"alert\">";
                $message = "Отсутствует временная папка.";
                break;
            case 7: //UPLOAD_ERR_CANT_WRITE
                $message = "<div class=\"alert alert-danger\" role=\"alert\">";
                $message = "Не удалось записать файл на диск";
                break;
            case 8: //UPLOAD_ERR_EXTENSION
                $message = "<div class=\"alert alert-danger\" role=\"alert\">";
                $message = "Модуль PHP остановил загрузку файла. PHP не предоставляет способа определить, какой модуль остановил загрузку файла; в этом может помочь просмотр списка загруженных модулей с помощью phpinfo().";
                break;
        }

    } elseif (is_uploaded_file($_FILES['img']['tmp_name'])) {

        if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {

            $message = "<div class=\"alert alert-primary\" role=\"alert\">";
            $message .= "Файл корректен и был успешно загружен.\n";

        } else {

            $message = "<div class=\"alert alert-danger\" role=\"alert\">";
            $message = "Возможная атака с помощью файловой загрузки!\n";

        }

    } else {

        $message = "<div class=\"alert alert-danger\" role=\"alert\">";
        $message = "Возможная атака с помощью файловой загрузки!\n";
        $message = "Файл '" . $_FILES['userfile']['tmp_name'] . "'.";

    }

    $message .= "</div>";
    echo $message;

}
