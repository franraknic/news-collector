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
            CategoryId::hrvatska => 'Hrvatska',
            CategoryId::zagreb => 'Zagreb',
            CategoryId::regija => 'Regija',
            CategoryId::svijet => 'Svijet',
            CategoryId::crna_kronika => 'Crna kronika',
            CategoryId::nogomet => 'Nogomet',
            CategoryId::kosarka => 'Košarka',
            CategoryId::tenis => 'Tenis',
            CategoryId::financije_i_trzista => 'Financije i tržišta',
            CategoryId::tvrtke => 'Tvrtke',
            CategoryId::karijere => 'Karijere',
          );

        foreach ($categories as $id => $category) {

            $category = new Category($category);
            $category->setVisible(1);
            $category->setId($id);
            $em->persist($category);
        }
        $em->flush();
    }
}