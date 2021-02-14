<?php

declare(strict_types=1);

namespace App\Application\File;

use App\Application\File\Csv\ProductSavingCsvService;
use App\Application\File\Csv\RemodelCollectionForCsvPolicy;
use App\Application\File\Markdown\RemodelCollectionForMarkdownPolicy;
use App\Application\File\Markdown\SavingMarkdownService;

final class SavingFilesServicesCollectionImpl implements SavingFilesServicesCollection
{
    private ProductSavingCsvService $savingCsvService;
    private SavingMarkdownService $savingMarkdownService;
    private RemodelCollectionForCsvPolicy $collectionForCsvPolicy;
    private RemodelCollectionForMarkdownPolicy $collectionForMarkdownPolicy;

    public function __construct(
        ProductSavingCsvService $savingCsvService,
        SavingMarkdownService $savingMarkdownService,
        RemodelCollectionForCsvPolicy $collectionForCsvPolicy,
        RemodelCollectionForMarkdownPolicy $collectionForMarkdownPolicy
    ) {
        $this->savingCsvService = $savingCsvService;
        $this->savingMarkdownService = $savingMarkdownService;
        $this->collectionForCsvPolicy = $collectionForCsvPolicy;
        $this->collectionForMarkdownPolicy = $collectionForMarkdownPolicy;
    }

    /**
     * @return SavingFileService[]
     */
    public function getServices(): array
    {
        $this->savingCsvService->setPolicy($this->collectionForCsvPolicy);
        $this->savingMarkdownService->setPolicy($this->collectionForMarkdownPolicy);

        return [
            $this->savingCsvService,
            $this->savingMarkdownService,
        ];
    }
}
