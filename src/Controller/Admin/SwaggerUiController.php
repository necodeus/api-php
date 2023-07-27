<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SwaggerUiController extends AbstractController
{
    public function __invoke(Request $request)
    {
        return $this->render('doc.html.twig', [
            'swagger' => '/admin.json',
        ]);
    }
}
