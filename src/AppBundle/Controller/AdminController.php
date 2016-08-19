<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="adminpage")
     * @Template()
     */
    public function adminAction(Request $request)
    {


        return array();
    }

    /**
     * @Route("/admin/article/{page}",  defaults={"page": "1"} , name="article")
     * @Template()
     */
    public function articleAction(Request $request, $page)
    {
        //Podešavanje vidljivosti pojedinačnih članaka

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Article');
        //$articles = $repository->findBy(array(), array('dateScraped'=>'desc'));


        $query = $repository->createQueryBuilder('a');


        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', $page)/*page number*/,
            20/*limit per page*/, array(
                'defaultSortFieldName' => array('a.dateScraped', 'a.source'),
                'defaultSortDirection' => 'dsc',
            )
        );

        $articles = $pagination;
        $defaultData = array();
        $form = $this->createFormBuilder($defaultData)->add('save', SubmitType::class, array('label' => 'Unesi'));

        foreach ($articles as $article) {

            if ($article->getVisible()) {


                $form->add($article->getId(), CheckboxType::class,
                    array('required' => false, 'data' => true, 'label' => $article->getTitle()));
            } else {
                $form->add($article->getId(), CheckboxType::class,
                    array('required' => false, 'data' => false, 'label' => $article->getTitle()));
            }
        }
        $form = $form->getForm();


        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            foreach ($data as $id => $visible) {
                if ($visible == false) {
                    $visible = 0;
                } else {
                    $visible = 1;
                }
                $query = $em->createQuery("UPDATE AppBundle:Article a SET a.visible =" . $visible . " WHERE a.id=" . $id . " AND a.visible!=" . $visible);
                $result = $query->getResult();
            }

            return $this->redirectToRoute('adminpage');;
        }


        return array('pagination' => $articles, 'form' => $form->createView());
    }

    /**
     * @Route("/admin/source", name="sources")
     * @Template()
     */
    public function sourceAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('AppBundle:Article');
        $query = $repository->createQueryBuilder('a')
            ->select('a.source')
            ->distinct()
            ->getQuery();
        $sources = $query->getResult();
        $articles = $repository->findAll();

        $defaultData = array();
        $form = $this->createFormBuilder($defaultData);

        $tmpArr = [];
        foreach ($sources as $source){
            foreach ($source as $s){
                $tmpArr[] = str_replace('.', '-',$s);
            }
        }

        foreach ($tmpArr as $source){
            $form->add($source, CheckboxType::class,
                array('required' => false, 'data' => true, 'label' => $source));
        }
        $form = $form->add('save', SubmitType::class, array('label' => 'Unesi'))->getForm();

        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted()){
            $data = $form->getData();
            foreach ($data as $source => $visible) {
                if ($visible == false) {
                    $visible = 0;
                } else {
                    $visible = 1;
                }
                $query = $em->createQuery("UPDATE AppBundle:Article a SET a.visible =" . $visible . " WHERE a.source='".str_replace('-', '.',$source)."'");
                $result = $query->getResult();
            }
        }

        return array('form' => $form->createView());
    }


        /**
         * @Route("/admin/category", name="categories")
         * @param Request $request
         * @Template()
         * @return array
         */
        public function categoryAction(Request $request)
        {

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('AppBundle:Category');
            $categories = $repository->findAll();

            $defaultData = array();
            $form = $this->createFormBuilder($defaultData);

            foreach ($categories as $category) {

                if ($category->getVisible()) {


                    $form->add($category->getId(), CheckboxType::class,
                        array('required' => false, 'data' => true, 'label' => $category->getName()));
                } else {
                    $form->add($category->getId(), CheckboxType::class,
                        array('required' => false, 'data' => false, 'label' => $category->getName()));
                }
            }
            $form = $form->add('save', SubmitType::class, array('label' => 'Unesi'))->getForm();

            $form->handleRequest($request);

            if ($form->isValid() && $form->isSubmitted()) {
                $data = $form->getData();
                foreach ($data as $id => $visible) {
                    if ($visible == false) {
                        $visible = 0;
                    } else {
                        $visible = 1;
                    }
                    $query = $em->createQuery("UPDATE AppBundle:Category c SET c.visible =" . $visible . " WHERE c.id=" . $id . " AND c.visible!=" . $visible);
                    $result = $query->getResult();
                }

                return $this->redirectToRoute('adminpage');
            }
            return array('categories' => $category, 'form' => $form->createView());
        }

        /**
         * @Route("/admin/scraping-info", name="show_scraping_info")
         * @Template()
         */
        public
        function showScrapingInfoAction(Request $request)
        {

            $em = $this->getDoctrine()->getManager();
            $repositoryA = $em->getRepository('AppBundle:Article');
            $query = $repositoryA->createQueryBuilder('a')
                ->innerJoin('a.categories', 'c');
            $sourceQuery = $repositoryA->createQueryBuilder('a')
                ->select('a.source')
                ->distinct();
            $sources = $sourceQuery->getQuery()->getResult();
            $articles = $query->getQuery()->getResult();
            $repositoryB = $em->getRepository('AppBundle:Category');
            $cats = $repositoryB->findAll();
            return array('categories' => $cats, 'articles' => $articles, 'sources' => $sources);

        }
    }
