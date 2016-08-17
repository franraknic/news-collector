<?php

namespace AppBundle\Command;

use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Service\Scraper\CategoryId;

class CreateCategoriesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('categories:create')
            ->setDescription('Creates hardcoded categories.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doc = $this->getContainer()->get('doctrine');
        $em = $doc->getManager();
        $categories = array(
            CategoryId::hrvatska => 'hrvatska',
            CategoryId::zagreb => 'zagreb',
            CategoryId::regija => 'regija',
            CategoryId::svijet => 'svijet',
            CategoryId::crna_kronika => 'crna kronika',
            CategoryId::nogomet => 'nogomet',
            CategoryId::kosarka => 'kosarka',
            CategoryId::tenis => 'tenis',
            CategoryId::financije_i_trzista => 'financije i trzista',
            CategoryId::tvrtke => 'tvrtke',
            CategoryId::karijere => 'karijere',
    );
        foreach ($categories as $category) {

            $category = new Category($category);
            $id = array_search($category, $categories);
            $category->setVisible(1);
            $category->setId($id);
            $em->persist($category);
        }
        $em->flush();
    }
}