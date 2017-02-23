<?php

namespace Toro\Bundle\CoreBundle\Doctrine\ORM;

use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Channel\Model\ChannelInterface;
use Toro\Bundle\CmsBundle\Doctrine\ORM\PostRepository as BasePostRepository;

class PostRepository extends BasePostRepository
{
    private function hasAlias(QueryBuilder $queryBuilder, $alias)
    {
        return in_array($alias, $queryBuilder->getAllAliases());
    }

    /**
     * {@inheritdoc}
     */
    public function createQueryBuilderByChannelAndTaxonSlug(ChannelInterface $channel, $locale, $taxonSlug)
    {
        return $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->leftJoin('o.translations', 'translation')
            ->innerJoin('o.taxon', 'tx')
            ->leftJoin('tx.translations', 'taxonTranslation')
            ->andWhere('translation.locale = :locale')
            ->andWhere('taxonTranslation.locale = :locale')
            ->andWhere('taxonTranslation.slug = :taxonSlug')
            ->andWhere('o.channel = :channel')
            ->andWhere('o.published = true')
            ->setParameter('locale', $locale)
            ->setParameter('taxonSlug', $taxonSlug)
            ->setParameter('channel', $channel)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function createListQueryBuilder($locale, array $criteria = null)
    {
        $queryBuilder = $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->leftJoin('o.translations', 'translation')
            ->andWhere('translation.locale = :locale')
            ->setParameter('locale', $locale)
        ;

        if (array_key_exists('tagId', (array) $criteria)) {
            $queryBuilder->innerJoin('translation.tags', 'tag');
            unset($criteria['tagId']);
        }

        if (array_key_exists('flaggedTypeId', (array) $criteria)) {
            $queryBuilder->innerJoin('o.flaggeds', 'flagged');
            $queryBuilder->innerJoin('flagged.type', 'flaggedType');
            unset($criteria['flaggedTypeId']);
        }

        if (array_key_exists('flagged', (array) $criteria)) {
            $queryBuilder->innerJoin('o.flaggeds', 'flagged');
            $queryBuilder->innerJoin('flagged.type', 'flaggedType');
            unset($criteria['flagged']);
        }

        if (array_key_exists('taxonId', (array) $criteria)) {
            $criteria['taxon'] = $criteria['taxonId'];
            unset($criteria['taxonId']);
        }

        $this->applyCriteria($queryBuilder, (array) $criteria);

        return $queryBuilder;
    }
}
