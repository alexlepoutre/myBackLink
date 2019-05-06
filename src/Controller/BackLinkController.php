<?php

namespace App\Controller;

use App\Entity\BackLink;
use App\Form\BackLinkType;
use App\Entity\BackLinkLog;
use App\Repository\BackLinkRepository;
use App\Repository\BackLinkLogRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BackLinkController extends AbstractController
{
    /**
     * @Route("/", name="back_link_index", methods={"GET"})
     */
    public function index(BackLinkRepository $backLinkRepository): Response
    {
        return $this->render('back_link/index.html.twig', [
            'back_links' => $backLinkRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/new", name="back_link_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $backLink = new BackLink();
        $form = $this->createForm(BackLinkType::class, $backLink);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($backLink);
            $entityManager->flush();

            return $this->redirectToRoute('back_link_index');
        }

        return $this->render('back_link/new.html.twig', [
            'back_link' => $backLink,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/cron", name="back_link_cron", methods={"GET"})
     */
    public function blcron(BackLinkRepository $backLinkRepository, BackLinkLogRepository $backLinkLogRepository): Response
    {
        $backLinks = $backLinkRepository->findAll();

        foreach ( $backLinks as $backLink ) {

            $backLinkLog = new BackLinkLog;

            $backLinkLog->setCreatedAt(new \DateTime('now'));

            $site = $backLink->getMySite();
            $url = $backLink->getHisSite();

            if (preg_match("#$site(.*)</a>#Ui", file_get_contents($url), $titre) != '') 
            {
                $backLinkLog->setFoundIt(true);
                $backLinkLog->setLogText($backLink->getMySite() . substr($titre[1],0,255));
                $backLink->setFoundIt(true);
            }
            else
            {
                $backLinkLog->setFoundIt(false);
                $backLinkLog->setLogText('');
                $backLink->setFoundIt(false);
            }
            
            
            $backLinkLog->setBackLink($backLink);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($backLinkLog);
            $entityManager->persist($backLink);
        }

        $entityManager->flush();

        return $this->redirectToRoute('back_link_index');
        
    }

    /**
     * @Route("/admin/{id}/show", name="back_link_show", methods={"GET"})
     */
    public function show(BackLinkLogRepository $backLinkLogRepository, BackLink $backLink): Response
    {
        return $this->render('back_link/show.html.twig', [
            'back_link' => $backLink,
            'back_link_logs' => $backLinkLogRepository->findBy(array('BackLink' => $backLink->getId())),
        ]);
    }

    /**
     * @Route("/admin/{id}/edit", name="back_link_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BackLink $backLink): Response
    {
        $form = $this->createForm(BackLinkType::class, $backLink);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('back_link_index', [
                'id' => $backLink->getId(),
            ]);
        }

        return $this->render('back_link/edit.html.twig', [
            'back_link' => $backLink,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/{id}/analyse", name="back_link_analyse", methods={"GET","POST"})
     */
    public function analyse(BackLinkLogRepository $backLinkLogRepository, BackLink $backLink): Response
    {
        $backLinkLog = new BackLinkLog;

        $backLinkLog->setCreatedAt(new \DateTime('now'));

        $site = $backLink->getMySite();
        $url = $backLink->getHisSite();

        if (preg_match("#$site(.*)</a>#Ui", file_get_contents($url), $titre) != '') 
        {
            $backLinkLog->setFoundIt(true);
            $backLinkLog->setLogText($backLink->getMySite() . substr($titre[1],0,255));
        }
        else
        {
            $backLinkLog->setFoundIt(false);
            $backLinkLog->setLogText('');
        }
        
        
        $backLinkLog->setBackLink($backLink);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($backLinkLog);
        $entityManager->flush();

        return $this->redirectToRoute('back_link_show', array('id' => $backLink->getId()));
        
    }

    /**
     * @Route("/admin/bl/{id}", name="back_link_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BackLink $backLink): Response
    {
        if ($this->isCsrfTokenValid('delete'.$backLink->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($backLink);
            $entityManager->flush();
        }

        return $this->redirectToRoute('back_link_index');
    }
}
