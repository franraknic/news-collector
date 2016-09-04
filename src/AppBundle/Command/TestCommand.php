<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('scrape:test')
            ->setDescription('Scrapes the provided source without persisting. Current sources: jutarnji index jazzera')
            ->addArgument('source', InputArgument::REQUIRED, 'Source to be scraped!');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sources = array('jutarnji' => 'jutarnji-scraper', 'index' => 'index-scraper', 'jazzera' => 'jazzera-scraper');
        foreach ($sources as $arg => $cont) {
            if ($input->getArgument('source') == $arg) {
                $output->writeln(date("Y-m-d H:i:s")." Starting: ". $cont);
                $scraper = $this->getContainer()->get($cont);
                $articles = $scraper->fetchArticles();
                $output->writeln(date("Y-m-d H:i:s").' Scraped: '. $arg);
            }
        }
    }
}