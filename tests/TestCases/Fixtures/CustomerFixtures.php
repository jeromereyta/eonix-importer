<?php

use App\Entities\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CustomerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $customer = new Customer('Joseph', 'Sutton', 'joseph.sutton@example.com', 'drifter', 'male', 'Australia', 'Geraldton','06')
        
        $manager->persist($customer);
        $manager->flush();
    }
}
