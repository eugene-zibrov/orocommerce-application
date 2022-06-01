<?php

namespace Training\Bundle\UserNamingBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;
use Training\Bundle\UserNamingBundle\Form\Type\UserNamingFormType;

class UserNamingTypeController extends AbstractController
{
    /**
     * @Route("/", name="training_user_naming_index")
     * @Template("@UserNaming/UserNaming/index.html.twig")
     */
    public function indexAction()
    {
        return [
            'entity_class' => UserNamingType::class
        ];
    }

    /**
     * @Route("/show/{id}", name="training_user_naming_show", methods={"GET"})
     * @Template("@UserNaming/UserNaming/show.html.twig")
     */
    public function showAction(UserNamingType $type)
    {
        return [
            'entity' => $type
        ];
    }

    /**
     * @Route("/delete/{id}", name="training_user_naming_delete", methods={"DELETE"})
     */
    public function deleteAction(UserNamingType $type)
    {
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();
        $em->remove($type);
        $em->flush();
        return new Response('', Response::HTTP_OK);
    }

    /**
     * @Route("/create", name="training_user_naming_create", methods={"GET","POST"})
     * @Template("@UserNaming/UserNaming/create.html.twig")
     */
    public function createAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->save($request);
            return $this->redirectToRoute('training_user_naming_index');
        }
        return $this->populateForm();
    }

    /**
     * @Route("/edit/{id}", name="training_user_naming_update", methods={"GET","POST"})
     * @Template("@UserNaming/UserNaming/edit.html.twig")
     */
    public function updateAction(UserNamingType $type)
    {
        return $this->populateForm($type);
    }

    public function save(Request $request, UserNamingType $type = null): void
    {
        $userNaming = is_null($type) ? new UserNamingType() : $type;
        $form       = $this->createForm(UserNamingFormType::class, $userNaming);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $doctrine = $this->container->get('doctrine');
            $em = $doctrine->getManager();
            $em->persist($data);
            $em->flush();
        }
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

    private function populateForm(?UserNamingType $type = null): array
    {
        $form = $this->createForm(UserNamingFormType::class, $type);

        return [
            'entity' => $type,
            'form' => $form->createView()
        ];
    }
}
