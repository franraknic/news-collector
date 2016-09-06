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
        $rep = $this->em->getRepository("AppBundle:Category");
        $cat = $rep->findOneBy(array("id" => $id));
        $articles = array();
        $client = new Client();
        foreach ($articleUrls as $url) {
            $article = new Article();
            $crawler = $client->request('GET', $url);
            $title = $crawler->filter('#node-565601 > section > section > article > div.wrapper > h1')
                ->each(function ($node) {

                    return $node->text();
                });

            echo reset($title);
            $article->setTitle(reset($title));
            $articles[] = $article;
        }
        return $articles;
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
                echo "http://balkans.aljazeera.net" . $node->first()->attr('href');
            });
        $articleUrls = array_merge($articleUrls, $newArticleUrls);
        return $articleUrls;
    }

}