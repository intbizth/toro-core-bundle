<?php

namespace Toro\Bundle\CoreBundle\Validator\Initializer;

use Sylius\Component\User\Canonicalizer\CanonicalizerInterface;
use Symfony\Component\Validator\ObjectInitializerInterface;
use Toro\Bundle\CoreBundle\Model\CustomerInterface;

final class CustomerInitializer implements ObjectInitializerInterface
{
    /**
     * @var CanonicalizerInterface
     */
    private $canonicalizer;

    /**
     * @param CanonicalizerInterface $canonicalizer
     */
    public function __construct(CanonicalizerInterface $canonicalizer)
    {
        $this->canonicalizer = $canonicalizer;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize($object)
    {
        if ($object instanceof CustomerInterface) {
            $emailCanonical = $this->canonicalizer->canonicalize($object->getEmail());
            $object->setEmailCanonical($emailCanonical);
        }
    }
}
