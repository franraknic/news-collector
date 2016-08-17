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
        $this->em = $em;
    }

    public function persistArticles($articles)
    {
        echo "Preparing articles.... \n";
        foreach ($articles as $article) {
            $stored = $this->em->getRepository('AppBundle:Article')->findOneBy(array('link' => $article->getLink()));
            $n=0;
            if ($stored == null) {
                echo "Persisting...".$article->getLink();
                $n++;
                $this->em->persist($article);
            }
        }
        try {
            echo "Saving articles.... \n";
            $this->em->flush();
        } catch (UniqueConstraintViolationException $e) {
            echo "There are some duplicate articles.\n";
        }
        echo "Saved ".$n." new articles.\n";
    }
}