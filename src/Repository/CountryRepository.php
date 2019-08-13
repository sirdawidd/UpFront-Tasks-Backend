<?php declare(strict_types=1);

namespace Taxation\Repository;

use Exception;
use Taxation\Entity\Country;

class CountryRepository
{
    /**
     * @throws Exception
     */
    public function getByName(string $name): Country
    {
        $data = json_decode(file_get_contents(__DIR__ . '/fixtures/Data.json', true), true);

        foreach ($data as $country) {
            if ($country['name'] === $name) {
                return new Country($country);
            }
        }

        throw new Exception(sprintf('Country %s was not found', $name));
    }
}