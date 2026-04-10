<?php 

namespace App\Helpers;

use Exception;

class Env {
    private static string $envPath = __DIR__ . '/../../.env';
    private static string $envRegex = "/^\s*([a-zA-Z_][a-zA-Z0-9_]*)=(.*)$/";


    private static function extract_key_value(string $line): ?array {
        $matches = [];
        if (!preg_match(self::$envRegex, $line, $matches)) {
            return null;
        }

        return [
            'key' => $matches[1],
            'value' => $matches[2],
        ];
    }

    public static function load_variables(): void {
        if (!file_exists(self::$envPath)) {
            throw new Exception(".env file not found in the project's root directory");
        }

        $lines = file(self::$envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $matches = self::extract_key_value($line);
            if ($matches == null) {
                continue;
            }

            $key = $matches["key"];
            $value = $matches["value"];

            $_ENV[$key] = $value;
        }
    }

}

