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
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Article');
        $query = $repository->createQueryBuilder('a')
            ->innerJoin('a.categories', 'c')
            ->where('c.visible = 1 AND a.visible = 1');
        $articles = $query->getQuery()->getResult();


        return array('articles' => $articles);
    }

    /**
     * @Route("/cat/{category_id}", name="category")
     * @Template("AppBundle:Default:index.html.twig")
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
     * @Template("AppBundle:Default:show_article.html.twig")
     */
    public function showAction(Request $request, $id)
    {
        $rep = $this->getDoctrine()->getRepository('AppBundle:Article');
        $article = $rep->findOneBy(array('id' => $id));
        return array('article' => $article);
    }
}
