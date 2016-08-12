<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use AppBundle\Entity\Article;

class Test2Controller extends Controller
{
    /**
     * @Route("/testpage", name="testpage")
     */
    public function indexAction(Request $request)
    {
        $sourcePageUrl='http://www.index.hr/vijesti/clanak/glas-koncila-neposlusna-zena-je-ona-koja-trazi-jednakosti/912366.aspx';
        $client = new Client();
        $article = new Article();
        $crawler = $client->request('GET', $sourcePageUrl);
        $article->setTitle($crawler->filter('#article_title_inner h1')->first()->text());
        $article->setLink($sourcePageUrl);
        $article->setSource("index.hr");
        $article->setVisible(true);

        $article->setContent(implode(" ",$crawler->filter('#article_text > p')->each(function ($node){
            return $node->text();
        })));
        return new Response('<html><body>'.$article->getContent().'</body></html>');
    }
}
