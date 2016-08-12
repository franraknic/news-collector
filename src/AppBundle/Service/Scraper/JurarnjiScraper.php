<?php

namespace AppBundle\Service\Scraper;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class JutarnjiScraper extends BaseScraper
{
    /**
     * Returns array of URLs for source pages.
     * E.g. site.com/news site.com/sport
     * @return array
     */
    protected function getSourcePages()
    {
        return array(
            [
                'http://www.jutarnji.hr/vijesti/hrvatska',
                'http://www.jutarnji.hr/vijesti/svijet',
                'http://www.jutarnji.hr/vijesti/crna-kronika',
                'http://www.jutarnji.hr/sport/nogomet',
                'http://www.jutarnji.hr/sport/kosarka',
                'http://www.jutarnji.hr/sport/tenis',
                'http://www.jutarnji.hr/biznis/financije-i-trzista',
                'http://www.jutarnji.hr/biznis/tvrtke',
                'http://www.jutarnji.hr/biznis/karijere',
            ]
        );
    }

    /**
     * Returns array of articles from given URL
     * @todo move to class extension
     * @param $articleUrls
     */
    protected function processUrls($articleUrls)
    {
        // TODO: Implement processUrls() method.
    }

    /**
     * Returns array of article URLS
     * @todo move to class extension
     * @param $sourcePageUrl
     * @return array
     */
    protected function fetchArticleUrlsFromPage($sourcePageUrl)
    {
        $client = new Client();
        $articleUrls = [];
        foreach ($sourcePageUrl as $url) {
            $crawler = $client->request('GET', $url);
            for ($i = 1; $i <= 15; $i++) {
                $crawler->filter('body > div . container > section > div . row . jl - scroll - container > div . col - sm - 8 > section:nth - child(2) > article:nth - child('.$i.') > div > div . media - body > h4 > a')
                    ->each(function ($node){
                        $articleUrls[] = $node;
                    });
            }
        }
        return $articleUrls;
    }

    public function fetchArticles()
    {
    }
}