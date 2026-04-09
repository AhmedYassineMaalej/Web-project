<?php

namespace App\Models;
use Exception;

class CategoryRepository extends Repository {
    public static string $tableName = "ProductOffer";

    public static function getByID(int $categoryID): array {
        $data = self::select(['categoryID' => $categoryID]);
        return array_map(self::convertToCategory(...), $data);
    }

    private static function convertToCategory(object $data): Category {
        if (!$data) {
            throw new Exception("unable to convert data into ProductOffer");
        };

        return new Category(
            $data->ID,
            $data->Name,
        );
    }
}
