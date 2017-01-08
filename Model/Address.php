<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Addressing\Model\Address as BaseAddress;

class Address extends BaseAddress implements AddressInterface
{
    /**
     * @var CustomerInterface
     */
    protected $customer;

    /**
     * {@inheritdoc}
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomer(CustomerInterface $customer = null)
    {
        $this->customer = $customer;
    }
}
