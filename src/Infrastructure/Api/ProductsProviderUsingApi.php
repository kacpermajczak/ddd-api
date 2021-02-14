<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Application\ProductsCollection;
use App\Application\ProductsProvider;
use App\Application\ProvideProducts;
use App\Domain\Product;
use App\Infrastructure\Common\JsonHandler;
use Assert\InvalidArgumentException;
use Safe\Exceptions\JsonException;
use Symfony\Component\HttpFoundation\Request;

final class ProductsProviderUsingApi implements ProductsProvider
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

    public function provide(ProvideProducts $command): ProductsCollection
    {
        $jsonData = $this->handleRequest($command);
        $decodedData = $this->decodeRequest($jsonData)['products'];

        return $this->createCollection($decodedData);
    }

    private function decodeRequest(string $jsonData): array
    {
        try {
            $decodedData = $this->jsonHandler->jsonDecode($jsonData, true);
        } catch (JsonException $previous) {
            throw CouldNotLoadProducts::becauseJsonStructureIsInvalid($jsonData, $previous);
        }

        return $decodedData;
    }

    private function createCollection(array $products): ProductsCollection
    {
        try {
            $collection = ProductsCollection::empty();
            foreach ($products as $product) {
                $collection->addProduct(
                    Product::fromScalars(
                        $product['id'],
                        $product['title'],
                        $product['category'],
                        $product['price'],
                    )
                );
            }
        } catch (InvalidArgumentException $exception) {
            throw CouldNotLoadProducts::becauseJsonDataIsInvalid($exception->getMessage());
        }

        return $collection;
    }

    private function handleRequest(ProvideProducts $command): string
    {
        return $this->requestHandler->handleRequest($command->getProductsUrl(), Request::METHOD_GET);
    }
}
