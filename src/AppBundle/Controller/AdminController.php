<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/admin/option_1", name="option_1")
     * @Template()
     */
    public function option_1Action(Request $request)
    {
        //Podešavanje vidljivosti pojedinačnih članaka

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Article');
        $query = $repository->createQueryBuilder('a')
            ->innerJoin('a.categories', 'c');
        $articles = $query->getQuery()->getResult();


        $defaultData = array();
        $form = $this->createFormBuilder($defaultData);
        foreach ($articles as $article) {

            if ($article->getVisible()) {


                $form->add($article->getId(), CheckboxType::class, array('required' => false, 'data' => true, 'label' => $article->getTitle()));
            } else {
                $form->add($article->getId(), CheckboxType::class, array('required' => false, 'data' => false, 'label' => $article->getTitle()));
            }
        }
        $form = $form->add('save', SubmitType::class, array('label' => 'Unesi'))->getForm();


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
                $query = $em->createQuery("UPDATE AppBundle:Article a SET a.visible =" . $visible . " WHERE a.id=" . $id." AND a.visible!=".$visible);
                $result = $query->getResult();
            }

            return $this->redirectToRoute('option_1');;
        }


        return array('articles' => $articles, 'form' => $form->createView());
    }
}
