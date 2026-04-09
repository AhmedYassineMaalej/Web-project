<?php

namespace App\Repositories;
use App\Entities\Category;

use Exception;

class CategoryRepository extends Repository {
    protected static string $tableName = "Category";

    public static function getByID(int $categoryID): Category {
        $data = self::select(['ID' => $categoryID])[0];
        return self::convertToCategory($data);
    }

    private static function convertToCategory(object $data): Category {
        return new Category(
            $data->ID,
            $data->Name,
        );
    }
}
