<?php

namespace Training\Bundle\UserNamingBundle\Controller;

use Oro\Bundle\EntityBundle\ORM\DoctrineHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class UserNamingTypeController extends AbstractController
{
    /**
     * @Route("/", name="training_user_naming_index")
     * @Template("@UserNaming/UserNaming/index.html.twig")
     */
    public function index()
    {
    }

    /**
     * @Route("/show/{id}", name="training_user_naming_show", methods={"GET"})
     * @Template("@UserNaming/UserNaming/show.html.twig")
     */
    public function show(UserNamingType $type)
    {
        return [
            'entity' => $type
        ];
    }

    /**
     * @Route("/delete/{id}", name="training_user_naming_delete", methods={"DELETE"})
     */
    public function delete(UserNamingType $type)
    {
        $doctrine = $this->container->get(DoctrineHelper::class);
        $doctrine->getManager()->remove($type);
        return new Response('', Response::HTTP_ACCEPTED);
    }

    /**
     * @Route("/create", name="training_user_naming_create", methods={"POST"})
     */
    public function create(Request $request)
    {

    }

    /**
     * @Route("/widget/{id}", name="training_user_naming_widget")
     * @Template("@UserNaming/UserNaming/Widget/info.html.twig")
     */
    public function renderWidget(UserNamingType $type)
    {
        return [
            'entity' => $type
        ];
    }
}
