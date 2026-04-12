<?php

namespace App\Controllers;

use App\Repositories\ProductRepository;
use App\Helpers\JWT;

class HomeController {
    public static function index(): void {
        $is_logged = JWT::isLoggedIn();
        $username = $_SESSION['username'] ?? '';

        /* // Get products with most offers (best deals) - keep as objects */
        /* $bestDealsData = ProductRepository::getProductsWithMostOffers(6); */
        /**/
        /* $bestDeals = []; */
        /* foreach ($bestDealsData as $item) { */
        /*     $bestDeals[] = $item['product']; // Pass the actual product object */
        /* } */
        /**/
        /* // Get top offers (expiring deals) */
        /* $expiringDealsData = ProductRepository::getTopOffers(6); */
        /* $expiringDeals = []; */
        /* foreach ($expiringDealsData as $item) { */
        /*     $expiringDeals[] = $item['product']; // Pass the actual product object */
        /* } */
        /**/
        /* // Get newest products */
        /* $newestDeals = ProductRepository::getNewestProducts(6); // Already returns product objects */
        /**/
        /**/
        /* // Get deal of the day */
        /* $dealOfTheDayData = ProductRepository::getDealOfTheDay(); */
        /* $dealOfTheDay = $dealOfTheDayData ? [ */
        /*     $dealOfTheDayData[0], */
        /*     $dealOfTheDayData[1], */
        /*     $dealOfTheDayData[2] */
        /* ] : null; */
        /**/
        require __DIR__ . '/../../views/pages/home.php';
    }
}
