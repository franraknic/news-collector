<?php

namespace AppBundle\Service\Scraper;

use AppBundle\Entity\Article;
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

            'http://www.jutarnji.hr/vijesti/hrvatska',
            'http://www.jutarnji.hr/vijesti/svijet',
            'http://www.jutarnji.hr/vijesti/crna-kronika',
            'http://www.jutarnji.hr/sport/nogomet',
            'http://www.jutarnji.hr/sport/kosarka',
            'http://www.jutarnji.hr/sport/tenis',
            'http://www.jutarnji.hr/biznis/financije-i-trzista',
            'http://www.jutarnji.hr/biznis/tvrtke',
            'http://www.jutarnji.hr/biznis/karijere',

        );
    }

    /**
     * Returns array of articles from given URL
     * @param $articleUrls
     * @return array
     */
    protected function processUrls($articleUrls)
    {
        $articles = array();
        foreach ($articleUrls as $url) {
            echo "Scraping: " . $url . "\n";
            $client = new Client();
            $article = new Article();
            $crawler = $client->request('GET', $url);
            $title = $crawler->filter('body > div.container > section > div:nth-child(2) > div > div > h1')
                ->each(function ($node) {
                    return $node->text();
                });
            $content = $crawler->filter('body > div.container > section > div.row.article_body > div.col-sm-8 > div > section > div')
                ->each(function ($node) {
                    return $node->text();
                });

            $article->setTitle(reset($title));
            $article->setContent(reset($content));
            $article->setLink($url);
            $article->setSource('jutarnji.hr');
            $articles[] = $article;
        }
        return $articles;
    }

    /**
     * Returns array of article URLS
     * @param array
     * @return array
     */
    protected function fetchArticleUrlsFromPage($sourcePageUrls)
    {
        $articleUrls = array();
        foreach ($sourcePageUrls as $url) {
            echo "Gathering links from: " . $url . "\n";
            $client = new Client();
            $crawler = $client->request('GET', $url);
            for ($i = 1; $i <= 15; $i++) {
                $newArticleUrls = $crawler->filter('body > div.container > section > div.row.jl-scroll-container > div.col-sm-8 > section:nth-child(2) > article:nth-child(' . $i . ') > div > div.media-body > h4 > a ')
                    ->each(function ($node) {
                        #var_dump($node->first()-attr('href'));
                        return $node->first()->attr('href');
                    });

                $articleUrls = array_merge($articleUrls, $newArticleUrls);
            }
        }

        return $articleUrls;
    }

    public function fetchArticles()
    {
        $pageUrls = $this->getSourcePages();
        $articleUrls = $this->fetchArticleUrlsFromPage($pageUrls);
        $articles = $this->processUrls($articleUrls);
        echo "Scraped " . count($articles) . " articles!\n";
    }
}