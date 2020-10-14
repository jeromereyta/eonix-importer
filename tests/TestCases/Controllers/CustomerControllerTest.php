<?php

class CustomerControllerTest extends TestCase
{

    public function testCanViewAllCustomers()
    {
        $this->get("customers", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                    'full_name',
                    'email',
                    'country',
                ],
            ],
        ]);
    }

    public function testCanViewAllCustomersWithPagination()
    {
        $this->get("customers?page=1&limit=10", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                    'full_name',
                    'email',
                    'country',
                ],
            ],
        ]);
    }


    public function testCanViewSpecificCustomer()
    {
        $this->get("customers/1", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => [
                'full_name',
                'email',
                'password',
                'gender',
                'country',
                'city',
                'phone',
            ],

        ]);
    }

    public function testCannotViewSpecificCustomer()
    {
        $this->get("customers/0", []);
        $this->seeStatusCode(404);
    }
}
