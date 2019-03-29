<?php

namespace App\Controller;

use App\Entity\BackLinkLog;
use App\Form\BackLinkLogType;
use App\Repository\BackLinkLogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/log")
 */
class BackLinkLogController extends AbstractController
{
    /**
     * @Route("/list", name="back_link_log_index", methods={"GET"})
     */
    public function index(BackLinkLogRepository $backLinkLogRepository): Response
    {
        return $this->render('back_link_log/index.html.twig', [
            'back_link_logs' => $backLinkLogRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="back_link_log_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $backLinkLog = new BackLinkLog();
        $form = $this->createForm(BackLinkLogType::class, $backLinkLog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($backLinkLog);
            $entityManager->flush();

            return $this->redirectToRoute('back_link_log_index');
        }

        return $this->render('back_link_log/new.html.twig', [
            'back_link_log' => $backLinkLog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_link_log_show", methods={"GET"})
     */
    public function show(BackLinkLog $backLinkLog): Response
    {
        return $this->render('back_link_log/show.html.twig', [
            'back_link_log' => $backLinkLog,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="back_link_log_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BackLinkLog $backLinkLog): Response
    {
        $form = $this->createForm(BackLinkLogType::class, $backLinkLog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('back_link_log_index', [
                'id' => $backLinkLog->getId(),
            ]);
        }

        return $this->render('back_link_log/edit.html.twig', [
            'back_link_log' => $backLinkLog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_link_log_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BackLinkLog $backLinkLog): Response
    {
        if ($this->isCsrfTokenValid('delete'.$backLinkLog->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($backLinkLog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('back_link_log_index');
    }
}
