<?php

namespace App\Repositories;
use App\Entities\ProductOffer;

use Exception;

class ProductOfferRepository extends Repository {
    protected static string $tableName = "ProductOffer";

    public static function getProductOffers(int $productID): array {
        $data = self::select(['ProductID' => $productID]);
        return array_map(self::convertToProductOffer(...), $data);
    }

    private static function convertToProductOffer(object $data): ProductOffer {
        if (!$data) {
            throw new Exception("unable to convert data into ProductOffer");
        };

        return new ProductOffer(
            $data->ID,
            $data->ProductID,
            $data->Link,
            $data->Price,
            $data->ProviderID
        );
    }
    public static function getProductOfferById(int $id): ?ProductOffer {
        $data = self::findById($id);
        if (!$data) return null;
        return self::convertToProductOffer($data);
    }

}
