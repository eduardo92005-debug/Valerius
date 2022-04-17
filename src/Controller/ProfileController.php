<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Form\ProfileType;
use App\Repository\ProfileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProfileController extends AbstractController
{


    /**
     * @Route("profile/edit/{id}", name="app_profile_edit", methods={"GET", "POST"})
     */
    public function edit(int $id, Request $request, Profile $profile, ProfileRepository $profileRepository): Response
    {
        $current_profile = $profileRepository->find($id);
        $form = $this->createForm(ProfileType::class, $current_profile);
        $form->handleRequest($request);
        $current_user = $profile->getAssociateUser()->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            $profileRepository->add($current_profile);
        }

        return $this->renderForm('UserAdmin/profile/edit.html.twig', [
            'profile' => $profile,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_profile_delete", methods={"POST"})
     */
    public function delete(Request $request, Profile $profile, ProfileRepository $profileRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profile->getId(), $request->request->get('_token'))) {
            $profileRepository->remove($profile);
        }

        return $this->redirectToRoute('app_profile_delete');
    }
}
