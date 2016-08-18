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
        switch ($input->getArgument('source')) {
            case 'jutarnji':
                $scraper = $this->getContainer()->get('jutarnji-scraper');
                $articles = $scraper->fetchArticles();
                $persistence = $this->getContainer()->get('persist-articles');
                $persistence->persistArticles($articles);
                break;

            case 'index':
                $scraper = $this->getContainer()->get('index-scraper');
                $articles = $scraper->fetchArticles();
                $persistence = $this->getContainer()->get('persist-articles');
                $persistence->persistArticles($articles);
                break;

            default:
                $output->writeln('Invalid argument! Valid sources are: jutarnji index');

        }
    }
}