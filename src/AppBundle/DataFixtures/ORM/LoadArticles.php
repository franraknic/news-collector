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
        for ($i = 0; $i < 100; $i++) {

            $faker = Faker\Factory::create('hr_HR');

            $dummyArticle = new Article();
            $dummyArticle->setTitle($faker->lastName);
            $dummyArticle->setContent($faker->text(4000));
            $dummyArticle->setSource($faker->domainName);
            $dummyArticle->setVisible(rand(0,1));
            $dummyArticle->setDateScraped($faker->dateTimeBetween('-1 days','now'));
            $dummyArticle->setDatePublished($faker->dateTimeBetween('-3 days', '-2 days'));
            $dummyArticle->setLink($faker->url);
            $dummyArticle->setMediaLink($faker->imageUrl);

            for ($n = 1; $n <= 20; $n++){
                if (rand(0,100) % 7 == 0){
                    $dummyArticle->addCategory($this->getReference('category'.$n));
                }
            }


            $manager->persist($dummyArticle);
            }
        $manager->flush();
    }

    public function getOrder()
    {
        return 100;
    }
}
