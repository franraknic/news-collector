<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;
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

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            15/*limit per page*/,array(
                'defaultSortFieldName' => array('a.dateScraped', 'a.source'),
                'defaultSortDirection' => 'dsc',
            )
        );

        $categories=$em->getRepository('AppBundle:Category')->createQueryBuilder('c')
            ->where('c.visible=1')->getQuery()->getResult();


        return array('pagination' => $pagination, 'categories' => $categories);
    }

    /**
     * @Route("/cat/{category_id}", name="category")
     * @Template("AppBundle:Default:index.html.twig")
     */
    public function categoryAction(Request $request, $category_id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Article');
        $query = $repository->createQueryBuilder('a')
            ->innerJoin('a.categories', 'c')
            ->where('c.visible = 1 AND a.visible = 1 AND c.id='.$category_id);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            15/*limit per page*/,array(
                'defaultSortFieldName' => array('a.dateScraped', 'a.source'),
                'defaultSortDirection' => 'dsc',
            )
        );


        return array('pagination' => $pagination , 'categories' => null);
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
