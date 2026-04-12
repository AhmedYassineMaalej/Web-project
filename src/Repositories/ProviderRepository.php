<?php

namespace App\Repositories;
use App\Entities\Provider;

use Exception;

class ProviderRepository extends Repository {
    protected static string $tableName = "Provider";

    public static function getByID(int $provider_id): Provider {
        $data = self::select(['ID' => $provider_id])[0];
        return self::convertToProvider($data);
    }

    private static function convertToProvider(object $data): Provider {
        return new Provider(
            $data->ID,
            $data->Name,
        );
    }
}
