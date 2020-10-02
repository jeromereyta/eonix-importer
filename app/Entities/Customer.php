<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="customers")
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $first_name;

    /**
     * @ORM\Column(type="string")
     */
    private $last_name;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     */
    private $gender;

    /**
     * @ORM\Column(type="string")
     */
    private $country;

    /**
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @ORM\Column(type="string")
     */
    private $phone;

    protected $customer;

    public function __construct($first_name, $last_name, $email, $password, $gender, $country, $city, $phone)
    {
        $this->first_name = $first_name;
        $this->last_name  = $last_name;
        $this->email      = $email;
        $this->password   = $password;
        $this->gender     = $gender;
        $this->country    = $country;
        $this->city       = $city;
        $this->phone      = $phone;
        $this->customer   = new ArrayCollection();
    }

    /**
     * Set id
     * @param integer $id
     * @return Test
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->first_name;
    }

    public function getLastname()
    {
        return $this->last_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getCustomerDetails()
    {
        return [
            'full_name' => $this->first_name . ' ' . $this->last_name,
            'email'     => $this->email,
            'password'  => $this->password,
            'gender'    => $this->gender,
            'country'   => $this->country,
            'city'      => $this->city,
            'phone'     => $this->phone,
        ];
    }

    public function getCustomer()
    {
        return [
            'full_name' => $this->first_name . ' ' . $this->last_name,
            'email'     => $this->email,
            'country'   => $this->country,
        ];
    }
}
