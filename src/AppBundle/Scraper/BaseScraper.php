<?php

namespace AppBundle\Scraper;

require_once 'vendor/autoload.php';
use Goutte\Client;

// Placeholder for Scrape class
class BaseScraper
{

    public function dummy()
    {
        /*
        $client = new Client();
        $crawler = $client->request('GET', 'http://www.index.hr/sport/');
        $content = [];
        $content['title'] = $crawler->filterXPath('//*[@id="main_container"]/div/div[2]/div[2]/div/div[3]/div[2]/div/div/div[3]')->first()->text();
        $crawler->filter('#article_text p')->each(function ($node) use (&$content) {
            $content['body'][] = $node->text();
        });
        var_dump($content);
        */
        echo "Hello from the container. \n";
        echo "BaseScraper class.\n";
        return 0;
    }
}