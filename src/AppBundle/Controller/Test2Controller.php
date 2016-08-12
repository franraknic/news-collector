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
        $sourcePage="http://www.index.hr";
        $client = new Client();
        $crawler = $client->request('GET',"http://www.index.hr/sport/" );
        $articlesUrl = $crawler
            ->filter('.columnright')
            ->filter('.list_news')
            ->first()
            ->filter('a')
            ->each(function ($node) use ($sourcePage) {
                return $sourcePage.$node->attr('href');
            });
        return new Response('<html><body>'.implode("<br>",$articlesUrl).'</body></html>');
    }
}
