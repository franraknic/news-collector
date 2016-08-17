<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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



        return array();
    }
}
