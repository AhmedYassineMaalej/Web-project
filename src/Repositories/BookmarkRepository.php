<?php

namespace App\Repositories;

use App\Entities\Bookmark;

class BookmarkRepository extends Repository
{
    protected static string $tableName = 'Bookmark';

    /**
     * @return array<Bookmark>
     */
    public static function getUserBookmarks(int $userID): array
    {
        $bookmarks = self::select([
            'UserID' => $userID,
        ]);

        return array_map(function ($row) {
            return new Bookmark($row->UserID, $row->ProductID);
        }, $bookmarks);
    }

    public static function addUserBookmark(int $userID, int $productID): bool
    {
        return self::insert([
            'UserID' => $userID,
            'ProductID' => $productID,
        ]);
    }

    public static function removeUserBookmark(int $userID, int $productID): void
    {
        self::delete([
            'UserID' => $userID,
            'ProductID' => $productID,
        ]);
    }


    public static function isProductBookmarked(int $userID, int $productID): bool
    {
        $rows = self::select([
            'UserID' => $userID,
            'ProductID' => $productID,
        ]);

        return count($rows) > 0;
    }
}
