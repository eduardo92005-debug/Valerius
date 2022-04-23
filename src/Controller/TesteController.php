<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Form\Profile1Type;
use App\Repository\ProfileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/teste")
 */
class TesteController extends AbstractController
{
    /**
     * @Route("/", name="app_teste_index", methods={"GET"})
     */
    public function index(ProfileRepository $profileRepository): Response
    {
        return $this->render('teste/index.html.twig', [
            'profiles' => $profileRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_teste_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProfileRepository $profileRepository): Response
    {
        $profile = new Profile();
        $form = $this->createForm(Profile1Type::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profileRepository->add($profile);
            return $this->redirectToRoute('app_teste_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('teste/new.html.twig', [
            'profile' => $profile,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_teste_show", methods={"GET"})
     */
    public function show(Profile $profile): Response
    {
        return $this->render('teste/show.html.twig', [
            'profile' => $profile,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_teste_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Profile $profile, ProfileRepository $profileRepository): Response
    {
        $form = $this->createForm(Profile1Type::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profileRepository->add($profile);
            return $this->redirectToRoute('app_teste_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('teste/edit.html.twig', [
            'profile' => $profile,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_teste_delete", methods={"POST"})
     */
    public function delete(Request $request, Profile $profile, ProfileRepository $profileRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profile->getId(), $request->request->get('_token'))) {
            $profileRepository->remove($profile);
        }

        return $this->redirectToRoute('app_teste_index', [], Response::HTTP_SEE_OTHER);
    }
}
