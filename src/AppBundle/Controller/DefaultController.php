<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $rep = $this->getDoctrine()->getRepository('AppBundle:Article');
        $articles = $rep->findAll();

        return $this->render('default/public.html.twig', array('articles' => $articles));
    }

    /**
     * @Route("/cat/{category}", name="category")
     */
    public function categoryAction(Request $request, $category)
    {
        $rep = $this->getDoctrine()->getRepository('AppBundle:Category');

        $cat = $rep->findOneBy(array('name' => $category));

        return $this->render('default/public.html.twig', array('articles' => $cat->getArticles()));
    }
}
