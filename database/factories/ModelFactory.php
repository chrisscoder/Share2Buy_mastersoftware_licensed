<?php

use Faker\Generator as Faker;

use App\Models\Designer;
use App\Models\DynamicPage;
use App\Models\FeaturedProduct;
use App\Models\Product;
use App\Models\User;

$factory->define(Designer::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'intro' => $faker->paragraph(),
        'body' => $faker->paragraphs(3, true),
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'intro' => $faker->name,
        'body' => $faker->paragraphs(3, true),
        'start_date' => \Carbon\Carbon::tomorrow(),
        'end_date' => \Carbon\Carbon::tomorrow()->addWeek(2),
        'price' => 300,
        'periode' => 14,
        'online' => 1,
        'materials' => 'wood',
        'category' => 'home',
        'type_value' => 'other',

    ];
});

$factory->define(DynamicPage::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'intro' => $faker->paragraph,
        'body' => $faker->paragraphs(3, true),
    ];
});

$factory->define(FeaturedProduct::class, function (Faker $faker) {
    return [
        'product_id' => 1,
        'priority' => array_rand(['0','10', '15']),
    ];
});

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'designer_id' => 0,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});
