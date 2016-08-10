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

            $faker = Faker\Factory::create('hr_HR');

            $dummyArticle = new Article();
            $dummyArticle->setTitle($faker->lastName);
            $dummyArticle->setContent($faker->text(200));
            $dummyArticle->setSource($faker->domainName);
            $dummyArticle->setVisible(rand(0,1));
            $dummyArticle->setDateScraped($faker->dateTimeBetween('-1 days','now'));
            $dummyArticle->setDatePublished($faker->dateTimeBetween('-3 days', '-2 days'));
            $dummyArticle->setLink($faker->url);
            $dummyArticle->setMediaLink($faker->imageUrl);
            $dummyArticle->addCategory($this->getReference("category" . rand(1, 25)));
            $manager->persist($dummyArticle);

        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 100;
    }
}
