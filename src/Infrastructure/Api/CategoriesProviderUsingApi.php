<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Application\CategoriesProvider;
use App\Application\CategoryMap;
use App\Application\CategoryMapsCollection;
use App\Application\ProvideCategories;
use App\Domain\Category;
use App\Infrastructure\Common\JsonHandler;
use Assert\InvalidArgumentException;
use Safe\Exceptions\JsonException;
use Symfony\Component\HttpFoundation\Request;

final class CategoriesProviderUsingApi implements CategoriesProvider
{
    private GuzzleRequestHandler $requestHandler;
    private JsonHandler $jsonHandler;

    public function __construct(
        GuzzleRequestHandler $requestHandler,
        JsonHandler $jsonHandler
    ) {
        $this->requestHandler = $requestHandler;
        $this->jsonHandler = $jsonHandler;
    }

    public function provide(ProvideCategories $command): CategoryMapsCollection
    {
        $jsonData = $this->handleRequest($command);
        $decodedData = $this->decodeRequest($jsonData)['categories'];

        return $this->createCategoryMapsCollection($decodedData);
    }

    private function decodeRequest(string $jsonData): array
    {
        try {
            $decodedData = $this->jsonHandler->jsonDecode($jsonData, true);
        } catch (JsonException $previous) {
            throw CouldNotLoadCategories::becauseJsonStructureIsInvalid($jsonData, $previous);
        }

        return $decodedData;
    }

    private function createCategoryMapsCollection(array $decodedData): CategoryMapsCollection
    {
        try {
            $categoriesCollection = CategoryMapsCollection::empty();
            foreach ($decodedData as $category) {
                $categoriesCollection->add(
                    CategoryMap::fromPair(
                        Category::fromString($category['old']),
                        Category::fromString($category['new'])
                    )
                );
            }
        } catch (InvalidArgumentException $exception) {
            throw CouldNotLoadCategories::becauseJsonDataIsInvalid($exception->getMessage());
        }

        return $categoriesCollection;
    }

    private function handleRequest(ProvideCategories $command): string
    {
        return $this->requestHandler->handleRequest($command->getCategoriesUrl(), Request::METHOD_GET);
    }
}
