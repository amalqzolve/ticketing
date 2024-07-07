<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Userinfo;
use Faker\Generator as Faker;

$factory->define(Userinfo::class, function (Faker $faker) {
    return [
       // 'cust_type' => $faker->type,
       'cust_name' => $faker->name,
       // 'cust_add1' => $faker->address,
       // 'cust_add2' => $faker->address,
       // 'cust_country' => $faker->country,
       // 'cust_city'    => $faker->city,
       // 'cust_region'  => $faker->region,
       // 'cust_zip'     => $faker->zip,
       // 'cust_email'   => $faker->email,
       // 'cust_officephone' => $faker->phonenumber,
       // 'cust_mobile'  => $faker->phonenumber,
       // 'cust_fax'     => $faker->fax,
       // 'cust_website' => $faker->website,

    ];
});
