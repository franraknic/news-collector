<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template("public.html.twig")
     */
    public function indexAction(Request $request)
    {
        $rep = $this->getDoctrine()->getRepository('AppBundle:Article');
        $articles = $rep->findBy(['visible' => true]);

        //neznam kako drugacije provjeriti je li kategorija vidljiva
        foreach ($articles as $article) {
            foreach ($article->getCategories() as $category) {
                if ($category->getVisible() == false) {
                    if (($key = array_search($article, $articles)) !== false) {
                        unset($articles[$key]);
                    }
                }
            }
        }

        return array('articles' => $articles);
    }

    /**
     * @Route("/cat/{category_id}", name="category")
     * @Template("public.html.twig")
     */
    public function categoryAction(Request $request, $category_id)
    {
        $rep = $this->getDoctrine()->getRepository('AppBundle:Category');

        $cat = $rep->findOneBy(array('id' => $category_id, 'visible' => true));

        if ($cat != null) {
            return array('articles' => $cat->getArticles());
        } else {
            return new Response("Nažalost, kategorija privremeno nije dostupna!");
        }
    }

    /**
     * @Route("/show/{id}", name="show_article")
     * @Template("show_article.html.twig")
     */
    public function showAction(Request $request, $id)
    {
        $rep = $this->getDoctrine()->getRepository('AppBundle:Article');
        $article = $rep->findOneBy(array('id' => $id));
        return array('article' => $article);
    }
}
