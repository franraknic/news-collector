<?php

/** TODO:
 * Koristiti Faker library za generiranje vise podataka*/

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Category;

class LoadCategoryData implements FixtureInterface{

    public function load(ObjectManager $manager){

        $dummyCategory = new Category();
        $dummyCategory->setName('Sport');
        $dummyCategory->setVisible(True);
        $dummyCategory->setArticles(['test', 'test1']);

        $manager->persist($dummyCategory);
        $manager->flush();

    }
}