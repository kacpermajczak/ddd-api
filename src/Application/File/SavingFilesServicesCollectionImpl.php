<?php

declare(strict_types=1);

namespace App\Application\File;

use App\Application\File\Csv\ProductSavingCsvService;
use App\Application\File\Markdown\SavingMarkdownService;

final class SavingFilesServicesCollectionImpl implements SavingFilesServicesCollection
{
    private ProductSavingCsvService $savingCsvService;
    private SavingMarkdownService $savingMarkdownService;

    public function __construct(
        ProductSavingCsvService $savingCsvService,
        SavingMarkdownService $savingMarkdownService
    ) {
        $this->savingCsvService = $savingCsvService;
        $this->savingMarkdownService = $savingMarkdownService;
    }

    /**
     * @return SavingFileService[]
     */
    public function getServices(): array
    {
        return [
            $this->savingCsvService,
            $this->savingMarkdownService,
        ];
    }
}
