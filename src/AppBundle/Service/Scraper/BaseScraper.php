<?php

namespace AppBundle\Service\Scraper;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;


abstract class BaseScraper implements ScraperInterface
{
    protected $rawCrawler;

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
    protected abstract function processUrls($articleUrls);

    /**
     * Returns array of article URLS
     * @todo move to class extension
     * @param $sourcePageUrl
     */
    protected abstract function fetchArticleUrlsFromPage($sourcePageUrl);


}