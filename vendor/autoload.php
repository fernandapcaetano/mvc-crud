<?php

spl_autoload_register(function ($className) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $file = __DIR__ . '/../' . $path . '.php';
    if (file_exists($file)) {
        require $file;
    }
});