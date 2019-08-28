<?php
    spl_autoload_register(function ($class) {
//        Pour la compatibilité UNIX
        $class = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($class));
        print_r(ROOT_PATH);
//        $file_name = $path . $class . '.class.php';
//        $file_name = HOME . 'application/model/' . $class . '.class.php';
        $file_name = ROOT_PATH . '/application/model/' . $class . 'class.php';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        print_r($file_name);
//        if (file_exists($file_name)) {
        if (is_file($file_name)) {
            require_once $file_name;
        }
    });
