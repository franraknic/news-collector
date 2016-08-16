<?php

namespace AppBundle\Command;

use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCategoriesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('categories:create')
            ->setDescription('Creates hardcoded categories.')
            ->setHelp('Some text for --help user input');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doc = $this->getContainer()->get('doctrine');
        $em = $doc->getManager();
        $categories = array('hrvatska', 'zagreb', 'regija', 'svijet', 'crna kronika');
        foreach ($categories as $category) {

            $category = new Category($category);
            $category->setVisible(1);
            $em->persist($category);
            $em->flush();
        }

    }
}