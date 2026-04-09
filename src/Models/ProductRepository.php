<?php

namespace App\Models;
use Exception;
use PDO;

class ProductRepository extends Repository {
    public static string $tableName = "Product";

    /*
    the three methods below, all they do is return one of the three objects whose classes are inside Product.php, ProductInfo.php and ProductOffer.php
    Example of $data = (object)['ID' => 1, 'Reference' => 'aa', etc];
    */


    private static function convertToProductInfo(object $data): ProductInfo {
            return new ProductInfo(
            $data->ID,
            $data->ProductID,
            $data->Key,
            $data->Value
        );
    }

    public static function getProductById(int $id): ?Product {
        $result = $this->findById($id);
        return new Product(
            $result->ID,
            $result->Name,
            $result->Reference,
            $result->Description,
            $result->Image,
            $result->Category,
            $result->Info,
        );
    }

    //expect as return type an array of Product objects (Read Product.php)
    public function getAllProducts() {
        $results = $this->findAll();
        return array_map([$this, 'convertToProduct'], $results);
    }

    /* TODO: move to ProductInfoRepository */
    public static function getProductInfo($productId) {
        try {
            $conn = self::getConnection();
            $stmt = $conn->prepare("SELECT * FROM ProductInfo WHERE ProductID = ?");
            $stmt->execute([$productId]);
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            return array_map([$this, 'convertToProductInfo'], $results);
        } catch (Exception $e) {
            return [];
        }
    }


    public static function getProductsWithMostOffers(int $limit = 6) {
        try {
            $conn = self::getConnection();
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
            
            $products = [];
            foreach ($results as $row) {
                $categoryID = $row->CategoryID;
                $category = CategoryRepository::getByID($categoryID);

                $products[] = [
                    'product' => new Product(
                        $row->ID,
                        $row->Name,
                        $row->Reference,
                        $row->Description,
                        $row->Image,
                        $category,
                        $row->Info,
                    ),
                    'offer_count' => $row->offer_count,
                    'min_price' => $row->min_price
                ];
            }
            return $products;
        } catch (Exception $e) {
            return [];
        }
    }

    public static function getTopOffers(int $limit = 6) {
        try {
            $conn = self::getConnection();
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

            $products = [];
            foreach ($results as $row) {
                $categoryID = $row->CategoryID;
                $category = CategoryRepository::getByID($categoryID);

                $products[] = [
                    'product' => new Product(
                        $row->ID,
                        $row->Name,
                        $row->Reference,
                        $row->Description,
                        $row->Image,
                        $category,
                        $row->Info,
                    ),
                    'min_price' => $row->min_price,
                    'offer_count' => $row->offer_count
                ];
            }
            return $products;
        } catch (Exception $e) {
            return [];
        }
    }


    public function getMostInfoProducts($limit = 6) {
        try {
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

            $products = [];
            foreach ($results as $row) {
                $products[] = [
                    'product' => new Product(
                        $row->ID,
                        $row->Name,
                        $row->Reference,
                        $row->Description,
                        $row->Image,
                        $row->Category,
                        $row->Info,
                    ),
                    'info_count' => $row->info_count
                ];
            }
            return $products;
        } catch (Exception $e) {
            return [];
        }
    }


    public function getNewestProducts($limit = 6) {
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
                $category = CategoryRepository::getByID($result->CategoryID);
                $info = ProductInfoRepository::getByID($result->ID);

                return new Product(
                    $result->ID,
                    $result->Name,
                    $result->Reference,
                    $result->Description,
                    $result->Image,
                    $category,
                    $info,
                );

            }, $results);
        } catch (Exception $e) {
            return [];
        }
    }


    public function getDealOfTheDay() {
        try {
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
                $row->Description ?? 'Product',
                $row->Image ?? '/images/placeholder.png',
                $row->min_price ?? 0
            ];
        } catch (Exception $e) {
            return null;
        }
    }

    public function getMinPriceForProduct(int $productId) {
        try {
            $conn = self::getConnection();
            $stmt = $conn->prepare("
                SELECT MIN(Price) as min_price
                FROM ProductOffer
                WHERE ProductID = ?
            ");
            $stmt->execute([$productId]);
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            return $result->min_price ? (float)$result->min_price : null;
        } catch (Exception $e) {
            return null;
        }
    }
}
