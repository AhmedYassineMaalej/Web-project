<?php

namespace App\Models;
use Exception;

class ProductInfoRepository extends Repository {
    private static string $tableName = "ProductInfo";

    public static function getByID(int $productID): array {
        self::select(["ProductID" => $productID]);
    }
}
