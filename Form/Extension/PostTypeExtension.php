<?php

namespace Toro\Bundle\CoreBundle\Form\Extension;

use Sylius\Bundle\TaxonomyBundle\Form\Type\TaxonChoiceType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Toro\Bundle\CmsBundle\Form\Type\PostType;

final class PostTypeExtension extends AbstractTypeExtension
{
    /**
     * @var string
     */
    private $taxonRoot;

    public function __construct($taxonRoot)
    {
        $this->taxonRoot = $taxonRoot;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('taxon', TaxonChoiceType::class, [
                'required' => true,
                'label' => 'Taxon',
                'placeholder' => '',
                'root' => $this->taxonRoot
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return PostType::class;
    }
}
