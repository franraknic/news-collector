<?php

/** TODO:
 * Koristiti Faker library za generiranje vise podataka*/


namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Article;

class LoadArticleData implements FixtureInterface{

    public function load(ObjectManager $manager)
    {

        $dummyArticle = new Article();
        $dummyArticle->setTitle('Senzacionalna vijest');
        $dummyArticle->setContent('Najgore napisani clanak ikad.');
        $dummyArticle->setSource('24Sata');
        $dummyArticle->setCategories(['Zutilo', 'Politika']);
        $dummyArticle->setVisible(True);

        $manager->persist($dummyArticle);
        $manager->flush();
    }
}
