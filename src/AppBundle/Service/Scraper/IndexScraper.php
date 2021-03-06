<?php

namespace AppBundle\Service\Scraper;

use AppBundle\Entity\Category;
use Goutte\Client;
use InvalidArgumentException;
use AppBundle\Entity\Article;
use Doctrine\ORM\EntityManager;


class IndexScraper extends BaseScraper
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
        $sourcePages = array(
            CategoryId::hrvatska => 'http://www.index.hr/vijesti/rubrika/hrvatska/22.aspx',
            CategoryId::zagreb => 'http://www.index.hr/vijesti/rubrika/zagreb/1553.aspx',
            CategoryId::regija => 'http://www.index.hr/vijesti/rubrika/regija/1540.aspx',
            CategoryId::svijet => 'http://www.index.hr/vijesti/rubrika/svijet/23.aspx',
            CategoryId::crna_kronika => 'http://www.index.hr/vijesti/rubrika/crna-kronika/46.aspx'
        );

        return $sourcePages;
    }

    /**
     * Returns array of articles from given URL
     * @param $articleUrls
     * @param $id
     * @return array
     */
    protected function processUrls($articleUrls,$id)
    {
        $articles = array();


        foreach ($articleUrls as $articleUrl) {

            $rep = $this->em->getRepository("AppBundle:Category");
            $cat = $rep->findOneBy(array("id" => $id));

            $client = new Client(['timeout' => 6.0]);
            $article = new Article();
            sleep(1);
            $crawler = $client->request('GET', $articleUrl);
            try {
                $title = $crawler->filter('#article_title_inner h1')->first()->text();
                $article->setTitle($title);
            } catch (InvalidArgumentException $e) {
                // todo print information about url
                continue;
            }
            $media=$crawler->filter( '#ContentPlaceHolder1_articleimage')->first()->attr("src");



            $article->setLink($articleUrl);
            $article->setSource("index.hr");
            $article->setVisible(true);
            $article->addCategory($cat);
            $article->setDateScraped(new \DateTime('now'));
            $article->setMediaLink($media);


            $nodeList = $crawler->filter('#article_text  p');
            $parsedNodes = $nodeList->each(function ($node) {
                try {
                    return $node->text();
                } catch (InvalidArgumentException $e) {
                    return "";
                }
            });
            $article->setContent(implode(" ", $parsedNodes));
            $articles[] = $article;

        }

        return $articles;
    }

    /**
     * Returns array of article URLS
     * @param $sourcePageUrl
     * @return array
     */
    protected function fetchArticleUrlsFromPage($sourcePageUrl)
    {
        $sourcePage = "http://www.index.hr";
        $client = new Client(['timeout' => 6.0]);

        sleep(1);
        $crawler = $client->request('GET', $sourcePageUrl);
        $articlesUrl = $crawler
            ->filter('.columnright')
            ->filter('.list_news')
            ->first()
            ->filter('a')
            ->each(function ($node) use ($sourcePage) {
                return $sourcePage . $node->attr('href');
            });

        return $articlesUrl;
    }
}