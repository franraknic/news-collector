<?php

namespace AppBundle\Service\Scraper;

use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManager;
use Goutte\Client;

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

            if($id == 6 || $id == 7 || $id == 8){

                $title = $crawler->filter('body > div.container > section > div.row.articleWrapper > div.header.ahh.col-sm-12 > h1')
                    ->each(function ($node) {

                        return $node->text();
                    });

                $article->setTitle(reset($title));
                $article->setContent(reset($content));
                $article->setLink($url);
                $article->setSource('jutarnji.hr');
                $article->setMediaLink(reset($media));
                $article->setDateScraped(new \DateTime('now'));
                $article->addCategory($cat);
                $article->setVisible(true);

                $articles[] = $article;
            }else {


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


                $article->setTitle(reset($title));
                $article->setContent(reset($content));
                $article->setLink($url);
                $article->setSource('jutarnji.hr');
                $article->setMediaLink(reset($media));
                $article->setDateScraped(new \DateTime('now'));
                $article->addCategory($cat);
                $article->setVisible(true);

                $articles[] = $article;
            }
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
        for ($i = 1; $i <= 15; $i++) {
            $newArticleUrls = $crawler->filter('body > div.container > section > div.row.jl-scroll-container > div.col-sm-8 > section:nth-child(2) > article:nth-child(' . $i . ') > div > div.media-body > h4 > a ')
                ->each(function ($node) {
                    return $node->first()->attr('href');
                });

            $articleUrls = array_merge($articleUrls, $newArticleUrls);
        }

        return $articleUrls;
    }

}