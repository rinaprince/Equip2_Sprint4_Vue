<?php

namespace App\Entity;

use App\Repository\PrivateCustomerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrivateCustomerRepository::class)]
class PrivateCustomer extends Customer
{

    public function getType(): string
    {
        return "private";
    }
}
