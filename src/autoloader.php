<?php

namespace App;


function autoload(string $classpath) {
    $parts = explode("\\", $classpath);
    $classname = end($parts);
    $namespace_parts = array_slice($parts, 0, -1);

    $path = "";

    foreach ($namespace_parts as $part) {
        error_log($part);
        $path_part = match ($part) {
            "App" => "",
            "Controllers" => "/Controllers",
            "Helpers" => "/Helpers",
            "Models" => "/Models",
            "Auth" => "/Auth",
        };
        $path = $path . $path_part;
    }


    require __DIR__ . $path . '/' . $classname . ".php";
}


spl_autoload_register(__NAMESPACE__ . "\autoload");

?>


