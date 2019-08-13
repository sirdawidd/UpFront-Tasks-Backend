<?php declare(strict_types=1);

use Taxation\Console\CalculateTaxRate;

$console->add(new CalculateTaxRate($app->getContainer()));