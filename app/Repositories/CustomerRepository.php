<?php

namespace App\Repositories;

use App\Entities\Customer;
use Doctrine\ORM\EntityManagerInterface;

class CustomerRepository
{

    protected $entityManager;

    /**
     * Customer Controller constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     * @param App\Services\RandomUserService $dataProvider
     */

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function importCustomersData(array $customers)
    {
        $updateCustomers = [];
        $createCustomers = [];
        $batchSize       = 20;
        $counter         = 0;

        $existingCustomers = $this->getCustomersEmailsThatAlreadyExist(array_column($customers, 'email'));

        foreach ($customers as $key => $customer) {

            if (in_array($customer['email'], $existingCustomers)) {
                $updateCustomers[] = $customer;
            } else {
                $createCustomers[] = $customer;
            }
        }
        
        foreach ($createCustomers as $key => $newCustomer) {

            $newData = new Customer(
                $newCustomer['first_name'],
                $newCustomer['last_name'],
                $newCustomer['email'],
                $newCustomer['password'],
                $newCustomer['gender'],
                $newCustomer['country'],
                $newCustomer['city'],
                $newCustomer['phone']
            );

            $this->entityManager->persist($newData);

            $counter++;

            if ($counter == $batchSize) {
                $counter = 0;
                $this->entityManager->flush();
                $this->entityManager->clear();
            }
        }

        $this->entityManager->flush();
        $this->entityManager->clear();

        if (!empty($updateCustomers)) {

            foreach ($updateCustomers as $key => $updateCustomer) {

                $customer = $this->entityManager->getRepository(Customer::class)->findBy(['email' => $updateCustomer['email']]);

                $updateCustomerEntity = new Customer(
                    $updateCustomer['first_name'],
                    $updateCustomer['last_name'],
                    $updateCustomer['email'],
                    $updateCustomer['password'],
                    $updateCustomer['gender'],
                    $updateCustomer['country'],
                    $updateCustomer['city'],
                    $updateCustomer['phone']
                );

                $updateCustomerEntity->setId($customer->getId());

                $this->entityManager->merge($updateCustomerEntity);

                $this->entityManager->flush();

                $this->entityManager->clear();
            }
        }
    }

    public function getCustomersEmailsThatAlreadyExist(array $emails = [])
    {
        $results = [];

        if (!empty($emails)) {

            $existingCustomers = $this->entityManager->getRepository(Customer::class)->findBy([
                'email' => $emails,
            ]);

            foreach ($existingCustomers as $key => $customer) {
                $results[] = $customer->getEmail();
            }
        }

        return $results;
    }

}
