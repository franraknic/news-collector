<?php
/**
 * Created by PhpStorm.
 * User: fraknic
 * Date: 16.08.16.
 * Time: 15:58
 */

namespace AppBundle\Service\Scraper;


class JazzeraScraper extends BaseScraper
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
     * @param $articleUrls
     * @param $id
     */
    protected function processUrls($articleUrls, $id)
    {
        // TODO: Implement processUrls() method.
    }

    /**
     * Returns array of article URLS
     * @param $sourcePageUrl
     */
    protected function fetchArticleUrlsFromPage($sourcePageUrl)
    {
        // TODO: Implement fetchArticleUrlsFromPage() method.
    }

}