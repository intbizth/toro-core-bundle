<?php

namespace Toro\Bundle\CoreBundle\Form\Extension;

use Sylius\Bundle\TaxonomyBundle\Form\Type\TaxonChoiceType;
use Sylius\Component\Taxonomy\Model\TaxonInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class TaxonChoiceTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'choice_attr' => function(TaxonInterface $taxon) {
                    return [
                        // data option using for selectize
                        'data-data' => json_encode([
                            'code' => $taxon->getCode(),
                            'name' => $taxon->getName(),
                            'slug' => $taxon->getSlug(),
                            'path_name' => $taxon->getPathName(),
                        ])
                    ];
                },
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return TaxonChoiceType::class;
    }
}
