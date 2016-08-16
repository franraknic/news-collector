<?php
/**
 * Created by PhpStorm.
 * User: fraknic
 * Date: 16.08.16.
 * Time: 15:58
 */

namespace AppBundle\Service\Scraper;


class JazzeraScraper extends BaseScraper implements ScraperInterface
{

    /**
     * Returns array of URLs for source pages.
     * E.g. site.com/news site.com/sport
     * @return array
     */
    protected function getSourcePages()
    {
        array(

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
     */
    protected function fetchArticleUrlsFromPage($sourcePageUrl)
    {
        // TODO: Implement fetchArticleUrlsFromPage() method.
    }

    public function fetchArticles()
    {
        // TODO: Implement fetchArticles() method.
    }
}