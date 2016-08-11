<?php

namespace AppBundle\Scraper;

require_once 'vendor/autoload.php';
use Goutte\Client;

// Placeholder for Scrape class
class BaseScraper
{

    #submenu
    #submenu > li:nth-child(2) > a > cufon > canvas
    private $rawContent;

    public function getRawContent()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'http://www.index.hr/vijesti/');

        $content = [];

        foreach ($crawler->filter('#submenu > li > a > cufon ') as $link){
            $content[] = $link;
        }

        var_dump($content);
    }
}