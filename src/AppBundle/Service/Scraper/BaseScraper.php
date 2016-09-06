<?php

namespace AppBundle\Service\Scraper;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;


abstract class BaseScraper
{

    /**
     * Returns array of URLs for source pages.
     * E.g. site.com/news site.com/sport
     * @return array
     */
    protected abstract function getSourcePages();

    /**
     * Returns array of articles from given URL
     * @param $articleUrls
     * @param $id
     */
    protected abstract function processUrls($articleUrls, $id);

    /**
     * Returns array of article URLS
     * @param $sourcePageUrl
     */
    protected abstract function fetchArticleUrlsFromPage($sourcePageUrl);

    public function fetchArticles()
    {
        $sourcePages = $this->getSourcePages();
        $articles = array();
        foreach ($sourcePages as $sourcePage) {
            $articleUrls = $this->fetchArticleUrlsFromPage($sourcePage);
            $id = array_search($sourcePage, $sourcePages);
            $articles1 = $this->processUrls($articleUrls, $id);
            #$articles = array_merge($articles, $articles1);
        }

        return $articles;

    }


}