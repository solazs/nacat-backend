<?php

namespace Nacat\BackendBundle\Controller;


use Nacat\BackendBundle\Form\RegistrationType;
use Nacat\DataBundle\Entity\Editor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NacatUserController extends Controller
{
    /**
     * @Route("/editors")
     * @Method({"POST"})
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createEditor(Request $request)
    {
        /** @var \FOS\UserBundle\Model\UserManagerInterface $userManager */
        $userManager = $this->container->get('fos_user.user_manager');
        /** @var \Nacat\DataBundle\Entity\Editor $user */
        $user = $userManager->createUser();
        return $this->handleForm($user, $request, $userManager);
    }

    /**
     * @Route("/editors/{id}")
     * @Method({"POST"})
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param int                                       $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateEditor(Request $request, $id)
    {
        /** @var \FOS\UserBundle\Model\UserManagerInterface $userManager */
        $userManager = $this->container->get('fos_user.user_manager');
        /** @var \Nacat\DataBundle\Entity\Editor $user */
        $user = $userManager->findUserBy(['id' => $id]);
        if (!$user) {
            throw new NotFoundHttpException('User not found.');
        }
        return $this->handleForm($user, $request, $userManager);
    }

    private function handleForm(Editor $user, Request $request, $userManager)
    {
        $data = $request->getContent();
        $params = json_decode($data, true);
        if (!$params || !is_array($params)){
            throw new BadRequestHttpException('Invalid JSON or null content.');
        }
        if (array_key_exists('password', $params)) {
            $params['plainPassword'] = ['first' => $params['password'], 'second' => $params['password']];
            unset($params['password']);
        }
        $form = $this->createForm(RegistrationType::class, $user);
        $form->submit($params, false);
        if ($form->isValid()) {
            $user = $form->getData();
            if (array_key_exists('plainPassword', $params)){
                $user->setPlainPassword($params['plainPassword']);
            }
            $user->setEnabled(true);
            $userManager->updateUser($user, true);
            $response = new Response();
            $response->headers->set('Content-type', 'application/json');
            $response->setStatusCode(201);
            $serializer = $this->get('jms_serializer');
            $jsonData = $serializer->serialize(
              ["data" => $user, "meta" => []],
              "json"
            );
            $response->setContent($jsonData);
            return $response;
        } else {
            $response = new Response();
            $response->headers->set('Content-type', 'application/json');
            $response->setStatusCode(400);
            $serializer = $this->get('jms_serializer');
            $jsonData = $serializer->serialize(
              ["data" => $form, "meta" => []],
              "json"
            );
            $response->setContent($jsonData);
            return $response;
        }
    }
}