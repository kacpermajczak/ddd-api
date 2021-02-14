<?php

declare(strict_types=1);

namespace App\Application;

interface ProductsProvider
{
    /**
     * core code knows about external services to connect with?
     * @see adr-002
     */
    public function provide(ProvideProducts $command): ProductsCollection;
}
