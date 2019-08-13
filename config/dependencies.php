<?php
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    $container['countryRepository'] = function ($c) {
        return new \Taxation\Repository\CountryRepository();
    };
};