<?php

namespace App\Services;

use App\Interfaces\DataProvider;

class RandomUserService implements DataProvider
{

    public function formatCustomersData(array $customers)
    {
        $results = [];

        foreach ($customers as $key => $customer) {
            
            $results[] = [
                'first_name' => $customer['name']['first'],
                'last_name'  => $customer['name']['last'],
                'email'      => $customer['email'],
                'password'   => $customer['login']['md5'],
                'gender'     => $customer['gender'],
                'country'    => $customer['location']['country'],
                'city'       => $customer['location']['city'],
                'phone'      => $customer['phone'],
            ];
        }

        return $results;
    }

    public function fetchDataFromDataProvider()
    {
        $client = new \GuzzleHttp\Client();

        $customers = [];

        $response = $client->request('GET', 'https://randomuser.me/api/?inc=gender,name,nat,login,phone,email,location&nat=au&results=100');

        if ($response->getStatusCode() == 200) {

            $customers = json_decode($response->getBody(), true)['results'];

            $customers = $this->formatCustomersData($customers);
        }

        return $customers;
    }
}
