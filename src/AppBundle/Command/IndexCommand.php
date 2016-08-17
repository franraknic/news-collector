<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class IndexCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('scrape:index')
            ->setDescription('Scrapes index.hr for articles.');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $scraper = $this->getContainer()->get('index-scraper');
        $articles = $scraper->fetchArticles();
        $persistence = $this->getContainer()->get('persist-articles');
        $persistence->persistArticles($articles);

    }
}