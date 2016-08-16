<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class JutarnjiCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('scrape:jutarnji')
            ->setDescription('Scrapes jutarnji.hr for articles.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $scraper = $this->getContainer()->get('jutarnji-scraper');
        $scraper->fetchArticles();

    }
}