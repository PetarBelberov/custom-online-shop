<?php

// PSR-4 autoloading standard - consistent directory structure and namespace convention.
spl_autoload_register(function ($className) {
    $prefixes = [
        'Models\\' => __DIR__ . '/src/Models/',
        'Controllers\\' => __DIR__ . '/src/Controllers/',
        'Helpers\\' => __DIR__ . '/src/helpers/'
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $className, $len) !== 0) {
            continue;
        }

        $relativeClass = substr($className, $len);
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});