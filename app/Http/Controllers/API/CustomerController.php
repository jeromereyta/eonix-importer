<?php

namespace App\Http\Controllers\API;

use App\Entities\Customer;
use App\Http\Controllers\Controller;
use App\Services\ImportService;
use Doctrine\ORM\EntityManagerInterface;

class CustomerController extends Controller
{
    protected $importService;
    protected $entityManager;

    /**
     * Customer Controller constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     * @param App\Services\RandomUserService $dataProvider
     */

    public function __construct(EntityManagerInterface $entityManager, ImportService $importService)
    {
        $this->importService = $importService;
        $this->entityManager = $entityManager;
    }

    public function index()
    {
        $customers = $this->entityManager->getRepository(Customer::class)->findAll();

        $results = [
            'data' => [],
        ];

        foreach ($customers as $key => $customer) {
            $results['data'][] = $customer->getCustomer();
        }

        return response()->json($results);
    }

    public function view($id)
    {
        $customer = $this->entityManager->getRepository(Customer::class)->findOneBy(['id' => $id]);

        if (empty($customer)) {
            return response()->json(['error' => 'Not found'], 404, ['X-Header-One' => 'Header Value']);
        }

        return response()->json(['data' => $customer->getCustomerDetails()]);
    }

    public function importCustomers()
    {
        return $this->importService->importCustomers();
    }

}
