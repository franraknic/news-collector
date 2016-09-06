<?php
/**
 * Created by PhpStorm.
 * User: fraknic
 * Date: 16.08.16.
 * Time: 15:58
 */

namespace AppBundle\Service\Scraper;

use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManager;
use Goutte\Client;

class JazzeraScraper extends BaseScraper
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Returns array of URLs for source pages.
     * E.g. site.com/news site.com/sport
     * @return array
     */
    protected function getSourcePages()
    {
        return array(

            CategoryId::hrvatska => 'http://balkans.aljazeera.net/tag/hrvatska'
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
        $articleUrls = array();
        $client = new Client();
        $crawler = $client->request('GET', $sourcePageUrl);
        $newArticleUrls = $crawler->filter('div.description > h2 > a')
            ->each(function ($node) {
                return "http://balkans.aljazeera.net".$node->first()->attr('href');
            });
        $articleUrls = array_merge($articleUrls, $newArticleUrls);
    }

}