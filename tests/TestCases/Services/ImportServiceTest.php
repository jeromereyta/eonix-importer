<?php

use App\Entities\Customer;
use App\Repositories\CustomerRepository;
use App\Services\ImportService;
use App\Services\RandomUserService;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class ImportServiceTest extends TestCase
{
    protected $entityManager;

    public function testCanImportCustomers()
    {
        // Create a stub for the SomeClass class.
        $importServiceStub = $this->createMock(ImportService::class);

        $data = [
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
                "email"    => "joseph.sutton123@example.com",
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
        ];

        $importServiceStub->method('generateCustomersFromDataProvider')
            ->willReturn($data);

        $entityManager = $this->createMock(EntityManagerInterface::class);

        $repo = $this->createMock(ObjectRepository::class);

        $repo->expects($this->once())->method('findBy')->willReturn([new Customer('Joseph', 'Sutton', 'joseph.sutton@example.com', 'drifter', 'male', 'Australia', 'Geraldton','06')]);
        
        $entityManager->expects($this->any())->method('getRepository')->willReturn($repo);

        $customerRepository = new CustomerRepository($entityManager);
        $dataProvider       = new RandomUserService;

        $importService = new ImportService($customerRepository, $dataProvider);

        $customers = $importServiceStub->generateCustomersFromDataProvider();

        $createdCustomers = $importService->importCustomers($customers);
    }

}
