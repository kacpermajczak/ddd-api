<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use App\Application\GetProductsWithCategories;
use App\Infrastructure\Common\JsonHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class TransformProductsController extends AbstractController
{
    private MessageBusInterface $messageBus;
    private JsonHandler $jsonHandler;

    public function __construct(MessageBusInterface $messageBus, JsonHandler $jsonHandler)
    {
        $this->messageBus = $messageBus;
        $this->jsonHandler = $jsonHandler;
    }

    /**
     * @Route("/transformProducts", methods={"POST"})
     */
    public function transformProducts(Request $request): JsonResponse
    {
        $content = $this->jsonHandler->jsonDecode($request->getContent());
        $this->messageBus->dispatch(
            GetProductsWithCategories::fromUrl($content->products, $content->categories)
        );

        return new JsonResponse(null, Response::HTTP_ACCEPTED);
    }
}
