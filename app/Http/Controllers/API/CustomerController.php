<?php

namespace App\Http\Controllers\API;

use App\Entities\Customer;
use App\Http\Controllers\Controller;
use App\Services\ImportService;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;
use App\Transformers\CustomerTransformer;

class CustomerController extends Controller
{
    protected $importService;
    protected $entityManager;

    use PaginatesFromParams;

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

    public function index(Request $request)
    {
        $input = $request->all();

        $page  = (!empty($input['page']) && is_numeric($input['page'])) ? (int) $input['page'] : 1;
        $limit = (!empty($input['limit']) && is_numeric($input['limit'])) ? (int) $input['limit'] : 15;

        $builder = $this->entityManager->getRepository(Customer::class)->createQueryBuilder('o');
        $customers = $this->paginate($builder->getQuery(), $limit, $page,false);
        
        $results = $customers->toArray();

        $results['data'] = (new CustomerTransformer)->transformCustomers($customers->getIterator());

        return response()->json($results);
    }

    public function view($id)
    {
        $customer = $this->entityManager->getRepository(Customer::class)->findOneBy(['id' => $id]);

        if (empty($customer)) {
            return response()->json(['error' => 'Not found'], 404, ['X-Header-One' => 'Header Value']);
        }

        return response()->json(['data' => (new CustomerTransformer)->transformCustomer($customer)]);
    }

    public function importCustomers()
    {
        $customers = $this->importService->generateCustomersFromDataProvider();
        
        return $this->importService->importCustomers($customers);
    }

    private function createQueryBuilder(){}
}
