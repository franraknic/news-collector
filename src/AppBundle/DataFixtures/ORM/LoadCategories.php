<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Category;
use Faker;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface{

    public function load(ObjectManager $manager){

        for ($i = 1; $i <= 40; $i++) {

            $faker = Faker\Factory::create();

            $dummyCategory = new Category();
            $dummyCategory->setName($faker->word);
            $dummyCategory->setVisible(True);
            $this->addReference("category" . $i, $dummyCategory);
            $manager->persist($dummyCategory);
        }

        $manager->flush();

    }

    public function getOrder(){
        return 1;
    }
}