<?php 

namespace App\Controller\Common\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\LinksRepository;

class LinkController extends AbstractController
{
    public function __construct(private LinksRepository $links)
    {
    }

    #[Route('/api/v1/links', name: 'links', host: '{common-api.localhost|common-api.necodeo.com}')]
    public function index(Request $request)
    {
        $httpReqUri = $request->query->get('url');

        $links = $this->links->findBy(['httpReqUri' => $httpReqUri]);

        return $this->json([
            'status' => 'ok',
            'links' => $links,
        ]);
    }
}