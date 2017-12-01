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
    public function getCustomer(): BaseCustomerInterface
    {
        return $this->customer;
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomer(BaseCustomerInterface $customer = null): void
    {
        if ($this->customer !== $customer) {
            $this->customer = $customer;
            $this->assignUser($customer);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail(): ?string
    {
        return $this->customer->getEmail();
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail(?string $email): void
    {
        $this->customer->setEmail($email);
    }

    /**
     * {@inheritdoc}
     */
    public function getEmailCanonical(): ?string
    {
        return $this->customer->getEmailCanonical();
    }

    /**
     * {@inheritdoc}
     */
    public function setEmailCanonical(?string $emailCanonical): void
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
