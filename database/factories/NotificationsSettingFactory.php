<?php

use App\NotificationsSetting;
use App\User;
use Faker\Generator as Faker;

$factory->define(NotificationsSetting::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'invoice_approved' => true,
        'invoice_paid' => true,
        'invoice_denied' => true,
    ];
});
