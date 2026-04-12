<?php

namespace App\Repositories;

use App\Entities\Bookmark;
use Exception;
/*
4 methods in total
getUserBookmarks : given a user id return an array of bookmark objects
addUserBookmark + removeUserBookmark : given user id and product id we insert or delete bookmark db from/into bookmark
isBookmarked : given user_id and product_id return a boolean
getBookmarkedProducts : given
*/

class BookmarkRepository extends Repository {
    protected static string $tableName = "Bookmark";

    /**
     * @return array<Bookmark>
     */
    public static function getUserBookmarks(int $userID): array {
        $bookmarks = self::select(["UserID" => $userID]);

        return array_map(function ($row) {
            return new Bookmark(
                $row->ID,
                $row->UserID,
                $row->ProductID,
                $row->CreatedAt,
                $row->UpdatedAt
            );
        }, $bookmarks);
    }

    public static function addUserBookmark(int $userID, int $productID): bool {
        $existing = self::select([
            "UserID" => $userID,
            "ProductID" => $productID
        ]);
        
        if (!empty($existing)) {
            return true; 
        }
        
        $result = self::insert([
            "UserID" => $userID,
            "ProductID" => $productID
        ]);
        
        if ($result) {
            RecommendationRepository::updateWeightsOnBookmark($userID, $productID, true);
        }
        
        return $result;
    }

    public static function removeUserBookmark(int $userID, int $productID): bool {
        try {
            $conn = self::getConnection();
            $stmt = $conn->prepare("DELETE FROM Bookmark WHERE UserID = ? AND ProductID = ?");
            $result = $stmt->execute([$userID, $productID]);
            
            if ($result) {
                RecommendationRepository::updateWeightsOnBookmark($userID, $productID, false);
            }
            
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function isBookmarked(int $userID, int $productID): bool {
        $existing = self::select([
            "UserID" => $userID,
            "ProductID" => $productID
        ]);
        return !empty($existing);
    }
}