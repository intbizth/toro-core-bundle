<?php

namespace Toro\Bundle\CoreBundle\Processor;

use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Toro\Bundle\CoreBundle\Model\PostFlaggedInterface;
use Toro\Bundle\CoreBundle\Model\PostFlaggedTypeInterface;
use Toro\Bundle\CoreBundle\Model\PostInterface;

class FlaggedProcessor
{
    /**
     * @var RepositoryInterface
     */
    private $postRepository;

    /**
     * @var RepositoryInterface
     */
    private $flaggedTypeRepository;

    /**
     * @var RepositoryInterface
     */
    private $flaggedRepository;

    /**
     * @var FactoryInterface
     */
    private $flaggedFactory;

    public function __construct(
        RepositoryInterface $postRepository,
        RepositoryInterface $flaggedTypeRepository,
        RepositoryInterface $flaggedRepository,
        FactoryInterface $flaggedFactory
    )
    {
        $this->postRepository = $postRepository;
        $this->flaggedTypeRepository = $flaggedTypeRepository;
        $this->flaggedRepository = $flaggedRepository;
        $this->flaggedFactory = $flaggedFactory;
    }

    public function updater(PostInterface $post, array $flggedTypeIds = null)
    {
        $post->getFlaggeds()->clear();

        if (empty($flggedTypeIds)) {
            return;
        }

        /** @var PostFlaggedTypeInterface[] $flggedTypes */
        $flggedTypes = $this->flaggedTypeRepository->findBy(['id' => $flggedTypeIds]);

        /** @var PostFlaggedTypeInterface[] $olderFlaggeds */
        $olderFlaggeds = $post->getFlaggeds()->toArray();

        foreach ($flggedTypes as $flaggedType) {
            /** @var PostFlaggedInterface $flagged */
            $flagged = $this->flaggedFactory->createNew();
            $flagged->setType($flaggedType);

            $post->addFlagged($flagged);

            if ($flaggedType->isSingleActive()) {
                $flaggeds = $this->flaggedRepository->findBy(['type' => $flaggedType]);

                foreach ($flaggeds as $flagged) {
                    $post->removeFlagged($flagged);
                }

                continue;
            }
        }
    }
}
