<?php

namespace App\Interfaces;

interface DataProvider
{
    public function fetchDataFromDataProvider();
    public function formatCustomersData(array $customers);
}