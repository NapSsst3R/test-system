<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Application\ResultTest\ResultTestServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultTestController extends AbstractController
{
    public function __construct(
        private readonly ResultTestServiceInterface $resultTestService,
    ) {}

    #[Route(path: '/result/{testId}', name: 'result.test.controller')]
    public function resultTest(int $testId, Request $request): Response
    {
        $sessionId = $request->getSession()->getId();

        $data = $this->resultTestService->getResultInfo($testId, $sessionId);

        if (empty($data)) {
            // @todo catch Exception
            return new Response(
                // @todo error page
                $this->renderView('base.html.twig'),
                Response::HTTP_FORBIDDEN
            );
        }

        return $this->render('test/result.test.html.twig', $data);
    }
}
