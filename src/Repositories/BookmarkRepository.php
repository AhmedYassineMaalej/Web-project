<?php

namespace App\Repositories;

use App\Entities\Bookmark;
use App\Repositories\Repository;
use PDO;

class BookmarkRepository extends Repository {
    protected static string $tableName = "Bookmark";

    /**
    * @return array<Bookmark>
    */

//    public static function getUserBookmarks(int $userID): array {
//        $bookmarks = self::select([
//            "UserID" => $userID,
//        ]);
//
//        return array_map(function ($row) {
//            return new Bookmark($row->UserID, $row->ProductID);
//        }, $bookmarks);
//    }
    public static function getUserBookmarks(int $userID): array
    {
        $sql = "
        SELECT 
            b.ID AS bookmark_id,
            b.UserID,
            b.ProductID,

            p.Name AS product_name,
            p.Image AS product_image,

            po.Price AS price

        FROM Bookmark b
        JOIN Product p ON b.ProductID = p.ID
        LEFT JOIN ProductOffer po ON po.ProductID = p.ID
        WHERE b.UserID = :userID
    ";

        $stmt = self::getConnection()->prepare($sql);
        $stmt->bindValue(':userID', $userID);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);

        return array_map(function ($row) {
            $quantity = 1; // no quantity column in DB

            return [
                'id' => $row->bookmark_id,
                'name' => $row->product_name,
                'image' => $row->product_image,
                'quantity' => $quantity,
                'price' => $row->price ?? 0,
                'total' => ($row->price ?? 0) * $quantity
            ];
        }, $rows);
    }


    public static function addUserBookmark(int $userID, int $productID): bool {
        return self::insert([
            "UserID" => $userID,
            "ProductID" => $productID,
        ]);
    }


}

