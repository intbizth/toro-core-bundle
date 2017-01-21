<?php

namespace Toro\Bundle\CoreBundle\Form\Extension;

use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Toro\Bundle\CmsBundle\Form\Type\PostType;
use Toro\Bundle\CoreBundle\Form\Type\PostImageCollectionType;
use Toro\Bundle\MediaBundle\Form\EventListener\AddImageCollectionSubscriber;
use Toro\Bundle\MediaBundle\Form\ImageCollectionConfigureResolverInterface;

final class PostImageCollectionTypeExtension extends AbstractTypeExtension
{
    /**
     * @var ImageCollectionConfigureResolverInterface
     */
    private $resolver;

    /**
     * @var FactoryInterface
     */
    private $factory;

    public function __construct(FactoryInterface $factory, ImageCollectionConfigureResolverInterface $resolver)
    {
        $this->factory = $factory;
        $this->resolver = $resolver;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageCollections', CollectionType::class, [
                'entry_type' => PostImageCollectionType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'delete_empty' => true,
                'label' => 'Images',
            ])
            ->addEventSubscriber(new AddImageCollectionSubscriber($this->factory, $this->resolver))
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
