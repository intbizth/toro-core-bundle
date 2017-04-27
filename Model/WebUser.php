<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Customer\Model\CustomerInterface as BaseCustomerInterface;

class WebUser extends User implements WebUserInterface
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
    public function setCustomer(BaseCustomerInterface $customer = null)
    {
        if ($this->customer !== $customer) {
            $this->customer = $customer;
            $this->assignUser($customer);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->customer->getEmail();
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail($email)
    {
        $this->customer->setEmail($email);
    }

    /**
     * {@inheritdoc}
     */
    public function getEmailCanonical()
    {
        return $this->customer->getEmailCanonical();
    }

    /**
     * {@inheritdoc}
     */
    public function setEmailCanonical($emailCanonical)
    {
        $this->customer->setEmailCanonical($emailCanonical);
    }

    /**
     * @param CustomerInterface $customer
     */
    protected function assignUser(CustomerInterface $customer = null)
    {
        if (null !== $customer) {
            $customer->setUser($this);
        }
    }
}
