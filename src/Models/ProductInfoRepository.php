<?php

namespace App\Models;

class ProductInfoRepository extends Repository {
    public static string $tableName = "ProductInfo";

    public static function getByID(int $productID): array {
        $result = self::select(["ProductID" => $productID]);
        return array_map(function ($row) {
            return new ProductInfo(
                $row->ID,
                $row->ProductID,
                $row->Key,
                $row->Value,
            );
        }, $result);
    }
}
