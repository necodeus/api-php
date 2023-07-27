<?php

namespace App\Controller\Paper;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class SwaggerUiController extends AbstractController
{
    public function __invoke(Request $request)
    {
        return $this->render('doc.html.twig', [
            'swagger' => '/paper.json',
        ]);
    }
}
