<?php

namespace AppBundle\Service\Scraper;

use AppBundle\Entity\Category;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use AppBundle\Entity\Article;
use Symfony\Component\Validator\Constraints\DateTime;


class IndexScraper extends BaseScraper
{
    /**
     * Returns array of URLs for source pages.
     * E.g. site.com/news site.com/sport
     * @return array
     */
    protected function getSourcePages()
    {
        $sourcePages = array('http://www.index.hr/vijesti/');

        return $sourcePages;
    }

    /**
     * Returns array of articles from given URL
     * @param $articleUrls
     * @return array
     */
    protected function processUrls($articleUrls)
    {
        $articles = array();

        foreach ($articleUrls as $articleUrl) {



            //testno
            $category= new Category();
            $category->setName("vijesti");
            $category->setVisible(true);
            //-------


            
            $client = new Client();
            $article = new Article();
            $crawler = $client->request('GET', $articleUrl);
            $article->setTitle($crawler->filter('#article_title_inner h1')->first()->text());
            $article->setLink($articleUrl);
            $article->setSource("index.hr");
            $article->setVisible(true);
            $article->addCategory($category);

            $article->setContent(implode(" ", $crawler->filter('#article_text > p')->each(function ($node) {
                return $node->text();
            })));
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
        $sourcePage="http://www.index.hr";
        $client = new Client();
        $crawler = $client->request('GET', $sourcePageUrl);
        $articlesUrl = $crawler
            ->filter('.columnright')
            ->filter('.list_news')
            ->first()
            ->filter('a')
            ->each(function ($node) use ($sourcePage) {
                return $sourcePage.$node->attr('href');
            });

        return $articlesUrl;
    }

    public function fetchArticles()
    {
        $sourcePages = $this->getSourcePages();
        $articleUrls = array();
        foreach ($sourcePages as $sourcePage) {
            $newUrls = $this->fetchArticleUrlsFromPage($sourcePage);
            $articleUrls = array_merge($articleUrls, $newUrls);
        }

        $articles = $this->processUrls($articleUrls);

        return $articles;

    }
}