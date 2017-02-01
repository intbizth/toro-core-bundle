<?php

namespace Toro\Bundle\CoreBundle\Doctrine\ORM;

use Toro\Bundle\TaggingBundle\Doctrine\ORM\TagRepository;

class PostTagRepository extends TagRepository
{
    /**
     * @param array $criteria
     * @param array $sorting
     *
     * @return \Pagerfanta\Pagerfanta
     */
    public function createPublicPaginator(array $criteria = null, array $sorting = null)
    {
        $queryBuilder = $this->createQueryBuilder('o');

        $queryBuilder
            ->addSelect('COUNT(o.id) AS HIDDEN taggedCount')
            ->groupBy('o.id')
            ->innerJoin('o.tagables', 'tagable')
            ->addOrderBy('taggedCount', 'DESC');

        $this->applyCriteria($queryBuilder, (array)$criteria);
        $this->applySorting($queryBuilder, (array)$sorting);

        return $this->getPaginator($queryBuilder);
    }
}
