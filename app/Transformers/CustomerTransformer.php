<?php
namespace App\Transformers;

use App\Entities\Customer;

class CustomerTransformer
{
    public function transformCustomer(Customer $customer)
    {
        return [
            'full_name' => $customer->getFirstname() . ' ' . $customer->getLastname(),
            'email'     => $customer->getEmail(),
            'password'  => $customer->getPassword(),
            'gender'    => $customer->getGender(),
            'country'   => $customer->getCountry(),
            'city'      => $customer->getCity(),
            'phone'     => $customer->getPhone(),
        ];
    }

    public function transformCustomers($customers)
    {
        $results = [];
        
        foreach ($customers as $key => $customer) {
            $results[] = $customer->getCustomer();
        }

        return $results;
    }

}
