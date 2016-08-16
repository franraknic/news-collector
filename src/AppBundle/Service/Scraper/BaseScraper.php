<?php

namespace AppBundle\Service\Scraper;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;


abstract class BaseScraper implements ScraperInterface
{

    /**
     * Returns array of URLs for source pages.
     * E.g. site.com/news site.com/sport
     * @return array
     */
    protected abstract function getSourcePages();

    /**
     * Returns array of articles from given URL
     * @todo move to class extension
     * @param $articleUrls
     */
    protected abstract function processUrls($articleUrls,$id);

    /**
     * Returns array of article URLS
     * @todo move to class extension
     * @param $sourcePageUrl
     */
    protected abstract function fetchArticleUrlsFromPage($sourcePageUrl);

    public function fetchArticles()
    {
        $sourcePages = $this->getSourcePages();
        $articles=array();
        foreach ($sourcePages as $sourcePage) {
            $newUrls = $this->fetchArticleUrlsFromPage($sourcePage);
            var_dump($newUrls);
            $id=array_search($sourcePage,$sourcePages);
            $articles1=$this->processUrls($newUrls,$id);
            $articles = array_merge($articles,$articles1);
        }

        return $articles;

    }


}