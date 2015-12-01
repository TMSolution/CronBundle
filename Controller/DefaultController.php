<?php

namespace TMSolution\CronBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Core\SecurityBundle\Annotations\Permissions;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

class DefaultController extends Controller
{

    /**
     * @Permissions(rights={MaskBuilder::MASK_VIEW})
     */
    public function indexAction($name)
    {
        return $this->render('TMSolutionCronBundle:Default:index.html.twig', array('name' => $name));
    }

}
