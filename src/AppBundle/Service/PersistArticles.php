<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class PersistArticles
{
    protected $em;

    /**
     * PersistArticles constructor.
     * @param $articles
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em =$em;
    }

    public function persistArticles($articles)
    {
        foreach ($articles as $article) {
            $this->em->persist($article);
        }
        try{
            $this->em->flush();
        }
        catch (UniqueConstraintViolationException $e){
            echo "duplicate article";
        }
    }
}