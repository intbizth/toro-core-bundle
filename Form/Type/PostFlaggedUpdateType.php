<?php

namespace Toro\Bundle\CoreBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Toro\Bundle\CoreBundle\Processor\FlaggedProcessor;

class PostFlaggedUpdateType extends AbstractResourceType
{
    /**
     * @var FlaggedProcessor
     */
    private $flaggedProcessor;

    /**
     * @param FlaggedProcessor $flaggedProcessor
     */
    public function setFlaggedProcessor(FlaggedProcessor $flaggedProcessor)
    {
        $this->flaggedProcessor = $flaggedProcessor;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('flaggedTypes', PostFlaggedTypeChoiceType::class, [
                'mapped' => false,
                'expanded' => true,
                'multiple' => true,
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $this->flaggedProcessor->updater(
                    $event->getForm()->getData(), @$event->getData()['flaggedTypes']
                );
            })
        ;
    }
}
