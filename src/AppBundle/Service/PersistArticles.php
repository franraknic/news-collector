<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;

class PersistArticles
{
    protected $articles;
    protected $em;

    /**
     * PersistArticles constructor.
     * @param $articles
     * @param EntityManager $em
     */
    public function __construct($articles, EntityManager $em)
    {
        $this->articles = $articles;
        $this->em = $em;
    }

    public function persistArticles()
    {
        foreach ($this->articles as $article) {
            $this->em->persist($article);
        }
        $this->em->flush();
    }
}