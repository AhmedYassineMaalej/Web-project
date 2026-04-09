<?php

namespace App\Models;
use Exception;

class ProductOfferRepository extends Repository {
    private static string $tableName = "ProductOffer";

    public static function getProductOffers(int $productID): array {
        $data = self::select(['ProductID' => $productID]);
        array_map(self::convertToProductOffer(...), $data);
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

}
