<?php

namespace Toro\Bundle\CoreBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Toro\Bundle\CmsBundle\Form\Type\PostTranslationType;
use Toro\Bundle\CoreBundle\Form\Type\PostTagChoiceType;

final class PostTranslationTaggableTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tags', PostTagChoiceType::class, [
                'required' => false,
                'multiple' => true,
                'label' => 'Tags',
                'attr' => ['data-tags' => true],
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return PostTranslationType::class;
    }
}
