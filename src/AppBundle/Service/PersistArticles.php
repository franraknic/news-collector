<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class PersistArticles
{
    protected $em;

    /**
     * PersistArticles constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em =$em;
    }

    public function persistArticles($articles)
    {
        echo "Preparing articles.... \n";
        foreach ($articles as $article) {
            $this->em->persist($article);

        }
        try{
            echo "Saving articles.... \n";
            $this->em->flush();
        }
        catch (UniqueConstraintViolationException $e){
            echo "There are some duplicate articles.\n";
        }
    }
}