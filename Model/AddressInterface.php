<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Addressing\Model\AddressInterface as BaseAddressInterface;

interface AddressInterface extends BaseAddressInterface
{
    /**
     * @return CustomerInterface|null
     */
    public function getCustomer();

    /**
     * @param CustomerInterface|null $customer
     */
    public function setCustomer(CustomerInterface $customer = null);
}
