<?php
    spl_autoload_register(function ($class) {
//        Pour la compatibilité avec UNIX
        $class = str_replace('\\',DIRECTORY_SEPARATOR, $class);
        $file_name = $_SESSION['ROOT_PATH'] . 'application/model/' . $class . '.class.php';
        if (is_file($file_name)) {
            require_once $file_name;
        }
    });
