<?php

namespace AppBundle\Service\Scraper;

use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManager;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use AppBundle\Service\Scraper\CategoryId;

class JutarnjiScraper extends BaseScraper
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

            CategoryId::hrvatska => 'http://www.jutarnji.hr/vijesti/hrvatska',
            CategoryId::svijet => 'http://www.jutarnji.hr/vijesti/svijet',
            CategoryId::crna_kronika => 'http://www.jutarnji.hr/vijesti/crna-kronika',
            CategoryId::nogomet => 'http://www.jutarnji.hr/sport/nogomet',
            CategoryId::kosarka => 'http://www.jutarnji.hr/sport/kosarka',
            CategoryId::tenis => 'http://www.jutarnji.hr/sport/tenis',
            CategoryId::financije_i_trzista => 'http://www.jutarnji.hr/biznis/financije-i-trzista',
            CategoryId::tvrtke => 'http://www.jutarnji.hr/biznis/tvrtke',
            CategoryId::karijere => 'http://www.jutarnji.hr/biznis/karijere',

        );
    }

    /**
     * Returns array of articles from given URL
     * @param $articleUrls
     * @param $id
     * @return array
     */
    protected function processUrls($articleUrls, $id)
    {
        $rep = $this->em->getRepository("AppBundle:Category");
        $cat = $rep->findOneBy(array("id" => $id));
        $articles = array();
        $client = new Client();
        foreach ($articleUrls as $url) {
            echo "Scraping: " . $url . "\n";
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
            $media = $crawler->filter('body > div.container > section > div:nth-child(2) > div > section > article > div > div.img-container.picture > img')
                ->each(function ($node) {

                    return $node->attr('src');
                });

            $date_published = $crawler->filter('body > div.container > section > div:nth-child(2) > div > div > ul > li:nth-child(4) > p')
                ->each(function ($node) {
                    $d = $node->text();
                    $d = substr($d, 1, 10);
                    $d = str_replace('.', '-', $d);
                    $d = strtotime($d);
                    return date('Y-m-d', $d);
                });


            $article->setTitle(reset($title));
            $article->setContent(reset($content));
            $article->setLink($url);
            $article->setSource('jutarnji.hr');
            $article->setMediaLink(reset($media));
            $article->setDatePublished($date_published);
            $article->addCategory($cat);
        }
        return $articles;
    }

    /**
     * Returns array of article URLS
     * @param array
     * @return array
     */
    protected function fetchArticleUrlsFromPage($sourcePageUrl)
    {
        $articleUrls = array();
        $client = new Client();
        $crawler = $client->request('GET', $sourcePageUrl);
        for ($i = 1; $i <= 10; $i++) {
            $newArticleUrls = $crawler->filter('body > div.container > section > div.row.jl-scroll-container > div.col-sm-8 > section:nth-child(2) > article:nth-child(' . $i . ') > div > div.media-body > h4 > a ')
                ->each(function ($node) {
                    return $node->first()->attr('href');
                });

            $articleUrls = array_merge($articleUrls, $newArticleUrls);
        }

        return $articleUrls;
    }

}