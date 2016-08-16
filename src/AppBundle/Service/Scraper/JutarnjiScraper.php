<?php

namespace AppBundle\Service\Scraper;

use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManager;
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
        return array(

            1 => 'http://www.jutarnji.hr/vijesti/hrvatska',
            2 => 'http://www.jutarnji.hr/vijesti/svijet',
            3 => 'http://www.jutarnji.hr/vijesti/crna-kronika',
            4 => 'http://www.jutarnji.hr/sport/nogomet',
            5 => 'http://www.jutarnji.hr/sport/kosarka',
            6 => 'http://www.jutarnji.hr/sport/tenis',
            7 => 'http://www.jutarnji.hr/biznis/financije-i-trzista',
            8 => 'http://www.jutarnji.hr/biznis/tvrtke',
            9 => 'http://www.jutarnji.hr/biznis/karijere',

        );
    }

    /**
     * Returns array of articles from given URL
     * @param $articleUrls
     * @return array
     */
    protected function processUrls($articleUrls, $id)
    {

        $articles = array();
        foreach ($articleUrls as $url) {
            echo "Scraping: " . $url . "\n";
            $client = new Client();
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