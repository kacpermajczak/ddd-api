<?php

declare(strict_types=1);

namespace App\Infrastructure\SymfonyBus;

use App\Application\ApplicationFacade;
use App\Application\GetProductsWithCategories;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetProductsWithCategoriesHandler implements MessageHandlerInterface
{
    private ApplicationFacade $application;

    public function __construct(ApplicationFacade $application)
    {
        $this->application = $application;
    }

    public function __invoke(GetProductsWithCategories $getProductsWithCategories): void
    {
        $this->application->saveFilesWithProducts($getProductsWithCategories);
    }
}
