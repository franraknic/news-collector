<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Article;
use Faker;





class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface{

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 500; $i++) {

            $faker = Faker\Factory::create();

            $dummyArticle = new Article();
            $dummyArticle->setTitle($faker->streetName);
            $dummyArticle->setContent($faker->text($maxNbChars = 200));
            $dummyArticle->setSource($faker->domainName);
            $dummyArticle->setVisible(rand(0,1));
            $dummyArticle->setDateScraped($faker->dateTime($max = 'now'));
            $dummyArticle->setDatePublished($faker->dateTime($max = 'now'));
            $dummyArticle->setLink($faker->url);
            $dummyArticle->addCategory($this->getReference("category".rand(1,25)));
            $manager->persist($dummyArticle);

        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 100;
    }
}
