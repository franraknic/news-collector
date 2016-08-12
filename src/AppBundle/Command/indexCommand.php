<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class indexCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('scrape:index')
            ->setDescription('Scrapes index.hr for articles.')
            ->setHelp('Some text for --help user input');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $scraper = $this->getContainer()->get('index-scraper');
        $output->writeln('I am a scraper. I scrape all day and I scrape all night!');
    }
}