<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ScrapeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('scraper:portal')
            ->setDescription('Scrapes a certain portal or domain.')
            ->setHelp('Some text for --help user input')
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        #$output->writeln('I am a scraper. I scrape all day and I scrape all night!');
        $somescraper = $this->getContainer()->get('scraper_service');
        $somescraper->getRawContent();
    }
}