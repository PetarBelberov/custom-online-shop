<?php

// PSR-4 autoloading standard - consistent directory structure and namespace convention.
spl_autoload_register(function ($className) {
    $prefix = 'Models\\';
    $baseDir = __DIR__ . '/src/Models/';
    $len = strlen($prefix);
    // Handles class files within the specified Models namespace.
    if (strncmp($prefix, $className, $len) !== 0) {
        return;
    }

    $relativeClass = substr($className, $len);
    // Full file path for the class file.
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});