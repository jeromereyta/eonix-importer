<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use App\Services\RandomUserService;

class ImportService
{
    private $customerRepository;
    private $dataProvider;

    public function __construct(CustomerRepository $customerRepository, RandomUserService $dataProvider)
    {
        $this->customerRepository = $customerRepository;
        $this->dataProvider       = $dataProvider;
    }

    public function importCustomers()
    {
        $customers = $this->dataProvider->fetchDataFromDataProvider();
    
        return $this->customerRepository->importCustomersData($customers);
    }
}
