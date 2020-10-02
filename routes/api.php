<?php

$router->group(['prefix' => '/'], function () use ($router) {
    $router->get('customers', ['uses' => 'CustomerController@index']);
    $router->get('customers/{id}', ['uses' => 'CustomerController@view']);
});
