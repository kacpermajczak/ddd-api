<?php

declare(strict_types=1);

namespace App\Application\File\Markdown;

use App\Application\File\RemodelCollectionPolicy;
use App\Application\File\SavingFileService;
use App\Application\ProductsWithCategoriesResult;

final class SavingMarkdownService implements SavingFileService
{
    private RemodelCollectionPolicy $policy;

    public function save(ProductsWithCategoriesResult $productsWithCategoriesResult): void
    {
        $this->policy->remodelCollection($productsWithCategoriesResult);
        //todo - implement rendering markdown
    }

    public function setPolicy(RemodelCollectionPolicy $policy): void
    {
        $this->policy = $policy;
    }
}
