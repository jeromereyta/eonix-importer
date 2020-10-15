<?php

use App\Services\RandomUserService;

class RandomUserServiceTest extends TestCase
{

    public function testCanFetchDataFromRandomUsers()
    {

        $randomUserStub = $this->createMock(RandomUserService::class);

        $randomUserStub->method('fetchDataFromDataProvider')
            ->willReturn([
                [
                    "gender"   => "male",
                    "name"     => [
                        "title" => "Mr",
                        "first" => "Joseph",
                        "last"  => "Sutton",
                    ],
                    "location" => [
                        "street"      => [
                            "number" => 3165,
                            "name"   => "Green Rd",
                        ],
                        "city"        => "Geraldton",
                        "state"       => "Queensland",
                        "country"     => "Australia",
                        "postcode"    => 7739,
                        "coordinates" => [
                            "latitude"  => "45.2973",
                            "longitude" => "148.4794",
                        ],
                        "timezone"    => [
                            "offset"      => "+4:00",
                            "description" => "Abu Dhabi, Muscat, Baku, Tbilisi",
                        ],
                    ],
                    "email"    => "joseph.sutton@example.com",
                    "login"    => [
                        "uuid"     => "1cfc0828-87d5-49a6-8044-cc791844ebbc",
                        "username" => "tinytiger577",
                        "password" => "drifter",
                        "salt"     => "k0jq3XY3",
                        "md5"      => "1f48a578c28bedef1f500678ff99f176",
                        "sha1"     => "d11a68cb22c6a7de3bed11bde140abfb9a74e977",
                        "sha256"   => "7f5b090d9ed454987aeb3aecdd21c3312a999af310a5eaef53810bd99cbd4df8",
                    ],
                    "phone"    => "07-2670-8237",
                    "nat"      => "AU",
                ],
            ]);

        $customers = $randomUserStub->fetchDataFromDataProvider();

        $randomUserService = new RandomUserService;

        $customers = $randomUserService->formatCustomersData($customers);
        
        $requiredFields = ['first_name', 'last_name', 'email', 'password', 'gender', 'country', 'city', 'phone'];

        foreach ($requiredFields as $key => $fields) {

            foreach ($customers as $subKey => $customer) {

                $this->assertArrayHasKey($fields, $customer);
            }
        }
    }

}
