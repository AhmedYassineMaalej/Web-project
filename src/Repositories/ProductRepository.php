<?php

namespace App\Repositories;
use App\Entities\Product;
use App\Entities\ProductInfo;
use App\Entities\ProductOffer;
use App\Repositories\ProductOfferRepository;

use Exception;
use PDO;

class ProductRepository extends Repository {
    protected static string $tableName = "Product";

    /*
    the three methods below, all they do is return one of the three objects whose classes are inside Product.php, ProductInfo.php and ProductOffer.php
    Example of $data = (object)['ID' => 1, 'Reference' => 'aa', etc];
    */

    private static function convertToProduct($data): ?Product {
        if (!$data) return null;
        
        
        return new Product(
            $data->ID,
            $data->Reference,
            $data->Description ?? $data->Name,
            $data->Image,
            $data->CategoryID
        );
    }

    private static function convertToProductInfo(object $data): ProductInfo {
        return new ProductInfo(
            $data->ID,
            $data->ProductID,
            $data->Key,
            $data->Value
        );
    }

    public static function getProductById(int $id): ?Product {
        $result = self::findById($id); 
        if (!$result) return null;
        
        return self::convertToProduct($result);
    }

    public static function getAllProducts() {
        $results = self::findAll();
        return array_map([self::class, 'convertToProduct'], $results); // Changed $this to self::class
    }


    public static function getProductInfo(int $productId) {
        try {
            $conn = self::getConnection();
            $stmt = $conn->prepare("SELECT * FROM ProductInfo WHERE ProductID = ?");
            $stmt->execute([$productId]);
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            return array_map([self::class, 'convertToProductInfo'], $results); // Changed $this to self::class
        } catch (Exception $e) {
            return [];
        }
    }

    public static function getProductsWithMostOffers(int $limit = 6) {
        $conn = self::getConnection();
        $limit = (int)$limit;
        $stmt = $conn->prepare("
            SELECT p.*, COUNT(po.ID) as offer_count, MIN(po.Price) as min_price
            FROM Product p
            INNER JOIN ProductOffer po ON p.ID = po.ProductID
            GROUP BY p.ID
            ORDER BY offer_count DESC
            LIMIT $limit
        ");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        return array_map(function ($row) {
            return self::convertToProduct($row);
        }, $results);
    }

    public static function getTopOffers(int $limit = 6) {
        $conn = self::getConnection();
        $limit = (int)$limit;
        $stmt = $conn->prepare("
            SELECT p.*, MIN(po.Price) as min_price, COUNT(po.ID) as offer_count
            FROM Product p
            INNER JOIN ProductOffer po ON p.ID = po.ProductID
            GROUP BY p.ID
            ORDER BY min_price ASC
            LIMIT $limit
        ");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        return array_map(function ($row) {
            return self::convertToProduct($row);
        }, $results);
    }

    public static function getMostInfoProducts($limit = 6) {
        $limit = (int)$limit;
        $conn = self::getConnection();
        $stmt = $conn->prepare("
            SELECT p.*, COUNT(pi.ID) as info_count
            FROM Product p
            INNER JOIN ProductInfo pi ON p.ID = pi.ProductID
            GROUP BY p.ID
            ORDER BY info_count DESC
            LIMIT $limit
        ");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        return array_map(function ($row) {
            return self::convertToProduct($row);
        }, $results);
    }

    public static function getNewestProducts($limit = 6) {
        try {
            $limit = (int)$limit;
            $conn = self::getConnection();
            $stmt = $conn->prepare("
                SELECT * FROM Product 
                ORDER BY ID DESC 
                LIMIT $limit
            ");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            return array_map(function ($result) {
                return self::convertToProduct($result);
            }, $results);
        } catch (Exception $e) {
            return [];
        }
    }

    public static function getDealOfTheDay() {
        $conn = self::getConnection();
        $stmt = $conn->prepare("
            SELECT p.*, MIN(po.Price) as min_price
            FROM Product p
            INNER JOIN ProductOffer po ON p.ID = po.ProductID
            GROUP BY p.ID
            ORDER BY RAND()
            LIMIT 1
        ");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$row) return null;

        return [
            $row->Reference ?? '',
            $row->Description ?? $row->Name ?? 'Product',
            $row->Image ?? '/images/placeholder.png',
            $row->min_price ?? 0
        ];
    }

    public static function getMinPriceForProduct(int $productId): ?float {
        $conn = self::getConnection();
        $stmt = $conn->prepare("
            SELECT MIN(Price) as min_price
            FROM ProductOffer
            WHERE ProductID = ?
        ");
        $stmt->execute([$productId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result->min_price ? (float)$result->min_price : null;
    }
    public static function getCompleteProduct($id) {
        $product = self::getProductById($id);
        if (!$product) return false;
        
        return (object)[
            'product' => $product,
            'info' => self::getProductInfo($id),
            'offers' => ProductOfferRepository::getProductOffers($id)
        ];
    }
}