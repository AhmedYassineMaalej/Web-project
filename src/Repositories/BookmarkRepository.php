<?php

namespace App\Repositories;

use App\Entities\Bookmark;
use App\Repositories\Repository;

class BookmarkRepository extends Repository {
    protected static string $tableName = "Bookmark";

    /**
    * @return array<Bookmark>
    */

    public static function getUserBookmarks(int $userID): array {
        $bookmarks = self::select([
            "UserID" => $userID,
        ]);

        return array_map(function ($row) {
            return new Bookmark($row->UserID, $row->ProductID);
        }, $bookmarks);
    }


    public static function addUserBookmark(int $userID, int $productID): bool {
        return self::insert([
            "UserID" => $userID,
            "ProductID" => $productID,
        ]);
    }


}

