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
     * @param string $locale
     * @param array|null $criteria The grid criteria ({ taxonCode: { type: 'equal', value: 'posts-07' } })
     *
     * @return QueryBuilder
     */
    public function createListQueryBuilder($locale, array $criteria = null)
    {
        $queryBuilder = $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->leftJoin('o.translations', 'translation')
            ->andWhere('translation.locale = :locale')
            ->setParameter('locale', $locale)
        ;

        if (array_key_exists('taxonCode', (array) $criteria)) {
            $queryBuilder->innerJoin('o.taxon', 'taxon');
        }

        if (array_key_exists('tagId', (array) $criteria)) {
            $queryBuilder->innerJoin('translation.tags', 'tag');
        }

        if (array_key_exists('flaggedTypeId', (array) $criteria)) {
            $queryBuilder->innerJoin('o.flaggeds', 'flagged');
            $queryBuilder->innerJoin('flagged.type', 'flaggedType');
        }

        if (array_key_exists('flagged', (array) $criteria)) {
            $queryBuilder->innerJoin('o.flaggeds', 'flagged');
            $queryBuilder->innerJoin('flagged.type', 'flaggedType');
        }

        return $queryBuilder;
    }
}
