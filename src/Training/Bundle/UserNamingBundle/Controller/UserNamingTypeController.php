<?php

namespace Training\Bundle\UserNamingBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class UserNamingTypeController
{
    /**
     * @Route("/", name="training_user_naming_index")
     * @Template("@UserNaming/user_naming/index.html.twig")
     */
    public function index()
    {
    }

    /**
     * @Route("/show/{id}", name="training_user_naming_show")
     * @Template("@UserNaming/user_naming/show.html.twig")
     * @param UserNamingType $type
     * @return void
     */
    public function show(UserNamingType $type)
    {

    }

    /**
     * @Route("/create", name="training_user_naming_create")
     */
    public function create()
    {

    }
}
