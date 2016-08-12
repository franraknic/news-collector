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
        // TODO: Implement getSourcePages() method.
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
     */
    protected function fetchArticleUrlsFromPage($sourcePageUrl)
    {
        // TODO: Implement fetchArticleUrlsFromPage() method.
    }

    public function fetchArticles()
    {
    }
}