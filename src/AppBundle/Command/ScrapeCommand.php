<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ScrapeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('scrape:source')
            ->setDescription('Scrapes the provided source. Current sources: jutarnji index')
            ->addArgument('source', InputArgument::REQUIRED, 'Source to be scraped!');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $persistence = $this->getContainer()->get('persist-articles');
        $sources = array('jutarnji' => 'jutarnji-scraper', 'index' => 'index-scraper');
        foreach ($sources as $arg => $cont) {
            if ($input->getArgument('source') == $arg) {
                $scraper = $this->getContainer()->get($cont);
                $articles = $scraper->fetchArticles();
                $persistence->persistArticles($articles);
            }
        }
    }
}