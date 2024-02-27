<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Application\Form\PassTheTestType;
use App\Application\PassTest\FormData\CollectServiceInterface;
use App\Application\PassTest\SubmitForm\SubmitFormServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PassTestController extends AbstractController
{
    public function __construct(
        private readonly CollectServiceInterface $collectFormData,
        private readonly SubmitFormServiceInterface $submitService
    ) {
        $this->collectFormData->handle();
    }

    #[Route(path: '/', name: 'pass.test.controller')]
    public function passTest(Request $request): Response
    {
        // @todo catch Exceptions and show error pages
        $form = $this->createForm(PassTheTestType::class, null, [
            'action' => $this->generateUrl('pass.test.controller'),
            'method' => 'POST',
            'questions' => $this->collectFormData->getQuestions(),
            'choices' => $this->collectFormData->getChoices(),
            'compound' => true,
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $test = $this->submitService->handle($form->getData(), $this->collectFormData->getQuestions());

            return $this->redirectToRoute('result.test.controller', ['testId' => $test->getId()]);
        }

        return $this->render('test/pass.test.html.twig', [
            'form' => $form,
        ]);
    }
}
