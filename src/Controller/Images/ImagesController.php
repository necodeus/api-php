<?php 

namespace App\Controller\Images;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ImagesRepository;

class ImagesController extends AbstractController
{
    public function __construct(private ImagesRepository $images)
    {
    }

    #[Route('/{id}', name: 'images', host: 'images.localhost')]
    public function index($id): BinaryFileResponse
    {
        $image = $this->images->findOneBy([
            'id' => $id,
        ]);

        if (!$image) {
            throw $this->createNotFoundException('The image does not exist');
        }

        return new BinaryFileResponse(
            '/var/www/html' . $image->localPath,
            Response::HTTP_OK,
            [
                'Content-Type' => $image->mimeType,
            ]
        );
    }
}
