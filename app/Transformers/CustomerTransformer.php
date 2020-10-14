<?php
namespace App\Transformers;

use App\Entities\Customer;

class CustomerTransformer
{
    public function transformCustomer(Customer $customer)
    {
        return [
            'full_name' => $this->getFirstname() . ' ' . $this->getLastname(),
            'email'     => $this->getEmail(),
            'password'  => $this->getPassword(),
            'gender'    => $this->getGender(),
            'country'   => $this->getCountry(),
            'city'      => $this->getCity(),
            'phone'     => $this->getPhone(),
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
