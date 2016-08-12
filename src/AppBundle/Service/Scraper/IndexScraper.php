<?php

namespace AppBundle\Service\Scraper;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;


class IndexScraper extends BaseScraper
{
    /**
     * Returns array of URLs for source pages.
     * E.g. site.com/news site.com/sport
     * @return array
     */
    protected function getSourcePages()
    {
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
    }

    public function fetchArticles()
    {
    }
}